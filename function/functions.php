<?php
$con = mysqli_connect("127.0.0.1", "root", "", "website_cms_ecom");

if(mysqli_connect_error())
  {
    echo "The Connection was not established: ".mysqli_connect_error();
  }

  function getCats()
  {
    global $con;

    $get_cats = "select *from categories";
    $run_cats = mysqli_query($con, $get_cats);

    while($row_cats = mysqli_fetch_array($run_cats))
    {
      $cat_id = $row_cats['cat_id'];
      $cat_title = $row_cats['cat_title'];
      echo"  <li> <a href='index.php? cat=$cat_id'>$cat_title</a> </li>";
    }

function getBrands()
{
  global $con;
  $get_brands = "select * from brands";

  $run_brands = mysqli_query($con, $get_brands);

  while($row_brands = mysqli_fetch_array($run_brands))
    {
      $brand_id = $row_brands['brand_id'];
      $brand_title = $row_brands['brand_title'];

      echo " <li> <a href='index.php?cat=$brand_id'>$brand_title</a> </li>";
    }



}


}

function get_product()
  {
    if(!isset($_GET['cat']) && !isset($_GET['brand']))
      {
        global $con;

        $get_pro = "SELECT * FROM products order by RAND() LIMIT 0,6";
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
          <a href='index.php?add_cart=$product_id'>
          <button style='float:right'> Add to Cart</button> </a>
          </div>
          ";

        }
      }

  }

  function get_product_by_cat_id()
    {
      if(isset($_GET['cat']))
        {
          global $con;
          $cat_id = $_GET['cat'];
          $get_cat_id = "SELECT * FROM products WHERE product_cat = '$cat_id'";
          $run_cat_pro = mysqli_query($con, $get_cat_id);
          $count_cats = mysqli_num_rows($run_cat_pro);

          if($count_cats == 0)
            {
              echo "<h2 style = 'padding:20px;'> Not found Product in this Category!</h2>";
            }

            while($row_cat_pro = mysqli_fetch_array($run_cat_pro))
              {
                $product_id        = $row_cat_pro['product_id'];
                $product_cat       = $row_cat_pro['product_cat'];
                $product_brand     = $row_cat_pro['product_brand'];
                $product_title     = $row_cat_pro['product_title'];
                $product_price     = $row_cat_pro['product_price'];
                $product_desc      = $row_cat_pro['product_desc'];
                $product_image     = $row_cat_pro['product_image'];
                $product_keywords  = $row_cat_pro['product_keywords'];

                echo "
                <div id ='single_product'>
                <h3> $product_title</h3>
                <img src ='admin/product_images/$product_image' width ='180' height = '180'/>
                <p><b> Price: $ $product_price</b></p>
                <a href='details.php?pro_id=$product_id'>Detail</a>
                <a href='index.php?add_cart=$product_id'>
                <button style='float:right'> Add to Cart</button> </a>
                </div>
                ";

              }
        }
    }

    function get_ip_address()
      {
        if(!empty($_SERVER['CLIENT_IP']))
          {
            $ip = $_SERVER['CLIENT_IP'];
          }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else
              {
                $ip = $_SERVER['REMOTE_ADDR'];
              }
          return $ip;
      }

    function cart()
      {
        global $con;
        if(isset($_GET['add_cart']))
          {
            $product_id = $_GET['add_cart'];
            $ip_address = get_ip_address();
            $sql_check ="SELECT * FROM cart WHERE product_id ='$product_id'";
            $run_check_pro = mysqli_query($con, $sql_check);

            if(mysqli_num_rows($run_check_pro))
              {
                echo "";
              }else
                {
                  $sql_fetch ="SELECT * FROM products WHERE product_id ='$product_id'";
                  $fetch_query =mysqli_query($con,$sql_fetch);
                  $fetch_pro =mysqli_fetch_array($fetch_query);
                  $product_title = $fetch_pro['product_title'];

                  $sql_add_cart = "INSERT INTO cart (product_id, product_title, ip_address) VALUE ('$product_id', '$product_title', '$ip_address')";
                  $run_insert_pro = mysqli_query($con,$sql_add_cart);
                  //if($run_insert_pro)

                }
          }
      }

    function total_price()
      {
        global $con;
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
                $product_title = $fetch_product['product_image'];
                $sing_price = $fetch_product['product_price'];
                $values = array_sum($product_price);

                $sql_qty = "SELECT * FROM cart WHERE product_id = '$product_id'";
                $run_qty = mysqli_query($con, $sql_qty);
                $fetch_qty = mysqli_fetch_array($run_qty);
                $quality = $fetch_qty['quality'];
                $values_qty = $values*$quality;

                $total += $values_qty;
              }
          }

        echo "$".$total;
      }

    function total_items()
      {
        global $con;
        $ip_address = get_ip_address();
        $sql_notif = "SELECT * FROM cart WHERE ip_address ='$ip_address'";
        $run_items = mysqli_query($con, $sql_notif);
        $count_items =mysqli_num_rows($run_items);
        if($count_items != 0)
          {
            echo $count_items;
          }
      }
    function get_product_by_brand_id()
      {
        if(isset($_GET['brand']))
          {
            global $con;
            $cat_id = $_GET['brand'];
            $get_brand_id = "SELECT * FROM products WHERE product_cat = '$brand_id'";
            $run_brand_pro = mysqli_query($con, $get_brand_id);
            $count_brands = mysqli_num_rows($run_brand_pro);

            if($count_brands == 0)
              {
                echo "<h2 style = 'padding:20px;'> Not found Product in this Category!</h2>";
              }

              while($row_brand_pro = mysqli_fetch_array($run_brand_pro))
                {
                  $product_id        = $row_brand_pro['product_id'];
                  $product_cat       = $row_brand_pro['product_cat'];
                  $product_brand     = $row_brand_pro['product_brand'];
                  $product_title     = $row_brand_pro['product_title'];
                  $product_price     = $row_brand_pro['product_price'];
                  $product_desc      = $row_brand_pro['product_desc'];
                  $product_image     = $row_brand_pro['product_image'];
                  $product_keywords  = $row_brand_pro['product_keywords'];

                  echo "
                  <div id ='single_product'>
                  <h3> $product_title</h3>
                  <img src ='admin/product_images/$product_image' width ='180' height = '180'/>
                  <p><b> Price: $ $product_price</b></p>
                  <a href='details.php?pro_id=$product_id'>Detail</a>
                  <a href='index.php?add_cart=$product_id'>
                  <button style='float:right'> Add to Cart</button> </a>
                  </div>
                  ";

                }
          }

      }

 ?>
