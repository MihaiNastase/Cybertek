<?php
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php';

  $ID = $_SESSION['ID'];
  $query = "SELECT * FROM `customers` WHERE `UserID` = '$ID'";
  echo $query;
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
              <a href="customer_dashboard.php?logout='1'">
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
  <!-- HEADER STARTS HERE -->

  <div class="row">
    <div class="hidden-xs col-md-1 col-lg-2"></div>
    <div class="col-xs-12 col-md-10 col-lg-8">

    </div>
    <div class="hidden-xs col-md-1 cold-lg-2"></div>

  </div>
  <div class="row">
    <div class="hidden-xs col-md-1 col-lg-2"></div>
    <div class="col-xs-12 col-md-10 col-lg-8">

    </div>
    <div class="hidden-xs col-md-1 cold-lg-2"></div>

  </div>
  <div class="row">
    <div class="hidden-xs col-md-1 col-lg-2"></div>
    <div class="col-xs-12 col-md-10 col-lg-8">

    </div>
    <div class="hidden-xs col-md-1 cold-lg-2"></div>

  </div>

  <div class="row footer"></div>
  </div>

  <!-- Stops form resubmit popup -->
  <script>
    if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  </body>

  </html>
<?php $conn -> close(); ?>
