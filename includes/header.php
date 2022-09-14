<?php
  include("includes/db.php");
  include("function/functions.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Shopping</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>

    <!-- Main container -->
    <div class="main_wrapper">

      <div class="header_wrapper">
          <div class="header_log">
        <a href="index.php">
          <img id="logo" src="image/logo.ico" alt="logo_icon" width="70" height="50"/>
        </a>
      </div><!--end header_log -->

      <div id="form">
        <form  action="results.php" method="get" enctype="multipart/form-data">
          <input type="text" name="user_query" placeholder="Search a Product"/>
          <input type="submit" name="search" value="Search"/>

        </form>
      </div> <!-- end form -->

      <div class="cart">
        <ul>
          <li class="dropdown_header_cart">
            <div id=" notification_total_cart" class="Shopping_cart">
              <img src="image/cart.webp" alt="cart" id="cart_image" alt="cart">
              <div class="noti_cart_number">
                <?php
                  total_items();
                 ?>
              </div>
            </div>
          </li>
        </ul>
      </div><!-- end cart-->

      <div class="register_login">
        <div class="login">
          <a href="index.php? action= login">Login</a>
        </div>

        <div class="register">
          <a href="customer_register">Register</a>
        </div>

      </div> <!--end register_login -->

    </div> <!-- end header_wrapper -->
