<?php
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php'; //connect to database

  //this if statements modify the link for the "BACK" button to redirect to the admin_.php page with the target previously used
  if($_SESSION['action']=="updateProfile") {
    $target = "target=profiles";
    if(isset($_POST['update_user'])){

    }
  } else if($_SESSION['action']=="updateProduct") {
    $target = "target=products";
  }

  $update_status = "";
//update customer profile
  if(isset($_POST['update_user'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $userID = $_SESSION['userID'];
    if (empty($firstName) || empty($lastName)){
      $update_status = "All fields required!";
    } else {
      $update = "UPDATE customers SET FirstName='$firstName', LastName='$lastName' WHERE UserID ='$userID' ";
      mysqli_query($conn, $update);
      $update_status = "Entry Updated!";
      unset($_POST['update_user']); //unset after query if the form is resumited on page reqest
    }
  }

//update product details
  if(isset($_POST['update_product'])) {
    $type = mysqli_real_escape_string($conn, $_POST['productType']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $productID = $_SESSION['productID'];

    //get uploaded fie
    $targetDir = "../MEDIA/image_upload/";
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png');
      if(in_array($fileType, $allowTypes)) {
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
          } else {
            $update_status = "File upload error!";
            $fileName = NULL;
          }
      }else{
        $update_status = '.jpg and .png only!';
        $fileName = NULL;
      }

    if (empty($type) || empty($price) || empty($description) || empty($stock)){
      $update_status = "All fields required!";
    } else {
      if($fileName == "") {
      $update = "UPDATE products SET ProductType='$type', Price='$price', Description='$description', AvailableStock='$stock' WHERE ProductID ='$productID'";
    } else { $update = "UPDATE products SET ProductType='$type', Price='$price', Description='$description', AvailableStock='$stock', Image='$fileName' WHERE ProductID ='$productID'"; }
      mysqli_query($conn, $update);
      $update_status = "Entry Updated!";
      unset($_POST['update_product']); //unset after query if the form is resumited on page reqest
    }
  }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../STYLES/main_style.css">
    <link rel="stylesheet" href="../STYLES/login_style.css">

    <link rel="icon" href="../MEDIA/cybertek.ico" type="image/ico">
    <title>UPDATE_</title>
    <style>
    </style>
</head>

<body>
  <div id="parallax_2"></div>

  <div class="container-flow">
  <div class="content col-sm-10 col-md-8"></div>
  <!-- HEADER STARTS HERE -->
    <?php include '../PHP/admin_header.php'; ?>
    <?php include '../PHP/admin_hamburger.php'; ?>
  <!-- HEADER ENDS HERE --------------------------------------------------------------------------->
  <div class="row">
    <div class="hidden-xs col-sm-1 col-md-2"></div>
    <div class="col-sm-10 col-md-8">

    	<!-- Display forms here -->
      <?php
      if($_SESSION['target'] == "profiles"):
        if(!isset($_SESSION['userID'])) : echo "<h1><span style='color:red;'>USER ID NOT FOUND</span></h1>";
          else :
          $query = "SELECT Email, FirstName, LastName FROM customers WHERE UserID =" . $_SESSION['userID'];
          $result = mysqli_query($conn, $query);
          if($result->num_rows === 0) :
            echo "<tr><td>No results</td></tr>";
          else :

            $data = mysqli_fetch_assoc($result);
            //print form
      ?>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <h2><u>Edit Entry: </u><?php echo $update_status; ?></h2>
      <div class="form-container">
        <table>
                    <tr>
                      <td><label>Email: </label></td>
                      <td><label><?php echo $data['Email']; ?></lable></td>
                    </tr>
                    <tr>
                      <td><label for="lname">First Name: </label></td>
                      <td><input type="text" name = "firstName" id="fname" value="<?php echo $data['FirstName'];?>"/></td>
                    </tr>
                    <tr>
                      <td><label for="mail">Last Name: </label></td>
                      <td><input type="text" name = "lastName" id="lname" value="<?php echo $data['LastName'];?>"/></td>
                    </tr>

          </table>
        </div>
                <button class="btn" type="submit" name="update_user">
                  <span class="btn__content">Update Entry</span>
                </button>

                <input type="reset" style="width:100px; height:50px; margin:auto; font-size:2em;">
      </form>
      <?php
          endif;
        endif;
      endif;
      ?> <!-- UPDATE CUSTOMER ENDS HERE --------------------------------------------------------------------------->

      <?php
      if($_SESSION['target'] == "products"):
        if(!isset($_SESSION['productID'])) : echo "<h1><span style='color:red;'>PRODUCT ID NOT FOUND</span></h1>";
          else :
          $query = "SELECT * FROM products WHERE ProductID =" . $_SESSION['productID'];
          $result = mysqli_query($conn, $query);
          if($result->num_rows === 0) :
            echo "<tr><td>No results</td></tr>";
          else :

            $data = mysqli_fetch_assoc($result);
            //print form
      ?>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <h2><u>Edit Entry: </u><?php echo $update_status; ?></h2>
      <div class="form-container">
        <table>
                    <tr>
                      <td><label>Name: </label></td>
                      <td><label><?php echo $data['ProductName']; ?></lable></td>
                    </tr>
                    <tr>
                      <td><label for="pt">Product Type: </label></td>
                      <td>
                        <select name = "productType" id="pt">
                          <option <?php if ($data['ProductType']  == 'Desktop PC') { echo "selected='true'";  } ?> value="Desktop PC">Desktop PC</option>
                          <option <?php if ($data['ProductType']  == 'Accessories') { echo "selected='true'";  } ?> value="Accessories">Accessories</option>
                          <option <?php if ($data['ProductType']  == 'Game Console') { echo "selected='true'";  } ?> value="Game Console">Game Console</option>
                          <option <?php if ($data['ProductType'] == 'Audio') { echo "selected='true'";  } ?> value="Audio">Audio</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><label for="">Price: </label></td>
                      <td><input type="text" name = "price" id="" value="<?php echo $data['Price'];?>"/></td>
                    </tr>
                    <tr>
                      <td><label for="desc">Description: </label></td>
                      <td><textarea name = "description" id="desc" ><?php echo $data['Description'];?></textarea></td>
                    </tr>
                    <tr>
                      <td><label for="">Available Stock: </label></td>
                      <td><input type="text" name = "stock" id="" value="<?php echo $data['AvailableStock'];?>"/></td>
                    </tr>
                    <tr>
                      <td><label for="">Image: </label></td>
                      <td>
                        <img src="
                          <?php
                            if($data['Image'] == NULL) {
                              echo "../MEDIA/no-preview-available.png";
                            } else {
                              echo "../MEDIA/image_upload/" . $data['Image'];
                            }

                          ?>
                        " width="200" height="200">
                      </td>
                    </tr>
                    <tr>
                      <td><label for="img">New Image: </label></td>
                      <td><input type="file" name = "image" id="img" /></td>
                    </tr>
          </table>
        </div>
                <button class="btn" type="submit" name="update_product">
                  <span class="btn__content">Update Entry</span>
                </button>

                <input type="reset" style="width:100px; height:50px; margin:auto; font-size:2em;">
      </form>
      <?php
          endif;
        endif;
      endif;
      ?> <!-- UPDATE PRODUCTS ENDS HERE --------------------------------------------------------------------------->

    </div>
    <div class="hidden-xs col-sm-1 col-md-2"></div>
  </div>

  <?php include 'footer.html'; ?>
</div>

  <!-- Stops form resubmit popup -->
  <script>
    if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  <script src="../JS/clock.js"></script>
  </body>

  </html>
