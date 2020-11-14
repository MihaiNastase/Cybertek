<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title> </title>
</head>
<body>
<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cybertech";

  //create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  //check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  //$sql = "INSERT INTO customers (`UserID`, `Email`, `FirstName`, `LastName`, `Password`, `City`, `AddressFirstLine`, `AddressSecondLine`, `CardNumber`, `ExpiryDate`, `CVS`) VALUES (NULL, 'MihaiNastae@email.com', 'Mihai', 'Nastase', 'password123', 'Coventry', '06 Ardea Court', 'David Road', '0123456789101112', '2021-11-12', '333')";

  //get info from form using POST
  $email = $_POST['email'];
  $lastName = $_POST['lname'];
  $firstName = $_POST['fname'];
  $password = $_POST['password'];

  $sql = "INSERT INTO customers (`UserID`, `Email`, `FirstName`, `LastName`, `Password`, `City`, `AddressFirstLine`, `AddressSecondLine`, `CardNumber`, `ExpiryDate`, `CVS`)
      VALUES (NULL, '$email', '$firstName', '$lastName', '$password', NULL, NULL, NULL, NULL, NULL, NULL)";




  if($conn->query($sql) === TRUE) {
      echo "New record added successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>
</body>
</html>
