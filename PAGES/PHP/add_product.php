<?php
  if (isset($_POST['add_prod'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['productName']); //using _POST over _GET for security reasons
    $type = mysqli_real_escape_string($conn, $_POST['productType']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    //get uploaded fie
    $targetDir = "../MEDIA/image_upload/";
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


    // form validation: ensure that the form is correctly filled ...
    if (empty($name) || empty($type) || empty($price) || empty($description) || empty($stock)){
      $error = $error . "All fields required! ";
    }

    // first check the database to make sure an admin does not already exist with that name
    $product_check_query = "SELECT * FROM products WHERE ProductName='$name' LIMIT 1";
    $result = mysqli_query($conn, $product_check_query);
    $product = mysqli_fetch_assoc($result);

    if ($product) { // if product with the same name exists add error to the string
      if ($user['Name'] === $name) {
        $error = $error . "A product with that name already exist!";
      }
    }
    //file upload validation
    $allowTypes = array('jpg','png');
      if(in_array($fileType, $allowTypes)) {
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
          } else {
            $error = $error . "File upload error!";
          }
      }else{
        $error = $error . '.jpg and .png only!';
      }

    // Add product if there are no errors in the form
    if ($error == "") {
      //prepare the query to insert the new product data into the database
      $query = "INSERT INTO products (`ProductID`, `ProductName`, `Price`, `ProductType`, `Description`, `AvailableStock`, `Image`)
        VALUES (NULL, '$name', '$price', '$type', '$description', '$stock', '" . $fileName . "');";
      mysqli_query($conn, $query);
      echo "<meta http-equiv='refresh' content='0'>"; //refresh the page so the changes to the tables are immediatly visible
    }
}
?>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<h2><u>Add Product:</u><span style="color:red;"><?php echo $error; ?></span></h2>
<div class="form-container">
  <table>
              <tr>
                <td><label for="pname">Product Name: </label></td>
                <td><input type="text" name = "productName" id="pname"/></td>
              </tr>
              <tr>
                <td><label for="type">Product Type: </label></td>
                <td>
                  <select name="productType" id="type">
                    <option value="Desktop PC">Desktop PC</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Game Console">Game Console</option>
                    <option value="Audio">Audio</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label for="pr">Price: </label></td>
                <td><input type="text" name = "price" id="pr"/></td>
              </tr>
              <tr>
                <td><label for="desc">Description: </label></td>
                <td><textarea name = "description" id="desc" placeholder="Add description..."></textarea></td>
              </tr>
              <tr>
                <td><label for="st">Stock: </label></td>
                <td><input type="number" min="1" max="500" name = "stock" id="st"/></td>
              </tr>
              <tr>
                <td><label for="img">Image: </label></td>
                <td><input type="file" name = "image" id="img"/></td>
              </tr>
    </table>
  </div>
          <button class="btn" type="submit" name="add_prod">
            <span class="btn__content">Add</span>
          </button>
</form>
