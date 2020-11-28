<?php
if (!isset($_SESSION['name'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['name']);
  header("location: index.html");
}
?>
