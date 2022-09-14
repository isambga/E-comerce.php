
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
        <div id="product_box">
          <?php
          
              if(!isset($_GET['cat']) && !isset($_GET['brand']))
                {
                  global $con;

                  $get_pro = "SELECT * FROM products";
                  $run_pro =mysqli_query($con, $get_pro);

                  while($row_pro = mysqli_fetch_array($run_pro))
                  {
                    $product_id        = $row_pro['product_id'];
                    $product_cat       = $row_pro['product_cat'];
                    $product_brand     = $row_pro['product_brand'];
                    $product_title     = $row_pro['product_title'];
                    $product_price     = $row_pro['product_price'];
                    $product_desc      = $row_pro['product_desc'];
                    $product_image     = $row_pro['product_image'];
                    $product_keywords  = $row_pro['product_keywords'];

                    echo "
                    <div id ='single_product'>
                    <h3> $product_title</h3>
                    <img src ='admin/product_images/$product_image' width ='180' height = '180'/>
                    <p><b> Price: $ $product_price</b></p>
                    <a href='details.php?pro_id=$product_id'>Detail</a>
                    <a href='index.php? add_cart =$product_id'>
                    <button style='float:right'>Add to Cart</button>
                    </a>
                    </div>
                    ";

                  }
                }
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
