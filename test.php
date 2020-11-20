<?php
$password = "admin";

$password = md5($password);

echo $password;

if(md5("admin") == "9dfc8dce7280fd49fc6e7bf0436ed325") {
  echo "match";
}

?>
