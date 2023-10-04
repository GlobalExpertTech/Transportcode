<?php
include('header/header.php');
//getting list of party
$sql="SELECT DISTINCT `id`,`companyname`,`ledgerid` FROM `partydata` ORDER BY `partydata`.`companyname` ASC";
$result = mysqli_query($con, $sql);
$party="<option value='0'>Select Party</option>";

while($row = mysqli_fetch_array($result))
{
    $party = $party."<option value='$row[2]'>$row[1]</option>";
}


if(isset($_POST['submitmonthreport']))
{
  $monthparty = $_POST['monthpartydropdown'];
  $monthname = $_POST['monthname'];

 // echo  "legerid=".$monthparty."&monthname =".$monthname;
   echo "
     <script>
  window.location = 'Viewmonthledger.php?legerid=".$monthparty."&monthname=".$monthname."';
     </script>
   ";

}



?>


      <!-- Main Content -->
      <div class="main-content ">
        <section class="section justify-content-center">
          <div class="section-body">
            <!-- add content here -->
<div class="row">
          

<div class="card col-12 col-md-5 m-1">
        <div class="card-header">
          <h4>MonthWise Report</h4>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data" class="col-12">
            <div class="row ">
              <div class="form-group col-12">
                <label>Party Name</label>
                <select id="monthpartydropdown" class="form-control" name="monthpartydropdown" required>
                            <?php
                            echo $party;
                            ?>
                        </select>
              </div>
              <div class="form-group col-12 ">
                <label>Select Month</label>
                <input type="month" name="monthname"  class="form-control" id="monthname" required>
              </div>
              <!-- <div class="form-group col-6">
                <label>To Date</label>
                <input type="date" name="tdate"  class="form-control" id="tdate">
              </div> -->

            </div>

            <div class="card-footer text-right">
             
             <button class="btn btn-primary mr-1" name="submitmonthreport" type="submit">Submit</button>
             
              <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
          </form>
        </div>
      </div>
      </div>

          </div>
        </section>
     

 <?php
 include('footers/footer.php');
?>