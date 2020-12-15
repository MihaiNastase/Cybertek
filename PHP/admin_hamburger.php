<!-- static repetive code (header for the customer side of the frontend) -->
<div class="row">
  <div class="col-12 hamburger">
    <div class="collapse" id="collapse">
    <div class="menu">
      <div class="row">
        <div class="col-6">
          <figure>
            <a href="admin_.php?target=products">
              <img src="../MEDIA/menu_buttons/add_product.png" alt="products">
              <figcaption>PRODUCTS_</figcaption>
            </a>
          </figure>
        </div>
        <div class="col-6">
          <figure>
            <a href="admin_.php?target=profiles">
              <img src="../MEDIA/menu_buttons/add_cust.png" alt="profiles">
              <figcaption>USERS_</figcaption>
            </a>
          </figure>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php
            if(isset($_SESSION['action'])):
          ?>
            <figure>
              <a href="<?php echo "admin_.php?" . $target; ?>">
                <img src="../MEDIA/menu_buttons/logout.png" alt="back">
                <figcaption>BACK_</figcaption>
              </a>
            </figure>
          <?php elseif(isset($_GET['target'])): ?>
            <figure>
              <a href="admin_dashboard.php?">
                <img src="../MEDIA/menu_buttons/logout.png" alt="back">
                <figcaption>BACK_</figcaption>
              </a>
            </figure>
          <?php
            else:
          ?>
            <figure>
              <a href="admin_dashboard.php?logout='1'" class="confirmation">
                <img src="../MEDIA/menu_buttons/logout.png" alt="logout">
                <figcaption>LOGOUT_</figcaption>
              </a>
            </figure>
        <?php endif; ?>

        </div>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-12">

  <a  data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
    <img src="../MEDIA/header.png" alt="CYBERTEK">
  </a>

      </div>
    </div>
  </div>
</div>
