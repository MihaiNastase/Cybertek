<?php
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php';

  if(isset($_POST['go_to'])){
    $_SESSION['productID'] = $_POST['productID'];
    unset($_POST['productID']);
    header('location: product.php');
  }

  include '../PHP/parse_query.php';

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
      	<h1>Welcome <strong><?php echo $_SESSION['name']; ?></strong> \\_</h1>
      <?php endif ?>
    </div>
    <div class="hidden-xs col-sm-1 col-md-2"></div>
  </div>
  <?php
    $message = "";
    $check = "SELECT `City`,`AddressFirstLine`,`AddressSecondLine`,`CardNumber`,`ExpiryDate`,`CVS` FROM `customers` WHERE `UserID` = '" . $_SESSION['ID'] . "'";
    if($user_info = mysqli_fetch_assoc(mysqli_query($conn, $check))){
      if($user_info['City'] == NULL || $user_info['AddressFirstLine'] == NULL || $user_info['AddressSecondLine'] == NULL){
        $message = $message . "<h3>Please complete your billing address in PROFILE_!</h3>";
      }
      if($user_info['CardNumber'] == NULL || $user_info['CVS'] == NULL || $user_info['ExpiryDate'] == NULL){
        $message = $message . "<h3>Please provide all your payment details in PROFILE_!</h3>";
      }

      if($message != "") {
        echo "<div class='col-12 notification'>" . $message . "</div>";
        $_SESSION['acc_complete'] = FALSE;
      } else { $_SESSION['acc_complete'] = TRUE; }
    }
  ?>

  <div class="row">
    <div class="hidden-sm col-md-1 col-lg-2"></div>
    <div class="col-xs-12 col-md-10 col-lg-8">
      <div class="search-bar">
      <form method="post">

          <select name="priceSort">
            <option <?php if ($priceSort == 'Sort By Price') { echo "selected='true'";  } ?> value="Sort By Price">Sort By Price</option>
            <option <?php if ($priceSort == 'Sort Price Ascending') { echo "selected='true'";  } ?> value="Sort Price Ascending">Sort Price Ascending</option>
            <option <?php if ($priceSort == 'Sort Price Descending') { echo "selected='true'";  } ?> value="Sort Price Descending">Sort Price Descending</option>
          </select>

          <select name="typeSort">
            <option <?php if ($typeSort == 'Sort By Type') { echo "selected='true'";  } ?> value="Sort By Type">Sort By Type</option>
            <option <?php if ($typeSort  == 'Desktop PC') { echo "selected='true'";  } ?> value="Desktop PC">Desktop PC</option>
            <option <?php if ($typeSort  == 'Accessories') { echo "selected='true'";  } ?> value="Accessories">Accessories</option>
            <option <?php if ($typeSort  == 'Game Console') { echo "selected='true'";  } ?> value="Game Console">Game Console</option>
            <option <?php if ($typeSort  == 'Audio') { echo "selected='true'";  } ?> value="Audio">Audio</option>
          </select>

          <input type="text" name="searchValue" placeholder="Search..." value="<?php echo $searchValue ?>"/>
          <input type="submit" name="search" value="Search>>"/>

      </form>
    </div>
    </div>
    <div class="hidden-sm col-md-1 col-lg-2"></div>
  </div>
  <?php
    include '../PHP/display_results.php';
  ?>
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

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  </body>

  </html>
<?php $conn -> close(); ?>
