<?php
include "config.php";

          $delete1 = mysqli_query($connect,"update tbl_category set fld_category_delete='1' where fld_category_id='".$_GET['fld_category_id']."'")or die(mysqli_error($connect));

          $delete2 = mysqli_query($connect, "update tbl_subcategory set fld_subcategory_delete='1' where fld_category_id='".$_GET['fld_category_id']."'")or die(mysqli_error($connect));




$gsafdh=mysqli_query($connect,"select * from tbl_product where fld_category_id='".$_GET['fld_category_id']."'");

          while($fetch=mysqli_fetch_array($gsafdh))
          {           

            $delete3=mysqli_query($connect, "update tbl_product_details set fld_product_details_delete='1' where fld_product_id='".$fetch['fld_product_id']."'")or die(mysqli_error($connect));
          }

          $delete4=mysqli_query($connect, "update tbl_product set  fld_product_delete='1' where fld_category_id='".$_GET['fld_category_id']."'")or die(mysqli_error($connect));


$back="javascript:history.back()";
  if($delete1)

          {
            echo '<script type="text/javascript">';
            echo "alert('Category deleted');";
            echo 'window.location.href = "add_category.php";';
            echo "</script>";

          }
         else
         {
            echo '<script type="text/javascript">';
            echo "alert('Category details not delete');";
            echo 'window.location.href = "add_category.php";';
            echo "</script>";
             
             }

             ?>