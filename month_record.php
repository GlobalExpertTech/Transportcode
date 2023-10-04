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
                <center> <h4>Monthly Record</h4></center>
             
                    <div class="form-group card-body row">
                      <div class="input-group mb-3">
                       <input type="month" id="inpmonth" class="form-control">
                        <div class="input-group-append">
                          <button class="btn btn-primary" id="btngetdata" type="button">Filter</button>
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
                           <!--  <th><center>Action</center></th> -->
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

<script type="text/javascript">
$(document).ready(function(){

$('#btngetdata').click(function(){

  var month=$('#inpmonth').val();

 //alert('month is '+month);
  if(month!="")
  {
 $.ajax({

      url:'getdata.php',
      method:'POST',
      // date:$('#searchdateform').serialize(),
      data:'month='+month,
      success:function(responcedata) 
      {
        $('#responce').html(responcedata);
      },

  });
  }else
  {
     alert('Please Select Month');
  }

});


});


</script>



  <?php include'footers/footer.php'?>