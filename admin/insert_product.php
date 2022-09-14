
<?php
include("includes/db.php");
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inserting Products </title>
  </head>
  <body bgcolor = "skyblue">
    <form  action="insert_product.php" method="post" enctype="multipart/form-data">
      <table align="center" width="795" border="2" bgcolor ="#187eae">
        <tr align = "center">
          <td colspan="7"> <h2>Insert new post here </h2> </td>
        </tr>

        <tr>
          <td align = "right"> <b>Product Title</b> </td>
          <td> <input type="text" name="product_title" size="60" required> </td>
        </tr>

        <tr>
          <td align = "right">  <b> Product Categories</b> </td>
          <td>
            <select  name="product_cat">
              <option> Select a Category</option>
              <?php

              $get_cats = "select *from categories";
              $run_cats = mysqli_query($con, $get_cats);

              while($row_cats = mysqli_fetch_array($run_cats))
              {
                $cat_id = $row_cats['cat_id'];
                $cat_title = $row_cats['cat_title'];
                echo" <option value = '$cat_id'> $cat_title</option> ";
              }
               ?>

          </select>
        </td>
        </tr>

        <tr>
        <td align = "right">  <b> Product Brands</b> </td>
        <td>
          <select  name="product_brand">
            <option> Select a Brand</option>
            <?php

            $get_brands = "select * from brands";

            $run_brands = mysqli_query($con, $get_brands);

            while($row_brands = mysqli_fetch_array($run_brands))
            {
              $brand_id = $row_brands['brand_id'];
              $brand_title = $row_brands['brand_title'];

              echo" <option value = '$brand_id'> $brand_title</option> ";
            }
            ?>
          </select>
        </tr>

        <tr>
          <td align = "right"> <b> Product Image: </b> </td>
          <td> <input type="file" name="product_image" /> </td>
        </tr>

        <tr>
          <td align = "right"> <b> Product Price: </b> </td>
          <td> <input type="text" name="product_price" required/> </td>
        </tr>

        <tr>
          <td align ="right"> <b> Product Description </b> </td>
          <td> <textarea name="product_desc" rows="6" cols="60" required></textarea> </td>
        </tr>
        <tr>
          <td align = "right"> <b>Product Keywords </b> </td>
          <td> <input type="text" name="product_keywords" required/> </td>
        </tr>

        <tr align = "center">
          <td colspan="7"> <input type="submit" name="insert_post" value="Insert Product"/> </td>

        </tr>
      </table>
    </form>

  </body>
</html>

<?php
if(isset($_POST['insert_post']))
  {
    $product_title = $_POST['product_title'];
    $product_cat   = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));
    $product_keywords = $_POST['product_keywords'];

    // Getting the image from the file
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    move_uploaded_file($product_image_tmp,"product_images/".$product_image);

    $insert_product ="INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords)
    VALUE ('$product_cat', '$product_brand', '$product_title', '$product_price', '$product_desc', '$product_image', '$product_keywords')";

    if(mysqli_query($con, $insert_product))
      {
        echo "<script> alert('Product has been inserted successfully') </script>";
      //  echo "<script> window.open('index.php?insert_product', '_self') </script>";
      }

  }

 ?>
