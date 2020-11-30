<?php
  echo $query;
  if($results = mysqli_query($conn, $query)) {
    if($results->num_rows === 0) {
      echo "<tr><td>No results</td></tr>";
    } else {
      while($row = mysqli_fetch_assoc($results)){
        echo "<div class='row catalog'>";
        echo $row['ProductID'] . $row['ProductName'] . $row['ProductType'] . $row['Price'];
        echo "</div>";
      }
    }
  }
?>
