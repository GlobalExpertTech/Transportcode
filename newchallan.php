<?php
include('header/header.php');
include('check.php');

//getting list of transporters
$sql="SELECT DISTINCT `id`,`companyname` FROM `partydata` ORDER BY `partydata`.`companyname` ASC";
$result = mysqli_query($con, $sql);
$transport="<option value='0'>Select Party</option>";

while($row = mysqli_fetch_array($result))
{
    $transport = $transport."<option value='$row[0]'>$row[1]</option>";
}
//------------Ends getting party data

//getting list of transporters
$sqlpayee="SELECT DISTINCT `id`,`companyname` FROM `partydata` ORDER BY `partydata`.`companyname` ASC";
$resultpayee = mysqli_query($con, $sqlpayee);
$payeelist="<option value='0'>Select Party</option>";

while($row = mysqli_fetch_array($resultpayee))
{
    $payeelist = $payeelist."<option value='$row[1]'>$row[1]</option>";
}
//------------Ends getting party data
//-----------Getting list of trucks
//getting list of transporters
$sql="SELECT DISTINCT `id`,`trucknumber` FROM `trucksdata`";
$result = mysqli_query($con, $sql);
$Trucklist="<option value='0'>---Select Truck---</option>";

while($row = mysqli_fetch_array($result))
{
    $Trucklist = $Trucklist."<option value='$row[1]'>$row[1]</option>";
}
//------------Ends-----------------
//getting goods data
$sql="SELECT DISTINCT `goodname` FROM `gooddata` ORDER BY `gooddata`.`goodname` ASC";
$result = mysqli_query($con, $sql);
$goodslist="<option value='0' disabled>Select Goods</option>";

while($row = mysqli_fetch_array($result))
{
    $goodslist = $goodslist."<option value='$row[0]'>$row[0]</option>";
}

$highestValue="00";
//get the challan Number 
$query = "SELECT MAX(id) FROM challanrecord";
$result = mysqli_query($con,  $query);
$row = mysqli_fetch_row($result);
// echo
$highestValue =  getbillno($row[0]+1);
//------------ENDS--------------



if(isset($_POST['submit']))
{
    $challanid=$_POST['challanid'];
    $challandate=$_POST['challandate'];
    $billno=$_POST['billno'];
    $billtype=$_POST['billtype'];
    $fromparty=$_POST['fparty'];
    $frompartyaddress=$_POST['frompartyaddress1'];
    $chequeenumber=$_POST['chequeenumber'];
    $toparty=$_POST['tpaty'];
    $topartyaddress=$_POST['topartyaddress1'];
    $truckno=$_POST['truckno'];
    $payingparty=$_POST['payingparty'];
    $krantiid=$_POST['krantiids'];
    $deliverdat=$_POST['deliveredat'];


    $insertchallan="INSERT INTO `challanrecord`(`challanNo`, `date`, `billno`, `billtype`,`chequeenumber`, `fromparty`, `frompartyaddress`, `toparty`, `topartyaddress`, `truckno`, `payingparty`,`companyid`,`dileverdat`) 
                    VALUES ('$challanid','$challandate','$billno','$billtype','$chequeenumber',(SELECT `companyname` from partydata where id='$fromparty'),'$frompartyaddress',(SELECT `companyname` from partydata where id='$toparty'),'$topartyaddress','$truckno','$payingparty','$krantiid','$deliverdat')";

      if(mysqli_query($con,$insertchallan))
      {
        
        echo '<script type="text/javascript">
           window.location = "goodsentry.php?challanid='.$billno.'"
      </script>';
    $_SESSION['validid'] = "1";
      }



}

?>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->

<form action="" method="post">
            <div class="card">
                  <div class="card-header">
                    <h4>Create New challan</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-3 col-6">
                        <label for="inputEmail4">Challan No : </label>
                        <input type="text" class="form-control" name="challanid" >
                      </div>
                      <div class="form-group col-md-3 col-6">
                        <label for="">Date</label>
                        <input class="form-control" type="date" name="challandate" value="<?php echo date("Y-m-d")?>" id="chldate">
                      </div>
                      <div class="form-group col-md-3 col-6">
                        <label for="">Bill No</label>
                        <input class="form-control" type="text" name="billno" value="<?php echo $highestValue; ?>" id="inputEmail4" readonly>
                      </div>
                      <div class="form-group col-md-3 col-6">
                        <label for="inputPassword4">Bill Type</label>
                        <select class="form-control" id="billtype" name="billtype" >
                          <option value="">Select Bill Type</option>
                          <option value="cash">Cash</option>
                          <option value="Online">Online</option>
                          <option value="credit">Credit</option>
                          <option value="chequee">chequee</option>
                        </select>
                        <input type="text" class="form-control mt-3" id="chequeenumber" name="chequeenumber" placeholder="Enter cheque Number">
                      </div>
                    </div>
    <hr>
                  <div class="form-row">
                      <div class="form-group col-md-6  col-6">
                        <label for="fparty">From Party</label>
                        <select id="fparty" class="form-control" name="fparty" onchange="fpartey()">
                           <?php
                           echo $transport;
                            ?> 
                        </select>
                        <p class="mt-2"><b>Address</b> : <span name="frompartyaddress" id="frompartyaddress"></span></p>
                        <input type="hidden" id="frompartyaddress1" name="frompartyaddress1">
                        <!-- <p><b>Address</b> : <span id="frompartymob"></span></p> -->
                      </div>
                      <div class="form-group col-md-6  col-6">
                        <label for="tpaty">To Party</label>
                        <select class="form-control" name="tpaty" id="tpaty" onchange="tparty()">
                        <?php
                            echo $transport;
                            ?>
                        </select>
                        <p class="mt-2"><b>Address</b> : <span name="topartyaddress" id="topartyaddress"></span></p>
                        <input type="hidden" id="topartyaddress1" name="topartyaddress1">
                      </div>

                      <div class="form-group col-md-3  col-6">
                        <label for="fparty">Select Transport</label>
                        <select id="fparty" class="form-control" name="truckno">
                            <?php
                            echo $Trucklist;
                            ?>
                        </select>
                       
                      </div>
                      <div class="form-group col-md-3  col-6">
                        <label for="payingparty">Payee Name</label>
                        <select id="payingparty" class="form-control" name="payingparty" id="payingparty" >
                        <?php
                            echo $payeelist;
                            ?>
                        </select>
                        

                  </div>
                      <div class="form-group col-md-3  col-6">
                        <label for="fparty">Select Company</label>
                        <select id="krantiids" class="form-control" name="krantiids">
                          <!-- <option value="">----Select Company----</option> -->
                          <option value="1">Kranti OLD</option>
                          <option value="2">Kranti New</option>
                        </select>
                       
                      </div>
                      <div class="form-group col-md-3  col-6">
                        <label for="payingparty">Delivered At</label>
                        <select id="deliveredat" class="form-control" name="deliveredat" id="deliveredat" >
                        <option value="Door Step">Door Step</option>
                          <option value="Godown">Godown</option>
                        </select>
                        

                  </div>
                    <button class="btn btn-primary form-control" type="submit" name="submit">Create Challan</button>

                    </div>

                  
                  <!-- <div class="card-footer mt--5  text-right">
                  </div> -->
                </div>
          </div>
        </section>
        </form> 

 <?php
 include('footers/footer.php');
?>

<script>

// var today = moment().format('YYYY-MM-DD');
// document.getElementById("chldate").value = today;
// /  
$( document ).ready(function() {
  $('#fparty').chosen();
  $('#tpaty').chosen();
  $('#payingparty').chosen();
    // console.log( "ready!" )//;
  $('#chequeenumber').hide();

    $('#billtype').change(function() {
    if ($(this).val() === 'chequee') {
        // Do something for option "b/\"
        // alert('HIi');
        $('#chequeenumber').show();
    }else{
      $('#chequeenumber').hide();
    }
});
  
});



function fpartey()
{
  // alert('hii');
  var fpartyid=$('#fparty').val();
  //  alert(fparty);


  $.ajax({
                url: "customers_backend.php",
                type: "POST",
                data: {
                  fpartyid: fpartyid,
                },
                success: function(data) {
                    console.log(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                    $('#frompartyaddress').html(data);
                    $('#frompartyaddress1').val(data);
                },
            });

}

function tparty()
{
  // alert('hii');
  var fpartyid=$('#tpaty').val();
  // alert(fparty);
  $.ajax({
                url: "customers_backend.php",
                type: "POST",
                data: {
                  fpartyid: fpartyid,
                },
                success: function(data) {
                    console.log(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                    $('#topartyaddress').html(data);
                    $('#topartyaddress1').val(data);
                },
            });

}
</script>