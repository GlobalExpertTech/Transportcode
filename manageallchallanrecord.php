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
                            <th>Bill.No</th>
                            <th>Challan.No</th>
                            <th class="text-center">From</th>
                            <th class="text-center">To</th>
                            <th>Payment Type</th>
                            <th>Truck No</th>
                            <th>Status</th>
                            <th>Action</th>

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
                                            <td> <a href="updategoodsentry.php?challanid=<?php echo $row['billno'];?>"> <?php echo $row['billno'];?></a></td>
                                            <td>  <?php echo $row['challanNo'];?></td>
                                            <td class="text-center"><?php echo $row['fromparty']."<br>".$row['frompartyaddress'];?></td>
                                            <td class="text-center"><?php echo $row['toparty']."<br>".$row['topartyaddress'];?></td>
                                            <td><?php echo $row['billtype'];?></td>
                                            <td><?php echo $row['truckno'];?></td>
                                            <td>
                                            <button class="btn btn-primary btn-sm" title="print with Amt" id="btndelivered" onclick="printchallanamt('<?php echo $row['billno'];?>','DELIVERED')"> <i class="fas fa-print"></i> </button>
                                              
                                               <?php
                                                  if($row['status']=="OPEN")
                                                  {
                                                echo "<div class='badge badge-pill badge-warning mb-1 float-right'>
                                                         ".$row['status']."
                                                      </div>";
                                                  }  
                                                  if($row['status']=="DELIVERED")
                                                  {
                                                echo "<div class='badge badge-pill badge-success mb-1 float-right'>
                                                         ".$row['status']."
                                                      </div>";
                                                  }  

                                              //  echo $row['status'];
                                               ?>
                                            </td>
                                            <td>
                                               
                                                <?php 
                                                    if($row['status']=="OPEN")
                                                    {
                                                    ?>
                                                         <button class="btn btn-primary btn-sm" title="Mark As Delivered" id="btndelivered" onclick="deliveredstatus('<?php echo $row['challanNo'];?>','DELIVERED')"> <i class="fas fa-truck"></i> </button>
                                                <button class="btn btn-primary btn-sm" title="Return Shipment"   id="btnreturn"   onclick="deliveredstatus('<?php echo $row['challanNo'];?>')"> <i class="fas fa-reply"></i> </button>

                                                    <?php
                                                    }  
                                                    if($row['status']=="DELIVERED")
                                                    {
                                                        ?>
                                                        <button class="btn btn-warning btn-sm" title="Mark As OPEN" id="btnundo" onclick="deliveredstatus('<?php echo $row['challanNo'];?>','OPEN')"> <i class="fas fa-undo"></i> </button>
                                                        <?php
                                                    }  
                                                ?>
                                            
                                               
                                                
                                                <!-- <button class="btn btn-primary"> <i class="fas fa-truck"></i> </button> -->
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

<script>



function printchallanamt(challanno)
{
  // alert(challanno);
  window.location = "printableA5.php?challanid="+challanno;
}
    function deliveredstatus(challanid,status)
    {
    //    alert(challanid)
    swal({
                    title: "Confirmation",
                    text: "Are you sure that the Challan No "+challanid+" is "+status+". Press Ok to Mark As a "+status,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "challanmanager_backend.php",
                            type: "POST",
                            data: {
                                challanid: challanid,
                                status:status
                            },
                            success: function(data) {
                                // swal("Poof! Your imaginary file has been deleted!" + deleteid, {
                                //     icon: "success",
                                // });
                                location.reload(true);
                                //alert("sucess");
                                //   readrecord();
                            },
                        });


                    } else {

                    }
                });

    }
</script>