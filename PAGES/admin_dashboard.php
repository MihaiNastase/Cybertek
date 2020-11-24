<?php
  session_start();

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: index.html");
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
    <title>LOGIN_</title>
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
              <a href="admin_.php?target=products">
                <img src="../MEDIA/menu_buttons/add_product.png" alt="logout">
                <figcaption>PRODUCTS_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="admin_.php?target=profiles">
                <img src="../MEDIA/menu_buttons/add_cust.png" alt="logout">
                <figcaption>USERS_</figcaption>
              </a>
            </figure>

            <figure>
              <a href="admin_dashboard.php?logout='1'">
                <img src="../MEDIA/menu_buttons/logout.png" alt="logout">
                <figcaption>LOGOUT_</figcaption>
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
  <!-- HEADER EDNS HERE -->

  <div class="row">
    <div class="hidden-xs col-sm-1 col-md-2"></div>
    <div class="col-sm-10 col-md-8">
    	<!-- notification message -->
    	<?php if (isset($_SESSION['success'])) : ?>
        <script>
            <?php
              $message = $_SESSION['success'];
              echo "alert('$message');";
            	unset($_SESSION['success']);
            ?>
        </script>
    	<?php endif ?>
      <!-- logged in user information -->
      <?php  if (isset($_SESSION['name'])) : ?>
      	<h1>Welcome ADMIN <strong><?php echo $_SESSION['name']; ?></strong></h1>
      <?php endif ?>
    </div>
    <div class="hidden-xs col-sm-1 col-md-2"></div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  <script src="../JS/clock.js"></script>
  </body>

  </html>
