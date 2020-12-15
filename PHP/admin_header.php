<div class="row">
  <div class="hidden-xs col-md-12 header">
    <div class="row">

      <div class="col-2"></div>
      <div class="col-3">
        <img src="../MEDIA/landing_page/logo.png" alt="CYBERTEK">
      </div>
      <div class="col-6">
        <div class="menu">

          <figure>
            <a href="admin_.php?target=products">
              <img src="../MEDIA/menu_buttons/add_product.png" alt="products">
              <figcaption>PRODUCTS_</figcaption>
            </a>
          </figure>

          <figure>
            <a href="admin_.php?target=profiles">
              <img src="../MEDIA/menu_buttons/add_cust.png" alt="profiles">
              <figcaption>USERS_</figcaption>
            </a>
          </figure>

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
    <div class="col-1">
      <div class="clock"></div>
    </div>
</div>
</div>
</div>
