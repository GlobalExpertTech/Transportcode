<?php 
include'header/header.php';
include'sidebars/sidebar.php';
?>
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
               <div class="card">
                    <!--  <div class="buttons">
                   <a href="#" class="btn btn-icon icon-left btn-primary"style="float:right"data-toggle="modal" data-target="#exampleModal1"><i class="far fa-edit"></i>Add Employee</a>
                 </div> -->
                 <br>
                <center> <h4>Monthly Payment</h4></center>
             
                   <div class="form-group card-body row">
                      <div class="input-group mb-3">
                     <!--    <input type="text" class="form-control mr-2"placeholder="Enter Employee Name"> -->
                        <input type="month" id="inpmonth" class="form-control">
                        <div class="input-group-append">
                          <button class="btn btn-primary" id="filterbtn" type="button">Filter</button>
                        </div>
                      </div>
                    </div>

              <!--   <div class="card-body row"style="align-items: center">
                       <div class="form-group">
                      <input type="text" class="form-control datepicker">
                     </div>
                  </div> -->
                   
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                             <th>Sr No</th>
                            <th>Employee Name</th>
                            <th><center>Present</center></th>
                            <th><center>Absent</center></th>
                            <th><center>Total</center></th>
                            <th><center>Status</center></th>
                            <th><center>Action</center></th>
                            </tr>
                        </thead>
                    
                        <tbody id="responce">
                         
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
              <div class="modal fade" id="exampleModal16" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Details</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </div>
               <div id="myEvent"></div>
             
                </div>
              </div>
            </div>
          </div>
        </div>
      
<script type="text/javascript">
  $(document).ready(function(){

      // alert('hii');
      //hiding data 
     hideall();

     function hideall()
     {
       $('#tableExport').hide();
     }

     $('#filterbtn').click(function(){

       var monthpay=$('#inpmonth').val();
       
        if(monthpay!="")
        {
        //  alert('monthpay is '+monthpay);


 $.ajax({

      url:'getdata.php',
      method:'POST',
      // date:$('#searchdateform').serialize(),
      data:'paymentmonth='+monthpay,
      success:function(responcedata) 
      {
        $('#tableExport').show();
        $('#responce').html(responcedata);
         // $('#button_action').show();
      },

  });






        }else
        {
          alert('Please Select Month');
        }
   
       });


   function ViewEmpData(id)
     {
      alert("Hii This is ID "+id);
     }
  });
  </script>
  <?php include'footers/footer.php'?>