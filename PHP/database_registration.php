
<?php
	session_start();

	// initializing variables
	$lastName = "";
  $firstName = "";
	$email    = "";
	$errors = array();

	//connect to database
	include 'dbconnect.php';

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
	  $user_check_query = "SELECT * FROM customers WHERE Email='$email' LIMIT 1";
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
	      VALUES (NULL, '$email', '$firstName', '$lastName', '$password', NULL, NULL, NULL, NULL, NULL, NULL);"; //these fields remain NULL untill a customer updates his credential after login
  	mysqli_query($conn, $query);
		//Log in the customers and continue the session
		$query = "SELECT `UserID` FROM `customers` WHERE `Email` = '$email';";
  	$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
  	$_SESSION['name'] = $firstName;
		$_SESSION['ID'] = $result['UserID'];
  	$_SESSION['success'] = "LOG//ON//SUCCESS_";
  	header('location: customer_dashboard.php');
  }
}

//close db connection
$conn->close();

?>
