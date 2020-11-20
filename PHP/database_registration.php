<!DOCTYPE html>
<?php
	session_start();

	// initializing variables
	$lastName = "";
  $firstName = "";
	$email    = "";
	$errors = array();

  //create connection
  $conn = new mysqli('localhost', 'root', '', 'cybertech');
  //check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
	  // receive all input values from the form
	  $firstName = mysqli_real_escape_string($conn, $_POST['firstName']); //using _POST over _GET for security reasons
		$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	  $email = mysqli_real_escape_string($conn, $_POST['email']);
	  $password = mysqli_real_escape_string($conn, $_POST['password']);
	  $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);

	  // form validation: ensure that the form is correctly filled ...
	  // by adding (array_push()) corresponding error unto $errors array
	  if (empty($firstName)) { array_push($errors, "First name is required"); }
		if (empty($lastName)) { array_push($errors, "Last name is required"); }
	  if (empty($email)) { array_push($errors, "Email is required"); }
	  if (empty($password)) { array_push($errors, "Password is required"); }
	  if ($password != $repassword) { array_push($errors, "The two passwords do not match"); }

	  // first check the database to make sure a user does not already exist with that email
	  $user_check_query = "SELECT * FROM customers WHERE email='$email' LIMIT 1";
	  $result = mysqli_query($conn, $user_check_query);
	  $user = mysqli_fetch_assoc($result);

	  if ($user) { // if user exists push that specific error intor the errors array
	   	if ($user['Email'] === $email) {
	      array_push($errors, "email already exists");
	    }
	  }

		// Register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

		//prepare the query to insert the new customer data into the database
  	$query = "INSERT INTO customers (`UserID`, `Email`, `FirstName`, `LastName`, `Password`, `City`, `AddressFirstLine`, `AddressSecondLine`, `CardNumber`, `ExpiryDate`, `CVS`)
	      VALUES (NULL, '$email', '$firstName', '$lastName', '$password', NULL, NULL, NULL, NULL, NULL, NULL)"; //this fields remain NULL untill a customer updates his credential after login
  	mysqli_query($conn, $query);
		//Log in the customers and continue the session
  	$_SESSION['name'] = $firstName;
  	$_SESSION['success'] = "LOG//ON//SUCCESS_";
  	header('location: index.php');
  }
}
