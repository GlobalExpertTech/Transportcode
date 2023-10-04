<?php 
include'header/header.php';
include'sidebars/sidebar.php';
?>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
               <div class="card">
                     <div class="buttons">
                   <a href="#" class="btn btn-icon icon-left btn-primary"style="float:right"data-toggle="modal" data-target="#exampleModal15"><i class="far fa-edit"></i>Add Product</a>
                 </div>

                    <h4>Product Details</h4>
             
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                             <th>Sr No</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Created Date</th>
                            <th>Modified Date</th>
                             <th>Action</th>
                          </tr>
                        </thead>
                     
                        <tbody>
                           <?php 
                                    $count=0; 


                                    $query="select c.*,sc.* from tbl_category c, tbl_products sc where  c.fld_category_id=sc.fld_category_id and c.fld_category_delete='0' and sc.fld_product_delete='0' group by sc.fld_product_id order by sc.fld_product_id desc ";
                                    // $query="select * from tbl_subcategory where fld_product_for_delete='0' order by fld_subcategory_id desc ";
                                    $row=mysqli_query($connect,$query) or die(mysqli_error($connect));
                                    
                                    while($fetch=mysqli_fetch_array($row)) {

                                    extract($fetch);

                                ?>
                          <tr>
                              <td><?php echo ++$count; ?></td>
                              <td><img alt="image" src="images/<?php echo $fetch['fld_product_image'];?>"
                class="user-img-radious-style"style="width:50px;height:50px"> </td>
                              <td><?php echo $fetch['fld_product_name'];?></td>
                              <td><?php echo $fetch['fld_product_description'];?></td>
                              <td><?php echo $fetch['fld_product_stock'];?></td>
                              <td><?php echo $fetch['fld_product_price'];?></td>
                              <td><?php echo $fetch['fld_product_created_date'];?></td>
                              <td><?php echo $fetch['fld_product_modified_date'];?></td>
                          <td>
                    <div class="card-header-action">
                    <div class="dropdown">
                      <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon edit_student"data-toggle="modal" data-target="#exampleModal12"><i class="far fa-edit"></i> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a href="" onclick="return confirm('Do you want to delete category ?')"class="dropdown-item has-icon text-danger delete_student"id="swal-6"><i class="far fa-trash-alt"></i>
                          Delete</a>
                      </div>
                    </div>
                  </td>
                 </tr>
                    <?php } ?>
                 </tbody>
                       
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
  <?php include'footers/footer.php'?>