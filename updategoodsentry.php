<?php
include('header/header.php');

if(!isset($_GET['challanid']))
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
                    <h4>Modify challan Record  </h4>
                   
                  </div>
                  <div class="card-body">
                  <div class="row justify-content-end">
                        <input type="checkbox" name="checkstatus" id="checkstatus" class="mr-2">Update Challan
                    </div>
                  <input type="hidden" id="hiddenchallanid" value="<?php echo $challanid; ?>">
                    <H6>Goods Entry</H6>
                    <div class="form-row">
                      <div class="form-group col-md-3  col-5">
                        <label for="">Select Good</label>
                        <select id="selectgood" class="form-control">
                            <?php
                            echo $goodslist;
                            ?>
                        </select>

                        <input type="text" id="txtgoodname" class="form-control" readonly>

                      </div>
                      <input type="hidden" id="hidden_id" >
                      <div class="form-group col-md-1 col-3">
                        <label for="">Weight</label>
                        <input type="number" id="weight" class="form-control" placeholder="Weight">
                      </div>
                  
                      <div class="form-group col-md-1 col-3" id="divprice">
                      <label for="" id="lblprice">Price</label>
                        <input type="number" id="price" class="form-control" placeholder="price">
                      </div>
                      <div class="form-group col-md-1 col-3" id="divtotal">
                      <label for="" id="lbltotal">Total</label>
                        <input type="number" id="total" class="form-control" placeholder="Total">
                      </div>

                      <div class="form-group col-md-1 col-3" id="divqty">
                      <label for="" id="lblqty">Qty</label>
                        <input type="number" id="txtqty" class="form-control" placeholder="Qty">
                      </div>

                      <div class="form-group col-md-1 col-3" id="divdisc">
                      <label for="" id="lbldisc">Disc</label>
                        <input type="text" id="txtdisc" class="form-control" placeholder="Disc">
                      </div>
                      
                      <div class="form-group col-md-2 col-4">
                       <button class="btn btn-primary mt-4" id="addbtn" onclick="addrecord('<?php echo $challanid; ?>')">Add Record</button>
                       <button class="btn btn-warning mt-4" id="updatebtn" onclick="updaterecord('<?php echo $challanid; ?>')">Update Record</button>
                      </div>
                    </div>

                  
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Sr.No</th>
                          <th scope="col">Good Name</th>
                          <th scope="col">Weight</th>
                          <th scope="col">Price</th>
                          <th scope="col">Total</th>
                          <th scope="col">Qty</th>
                          <th scope="col">Disc</th>           
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody id="showgoodsdata">
                       
                      </tbody>
                    </table>

                   
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-primary" onclick=savechallan()>Submit</button>
                    <button class="btn btn-info" onclick=printbill()>Print</button>
                  </div>
                </div>




          </div>
        </section>
     

 <?php
 include('footers/footer.php');
?>


<script>
  $(document).ready(function() {
      //  alert('hii');
       readrecord();
       $('#price').hide();
      //  $('#lblprice').hide();
      //  $('#lbltotal').hide();
      //  $('#lblqty').hide();
      //  $('#lbldisc').hide();

      //  $('#divdisc').hide();
      //  $('#divqty').hide();
       $('#divtotal').hide();
       $('#divprice').hide();

      //  $('#txtqty').hide();
      //  $('#txtdisc').hide();
       
       $('#updatebtn').hide();
       $('#total').hide();
       $('#txtgoodname').hide();
      // $('#btnpencil').hide();


       $('#checkstatus').change(function() {
        if($(this).is(":checked")) {

            $('#price').show();
            // $('#upsection').show();
            $('#addbtn').hide();
            $('#selectgood').hide();
            $('#txtgoodname').show();
            $('#updatebtn').show();
            $('#total').show();
           // $('#btnpencil').show();

           $('#divdisc').show();
           $('#divqty').show();
           $('#divtotal').show();
           $('#divprice').show();

        }else{

            $('#addbtn').show();
            $('#txtgoodname').hide();
            // $('#upsection').hide();
            $('#selectgood').show();
            $('#updatebtn').hide();
            $('#price').hide();
            $('#total').hide();


            $('#divdisc').hide();
       $('#divqty').hide();
       $('#divtotal').hide();
       $('#divprice').hide();

        }

    });

//price mulipiers
    $("#price").keyup(function(){

        var upweight = $('#weight').val();
        var price=$(this).val();
        if(price>0)
        {
            //alert(price);
            var rr=upweight*price;
            $('#total').val(rr);
        }
        else
        {
            $('#total').val("0");
           // alert("echo");
        }
        //console.log('gg');
  //  var upweight = $('#weight').val();
    // var upprice = $('#price').val();
       // alert();
  // $('#total').val();
    
});
    });





    function savechallan()
    {
  var challanID = $('#hiddenchallanid').val();
      getsubtotal(challanID);
    }


    function savechallanandprint()
    {
  var challanID = $('#hiddenchallanid').val();
      getsubtotal(challanID);
      window.location = "printablewithamt.php?challanid="+challanID;
    }

    function printbill()
    {
      var challanID = $('#hiddenchallanid').val();
      //getsubtotal(challanID);
      window.location = "printableA5.php?challanid="+challanID;
    }



    function getdata(challangoodid)
    {
        // alert(challangoodid);

          //  alert("get details hii"+updateid);
          $('#hidden_id').val(challangoodid);

            $.post("goods_backend.php", {
                challangoodid: challangoodid
            }, function(data, status) {
                // alert("Successfully");
                var user = JSON.parse(data);
                //   $('#up_categoryname').val(user.name);
                    console.log(user);

                 $('#txtgoodname').val(user.goodname);
                //  $('#selectgood').html('readonly');
                 $('#weight').val(user.weight);
                 $('#price').val(user.price);
                 $('#total').val(user.total);
                 $('#txtqty').val(user.qty);
                 $('#txtdisc').val(user.disc);
                // $('#upservicename').val(user.servicename);
                // $('#upserviceamt').val(user.serviceamt);

            });
           // $('#updatecustomer').modal('show');

                }




    function addrecord(challanid)
{
    //  alert(id)
    var goodname = $('#selectgood').val();
    var servicename = $('#selectgood').val();
    var weight = $('#weight').val();
    var qty = $('#txtqty').val();
    var disc = $('#txtdisc').val();
  //  alert(challanid+goodname+weight);
      if(weight!="")
      {
        // alert("inserting good");
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
                    $('#txtdisc').val("");
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                  readrecord();
                    // $('#tblcontent').html(data);
                },
            });
      }else{
      alert("inserting service");

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
  
}

function updaterecord()
{
    var itemids = $('#hidden_id').val();
    var upweight = $('#weight').val();
    var upgoodname = $('#txtgoodname').val();
    var uptotal = $('#total').val();
    var upprice = $('#price').val();
    var upqty = $('#txtqty').val();
    var updisc = $('#txtdisc').val();

   //  alert(itemids + upweight + upgoodname + uptotal + upprice);

    $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                    itemids: itemids,
                    upweight: upweight,
                    upgoodname: upgoodname,
                    uptotal: uptotal,
                    upprice: upprice,
                    upqty: upqty,
                    updisc: updisc,
                },
                success: function(data) {
                    console.log(data);
                    readrecord();
                },
            });




}




    function readrecord()
{
  var upchallanID = $('#hiddenchallanid').val();
// alert(idgood);
var updatecheck="true";
    $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                  upchallanID: upchallanID,
                  updatecheck: updatecheck,
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