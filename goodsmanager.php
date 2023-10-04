<?php
include('header/header.php');
$goosid = 0;
if (isset($_GET['id']) == "") {
  header('Location:logout.php');
}

//getting list of transporters
$sql = "SELECT DISTINCT `range` FROM `rangedata`";
$result = mysqli_query($con, $sql);
$goodslist = "<option value='0'>Select Good Range</option>";

while ($row = mysqli_fetch_array($result)) {
  $goodslist = $goodslist . "<option value='$row[0]'>$row[0]</option>";
}



$goosid = $_GET['id'];

// echo $goosid;


?>


<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->

      <h3> Manage Goods Data  <button class="btn btn-info btn-sm" onclick="readrecord()">Refresh</button></h3>


      <div class="row">
            <input type="hidden" id="hidden_id" value="<?php echo $goosid; ?>">
        <div class="col-5">
          <select name="" class="form-control" id="goodrange">
            <?php echo $goodslist ?>
          </select>
        </div>
        <div class="col-5">
          <input type="number" id="price" class="form-control" placeholder="Price For Range">
        </div>
        <div class="col-2">
          <button class="btn btn-primary" onclick="addrangerate(<?php echo $goosid;?>)">Add</button>
        </div>

      </div>

    <div class="container mt-5">
      <div class="card">
                  <div class="card-header">
                    <h4>Simple Table</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr>
                          <th>Sr.No</th>
                          <!-- <th>Good Name</th> -->
                          <th>Range</th>
                          <th>Price</i></th>
                          <th>Remove</th>
                        </tr>
                      <tbody id="showdata">

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
 $(document).ready(function() {
      //  alert('hii');
      readrecord();
    });


    function deleterangesdata(deleterangeid) {
      // alert("hello"+deleterangeid);
      
      swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Range Record!",
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
                              deleterangeid: deleterangeid
                            },
                            success: function(data) {
                                swal("Done! Your Range And Rate Record is Deleted!", {
                                    icon: "success",
                                });
                                readrecord();

                               // location.reload(true);
                                //alert("sucess");
                                //   readrecord();
                            },
                        });


                    } else {

                    }
                });

      
      }

function addrangerate(id)
{
    //  alert(id)
    var range = $('#goodrange').val();
    var price = $('#price').val();
//  alert(id+range+price);
    $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                    id: id,
                    range: range,
                    price: price,
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
  var idgood = $('#hidden_id').val();
//  alert(idgood)
    $.ajax({
                url: "goods_backend.php",
                type: "POST",
                data: {
                    idgood: idgood,
                },
                success: function(data) {
                    console.log(data);
                    $("#showdata").html(data);
                    // $('#basicModal').modal('hide');
                  //  location.reload();
                    // $('#tblcontent').html(data);
                },
            });

}

  </script>
