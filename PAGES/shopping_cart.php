<?php
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php';

  $userID = $_SESSION['ID'];

  $query = "SELECT * FROM `basket` WHERE `UserID`='$userID'";
  $results = mysqli_query($conn, $query);


  $productsToBuy = [];
  $total = [];
  //$_SESSION['acc_complete']

  if(isset($_POST['BUY'])){
    if($_SESSION['acc_complete']){
      if($_POST['alert']==""){
        $data = unserialize($_POST['data']);
        foreach ($data as $key => $value) {
          $adjustStock = "UPDATE `products` SET `AvailableStock`= `AvailableStock` - '$value' WHERE `ProductID` = '$key' ;";
          $emptyBasket = "DELETE FROM `basket` WHERE `UserID` = '$userID' AND `ProductID` = '$key' ;";
          mysqli_query($conn, $adjustStock);
          mysqli_query($conn, $emptyBasket);
          header("location:" . $_SERVER['PHP_SELF']);
        }
      } else { echo "<script> alert('$alert')</script>";}
    } else { echo "<script> alert('Please complete billing and payment info!')</script>"; }
  }

  $alert = "";

  if(isset($_POST['remove'])) {
    $entry = $_POST['entry'];
    $remove = "DELETE FROM `basket` WHERE `BasketID` = '$entry'";
    mysqli_query($conn, $remove);
    unset($_POST['remove']);
    header("location: " . $_SERVER['PHP_SELF']);
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
      <div class="profile-container basket">

      <table>
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
        <?php
          while($row = mysqli_fetch_assoc($results)){
            $productID = $row['ProductID'];
            $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `ProductName`, `Price`, `AvailableStock` FROM `products` WHERE `ProductID` = '$productID';"));
            array_push($total, ($row['Amount'] * $product['Price']));
            $productsToBuy[$productID] = $row['Amount'];
            if($row['Amount']>$product['AvailableStock']){
              $alert = "Some products in your basket are not in stock anymore!";
              echo "<tr class='red'><td>" . $product['ProductName'] . "</td><td>" . $row['Amount'] . "</td><td>" . $row['Amount'] * $product['Price'] . "$</td><td>" .
              "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'><input type='submit' name='remove' value='Remove'><input type='hidden' name='entry' value='" . $row['BasketID'] .  "'></form></td></tr>";
            } else {
            echo "<tr><td>" . $product['ProductName'] . "</td><td>" . $row['Amount'] . "</td><td>" . $row['Amount'] * $product['Price'] . "$</td><td>" .
              "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'><input type='submit' name='remove' value='Remove'><input type='hidden' name='entry' value='" . $row['BasketID'] . "'></form></td></tr>";
            }
          }
        ?>

        <tr>
          <td colspan="2">TOTAL:</td>
          <td> <?php echo array_sum($total); $dataString = htmlspecialchars(serialize($productsToBuy)); ?></td>
          <td><form method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>"><input type='submit' name='BUY' value='Buy'>
            <input type='hidden' name='data' value="<?php echo $dataString; ?>">
            <input type='hidden' name='alert' value="<?php echo $alert; ?>"></form></td>
        <tr>
      </tbody>
    </table>
      </div>
    </div>
    <div class="hidden-xs col-md-1 cold-lg-2"></div>
  </div>

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
