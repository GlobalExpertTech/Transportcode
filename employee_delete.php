<?php
include "config.php";

          $delete1 = mysqli_query($connect,"update tbl_employee set fld_category_delete='1' where fld_employee_id='".$_GET['fld_employee_id']."'")or die(mysqli_error($connect));
          
          


$back="javascript:history.back()";
  if($delete1)

          {
            echo '<script type="text/javascript">';
            echo "alert('Employee deleted');";
            echo 'window.location.href = "add_employee.php";';
            echo "</script>";

          }
         else
         {
            echo '<script type="text/javascript">';
            echo "alert('Employee not delete');";
            echo 'window.location.href = "add_employee.php";';
            echo "</script>";
             
             }

             ?>