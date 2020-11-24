<?php include 'dbconnect.php'; //connect to database
  //create query
 $query = "SELECT UserID, Email, FirstName, LastName, City, AddressFirstLine, AddressSecondLine, CardNumber, ExpiryDate, CVS FROM customers ORDER BY UserID ASC";
 $results = mysqli_query($conn, $query);
?>
<div class="table-container">
  <h1>VIEW/ADD/DELETE/MODIFY USER PROFILES</h1>
<table class="table-sortable" style="color:white; width=100%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>City</th>
      <th>Address First Line</th>
      <th>Address Second Line</th>
      <th>Payment Option</th>
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
          echo "<td>" . $row['UserID'] . "</td>";
          echo "<td>" . $row['Email'] . "</td>";
          echo "<td>" . $row['FirstName'] . "</td>";
          echo "<td>" . $row['LastName'] . "</td>";
          if($row['City'] == NULL) {
            echo "<td> Not Set </td>";
          } else { echo "<td>" . $row['City'] . "</td>"; }
          if($row['AddressFirstLine'] == NULL) {
            echo "<td> Not Set </td>";
          } else { echo "<td>" . $row['AddressSecondLine'] . "</td>"; }
          if($row['AddressSecondLine'] == NULL) {
            echo "<td style='color:red;'> Not Set </td>";
          } else { echo "<td>" . $row['AddressSecondLine'] . "</td>"; }
          if($row['CardNumber'] == NULL || $row['CardNumber'] == NULL || $row['CardNumber'] == NULL) {
            echo "<td style='color:red;'> Not Set </td>";
          } else { echo "<td style='color:green;'> Valid </td>"; }
          echo "<td> <a href='admin_.php?target=" . $_GET['target'] . "&whereID=" . $row['UserID'] . "&action=update'>UPDATE</a></td>";
          echo "<td> <a href='admin_.php?target=" . $_GET['target'] . "&whereID=" . $row['UserID'] . "&action=delete'>DELETE</a></td>";
          echo "</tr>";
        }
      }
    }

    ?>
  </tbody>
</table>
</div>

<?php
//repurpose variables for second query
$query = "SELECT AdminID, Name FROM administrators ORDER BY AdminID ASC";
$results = mysqli_query($conn, $query);
?>
<div class="table-container">
  <h1>VIEW/ADD Active Admins</h1>
<table class="table-sortable" style="color:white; width=100%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Admin Name</th>
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
          echo "<td>" . $row['AdminID'] . "</td>";
          echo "<td>" . $row['Name'] . "</td>";
          echo "</tr>";
        }
      }
    }

    ?>
  </tbody>
</table>
</div>
