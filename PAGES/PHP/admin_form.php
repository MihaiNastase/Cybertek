<?php //display the appropriate update forms (from the inlcude statement on line 120 in PHP/users_table.php)
  if(!isset($_GET['action'])) { $_GET['action'] = "";}
  $error = "";
  if($_GET['action'] == "addCustomer"){
    include 'add_customer.php';
  }

  if($_GET['action'] == "addAdmin") {
    include 'add_admin.php';
  }

if($_GET['action'] == "addProduct") {
    include 'add_product.php';
  }
 ?>
