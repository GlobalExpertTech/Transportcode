<?php
include('header/header.php');


//getting list of transporters
$sql="SELECT DISTINCT `transcompanyname` FROM `transporterdata`";
$result = mysqli_query($con, $sql);
$transport="<option value='0'>Select Trucks</option>";

while($row = mysqli_fetch_array($result))
{
    $transport = $transport."<option value='$row[0]'>$row[0]</option>";
}



?>


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- add content here -->

            <h3>Manage All Services</h3>
            <div class="row justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create New Service</button>
            </div>
            <hr>



            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Service Name</th>
                        <th>Service Charges</th>
                        <th>Action</th>
                        <!-- <th>View</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $selectquery = "SELECT * FROM `servicemaster`";
                    //    echo $selectquery;
                    $result = mysqli_query($con, $selectquery);
                    if (mysqli_num_rows($result) > 0) {
                         $num=1;
                        while ($row = mysqli_fetch_row($result)) { ?>
                            <tr>
                            <td><?php echo $num; ?></td>
                            <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                               
                                <td>
                               
                                <button class="btn btn-primary" onclick="getdata(<?php echo $row[0]; ?>)"> <i class="fas fa-pencil-alt"></i>
                                    </button>
                                <button class="btn btn-danger" onclick="deletedata(<?php echo $row[0]; ?>)"> <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                                <!-- <td><button class="btn btn-warning" onclick="viewdata(<?php echo $row[0]; ?>)"><i class="fas fa-eye"></i></button></td> -->
                            </tr>
                    <?php
                    $num++;  }
                    } else {
                        echo "<tr><td class='text-center text-warning' colspan='5'>No Transpoter Found !</td></tr>";
                    }


                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- model started -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Create New Service</h5>
                    <!-- <small class=" text-center text-danger"></small> -->
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><small>Press Esc Button to close</small></span>
                    </button>
                </div>
                <div class="modal-body">


                    <form class="">
                      
                                <div class="form-group">
                                    <label>Service Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-braille"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="" id="servicename" class="form-control" placeholder="">
                                             
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Service Charge</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-boxes"></i>
                                            </div>
                                        </div>
                                       <input type="text" class="form-control" id="serviceamt" placeholder="">
                                    </div>
                                </div>

                        <button type="button" class="btn btn-primary m-t-15  form-control" onclick="addrange()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- model ends -->

    <!-- -----------------------------------------------------------------------------------------------------df -->
    <!-- Update customer model -->
    <!-- model started -->
    <div class="modal fade bd-example-modal-lg" id="updatecustomer" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Update Service Data</h5>
                    <!-- <small class=" text-center text-danger"></small> -->
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><small>Press Esc Button to close</small></span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <form class="">
                      
                      <div class="form-group">
                          <label>Service Name</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-braille"></i>
                                  </div>
                              </div>
                              <input type="hidden" id="hidden_id">
                              <input type="text" name="" id="upservicename" class="form-control" placeholder="">
                                   
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Service Charges</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-boxes"></i>
                                  </div>
                              </div>
                             <input type="text" class="form-control" id="upserviceamt" placeholder="" >
                          </div>
                      </div>

              <button type="button" class="btn btn-warning m-t-15  form-control" onclick="updaterange()">Save</button>
          </form>
                </div>
            </div>
        </div>
    </div>
    <!-- model ends -->

    <?php
    include('footers/footer.php');
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
            // alert('hii');
        });



        function sendfun(id)
        {
            // alert(id);
            window.location.href = "goodsmanager.php?id=" + id;

        }

        function addrange() {
            // alert('fun');
            var name = $('#servicename').val();
            var amt = $('#serviceamt').val();
          

            // console.log(transname+"--"+trucknum+"--"+load+"--"+drname+"--"+drmob);
            $.ajax({
                url: "service_backend.php",
                type: "POST",
                data: {
                    name: name,
                    amt: amt,
                },
                success: function(data) {
                    console.log(data);
                    // $('#basicModal').modal('hide');
                    location.reload();
                    // $('#tblcontent').html(data);
                },
            });
        }

        function getdata(updateid) {

            //  alert("get details hii"+updateid);
            $('#hidden_id').val(updateid);

            $.post("service_backend.php", {
                updateid: updateid
            }, function(data, status) {
                // alert("Successfully");
                var user = JSON.parse(data);
                //   $('#up_categoryname').val(user.name);
                    console.log(user);

                // $('#hidden_id').val(user.id);
                $('#upservicename').val(user.servicename);
                $('#upserviceamt').val(user.serviceamt);

            });
            $('#updatecustomer').modal('show');


        }


        function updaterange() {

            var hidden_id = $('#hidden_id').val();
            var upname = $('#upservicename').val();
            var upamt= $('#upserviceamt').val();
          


            // console.log(cname+"--"+Oname+"--"+mob+"--"+emailid+"--"+address+"--"+acname+"--"+acnumber+"--"+IFSC+"--"+bankname);
            $.ajax({
                url: "service_backend.php",
                type: "POST",
                data: {
                    hidden_id: hidden_id,
                    upname: upname,
                    upamt: upamt,                 
                },
                success: function(data) {
                    console.log(data);
                    // $('#basicModal').modal('hide');
                    location.reload();
                    // $('#tblcontent').html(data);
                },
            });
        }


        function deletedata(deleteid) {
            // alert(id); 

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Service Record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "service_backend.php",
                            type: "POST",
                            data: {
                                deleteid: deleteid
                            },
                            success: function(data) {
                                swal("Poof! Your imaginary file has been deleted!" + deleteid, {
                                    icon: "success",
                                });
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