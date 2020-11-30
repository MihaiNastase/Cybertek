<?php
  if($results = mysqli_query($conn, $query)) :
    if($results->num_rows === 0) :
      echo "<tr><td>No results</td></tr>";
     else:
      while($row = mysqli_fetch_assoc($results)):

        echo "<div class='row'><div class='hidden-sm col-md-1 col-lg-2'></div><div class='col-sm-12 col-md-10 col-lg-8'>";
        echo "<p>" . $row['ProductID'] . $row['ProductName'] . $row['ProductType'] . $row['Price'] . $row['Image'] . "</p>";
        echo   "</div><div class='hidden-sm col-md-1 col-lg-2'></div></div>";


      endwhile;
    endif;
  endif;
?>
