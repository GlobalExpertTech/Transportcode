<?php
include('header/header.php');
// include('functions.php');
include('config.php');


date_default_timezone_set("Asia/Calcutta");
$today=date('Y-m-d');


function getusernamebyvchid($con,$vchid)
{
    $selectquery = "SELECT * FROM `vouchersdtls` where `vouchersid`='$vchid' AND `DRCRtype`='DR'";
    //  echo $selectquery;
   $result = mysqli_query($con, $selectquery);
   $row = mysqli_fetch_assoc($result);
   $legerid=$row['ledgerid'];

   echo getPartyNameByLegerid($con,$legerid);
}



function getPartyNameByLegerid($con,$legerid)
{
    $selectquery = "SELECT * FROM `ledgermaster` where `ledgerid`='$legerid'";
    //   echo $selectquery;
   $result = mysqli_query($con, $selectquery);
   $row = mysqli_fetch_assoc($result);
   $ledgername=$row['ledgername'];
   return $ledgername;
}
?>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                    
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Users</h5>
                          <h2 class="mb-3 font-18">
                          <?php
                            $usersql="SELECT * FROM `userlogin`";
                            echo mysqli_num_rows(mysqli_query($con,$usersql));
                            ?>
                          </h2>
                         </div>
                      </div>
                   
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                       
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Party</h5>
                          <h2 class="mb-3 font-18">
                          <?php
                            $usersql="SELECT * FROM `partydata`";
                            echo mysqli_num_rows(mysqli_query($con,$usersql));
                            ?>
                          </h2>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                         <img src="assets/img/banner/1.png" alt="">
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Today Challan</h5>
                          <h2 class="mb-3 font-18">
                            
                          <?php
                            $usersql="SELECT * FROM `challanrecord` WHERE `date`='$today'";
                            echo mysqli_num_rows(mysqli_query($con,$usersql));
                            ?>
                          </h2>
                          
                         </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Challan</h5>
                          <h2 class="mb-3 font-18">
                          
                          <?php
                            $usersql="SELECT * FROM `challanrecord`";
                            echo mysqli_num_rows(mysqli_query($con,$usersql));
                            ?>

                          </h2>
                         </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <!-- <a class="mb-0"style="color:#111" href="add_category.php"> <p class="mb-0">All Categories</p></a>
          <hr>-->
          <div class="row ">
             <?php 
                                    // $count=0; 
                                    // $query="select * from tbl_category where fld_category_delete='0' order by fld_category_id desc ";
                                    // $row=mysqli_query($connect,$query) or die(mysqli_error($connect));
                                    
                                    // while($fetch=mysqli_fetch_array($row)) {

                                    // extract($fetch);

                                ?>
            <!-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Testing data</h5>
                      <!--     <h2 class="mb-3 font-12"style="color:#a11">697</h2> -->
                           <!-- <p class="mb-0"><span class="col-green">10</span> Products</p>
                     
                         </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                         <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --> 
            <?php 
          // }  
          ?>
          </div>
          <hr>
           <div class="row">
            <div class="col-md-6 col-lg-12 col-xl-6">
               
              <div class="card">
                <div class="card-header">
                  <h4>Today's Challans</h4>
                  <!-- <form class="card-header-form">
                    <input type="text" name="search" class="form-control" placeholder="Search">
                  </form> -->
                </div>
                <div class="card-body">
<?php 


echo $today; 

$selecttodayschallan="SELECT * FROM `challanrecord` WHERE `date`='$today' AND `status`='OPEN'";
// echo $selecttodayschallan;

$result=mysqli_query($con,$selecttodayschallan);

if(mysqli_num_rows($result)>0)
{

  while($row=mysqli_fetch_assoc($result))
  {?>
<div class="support-ticket media pb-1 mb-3">
                    <img src="assets/img/image-64.png" class="user-img mr-2" alt="">
                    <div class="media-body ml-3">
                      <div class="badge badge-pill badge-success mb-1 float-right">OPEN</div>
                      <span class="font-weight-bold">Bill No : <?php echo $row['billno']; ?> / <?php echo $row['challanNo']; ?></span>
                      <!-- <a href="javascript:void(0)">XYZ ENGGINESERING TO ABC ENGGINESERING</a> -->
                      <p class="my-1"><?php echo $row['fromparty']; ?> <b>TO</b> <?php echo $row['toparty']; ?></p>
                      <small class="text-muted">Vehical N0 :  <span class="font-weight-bold font-13"><?php echo $row['truckno']; ?></span>
                        <!-- &nbsp;&nbsp; - 1 day ago -->
                      </small>
                    </div>
                  </div>
  <?php
  }



}else
{
  echo " No Record Found";
}



?>
                </div>
               
              </div>
                                      
            </div>
             <div class="col-md-6 col-lg-12 col-xl-6">
              <div class="card">
                <div class="card-header">
                  <h4>Recipt Entries</h4>
                  <form class="card-header-form">
                    <input type="date" id="txtdate" class="form-control" placeholder="Search">
                  </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Party Name</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php

$selectsql="SELECT * FROM `vouchers` WHERE `vouchersdate`='$today' AND `sub_vchtype`='recipt'";
// echo $selectsql;
$resultcoucher=mysqli_query($con,$selectsql);
if(mysqli_num_rows($resultcoucher)>0){

  while($rows=mysqli_fetch_assoc($resultcoucher))
{
  $vchid=$rows['vouchersid'];
  ?>
  <tr>
      <td><?php  echo $rows['vouchersid']; ?></td> 
      <td><?php  echo getusernamebyvchid($con,$vchid) ?></td> 
      <td><?php  echo $rows['vouchersdate']; ?></td> 
      <td><?php  echo $rows['vouchersamount']; ?></td> 
      <td><?php  echo $rows['paymenttype']; ?></td> 
</tr>
<?php }

}
else
{
  echo '<tr>
      <td>No recipt Found</td>
  </tr>';
}



                       ?>
                      </tbody>
                    </table>
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

  $('#txtdate').change(function() {
    var date = $(this).val();

    getdataforrecipt(date);

    // console.log(date, 'change')
});


function getdataforrecipt(reciptdate)
{

}
  </script>