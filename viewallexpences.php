<?php
include('header/header.php');
?>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->


            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Expence Table</h4>
                  </div>
                  <div class="card-body">
                  <div class="row justify-content-end">
                  <a href="createexpence.php"><button class="btn btn-primary justify-content-end">New Expence Entry</button></a>
            </div>
                    
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Exp.No</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Payment Type</th>
                            <th>Disc</th>
                          </tr>
                        </thead>
                        <tbody>
                          

                        <?php

                                $selectquery="SELECT * FROM `expencemaster`";

                                $result=mysqli_query($con, $selectquery);

                                $responce=array();

                                if(mysqli_num_rows($result)>0)
                                {
                                    // $num=1;
                                    while ($row=mysqli_fetch_assoc($result))
                                    {?>
                                        <tr>
                                          
                                            <td><?php echo $row['date'];?></td>
                                            <td><?php echo $row['expno'];?></td>
                                            <td><?php echo $row['expname'];?></td>
                                            <td><?php echo $row['amount'];?></td>
                                            <td><?php echo $row['paymenttype'];?></td>
                                            <td><?php echo $row['disc'];?></td>
                                           
                                        </tr>

                                   <?php
                                //    $num++;
                                 }
                                }


                        ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </section>
     

 <?php
 include('footers/footer.php');
?>