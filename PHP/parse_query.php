<?php
$priceSort = "";
$typeSort = "";
$searchValue = "";
$orderBy = "";
$whereType = "";
$searchLike = "";
$types = ["Desktop PC", "Accessories", "Game Console", "Audio"];
$error = "";

if(isset($_POST['search'])) {

  $priceSort = mysqli_real_escape_string($conn, $_POST['priceSort']);
  $typeSort = mysqli_real_escape_string($conn, $_POST['typeSort']);
  $searchValue = mysqli_real_escape_string($conn, $_POST['searchValue']);

  if($priceSort == "Sort Price Ascending") {
    $orderBy = " ORDER BY `Price` ASC ";
  }
  if($priceSort == "Sort Price Descending") {
    $orderBy = " ORDER BY `Price` DESC ";
  }

  foreach ($types as $type) {
    if($typeSort == $type) {
      $whereType = " WHERE `ProductType` = '$type' ";
      break;
    }
  }

  if(!empty($searchValue)) {
    if(empty($whereType)){
      $searchLike = " WHERE `ProductName` LIKE '%$searchValue%'";
    } else {
      $searchLike = " AND `ProductName` LIKE '%$searchValue%'";
    }
  }

  $query = "SELECT `ProductID`,`ProductName`,`Price`,`ProductType`,`Image` FROM `products` " . $whereType . $searchLike . $orderBy;
} else {
  $query = "SELECT `ProductID`,`ProductName`,`Price`,`ProductType`,`Image` FROM `products` ORDER BY `ProductID` ASC";
}
?>
