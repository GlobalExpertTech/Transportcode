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

            <h3>Trucks Master</h3>
            <div class="row justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New Truck</button>
            </div>
            <hr>



            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                <thead>
                    <tr>
                        <th>Transport Name</th>
                        <th>Truck No</th>
                        <th>Driver Name</th>
                        <th>Driver Mob</th>
                        <th>Action</th>
                        <!-- <th>View</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $selectquery = "SELECT * FROM `trucksdata`";
                    //    echo $selectquery;
                    $result = mysqli_query($con, $selectquery);
                    if (mysqli_num_rows($result) > 0) {
                        // $num=1;
                        while ($row = mysqli_fetch_row($result)) { ?>
                            <tr>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td>
                                    <button class="btn btn-primary" onclick="getdata(<?php echo $row[0]; ?>)"> <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger" onclick="deletedata(<?php echo $row[0]; ?>)"> <i class="fas fa-trash-alt"></i></button>
                                </td>
                                <!-- <td><button class="btn btn-warning" onclick="viewdata(<?php echo $row[0]; ?>)"><i class="fas fa-eye"></i></button></td> -->
                            </tr>
                    <?php
                        }
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
                    <h5 class="modal-title" id="formModal">Create New truck data</h5>
                    <!-- <small class=" text-center text-danger"></small> -->
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><small>Press Esc Button to close</small></span>
                    </button>
                </div>
                <div class="modal-body">


                    <form class="">
                      
                                <div class="form-group">
                                    <label>Transport Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-truck"></i>
                                            </div>
                                        </div>
                                        <select name="" id="transname" class="form-control">
                                                <?php 
                                                    echo $transport;
                                                ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Truck Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-truck"></i>
                                            </div>
                                        </div>
                                       <input type="text" class="form-control" id="trucknum" placeholder="Eg. MH-14-GH-8899 " style="text-transform: uppercase">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Loading Capacity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-weight-hanging"></i>
                                            </div>
                                        </div>
                                       <input type="text" class="form-control" id="loadingcapacity" placeholder="Eg. 21 tons">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Driver Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                       <input type="text" class="form-control" id="drivername" placeholder="Driver Name">
                                    </div>
                                </div>
                          
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-mobile"></i>
                                            </div>
                                        </div>
                                       <input type="text" class="form-control" id="drivermob" placeholder="Driver Mobile Number">
                                    </div>
                                </div>
                          
                     
                        <button type="button" class="btn btn-primary m-t-15  form-control" onclick="addparty()">Add New truck</button>
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
                    <h5 class="modal-title" id="formModal">Update Truck Record</h5>
                    <!-- <small class=" text-center text-danger"></small> -->
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><small>Press Esc Button to close</small></span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <form class="">
                      
                      <div class="form-group">
                          <label>Transport Name</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-truck"></i>
                                  </div>
                              </div>
                              <input type="hidden" id="hidden_id">
                              <select name="" id="uptransname" class="form-control">
                                      <?php 
                                          echo $transport;
                                      ?>
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Truck Number</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-truck"></i>
                                  </div>
                              </div>
                             <input type="text" class="form-control" id="uptrucknum" placeholder="Eg. MH-14-GH-8899 ">
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Loading Capacity</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-weight-hanging"></i>
                                  </div>
                              </div>
                             <input type="text" class="form-control" id="uploadingcapacity" placeholder="Eg. 21 tons">
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Driver Name</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-user"></i>
                                  </div>
                              </div>
                             <input type="text" class="form-control" id="updrivername" placeholder="Driver Name">
                          </div>
                      </div>
                
                      <div class="form-group">
                          <label>Mobile Number</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fas fa-mobile"></i>
                                  </div>
                              </div>
                             <input type="text" class="form-control" id="updrivermob" placeholder="Driver Mobile Number">
                          </div>
                      </div>
                
           
              <button type="button" class="btn btn-warning m-t-15  form-control" onclick="updateparty()">update truck details</button>
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

        function addparty() {
            // alert('fun');
            var transname = $('#transname').val();
            var trucknum = $('#trucknum').val();
            var load = $('#loadingcapacity').val();
            var drname = $('#drivername').val();
            var drmob = $('#drivermob').val();


            // console.log(transname+"--"+trucknum+"--"+load+"--"+drname+"--"+drmob);
            $.ajax({
                url: "trucks_backend.php",
                type: "POST",
                data: {
                    transname: transname,
                    trucknum: trucknum,
                    load: load,
                    drname: drname,
                    drmob: drmob,   
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

            $.post("trucks_backend.php", {
                updateid: updateid
            }, function(data, status) {
                // alert("Successfully");
                var user = JSON.parse(data);
                //   $('#up_categoryname').val(user.name);
              //      console.log(user);

                // $('#hidden_id').val(user.id);
                $('#uptransname').val(user.transportname);
                $('#uptrucknum').val(user.trucknumber);
                $('#uploadingcapacity').val(user.loadcapacity);
                $('#updrivername').val(user.drivername);
                $('#updrivermob').val(user.drivermob);

            });
            $('#updatecustomer').modal('show');


        }


        function updateparty() {

            var hidden_id = $('#hidden_id').val();
            var uptransname = $('#uptransname').val();
            var uptrucknum = $('#uptrucknum').val();
            var upload = $('#uploadingcapacity').val();
            var updrname = $('#updrivername').val();
            var updrmob = $('#updrivermob').val();


            // console.log(cname+"--"+Oname+"--"+mob+"--"+emailid+"--"+address+"--"+acname+"--"+acnumber+"--"+IFSC+"--"+bankname);
            $.ajax({
                url: "trucks_backend.php",
                type: "POST",
                data: {
                    hidden_id: hidden_id,
                    uptransname: uptransname,
                    uptrucknum: uptrucknum,
                    upload: upload,
                    updrname: updrname,
                    updrmob: updrmob,   
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
                    text: "Once deleted, you will not be able to recover this party Record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "trucks_backend.php",
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