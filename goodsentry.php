<?php
include('header/header.php');

if(!isset($_GET['challanid']) || $_SESSION['validid']=="")
{
  header('Location:newchallan.php');
}

$challanid=$_GET['challanid'];

//getting goods data
$sql="SELECT DISTINCT `id`,`goodname` FROM `gooddata` ORDER BY `gooddata`.`goodname` ASC";
$result = mysqli_query($con, $sql);
$goodslist="<option value='0'>---Select Goods---</option>";

while($row = mysqli_fetch_array($result))
{
    $goodslist = $goodslist."<option value='$row[0]'>$row[1]</option>";
}

//--------getting Service List data----------
$sql1="SELECT `servicename` FROM `servicemaster`";
$result1 = mysqli_query($con, $sql1);
$goodslist=$goodslist."<option value='0' disabled>-----Service-----</option>";

while($row1 = mysqli_fetch_array($result1))
{
    $goodslist = $goodslist."<option value='$row1[0]'>$row1[0]</option>";
}
// service data work finish
//--------getting goods data----------

// $highestValue="00";
// //get the challan Number 
// $query = "SELECT MAX(id) FROM challanrecord";
// $result = mysqli_query($con,  $query);
// $row = mysqli_fetch_row($result);
// // echo
// $highestValue =  "KRANTI00".$row[0]+1;
// //------------ENDS--------------


?>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->


            <div class="card">
                  <div class="card-header">
                    <h4>Create New challan </h4>
                  </div>
                  <div class="card-body">
                  <input type="hidden" id="hiddenchallanid" value="<?php echo $challanid; ?>">
                    <H6>Goods Entry</H6>
                    <div class="form-row">
                      <div class="form-group col-md-3  col-5">
                      <label for="">Select Goods</label>
                        <select id="selectgood" class="form-control">
                            <?php
                            echo $goodslist;
                            ?>
                        </select>
                      </div>
                      <div class="form-group col-md-1 col-3">
                      <label for="">Weight</label>
                        <input type="text" id="weight" class="form-control" placeholder="Weight">
                      </div>
                      <div class="form-group col-md-1 col-3">
                        <label for="">Qty</label>
                        <input type="text" id="txtqty" class="form-control" placeholder="Qty">
                      </div>
                      <div class="form-group col-md-3 col-3">
                        <label for="">Discription</label>
                        <!-- <input type="text" id="weight" class="form-control" placeholder="Weight"> -->
                        <Textarea class="form-control" id="txtarea"></Textarea>
                      </div>
                      <div class="form-group col-md-3 col-4">
                      
                       <button class="btn btn-primary btn-lg mt-4" onclick="addrecord('<?php echo $challanid; ?>')" >Add to challan</button>
                      </div>
                    </div>

                  
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Sr.No</th>
                          <th scope="col">Good Name</th>
                          <th scope="col">Weight</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody id="showgoodsdata">
                       
                      </tbody>
                    </table>

                   
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-primary btn-lg" id="btnsave"onclick=savechallan()>Submit ( Ctrl+s )</button>
                    <button class="btn btn-warning btn-lg" id="btnsaveprint" onclick=savechallanandprint()>Submit + Print ( Ctrl+p )</button>
                    <button class="btn btn-warning btn-lg" id="btnprint"onclick=printchallan()>Print</button>
                    <a href="newchallan.php"><button class="btn btn-info id="btnnewchallan"  btn-lg" onclick=savechallanandprint()>New Challan ( Ctrl+n )</button>
                    </a> </div>
                </div>




          </div>
          <!-- <h6>Shortcut Keys :  <span class="text-warning">1) Save Challan : ( Ctrl+s )</span>  |  2) Save and print challan (Ctrl+p)  |  3) New challan (Ctrl+n)</h6> -->
        </section>
     

 <?php
 include('footers/footer.php');
?>


<script>
  //Saving challan with ctrl+s
  $(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.which == 83){
      savechallan();
        return false;
    }
});

 //Printing and saving challan with ctrl+p
 $(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.which == 80){
      savechallanandprint()
        return false;
    }
});

 //Create new challan with ctrl+n
 $(document).bind("keyup keydown", function(e){
    if(e.ctrlKey && e.which == 77){
     
       createnewchallan();
        return false;
    }
});


function createnewchallan(){
  window.location = "newchallan.php";
}
  $(document).ready(function() {
    $('#btnprint').hide();

    $(window).keypress(function(event) {
    if (event.which == 115 && event.ctrlKey){
        myfunction();
    }
   });
      //  alert('hii');

        // $('#txtarea').keypress(function (e) {
        // if (e.which == 13) {
        //   alert('hii');
        //       // $('input[name = butAssignProd]').click();
        //       // return false;  
        // }
// });

       readrecord();
    });





    function savechallan()
    {
  var challanID = $('#hiddenchallanid').val();
      getsubtotal(challanID);
      createnewchallan();
    }


    function savechallanandprint()
    {
  var challanID = $('#hiddenchallanid').val();
      getsubtotal(challanID);
      window.open("printable.php?challanid="+challanID, '_blank').focus();
      createnewchallan();
      // window.location = "printable.php?challanid="+challanID;
    }


    function addrecord(challanid)
{
    //  alert(id)
    var goodname = $('#selectgood').val();
    var servicename = $('#selectgood').val();
    var weight = $('#weight').val();
    var qty = $('#txtqty').val();
    var disc = $('#txtarea').val();
  //  alert(challanid+goodname+weight);
      if(weight!="")
      {
        $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                  challanid: challanid,
                    goodname: goodname,
                    weight: weight,
                    qty: qty,
                    disc: disc,
                },
                success: function(data) {
                    console.log(data);
                    $('#weight').val("");
                    $('#txtqty').val("");
                    $('#txtarea').val("");
                    
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                  readrecord();
                    // $('#tblcontent').html(data);
                },
            });
      }
var servicevalue="1";
      $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                  challanid: challanid,
                  servicename: servicename,
                  servicevalue: servicevalue,
                },
                success: function(data) {
                    console.log(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                  readrecord();
                    // $('#tblcontent').html(data);
                },
            });

  
}





    function readrecord()
{
  var challanID = $('#hiddenchallanid').val();
// alert(idgood);
    $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                  challanID: challanID,
                },
                success: function(data) {
                    console.log(data);
                    $("#showgoodsdata").html(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                    // $('#tblcontent').html(data);
                },
            });

}

function getsubtotal(challannumber)
{

  var subtotal="subtotal";
  $.ajax({
                url: "challan_backend.php",
                type: "POST",
                data: {
                  challannumber: challannumber,
                  subtotal:subtotal,
                },
                success: function(data) {
                    console.log(data);
                    // return 
                   // $("#showgoodsdata").html(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                    // $('#tblcontent').html(data);
                },
            });

}

function deletegooditem(itemid)
{
    // alert(id);
    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Item Data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "goods_backend.php",
                            type: "POST",
                            data: {
                              itemid: itemid
                            },
                            success: function(data) {
                                swal("Poof! Your imaginary file has been deleted!" + itemid, {
                                    icon: "success",
                                });
                                location.reload(true);
                                //alert("sucess");
                                   readrecord();
                            },
                        });


                    } else {

                    }
                });
}
</script>