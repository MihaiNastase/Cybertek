<!DOCTYPE html>
<?php
	session_start();

	// initializing variables
	$email = "";
	$password = "";
	$errors = array();

	//connect to database
	include 'dbconnect.php';

	// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

	//check for form errors
  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }


  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM administrators WHERE Name='$email' AND Password='$password'";
  	$results = mysqli_query($conn, $query); //first query the administrators table to see if is an admin logging in
		if (mysqli_num_rows($results) == 1) {
			$user = mysqli_fetch_assoc($results);
			$_SESSION['name'] = $user['Name'];
			$_SESSION['success'] = "You are now logged in";
			header('location: admin_dashboard.php');
		} else { //if no admin matching the credentials is found then search for a customer
			$query = "SELECT * FROM customers WHERE Email='$email' AND Password='$password'";
			$results = mysqli_query($conn, $query);
	  	if (mysqli_num_rows($results) == 1) {
				$user = mysqli_fetch_assoc($results);
	  	  $_SESSION['name'] = $user['FirstName'];
	  	  $_SESSION['success'] = "You are now logged in";
	  	  header('location: customer_dashboard.php');
	  	}else { //if no admin or user is found then push an error into the errors array
	  		array_push($errors, "Wrong email/password combination");
	  	}
	 }
  }
}

//close db connection
$conn->close();

?>
