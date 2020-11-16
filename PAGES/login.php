<?php include('../PHP/database_login.php') ?>
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

        <div class = "form_shape">
          <?php include('../PHP/errors_login.php'); ?>
          <div class = "form_content">
            <form method="post" action="login.php">
              <table>
                          <tr>
                            <td>
                              <label for="mail">Email: </label>
                            </td>
                            <td>
                              <input type="text" name = "email" id="mail" value="<?php echo $email; ?>" />
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <label for="passwd">Password: </label>
                            </td>
                            <td>
                              <input type="password" name = "password" id="passwd" />
                            </td>
                          </tr>

                </table>
                        <button class="btn" type="submit" name="login_user">
                          <span class="btn__content">LOGIN_</span>
                        </button>
            </form>
          </div>
        </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  <script>
  (function() {
      // Add event listener
      document.addEventListener("mousemove", parallax);
      const elem = document.querySelector("#parallax_2");
      // Magic happens here
      function parallax(e) {
          let _w = window.innerWidth/2;
          let _h = window.innerHeight/2;
          let _mouseX = e.clientX;
          let _mouseY = e.clientY;
          let _depth1 = `${50 - (_mouseX - _w) * 0.01}% ${50 - (_mouseY - _h) * 0.01}%`;
          let _depth2 = `${50 - (_mouseX - _w) * 0.02}% ${50 - (_mouseY - _h) * 0.02}%`;
          let x = `${_depth2}, ${_depth1}`;
          //console.log(x);
          elem.style.backgroundPosition = x;
      }

  })();
  </script>
  <script>
  (function() {
    var element = document.getElementById("fail");
    if(typeof(element) != 'undefined' && element != null){
       document.querySelector(".form_shape").classList.add("fail");
   }


  })();
  </script>
  </body>

  </html>
