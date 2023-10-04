<?php
include "config.php";
if (isset($_POST['update'])) 
    {
        
        extract($_POST);

        $category1=$_POST['category'];
        $category=ucwords(strtolower($category1));
        $coulmn=array();
        $query1=mysqli_query($connect,"select * from tbl_category where fld_category_id!='".$_GET['category_id']."' and fld_category_name='".$category."' ");
        
        $total=mysqli_num_rows($query1);
    if ($total==1)     
    {
      echo '<script type="text/javascript">'; 
      echo 'alert("Record already exist");';
      echo "window.location.href = 'category_view.php';";
      echo '</script>'; 
    }    
        else
        {

            $query="Update tbl_category set fld_category_name='".$category."' where fld_category_id='".$_GET['category_id']."'";
            //echo $query."<br>";
            $row=mysqli_query($connect,$query) or die(mysqli_error($connect));
            if ($row) 
            {
                echo "<script>";
                echo "alert('Category details updated successfully');";
                echo "window.location.href='category_view.php';";
                echo "</script>";                 
            }
            else
            {
                echo "<script>";
                echo "alert('Category details not update.);";
                echo "window.location.href='category_view.php';";
                echo "</script>";
            }
        }    
    }
?>