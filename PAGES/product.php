<?php
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php'; //connect to database

//initialise variables for better handling of the query string
  $productName = "";
  $price = "";
  $productType = "";
  $description = "";
  $availableStock = "";
  $image = "";
  $alert = "";
  $userID = $_SESSION['ID'];
  $ID = $_SESSION['productID'];
  $query = "SELECT * FROM `products` WHERE `ProductID` = '$ID'";
  if($product_info = mysqli_fetch_assoc(mysqli_query($conn, $query))){
    $productName = $product_info['ProductName'];
    $price = $product_info['Price'];
    $productType = $product_info['ProductType'];
    $description = $product_info['Description'];
    $availableStock = $product_info['AvailableStock'];
    $image = $product_info['Image'];

    if($image == NULL) {
      $image = "no-preview-available.png";
    } else { $image = "/image_upload/" . $image; }
  }

//When pressing on the BUY button, first check if demanded units exceed available stock
if(isset($_POST['buy'])){
  $addUnits = mysqli_real_escape_string($conn, $_POST['units']);
  if($availableStock < $addUnits) {
    $alert = "Not enough units in stock";
  } else {
    $alert = "Item added to cart";
    $query = "SELECT `BasketID`, `Amount` FROM `basket` WHERE `UserID` = '$userID' AND `ProductID` = '$ID' LIMIT 1"; //query the database to see if the user already has that item in their cart
	  $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

    // if that user already has that item in the cart but want to purchase more, update the entry instead of creating new ones
	  if ($result) {
         $basketID = $result['BasketID'];
	   	   $newAmount = $result['Amount'] + $_POST['units'];
         mysqli_query($conn, "UPDATE `basket` SET `Amount` = '$newAmount' WHERE `basket`.`BasketID` = '$basketID';");
	    } else {
         mysqli_query($conn, "INSERT INTO `basket` (`BasketID`, `UserID`, `ProductID`, `Amount`) VALUES (NULL, '$userID', '$ID', '$addUnits');");
      }
	  }
  }
//INSERT INTO `basket` (`BasketID`, `UserID`, `ProductID`, `Amount`) VALUES (NULL, '9', '1', '2');

if($alert != ""){ //display alert if demand exceeds stock
  echo "<script> alert('$alert')</script>";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../STYLES/main_style.css">
    <link rel="stylesheet" href="../STYLES/login_style.css">

    <link rel="icon" href="../MEDIA/cybertek.ico" type="image/ico">
    <title>CATALOG_</title>
    <style>
    </style>
</head>

<body>
  <div id="parallax_2"></div>

  <div class="container-flow">
  <div class="content col-sm-10 col-md-8"></div>
  <!-- HEADER STARTS HERE -->
  <?php include 'customer_header.html'; ?>
  <!-- HEADER ENDS HERE -->

  <!-- Display product details -->
  <div class="row">
    <div class="hidden-xs col-md-1 col-lg-2"></div>
    <div class="col-xs-12 col-md-10 col-lg-8">
      <div class="profile-container">
        <div class="row">
          <div class="col-4">
            <img src="../MEDIA/<?php echo $image; ?>" style="width:100%; float:none;">
          </div>
          <div class="col-8">
            <div class ="row">
              <div class ="col-12">
                <h1><?php echo $productName ?></h1><br>
                <h2><u><?php echo $productType ?></u></h2><br>
                <h1><?php echo $price ?>$</h1><br>
                <h3>Availale: <?php echo $availableStock ?> units</h3>
                <p><?php echo $description ?></p>
              </div>
            </div>
            <div class ="row">
              <div class="col-12">
                <form id="my-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <table>
                    <tr><td><input type="number" value="1" min="1" max="25" name="units"></td>
                      <td><input type="submit" name="buy" value="Buy"></td></tr>
                    </table>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="hidden-xs col-md-1 cold-lg-2"></div>
  </div>

  <div class="row footer"></div>
  </div>

  <script>
    //Stops form resubmit popup
    if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); }

    //Display confirm popup on logout
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  </body>

  </html>
<?php $conn -> close(); ?>
