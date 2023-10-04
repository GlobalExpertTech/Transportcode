<?php
include('header/header.php');
date_default_timezone_set("Asia/Calcutta");
//getting list of party
$sql="SELECT DISTINCT `id`,`companyname`,`ledgerid` FROM `partydata` ORDER BY `partydata`.`companyname` ASC";
$result = mysqli_query($con, $sql);
$party="<option value='0'>Select Party</option>";

while($row = mysqli_fetch_array($result))
{
    $party = $party."<option value='$row[2]'>$row[1]</option>";
}
?>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->

            <div class="card">
        <div class="card-header">
          <h4>Recipt Entry</h4>
        </div>
        <div class="card-body">
          <!-- <form action="" method="post" enctype="multipart/form-data"> -->
            <div class="row">
              <div class="form-group col-6">
                <label>Party Name</label>
                <select id="partydropdown" class="form-control" name="partydropdown">
                            <?php
                            echo $party;
                            ?>
                        </select>
              </div>
              <div class="col-6">
              <label>Recipt Date</label>
                  <input type="date" class="form-control" name="txtdate" value="<?php echo date("Y-m-d")?>" id="txtdate">
              </div>

            </div>
            <div class="row">
                <!-- <div class="col-12 col-md-4">Address : <b><span id="txtaddress"></span></b></div>
                <div class="col-12 col-md-4">Mob : <b><span id="txtmob"></span></b> </div> -->
                <div class="col-12 col-md-4">Outstanding : 
                  <b>
                    <span id="txtbalplus" class="text-success"></span>
                    <span id="txtbalminus" class="text-danger"></span>
                  </b>
                 </div>
            </div>
            <hr>

            <div class="row">
              <div class="form-group col-6">
                <label>Amount</label>
                <input type="text" id="amt"  class="form-control">
              </div>

              <div class="form-group col-6">
                <label>Transaction Type</label>
                <select class="form-control" id="billtype" name="billtype" >
                          <option value="0">Select Bill Type</option>
                          <option value="cash">Cash</option>
                          <option value="Online">Online</option>
                          <option value="credit">Credit</option>
                          <option value="chequee">chequee</option>
                        </select>
              </div>
            </div>

           

            <div class="row">
              <div class="form-group col-6">
                <label>Narration</label>
                <textarea class="form-control" name="narration" id="narration"></textarea>
              </div>
              <div class="form-group col-6">
                <label>Payment Discription</label>
                <textarea class="form-control" name="disc" id="disc"></textarea>
              </div>

             
            </div>




            <div class="card-footer text-right">
             
             <button class="btn btn-primary mr-1" name="submitcomapny" onclick="insertrecipt()" type="">Submit</button>
             
              <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </div>
      </div>
      <!-- </form> -->

    </div>
  </section>
  <?php
  include('footers/footer.php');
  ?>


  <script>

$( document ).ready(function() {
  $('#partydropdown').chosen();
    $('#partydropdown').change(function() {
      $('#txtbalplus').html("");
      $('#txtbalminus').html("");
    var partyidledgerid=$(this).val();

    $.ajax({
                url: "voucher_backend.php",
                type: "POST",
                data: {
                  partyidledgerid: partyidledgerid,
                },
                success: function(data) {
                    console.log(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                  if(data>0)
                  {
                    $('#txtbalplus').html(data);
                  }else
                  {
                    $('#txtbalminus').html(data);
                  }
                    
                    // $('#frompartyaddress1').val(data);
                },
            });


});

  
});



function insertrecipt()
{
  var party=$('#partydropdown').val();
  var rdate=$('#txtdate').val();
  var Amount=$('#amt').val();
  var paymenttype=$('#billtype').val();
  var disc=$('#disc').val();
  var narration=$('#narration').val();

  // alert(party+" "+Amount+" "+paymenttype+" "+disc+" "+narration);  

  $.ajax({
                url: "challan_backend.php",
                type: "POST",
                data: {
                  party: party,
                  rdate:rdate,
                  Amount: Amount,
                  paymenttype: paymenttype,
                  disc: disc,
                  narration: narration
                },
                success: function(data) {
                    console.log(data);
                    $('#partydropdown').val("0");
                    $('#amt').val("");
                    $('#billtype').val("0");
                    $('#disc').val("");
                    $('#narration').val("");
                },
            });
}
  </script>