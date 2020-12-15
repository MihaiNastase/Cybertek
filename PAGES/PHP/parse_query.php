<?php
//initialise variables for better handling of the query string
$priceSort = "";
$typeSort = "";
$searchValue = "";
$orderBy = "";
$whereType = "";
$searchLike = "";
$types = ["Desktop PC", "Accessories", "Game Console", "Audio"]; //initialise array containing all the possible types for a product
$error = "";

//when the search button is clicked
if(isset($_POST['search'])) {
//get the search values of the form
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
    if(empty($whereType)){ //dependig if there is a specific type parameter to be searched, add an AND between the WHERE search parameters or dirrectly search just for the product name
      $searchLike = " WHERE `ProductName` LIKE '%$searchValue%'";
    } else {
      $searchLike = " AND `ProductName` LIKE '%$searchValue%'";
    }
  }

  $query = "SELECT `ProductID`,`ProductName`,`Price`,`ProductType`,`Image` FROM `products` " . $whereType . $searchLike . $orderBy;
} else {
  //this is the default query that will display all the products if no specific search is done by the user
  //this query is used by the code in the include on line 118 of PAGES/customer_dashboard.php
  $query = "SELECT `ProductID`,`ProductName`,`Price`,`ProductType`,`Image` FROM `products` ORDER BY `ProductID` ASC";
}
?>
