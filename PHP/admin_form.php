<?php
  if(!isset($_GET['action'])) { $_GET['action'] = "";}
  $error = "";
  if($_GET['action'] == "addCustomer"):
    if (isset($_POST['reg_user'])) {
      // receive all input values from the form
      $firstName = mysqli_real_escape_string($conn, $_POST['firstName']); //using _POST over _GET for security reasons
      $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      // form validation: ensure that the form is correctly filled ...
      if (empty($firstName) || empty($lastName) || empty($email) || empty($password)){
        $error = $error . "All fields required! ";
      }

      // first check the database to make sure a user does not already exist with that email
      $user_check_query = "SELECT * FROM customers WHERE email='$email' LIMIT 1";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) { // if user exists add that error to the string
        if ($user['Email'] === $email) {
          $error = $error . "An user with that email already exist!";
        }
      }

      // Add user if there are no errors in the form
      if ($error == "") {
        $password = md5($password);//encrypt the password before saving in the database

        //prepare the query to insert the new customer data into the database
        $query = "INSERT INTO customers (`UserID`, `Email`, `FirstName`, `LastName`, `Password`, `City`, `AddressFirstLine`, `AddressSecondLine`, `CardNumber`, `ExpiryDate`, `CVS`)
            VALUES (NULL, '$email', '$firstName', '$lastName', '$password', NULL, NULL, NULL, NULL, NULL, NULL)"; //these fields remain NULL untill a customer updates his credential after login
        mysqli_query($conn, $query);
        echo "<meta http-equiv='refresh' content='0'>"; //refresh the page so the changes to the tables are immediatly visible
      }
    }
?>
  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <h2><u>Add Customer:</u><span style="color:red;"><?php echo $error; ?></span></h2>
  <div class="form-container">
    <table>
                <tr>
                  <td><label for="fname">First Name: </label></td>
                  <td><input type="text" name = "firstName" id="fname"/></td>
                </tr>
                <tr>
                  <td><label for="lname">Last Name: </label></td>
                  <td><input type="text" name = "lastName" id="lname"/></td>
                </tr>
                <tr>
                  <td><label for="mail">Email: </label></td>
                  <td><input type="email" name = "email" id="mail"/></td>
                </tr>
                <tr>
                  <td><label for="passwd">Password: </label></td>
                  <td><input type="password" name = "password" id="passwd" /></td>
                </tr>
      </table>
    </div>
            <button class="btn" type="submit" name="reg_user">
              <span class="btn__content">Add</span>
            </button>
  </form>

<?php
  endif;
  if($_GET['action'] == "addAdmin"):

    if (isset($_POST['reg_user'])) {
      // receive all input values from the form
      $name = mysqli_real_escape_string($conn, $_POST['name']); //using _POST over _GET for security reasons
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      // form validation: ensure that the form is correctly filled ...
      if (empty($name) || empty($password)){
        $error = $error . "All fields required! ";
      }

      // first check the database to make sure an admin does not already exist with that name
      $user_check_query = "SELECT * FROM administrators WHERE Name='$name' LIMIT 1";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      if ($user) { // if user exists add that error to the string
        if ($user['Name'] === $name) {
          $error = $error . "An admin with that name already exist!";
        }
      }

      // Add user if there are no errors in the form
      if ($error == "") {
        $password = md5($password);//encrypt the password before saving in the database

        //prepare the query to insert the new customer data into the database
        $query = "INSERT INTO administrators (`AdminID`, `Name`, `Password`)
            VALUES (NULL, '$name', '$password')";
        mysqli_query($conn, $query);
        echo "<meta http-equiv='refresh' content='0'>"; //refresh the page so the changes to the tables are immediatly visible
      }
    }
    ?>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <h2><u>Add Admin:</u><span style="color:red;"><?php echo $error; ?></span></h2>
    <div class="form-container">
      <table>
                  <tr>
                    <td><label for="fname">Admin Name: </label></td>
                    <td><input type="text" name = "name" id="fname"/></td>
                  </tr>
                  <tr>
                    <td><label for="passwd">Password: </label></td>
                    <td><input type="password" name = "password" id="passwd" /></td>
                  </tr>
        </table>
      </div>
              <button class="btn" type="submit" name="reg_user">
                <span class="btn__content">Add</span>
              </button>
    </form>

<?php
endif;
if($_GET['action'] == "addProduct") {
    //TODO craete products page first
  }
 ?>
