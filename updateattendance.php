<?php 
include'header/header.php';
include'sidebars/sidebar.php';

$date="";
if(isset($_POST['serchdate']))
{
$date=$_POST['srdate'];
}


if(isset($_POST['update_action']))
{

   $attend = $_POST['attend'];

foreach ($attend as $atn_key => $atn_value) {
  $dt=$_POST['dateholder'];
  echo $atn_value;
  echo $atn_key.'<br>';
      if ($atn_value == "present") 
      {
        $query = "UPDATE tbl_attendance SET att_status = 'present' WHERE empID = '".$atn_key."' AND attdate = '".$dt."'";
        echo $query;
        if(mysqli_query($connect, $query))
        {
            echo "inserted";
        }else
        {
            echo "error to insert";
        }
      } 
      elseif ($atn_value == "absent") 
      {
        $query = "UPDATE tbl_attendance SET att_status = 'absent' WHERE empID = '".$atn_key."' AND attdate = '".$dt."'";
        echo $query;
        if(mysqli_query($connect, $query))
        {
            echo "inserted";
        }else
        {
            echo "error to insert";
        }
      }
    }

    echo '<script>window.location="add_attendance.php"</script>';





}




//     $attend = $_POST['attend'];
//     $cur_date = date('Y-m-d');    
// $taken=false;
// foreach ($attend as $atn_key => $atn_value) 
//  {
//   // echo $atn_value;
//   // echo $atn_key.'<br>';

//  $chkquery="SELECT * FROM `tbl_attendance` where `empID`='$atn_key' and`attdate`='$cur_date'";
//    // echo $chkquery ;
//     $result = mysqli_query($connect, $chkquery);
//     if ($result==true) 
//     {
//    //   echo '<script>alert("Attendance Already Taken Today !")</script>';
//       $taken=true;

//     }
// }


// if($taken)
// {
// echo '<script>alert("Attendance Already Taken Today !")</script>';
    
// }else
// {
  
//  // $attend = $_POST['attend'];
//  foreach ($attend as $atn_key => $atn_value) 
//  {
//   // echo $atn_value;
//   // echo $atn_key.'<br>';

   
//          if ($atn_value == "present") 
//       {
//         $stu_query = "INSERT INTO tbl_attendance(`empID`, `att_status`,`attdate`) VALUES('$atn_key', 'present', '$cur_date')";
//         if(mysqli_query($connect, $stu_query))
//         {
//             //echo "inserted";
//         }else
//         {
//             //echo "error to insert";
//         }
//         // $data_insert = $this->db->insert($stu_query);
//       } elseif ($atn_value == "absent") 
//       {
//         $stu_query = "INSERT INTO tbl_attendance(`empID`, `att_status`,`attdate`) VALUES('$atn_key', 'absent', '$cur_date')";
//          mysqli_query($connect, $stu_query);
//           if(mysqli_query($connect, $stu_query))
//         {
//             //echo "inserted";
//         }else
//         {
//             //echo "error to insert";
//         }
//         // $data_insert = $this->db->insert($stu_query);
//       }
    
//     }
// }

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
                <center> <h4>Update Attendance of Date <?php echo $date; ?></h4></center>
             
                   <!--  <div class="form-group card-body row">
                      <form class="col-12" method="POST" action="updateattendance.php">
                      <div class="input-group mb-3 ">
                        <input type="text" name="srdate" class="form-control datepicker">
                        <div class="input-group-append">
                          <button class="btn btn-primary" name="serchdate" type="submit">Filter</button>
                        </div>
                      </div>
                      </form>
                    </div> -->
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
                    
                        <tbody>
                         
                          <?php 
                            $count=0; 
                            $query="SELECT * FROM `tbl_attendance` where attdate='$date'";
                            $row=mysqli_query($connect,$query) or die(mysqli_error($connect));
                                
                                while($fetch=mysqli_fetch_array($row)) 
                                {

                                extract($fetch);
                            ?>
                          <tr>
                        <td><?php echo ++$count; ?></td>
                        <td>
                          <?php echo getempname($connect,$fetch["empID"]); ?>
                          <input type="hidden" name="fld_employee_id[]" value="<?php echo $fetch['empID']; ?>" />
                          <input type="hidden" name="dateholder" value="<?php echo $date; ?>">
                        </td>
                        <td align="center">
                        <input type="radio" name="attend[<?php echo $fetch['empID']; ?>]" value="present" <?php if($fetch['att_status'] == "present") {echo "checked";} ?>> Present
             
                        </td>
                        <td align="center">
                            <input type="radio" name="attend[<?php echo $fetch['empID']; ?>]" value="absent" <?php if($fetch['att_status'] == "absent") {echo "checked";} ?>> Absent
                        </td>
                      </tr>
    
                      <?php } ?>
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

          </div>
        </section>
        <script>
          <?php 

  function getempname($con,$id)
          {
              $sql = "SELECT `fld_employee_name` FROM tbl_employee WHERE fld_employee_id='$id'";
           //   echo $sql;
              $result = mysqli_query($con, $sql);
              $empname="";
              if (mysqli_num_rows($result) > 0) 
              {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) 
                {
                  $empname=$row['fld_employee_name'];
                }
      return $empname;
          }

}




           ?>
// $(document).ready(function(){
//    $('#attendance_form').on('submit', function(event){
//     alert("button is clicked");
  //   event.preventDefault();
  //   $.ajax({
  //     url:"attendance_action.php",
  //     method:"POST",
  //     data:$(this).serialize(),
  //     dataType:"json",
  //     beforeSend:function()
  //     {
  //       $('#button_action').attr('disabled', 'disabled');
  //       $('#button_action').val('Validate...');
  //     },
  //     success:function(data){
  //       $('#button_action').attr('disabled', false);
  //       $('#button_action').val($('#action').val());
  //       if(data.success)
  //       {
  //         $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
  //         clear_field();             
  //         dataTable.ajax.reload();
  //       }
  //       if(data.error)
  //       { 
  //         if(data.error_attendance_date != '')
  //         {
  //           $('#error_attendance_date').text(data.error_attendance_date);
  //         }
  //         else
  //         {
  //           $('#error_attendance_date').text('');
  //         }
  //       }
  //     }
  //   });
//   });
// });
// $(document).ready(function(){
//   $("attendance_form").submit(function(){
//     alert("Submitted");
//   });
// });
</script>
  <?php include'footers/footer.php'?>