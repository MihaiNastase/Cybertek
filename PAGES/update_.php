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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userID = $_SESSION['userID'];
    $update = "UPDATE customers SET FirstName='$firstName', LastName='$lastName' WHERE UserID ='$userID' ";
    mysqli_query($conn, $update);
    $update_status = "Entry Updated!";
    unset($_POST['update_user']); //unset after query if the form is resumited on page reqest
  }

//update product details
  if(isset($_POST['update_product'])) {
    //TODO
    $update_status = "Entry Updated!";
    unset($_POST['update_product']); //unset after query if the form is resumited on page reqest
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
              <a href="<?php echo "admin_.php?" . $target; ?>">
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

    	<!-- Display forms here -->
      <?php
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
      </form>
      <?php
          endif;
        endif;

      ?>

    </div>
    <div class="hidden-xs col-sm-1 col-md-2"></div>
  </div>
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
