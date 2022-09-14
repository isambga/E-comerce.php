
<?php
  include('includes/header.php');
 ?>

    <div class="menu_bar">
      <ul id="menu">
        <li> <a href="index.php">Home</a> </li>
        <li> <a href="product.php">Product</a> </li>
        <li> <a href="customer/customer.php">Customer</a> </li>
        <li> <a href="cart.php">Shopping cart</a> </li>
        <li> <a href="contact.php">Contact Us</a> </li>

      </ul>

    </div>

      <div class="content_wrapper">
      <div id="sidebar">
        <div id="sidebar_title">
          Categories
        </div>
        <ul id="cats">

          <?php
            getCats();
          ?>
        </ul>

        <div id="sidebar_title">
          Brands
        </div>
        <ul id="cats">
          <?php
            getBrands()
           ?>

        </ul>
      </div> <!--end sidebar -->
<!-- Content area -->
      <div id="content_area">
        <?php
          cart();
         ?>
        <div id="product_box">
          <?php
            get_product();
           ?>

           <?php
              get_product_by_cat_id();
            ?>

      <!-- brand -->

           <?php
              get_product_by_brand_id();
            ?>

        </div><!-- product_box -->
      </div><!-- /.content area -->
      </div> <!-- end content_wrapper-->
<?php
include('includes/footer.php');
 ?>
