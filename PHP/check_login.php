<?php
//if no session is available or a user logs out, redirect to login page (prevent entering a session after a logout)
if (!isset($_SESSION['name'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
//if a user logs out, destroy session, return to index page
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['name']);
  header("location: index.html");
}
?>
