<? //TODO to be completed
  session_start();

  include '../PHP/check_login.php'; //check login status for session

  include '../PHP/dbconnect.php';

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
    <script src="../JS/magnifier.js">
    </script>
</head>

<body>
  <div id="parallax_2"></div>

  <div class="container-flow">
    <div class="content col-sm-10 col-md-8"></div>
    <!-- HEADER STARTS HERE -->
    <?php include 'customer_header.html'; ?>
    <?php include 'customer_hamburger.html'; ?>
    <!-- HEADER ENDS HERE -->

    <div class="row contact">
      <div class="hidden-xs col-md-1 col-lg-2"></div>
      <div class="col-xs-12 col-md-4 col-lg-3">
        <p>
          Reach us with an email at <a href="mailto:CyberTek@mail.com">CyberTek@mail.com</a> <br>
          OR <br>
          Via Phone at 077 7777 777 <br>
          <h2>Address:</h2>
          <ul>
            <li> Night City </li>
            <li> 07 Crane Road </li>
            <li> Kabuki Quarter </li>
          </ul>
        </p>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-5">
        <img id="cityMap" src="../MEDIA/map.png" >
      </div>
      <div class="hidden-xs col-md-1 cold-lg-2"></div>
    </div>

    <?php include 'footer.html'; ?>
  </div>
  <script>
    magnify(3);
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script src="../JS/parallax_2.js"></script>
  </body>

  </html>
