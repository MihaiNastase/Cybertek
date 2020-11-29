<?php
  session_start();
  $ypos = $_COOKIE["ypos"]; //use this to keep scroll position on page request (better accessibility)

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php'; //connect to database

//unset global variable for session action if the admin switches pages after update_.php
  if(isset($_SESSION['action'])) { unset($_SESSION['action']); }
  if(isset($_SESSION['target'])) { unset($_SESSION['target']); }


//set these actions and queries is the admin selected the profiles section
if($_GET['target'] == "profiles") {
  if(isset($_POST['update'])){
    $_SESSION['userID'] = $_POST['userID'];
    unset($_POST['userID']); //unset this POST variable to avoid a data leak
    $_SESSION['target'] = "profiles";
    $_SESSION['action'] = "updateProfile";
    header("location: update_.php");
    unset($_POST['update']); //unset POST variable so the querry is not ran again on page refresh
  }
  if(isset($_POST['delete'])){
    $query = "DELETE FROM customers WHERE UserID='" . $_POST['userID'] . "';";
    mysqli_query($conn, $query);
    unset($_POST['delete']); //unset POST variable so the querry is not ran again on page refresh
  }
}

//set these actions and queries is the admin selected the products section
if($_GET['target'] == "products") {
  if(isset($_POST['update'])){
    $_SESSION['productID'] = $_POST['productID'];
    unset($_POST['productID']); //unset this POST variable to avoid a data leak
    $_SESSION['target'] = "products";
    $_SESSION['action'] = "updateProduct";
    header("location: update_.php");
    unset($_POST['update']); //unset POST variable so the querry is not ran again on page refresh
  }
  if(isset($_POST['delete'])){
    $query = "DELETE FROM products WHERE ProductID='" . $_POST['productID'] . "';";
    mysqli_query($conn, $query);
    unset($_POST['delete']); //unset POST variable so the querry is not ran again on page refresh
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
    <title>ADMIN_</title>
    <style>
    </style>
</head>
<!--this solution for fixing scroll position does not work properly, find replacement-->
<body <?php echo "onScroll=\"document.cookie='$ypos=' + window.pageYOffset\" onLoad='window.scrollTo(0,$ypos)'"; ?> >
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
              <a href="admin_.php?target=products">
                <img src="../MEDIA/menu_buttons/add_product.png" alt="products">
                <figcaption>PRODUCTS_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="admin_.php?target=profiles">
                <img src="../MEDIA/menu_buttons/add_cust.png" alt="profiles">
                <figcaption>USERS_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="admin_dashboard.php?">
                <img src="../MEDIA/menu_buttons/logout.png" alt="back">
                <figcaption>BACK_</figcaption>
              </a>
            </figure>

        </div>
      </div>
      <div class="col-1">
        <div class="clock"></div>
      </div>
  </div>
  </div>
  </div>
  <!-- HEADER ENDS HERE -->
  <div class="row">
    <div class="hidden-xs col-sm-1 col-md-2"></div>
    <div class="col-sm-10 col-md-8">
    	<!-- Display tables here -->
      <?php
        if($_GET['target'] == "profiles") {
          include '../PHP/users_table.php'; //display tables containing users and amdmins
        } else if($_GET['target'] == "products") {
          include '../PHP/products_table.php'; //display tables containing products
        } else { header("location: admin_dashboard.php"); }
      ?>

    </div>
    <div class="hidden-xs col-sm-1 col-md-2"></div>
  </div>
  <div class="row">

  </div>
</div>

  <!-- Stops form resubmit popup -->
  <script>
    if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/tablesort.js"></script>

  <script src="../JS/parallax_2.js"></script>
  <script src="../JS/clock.js"></script>
  </body>
  </html>
  <?php $conn -> close(); ?>
