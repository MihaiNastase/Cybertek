<?php
  //pass the query from the search bar
  if($results = mysqli_query($conn, $query)) :
    if($results->num_rows === 0) :
      echo "<tr><td>No results</td></tr>";
     else:
      while($row = mysqli_fetch_assoc($results)):
        //get product details from database
        if($row['Image'] == NULL) {
          $image = "no-preview-available.png";
        } else {
          $image = "image_upload/" . $row['Image'];
        }
        ?>
          <!-- Display products on page -->
          <form method='post'>
            <input type='hidden' name='productID' value="<?php echo $row['ProductID']; ?>"/>
            <div class='row'>
              <div class='hidden-sm col-md-2 col-lg-3'></div>
              <div class='col-sm-12 col-md-8 col-lg-6'>
                <button class='product-wrapper' type="submit" name="go_to">
                  <div class='product-image'>
                    <img src='../MEDIA/<?php echo $image; ?>'>
                  </div>
                  <div class='product-text'>
                      <?php echo "<h1>" . $row['ProductName'] . "</h1><h3>". $row['ProductType'] . "</h3><h2>" . $row['Price'] . "$</h2></p>"; ?>
                  </div>
                </button>
             </div>
             <div class='hidden-sm col-md-2 col-lg-3'></div>
          </div>
         </form>

<?php
      endwhile;
    endif;
  endif;
?>

<script>
$(document).ready(chHeight());
$(document).resize(chHeight());
//get all images to display at the same size
function chHeight(){
  const wd = $(".product-image").find("img").width();
  $(".product-image").find("img").css("height", wd + "px")
  console.log(wd);
}
</script>
