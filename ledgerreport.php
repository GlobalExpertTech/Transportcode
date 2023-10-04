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

if(isset($_POST['submitcomapny']))
{
  $party = $_POST['partydropdown'];
  $fromdate = $_POST['fdate'];
  $todate = $_POST['tdate'];
  $comapnyid = $_POST['krantiids'];
  echo "
    <script>
    window.location = 'viewledger.php?legerid=".$party."&fdate=".$fromdate."&todate=".$todate."&companyid=".$comapnyid."';
    </script>
  ";

}

// if(isset($_POST['submitmonthreport']))
// {


//   $monthparty = $_POST['monthpartydropdown'];
//   $monthname = $_POST['monthname'];

//  // echo  "legerid=".$monthparty."&monthname =".$monthname;
//    echo "
//      <script>
//   window.location = 'Viewmonthledger.php?legerid=".$monthparty."&monthname=".$monthname."&companyid=".$comapnyid."';
//      </script>
//    ";

// }



?>


      <!-- Main Content -->
      <div class="main-content ">
        <section class="section justify-content-center">
          <div class="section-body">
            <!-- add content here -->
<div class="row">
            <div class="card col-12 col-md-5 m-1 ">
        <div class="card-header">
          <h4>Search Ledger</h4>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data" class="col-12">
            <div class="row ">
              <div class="form-group col-12">
                        <label for="fparty">Select Company</label>
                        <select id="krantiids" class="form-control" name="krantiids">
                          <!-- <option value="">----Select Company----</option> -->
                          <option value="1">Kranti OLD</option>
                          <option value="2">Kranti New</option>
                        </select>
                       
                      </div>
              <div class="form-group col-12">
                <label>Party Name</label>
                <select id="partydropdown" class="form-control" name="partydropdown" required>
                            <?php
                            echo $party;
                            ?>
                        </select>
              </div>
              <div class="form-group col-6">
                <label>From Date</label>
                <input type="date" name="fdate"  class="form-control" id="fdate" required>
              </div>
              <div class="form-group col-6">
                <label>To Date</label>
                <input type="date" name="tdate"  class="form-control" id="tdate" required>
              </div>

            </div>

            <div class="card-footer text-right">
             
             <button class="btn btn-primary mr-1" name="submitcomapny" type="submit">Submit</button>
             
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

<script>
  $( document ).ready(function() {
  $('#partydropdown').chosen();
  
  
});
</script>