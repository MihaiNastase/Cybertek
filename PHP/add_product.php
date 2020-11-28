<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<h2><u>Add Admin:</u><span style="color:red;"><?php echo $error; ?></span></h2>
<div class="form-container">
  <table>
              <tr>
                <td><label for="pname">Product Name: </label></td>
                <td><input type="text" name = "productName" id="pname"/></td>
              </tr>
              <tr>
                <td><label for="">: </label></td>
                <td><input type="text" name = "" id=""/></td>
              </tr>
              <tr>
                <td><label for="">: </label></td>
                <td><input type="text" name = "" id=""/></td>
              </tr>
              <tr>
                <td><label for="">: </label></td>
                <td><input type="text" name = "" id=""/></td>
              </tr>
              <tr>
                <td><label for="">: </label></td>
                <td><input type="text" name = "" id=""/></td>
              </tr>
    </table>
  </div>
          <button class="btn" type="submit" name="reg_user">
            <span class="btn__content">Add</span>
          </button>
</form>
