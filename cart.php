
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
        <div class="shopping_cart_container">

          <div class="shopping_cart" align ="right" style="padding:15px">
            <?php
            if(isset($_SESSION['customer_email']))
            {
              echo "<b> Your email: </b>".$SESSION['customer_email'];
            }else
            {
              echo ".";
            }

            ?>
            <b style="color:navy"> Your Cart-</b> Total Items: <?php total_items() ?> Total Price: <?php total_price(); ?>
          </div> <!--shopping_cart -->
          <form class="" action="index.html" method="post"  enctype="multipart/form-data">

            <table align ="center" width="100%">
              <tr align ="center">
                <th>Remove</th>
                <th>Product</th>
                <th>Quality</th>
                <th>Price</th>
              </tr>
              <?php

              $total =0;

              $ip_address = get_ip_address();
              $sql_cart = "SELECT * FROM cart WHERE ip_address = '$ip_address' ";
              $run_cart = mysqli_query($con,$sql_cart);

              while($fetch_cart = mysqli_fetch_array($run_cart))
                {
                  $product_id = $fetch_cart['product_id'];

                  $sql_result = "SELECT *FROM products WHERE product_id = '$product_id'";
                  $result_product = mysqli_query($con, $sql_result);
                  while($fetch_product = mysqli_fetch_array($result_product))
                    {
                      $product_price = array($fetch_product['product_price']);
                      $product_title = $fetch_product['product_title'];
                      $product_image = $fetch_product['product_image'];
                      $sing_price = $fetch_product['product_price'];
                      $values = array_sum($product_price);

                      $sql_qty = "SELECT * FROM cart WHERE product_id = '$product_id'";
                      $run_qty = mysqli_query($con, $sql_qty);
                      $fetch_qty = mysqli_fetch_array($run_qty);
                      $quality = $fetch_qty['quality'];
                      $values_qty = $values*$quality;

                      $total += $values_qty;
               ?>
              <tr align ="center">
                <td> <input type="checkbox" name="remove" value=""> </td>
                <td>
                   <?php echo $product_title; ?>
                   <br>
                   <img src="admin/product_images/<?php echo $product_image; ?>" width="100" height="100">
                 </td>
                <td> <input type="text" name="qty" size="5" value="<?php echo $quality; ?>"> </td>
                <td> <?php echo $sing_price; ?></td>
              </tr>
            <?php }} //ENDWHILE ?>
              <tr align ="center">
                <td colspan="2"> <input type="submit" name="update_cart" value="Update Cart"> </td>
                <td> <input type="submit" name="continue" value="Continue Shopping"> </td>
                <td> <button> <a href="checkout.php" style="text-decoration:none; color:black;"> Checkout</a> </button> </td>
              </tr>

            </table>
          </form>
        </div> <!--/shopping_cart_container -->
        <div id="product_box">

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
