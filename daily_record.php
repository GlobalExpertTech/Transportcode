<?php 
include'header/header.php';
include'sidebars/sidebar.php';


if(isset($_POST['update_action']))
{

   $attend = $_POST['attend'];

foreach ($attend as $atn_key => $atn_value) {
  $dt=$_POST['dateholder'];
  // echo $dt;
  // echo $atn_value;
  // echo $atn_key.'<br>';
      if ($atn_value == "present") 
      {
        $query = "UPDATE tbl_attendance SET att_status = 'present' WHERE empID = '".$atn_key."' AND attdate = '".$dt."'";
        echo $query;
        if(mysqli_query($connect, $query))
        {
            echo "update";
        }else
        {
            echo "error to update";
        }
      } 
      elseif ($atn_value == "absent") 
      {
        $query = "UPDATE tbl_attendance SET att_status = 'absent' WHERE empID = '".$atn_key."' AND attdate = '".$dt."'";
        echo $query;
        if(mysqli_query($connect, $query))
        {
            echo "update";
        }else
        {
            echo "error to update";
        }
      }
    }

   // echo '<script>window.location="add_attendance.php"</script>';





}





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
                <center> <h4>Attendance Record</h4></center>
                   <form  id="searchdateform" class="col-12">
                    <div class="form-group card-body row">
                      <div class="input-group mb-3">
                        <input type="date" name="inpdate" id="inpdate" class="form-control">
                        <div class="input-group-append">
                          <button class="btn btn-primary" id="btngetdata" name="btnsearch" type="button">Filter</button>
                        </div>
                      </div>
                    </div>
                </form>
              <!--   <div class="card-body row"style="align-items: center">
                       <div class="form-group">
                      <input type="text" class="form-control datepicker">
                     </div>
                  </div> -->
                   
                  <div class="card-body">
                    <div class="table-responsive">
                      <form method="post" action="" >
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                    
                        <thead>
                          <tr>
                             <th>Sr No</th>
                            <th>Employee Name</th>
                            <th><center>Present</center></th>
                            <th><center>Absent</center></th>
                            </tr>
                        </thead>
                    
                        <tbody id="responce">
                        </tbody>
                        
                      </table>

                      
                       <div class="input-group-append">
                     <!--    <input type="hidden" name="attendance_id" id="attendance_id" />
                        <input type="hidden" name="action" id="action" value="Add" /> -->
     <!--     <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" /> -->
                      <button  type="submit" name="update_action" id="button_action" class="btn btn-success">Update Record</button>
                      </form>
                
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
<script type="text/javascript">
$(document).ready(function(){

  $('#button_action').hide();

$('#btngetdata').click(function(){

  var date=$('#inpdate').val();
 //alert('date is '+date);
  if(date!="")
  {
 $.ajax({

      url:'getdata.php',
      method:'POST',
      // date:$('#searchdateform').serialize(),
      data:'datee='+date,
      success:function(responcedata) 
      {
        $('#responce').html(responcedata);
         $('#button_action').show();
      },

  });
  }else
  {
     alert('Please Select date');
  }

});
// $('#btngetdata').click(function(){

//   $.ajax({
//       url:'getdata.php',
//       method:'POST',
//       success:function(responcedata) 
//       {
//         $('#responce').html(responcedata);
//       }

//   });



});








  // alert('Hiii');
  // $("button").click(function(){
  //   $("p").slideToggle();
  // });

</script>


  <?php include'footers/footer.php'?>