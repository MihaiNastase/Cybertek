<?php
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php';

  $email = "";
  $firstName = "";
  $lastName = "";
  $city = "";
  $firstLine = "";
  $secondLine = "";
  $cardNumber = "";
  $expDate = "";
  $cvs = "";

  $ID = $_SESSION['ID'];
  $query = "SELECT * FROM `customers` WHERE `UserID` = '$ID'";
  if($user_info = mysqli_fetch_assoc(mysqli_query($conn, $query))){
    $email = $user_info['Email'];
    $firstName = $user_info['FirstName'];
    $lastName = $user_info['LastName'];
    $city = $user_info['City'];
    $firstLine = $user_info['AddressFirstLine'];
    $secondLine = $user_info['AddressSecondLine'];
    $cardNumber = $user_info['CardNumber'];
    $expDate = $user_info['ExpiryDate'];
    $cvs = $user_info['CVS'];
  }

  if(isset($_POST['update_user'])) {
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $firstLine = mysqli_real_escape_string($conn, $_POST['firstLine']);
    $secondLine = mysqli_real_escape_string($conn, $_POST['secondLine']);
    $cardNumber = mysqli_real_escape_string($conn, $_POST['cardNumber']);
    $expDate = mysqli_real_escape_string($conn, $_POST['expiryDate']);
    $cvs = mysqli_real_escape_string($conn, $_POST['cvs']);
    $userID = $_SESSION['ID'];
      $update = "UPDATE `customers` SET `City`='$city', `AddressFirstLine`='$firstLine', `AddressSecondLine`='$secondLine', `CardNumber`='$cardNumber', `ExpiryDate`='$expDate', `CVS`= '$cvs' WHERE `UserID` = '$userID' ";
      if(!mysqli_query($conn, $update)){echo "Update failed";}
      unset($_POST['update_user']); //unset after query if the form is resumited on page reqest
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
  <div class="row">
    <div class="hidden-xs col-md-12 header">
      <div class="row">

        <div class="col-2"></div>
        <div class="col-3">
          <img src="../MEDIA/landing_page/logo.png" alt="CYBERTEK">
        </div>
        <div class="col-6">
          <div class="menu">

            <figure>
              <a href="customer_dashboard.php">
                <img src="../MEDIA/menu_buttons/catalog.png" alt="logout">
                <figcaption>STORE_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="customer_profile.php">
                <img src="../MEDIA/menu_buttons/profile.png" alt="logout">
                <figcaption>PROFILE_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="contact.php">
                <img src="../MEDIA/menu_buttons/contact.png" alt="logout">
                <figcaption>CONTACT_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="customer_dashboard.php?logout='1'" class="confirmation">
                <img src="../MEDIA/menu_buttons/logout.png" alt="logout">
                <figcaption>LOGOUT_</figcaption>
              </a>
            </figure>

        </div>
      </div>
      <div class="col-1">
        <figure>
          <a href="shopping_cart.php">
            <img src="../MEDIA/menu_buttons/cart.png" alt="cart">
            <figcaption>CART_</figcaption>
          </a>
        </figure>
      </div>
  </div>
  </div>
  </div>
  <!-- HEADER ENDS HERE -->

  <div class="row">
    <div class="hidden-xs col-md-1 col-lg-2"></div>
    <div class="col-xs-12 col-md-10 col-lg-8">
      <div class="profile-container">
        <img src = "../MEDIA/user-profile.png">
        <h1>USER <?php echo $firstName . " " . $lastName; ?></h1>
        <h1>EMAIL <?php echo $email; ?></h1>
      </div>
    </div>
    <div class="hidden-xs col-md-1 cold-lg-2"></div>
  </div>
  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="row">
      <div class="hidden-xs col-md-1 col-lg-2"></div>
      <div class="col-xs-12 col-md-10 col-lg-8">
        <div class="profile-container">
          <h2><u>Billing Address</u></h2>
          <table>
            <tr>
              <td>City</td>
              <td><input type ="text" name="city" value="<?php echo $city; ?>"/></td>
            </tr>
            <tr>
              <td>Address First Line</td>
              <td><input type ="text" name="firstLine" value="<?php echo $firstLine; ?>"/></td>
            </tr>
            <tr>
              <td>Address Secod Line</td>
              <td><input type ="text" name="secondLine" value="<?php echo $secondLine; ?>"/></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="hidden-xs col-md-1 cold-lg-2"></div>
    </div>

    <div class="row">
      <div class="hidden-xs col-md-1 col-lg-2"></div>
      <div class="col-xs-12 col-md-10 col-lg-8">
        <div class="profile-container">
          <h2><u>Payment</u></h2>
          <table>
            <tr>
              <td>Card Number</td>
              <td><input name="cardNumber" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" value="<?php echo $cardNumber; ?>"/></td>
            </tr>
            <tr>
              <td>Expiry Date</td>
              <td><input type="date" id="datefield" name="expiryDate" value="<?php echo $expDate; ?>"/></td>
            </tr>
            <tr>
              <td>CVS</td>
              <td><input class="cvs" name="cvs" type="tel" inputmode="numeric" pattern="[0-9]{3}" autocomplete="cvs-number" maxlength="3" placeholder="xxx" value="<?php echo $cvs; ?>"/></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="hidden-xs col-md-1 cold-lg-2"></div>
    </div>

    <div class="row">
      <div class="hidden-xs col-md-1 col-lg-2"></div>
      <div class="col-xs-12 col-md-10 col-lg-8">
        <button class="btn" type="submit" name="update_user" value="update_user">
          <span class="btn__content">SAVE</span>
        </button>
      </div>
      <div class="hidden-xs col-md-1 cold-lg-2"></div>
    </div>
  </form>
  <div class="row footer"></div>
  </div>



  <!-- Stops form resubmit popup -->
  <script>
    if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); }

    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
  </script>
<script> //Simple script to fix the min of the expiry date to today's date
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1;
  var yyyy = today.getFullYear();
   if(dd<10){
          dd='0'+dd
      }
      if(mm<10){
          mm='0'+mm
      }
  today = yyyy+'-'+mm+'-'+dd;
  document.getElementById("datefield").setAttribute("min", today);
</script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  </body>

  </html>
<?php $conn -> close(); ?>
