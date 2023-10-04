<?php 	
include('config.php'); 

session_start();
$output = '';
if(isset($_POST["action"]))
{
	if($_POST["action"] == "Add")
 {
  $attendance_date = '';
  $error_attendance_date = '';
  $error = 0;
  if(empty($_POST["attendance_date"]))
  {
   $error_attendance_date = 'Attendance Date is required';
   $error++;
  }
  else
  {
   $attendance_date = $_POST["attendance_date"];
  }
  if($error > 0)
  {
   $output = array(
    'error'       => true,
    'error_attendance_date'   => $error_attendance_date
   );
  }
  else
  {
   $student_id = $_POST["student_id"];
   $query = '
   SELECT attendance_date FROM tbl_attendance 
   WHERE teacher_id = "'.$_SESSION["teacher_id"].'" 
   AND attendance_date = "'.$attendance_date.'"
   ';
   $statement = $connect->prepare($query);
   $statement->execute();
   if($statement->rowCount() > 0)
   {
    $output = array(
     'error'     => true,
     'error_attendance_date' => 'Attendance Data Already Exists on this date'
    );
   }
   else
   {
    for($count = 0; $count < count($student_id); $count++)
    {
     $data = array(
      ':student_id'   => $student_id[$count],
      ':attendance_status' => $_POST["attendance_status".$student_id[$count].""],
      ':attendance_date'  => $attendance_date,
      ':teacher_id'   => $_SESSION["teacher_id"]
     );

     $query = " 
     INSERT INTO tbl_attendance 
     (student_id, attendance_status, attendance_date, teacher_id) 
     VALUES (:student_id, :attendance_status, :attendance_date, :teacher_id)
     ";
     $statement = $connect->prepare($query);
     $statement->execute($data);
    }
    $output = array(
     'success'  => 'Data Added Successfully',
    );
   }
  }
  echo json_encode($output);
 }
}
 ?>