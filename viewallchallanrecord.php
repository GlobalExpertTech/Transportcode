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
                    <h4>List Of Challan </h4>
                  </div>
                  <div class="card-body">
                  <!-- <div class="row justify-content-end">
                  <a href="createexpence.php"><button class="btn btn-primary justify-content-end">New Expence Entry</button></a>
            </div> -->
                    
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Date</th>
                      
                            <th>Challan.No</th>
                            <th class="text-center">From</th>
                            <th class="text-center">To</th>
                            <th>Payment Type</th>
                            <th>Truck No</th>
                            <th>Status</th>

                          </tr>
                        </thead>
                        <tbody>
                          

                        <?php

                                $selectquery="SELECT * FROM `challanrecord` ORDER BY `challanrecord`.`id` DESC";

                                $result=mysqli_query($con, $selectquery);

                                $responce=array();

                                if(mysqli_num_rows($result)>0)
                                {
                                    // $num=1;
                                    while ($row=mysqli_fetch_assoc($result))
                                    {?>
                                        <tr>
                                          
                                            <td><?php echo $row['date'];?></td>
                              
                                            <td><?php echo $row['challanNo'];?></td>
                                            <td class="text-center"><?php echo $row['fromparty']."<br>".$row['frompartyaddress'];?></td>
                                            <td class="text-center"><?php echo $row['toparty']."<br>".$row['topartyaddress'];?></td>
                                            <td><?php echo $row['billtype'];?></td>
                                            <td><?php echo $row['truckno'];?></td>
                                            <td>
                                              
                                               <?php
                                                  if($row['status']=="OPEN")
                                                  {
                                                echo "<div class='badge badge-pill badge-success mb-1 float-right'>
                                                         ".$row['status']."
                                                      </div>";
                                                  }  

                                              //  echo $row['status'];
                                               ?>
                                            </td>
                                           
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