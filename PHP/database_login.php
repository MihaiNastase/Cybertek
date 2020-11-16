<!DOCTYPE html>
<?php
	session_start();

	// initializing variables
	$email = "";
	$password = "";
	$errors = array();

  //create connection
  $conn = new mysqli('localhost', 'root', '', 'cybertech');
  //check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

	// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM customers WHERE Email='$email' AND Password='$password'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
			$user = mysqli_fetch_assoc($results);
  	  $_SESSION['name'] = $user['FirstName'];
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>
