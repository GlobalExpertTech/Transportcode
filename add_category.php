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
                   <a href="#" class="btn btn-icon icon-left btn-primary"style="float:right"data-toggle="modal" data-target="#exampleModal13"><i class="far fa-edit"></i>Add Category</a>
                 </div>

                    <h4>Category Details</h4>
             
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                             <th>Sr No</th>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th>Modified Date</th>
                             <th>Action</th>
                          </tr>
                        </thead>
                    
                        <tbody>
                            <?php 
                                    $count=0; 
                                    $query="select * from tbl_category where fld_category_delete='0' order by fld_category_id desc ";
                                    $row=mysqli_query($connect,$query) or die(mysqli_error($connect));
                                    
                                    while($fetch=mysqli_fetch_array($row)) {

                                    extract($fetch);

                                ?>
                          <tr>
                            <td><?php echo ++$count; ?></td>
                            <td><?php echo $fetch['fld_category_name'];?></td>
                            <td><?php echo $fetch['fld_category_created_date'];?></td>
                            <td><?php echo $fetch['fld_category_modified_date'];?></td>
                            <td>   <div class="card-header-action">
                    <div class="dropdown">
                      <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon edit_student"data-toggle="modal" data-target="#exampleModal14"><i class="far fa-edit"></i> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a href="category_delete.php?fld_category_id=<?php echo $fetch['fld_category_id'] ?>" onclick="return confirm('Do you want to delete category ?')"class="dropdown-item has-icon text-danger delete_student"id="swal-6"><i class="far fa-trash-alt"></i>
                          Delete</a>
                      </div>
                    </div>
                  </td>
                    <?php } ?>
                          </tr>
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