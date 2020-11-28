<?php
  //create query
 $query = "SELECT ProductID, ProductName, Price, ProductType, Description, AvailableStock FROM products ORDER BY ProductID ASC";
 $results = mysqli_query($conn, $query);
?>
<!--CREATE TABLE THAT DISPLAYS ALL CUSTOMERS PROFILES
  *if the query returns NULL for any of the address values, then those addresses will be "NOT SET"
  *for security reasons regarding the credit card information of the customers,
  if any of the credit card number, cvs or expiry date are not set by the customer,
  then the "PAYMENT OPTION" is considered to be "NOT SET"
-->
<div class="table-container">
  <h1>VIEW/ADD/DELETE/MODIFY AVAILABLE PRODUCTS</h1>
<table class="table-sortable" style="color:white; width=100%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Product Name</th>
      <th>Price</th>
      <th>Product Type</th>
      <th>Product Description</th>
      <th>Available Stock</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php

    //check if query worked and check if there are any results
    if($results) {

      if($results->num_rows === 0) {
        echo "<tr><td>No results</td></tr>";
      } else {
        //print table
        while ($row = mysqli_fetch_assoc($results)) {
          echo "<tr>";
          echo "<td>" . $row['ProductID'] . "</td>";
          echo "<td>" . $row['ProductName'] . "</td>";
          echo "<td>" . $row['Price'] . "$</td>";
          echo "<td>" . $row['ProductType'] . "</td>";
          echo "<td>" . $row['Description'] . "</td>";
          echo "<td>" . $row['AvailableStock'] . "</td>";
          echo "<td><form method='post'><input type='submit' name='update' value='Update'/><input type='hidden' name='productID' value='" . $row['ProductID'] . "'/></form></td>";
          echo "<td><form onsubmit='return confirmAction()' method='post'><input type='submit' name='delete' value='Delete'/><input type='hidden' name='productID' value='" . $row['ProductID'] . "'/></form></td>";
          //
          //echo "<td> <a href='admin_.php?target=" . $_GET['target'] . "&whereID=" . $row['UserID'] . "&action=update'>UPDATE</a></td>";
          //echo "<td> <a href='admin_.php?target=" . $_GET['target'] . "&whereID=" . $row['UserID'] . "&action=delete'>DELETE</a></td>";
          //
          echo "</tr>";
        }
      }
    }

    ?>
  </tbody>
</table>
</div>

<!--CREATE FORMS THAT ADD PROFILES TO THE DATABASE
  *if the "ADD CUSTOMER PROFILE" button is clicked, then the php code will display a form
  Although I have already created a valid method for adding a customer to the database during registration
  for this form I will need something more lightweight and all contained withing the same php code
-->
<div class = "row">
  <div class = "col-12">
    <?php
      //Here I reused the same script for adding either products or admins or customers to make the code cleaner
      include 'admin_form.php';
    ?>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <a href="<?php echo $_SERVER['PHP_SELF']?>?target=products&action=addProduct"><div class="btn"><div class="btn__content">Add New Product</div></div></a>
  </div>
</div>
<script>
//a simple script to go with the "DELETE" buttons on the customers/products profile tables
//so the admin has a chance to go back on its action and not just completely delete an entry on accident
function confirmAction() {
  if(confirm("Confirm Action")) {
    return true;
  } else { return false; }
}

//TODO: Script that keeps page scroll on button press so when the page refreshes and display the add profile form, the admin will not have to scroll back to it (accessibility wise)
</script>
