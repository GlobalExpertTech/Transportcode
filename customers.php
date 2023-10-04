<?php
include('header/header.php');
?>


<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->

      <h3>Party Master</h3>
      <div class="row justify-content-end">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Create New Party</button>
      </div>
      <hr>



      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
        <thead>
          <tr>
            <th>Comapany Name</th>
            <th>Mobile No</th>
            <th>Email</th>
            <th>Action</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $selectquery = "SELECT * FROM `partydata`";
          //    echo $selectquery;
          $result = mysqli_query($con, $selectquery);
          if (mysqli_num_rows($result) > 0) {
            // $num=1;
            while ($row = mysqli_fetch_row($result)) { ?>
              <tr>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td>
                  <button class="btn btn-primary" onclick="getdata(<?php echo $row[10]; ?>)"> <i class="fas fa-pencil-alt"></i>
                  </button>
                  <button class="btn btn-danger" onclick="deletedata(<?php echo $row[ 0]; ?>)"> <i class="fas fa-trash-alt"></i></button>
                </td>
                <td><button class="btn btn-warning" onclick="viewdata(<?php echo $row[10]; ?>)"><i class="fas fa-eye"></i></button></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr><td>NO Medicine FOuund</td></tr>";
          }


          ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- model started -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">Create New Party</h5>
          <!-- <small class=" text-center text-danger"></small> -->
          <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><small>Press Esc Button to close</small></span>
          </button>
        </div>
        <div class="modal-body">

<!-- Row One -->
          <form class="">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Comapany Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-building"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Company Name" id="cname" name="cnmae">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Owner Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Owner Name" id="oname" name="password">
                  </div>
                </div>
              </div>
            </div>
<!-- Row Two -->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Mobile</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-mobile-alt"></i>
                      </div>
                    </div>
                    <input type="number" class="form-control" placeholder="Mobile No" id="mob" name="password">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                      </div>
                    </div>
                    <input type="email" class="form-control" placeholder="Email ID" id="email" name="password">
                  </div>
                </div>
              </div>
            </div>
<!-- Row Three -->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>GSTIN NO</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-fax"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="GST Number" id="gstno" name="gstno">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Opening Balance</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <!-- <i class="fas fa-envelope"></i> -->
                        ₹
                      </div>
                    </div>
                    <input type="email" class="form-control" placeholder="Opening Balance" id="opening" name="opening">
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label>Address</label>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-lock"></i>
                        </div>
                      </div> -->
                <!-- <input type="password" class="form-control" placeholder="Password" name="password"> -->
                <textarea name="txtpartyaddress" id="address" class="form-control" cols="30" id="address" rows="10"></textarea>
              </div>
            </div>

            <h4>Account Details</h4>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" placeholder="Acccount Holder Name" id="acname">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Acccount number" id="acnumber">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="text" class="form-control" placeholder="IFSC code" id="ifsccode">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Bank Name" id="bankname">
              </div>
            </div>


            <button type="button" class="btn btn-primary m-t-15  form-control" onclick="addparty()">Add New Party</button>
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
          <h5 class="modal-title" id="formModal">Update Party Record</h5>
          <!-- <small class=" text-center text-danger"></small> -->
          <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><small>Press Esc Button to close</small></span>
          </button>
        </div>
        <div class="modal-body">
          <form class="">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Comapany Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-building"></i>
                      </div>
                    </div>
                    <input type="hidden" id="hidden_id">
                    <input type="text" class="form-control" placeholder="Company Name" id="upcname" name="cnmae">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Owner Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Owner Name" id="uponame" name="password">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Mobile</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-mobile-alt"></i>
                      </div>
                    </div>
                    <input type="number" class="form-control" placeholder="Mobile No" id="upmob" name="password">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                      </div>
                    </div>
                    <input type="email" class="form-control" placeholder="Email ID" id="upemail" name="password">
                  </div>
                </div>
              </div>
            </div>

            <!-- third row -->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>GSTIN NO</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-fax"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="GST Number" id="upgstno" name="gstno">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Opening Balance</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <!-- <i class="fas fa-envelope"></i> -->
                        ₹
                      </div>
                    </div>
                    <input type="email" class="form-control" placeholder="Opening Balance" id="upopening" name="opening">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Address</label>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-lock"></i>
                        </div>
                      </div> -->
                <!-- <input type="password" class="form-control" placeholder="Password" name="password"> -->
                <textarea name="txtpartyaddress" id="upaddress" class="form-control" cols="30" id="address" rows="10"></textarea>
              </div>
            </div>

            <h4>Account Details</h4>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" placeholder="Acccount Holder Name" id="upacname">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Acccount number" id="upacnumber">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="text" class="form-control" placeholder="IFSC code" id="upifsccode">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Bank Name" id="upbankname">
              </div>
            </div>


            <button type="button" class="btn btn-warning m-t-15  form-control" onclick="updateparty()">Update Party</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- model ends -->

  <!-- -----------------------------------------------------------------------------------------------------df -->
  <!-- -----------------------------------------------------------------------------------------------------df -->
  <!-- View customer model -->
  <!-- model started -->
  <div class="modal fade bd-example-modal-lg" id="viewcustomer" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">View Party Data</h5>
          <!-- <small class=" text-center text-danger"></small> -->
          <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><small>Press Esc Button to close</small></span>
          </button>
        </div>
        <div class="modal-body">


          <form class="">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Comapany Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-building"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Company Name" id="vcname" name="cnmae" readonly></input>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Owner Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Owner Name" id="voname" name="password" readonly></input>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Mobile</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-mobile-alt"></i>
                      </div>
                    </div>
                    <input type="number" class="form-control" placeholder="Mobile No" id="vmob" name="password" readonly></input>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                      </div>
                    </div>
                    <input type="email" class="form-control" placeholder="Email ID" id="vemail" name="password" readonly></input>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- third row -->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>GSTIN NO</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-fax"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="GST Number" id="vgstno" name="gstno">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Opening Balance</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <!-- <i class="fas fa-envelope"></i> -->
                        ₹
                      </div>
                    </div>
                    <input type="email" class="form-control" placeholder="Opening Balance" id="vopening" name="opening">
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label>Address</label>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-lock"></i>
                        </div>
                      </div> -->
                <!-- <input type="password" class="form-control" placeholder="Password" name="password"> -->
                <textarea name="txtpartyaddress" class="form-control" cols="30" id="vaddress" rows="10" readonly></textarea>
              </div>
            </div>

            <h4>Account Details</h4>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" placeholder="Acccount Holder Name" id="vacname" readonly></input>
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Acccount number" id="vacnumber" readonly></input>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <input type="text" class="form-control" placeholder="IFSC code" id="vifsccode" readonly></input>
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Bank Name" id="vbankname" readonly></input>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- -----------------------------------------------------------------------------------------------------df -->



  <?php
  include('footers/footer.php');
  ?>

  <script type="text/javascript">
    $(document).ready(function() {
      // alert('hii');
    });

    function addparty() {
      // alert('fun');
      var cname = $('#cname').val();
      var Oname = $('#oname').val();
      var mob = $('#mob').val();
      var emailid = $('#email').val();
      var address = $('#address').val();
      var acname = $('#acname').val();
      var acnumber = $('#acnumber').val();
      var IFSC = $('#ifsccode').val();
      var bankname = $('#bankname').val();
      var gstno = $('#gstno').val();
      var opening = $('#opening').val();


      // console.log(cname+"--"+Oname+"--"+mob+"--"+emailid+"--"+address+"--"+acname+"--"+acnumber+"--"+IFSC+"--"+bankname);
      $.ajax({
        url: "customers_backend.php",
        type: "POST",
        data: {
          cname: cname,
          Oname: Oname,
          mob: mob,
          emailid: emailid,
          address: address,
          acname: acname,
          acnumber: acnumber,
          IFSC: IFSC,
          bankname: bankname,
          gstno:gstno,
          opening:opening
        },
        success: function(data) {
          console.log(data);
          // $('#basicModal').modal('hide');
          location.reload();
          // $('#tblcontent').html(data);
        },
      });
    }





    function viewdata(updateid) {

        // alert("get details hii"+updateid);
      // $('#hidden_id').val(updateid);

      $.post("customers_backend.php", {
        updateid: updateid
      }, function(data, status) {
        // alert("Successfully");
        var user = JSON.parse(data);
        //   $('#up_categoryname').val(user.name);
            console.log(user);
            var partylegderid=user.ledgerid;
            getopeningfromledger(partylegderid);
        // $('#hidden_id').val(user.id);
        $('#vcname').val(user.companyname);
        $('#voname').val(user.ownername);
        $('#vmob').val(user.mob);
        $('#vemail').val(user.email);
        $('#vgstno').val(user.gst);
        $('#vaddress').val(user.address);
        $('#vacname').val(user.acname);
        $('#vacnumber').val(user.acnumber);
        $('#vifsccode').val(user.ifsccode);
        $('#vbankname').val(user.bankname);

      });
      $('#viewcustomer').modal('show');


    }

    function getdata(updateid) {

        // alert("get details hii"+updateid);
      $('#hidden_id').val(updateid);

      $.post("customers_backend.php", {
        updateid: updateid
      }, function(data, status) {
        // alert("Successfully");
        var user = JSON.parse(data);
        //   $('#up_categoryname').val(user.name);
           console.log(user);

        // $('#hidden_id').val(user.id);
        $('#upcname').val(user.companyname);
        var partylegderid=user.ledgerid;
        $('#uponame').val(user.ownername);
        $('#upmob').val(user.mob);
        $('#upemail').val(user.email);
        $('#upaddress').val(user.address);
        $('#upgstno').val(user.gst);
        // $('#upopening').val(user.address);
        getopeningfromledger(partylegderid,"update");
        $('#upacname').val(user.acname);
        $('#upacnumber').val(user.acnumber);
        $('#upifsccode').val(user.ifsccode);
        $('#upbankname').val(user.bankname);

      });
      $('#updatecustomer').modal('show');


    }



    function getopeningfromledger(partylegderid,btnname)
    {
      $.ajax({
        url: "customers_backend.php",
        type: "POST",
        data: {
          partylegderid: partylegderid,
        },
        success: function(data) {
          // console.log("Data for parte"+data);
          if(btnname=="update")
          {
            $('#upopening').val(data);
          }else{
            $('#vopening').val(data);
          }
          
          // location.reload();
          // $('#tblcontent').html(data);
        },
      });
    }




    function updateparty() {
      var hidden_id = $('#hidden_id').val();
      var upcname = $('#upcname').val();
      var upOname = $('#uponame').val();
      var upmob = $('#upmob').val();
      var upemailid = $('#upemail').val();
      var upaddress = $('#upaddress').val();
      var upacname = $('#upacname').val();
      var upacnumber = $('#upacnumber').val();
      var upIFSC = $('#upifsccode').val();
      var upbankname = $('#upbankname').val();
      var upgstno = $('#upgstno').val();
      var upopening = $('#upopening').val();



      // console.log(cname+"--"+Oname+"--"+mob+"--"+emailid+"--"+address+"--"+acname+"--"+acnumber+"--"+IFSC+"--"+bankname);
      $.ajax({
        url: "customers_backend.php",
        type: "POST",
        data: {
          hidden_id: hidden_id,
          upcname: upcname,
          upOname: upOname,
          upmob: upmob,
          upemailid: upemailid,
          upaddress: upaddress,
          upacname: upacname,
          upacnumber: upacnumber,
          upIFSC: upIFSC,
          upbankname: upbankname,
          upgstno:upgstno,
          upopening:upopening
        },
        success: function(data) {
          console.log(data);
          // $('#basicModal').modal('hide');
          location.reload();
          // $('#tblcontent').html(data);
        },
      });
    }


    function deletedata(deleteid)
    {
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
                    url: "customers_backend.php",
                    type: "POST",
                    data: {deleteid:deleteid},
                    success:function(data) {
                      swal("Poof! Your imaginary file has been deleted!"+deleteid, {
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