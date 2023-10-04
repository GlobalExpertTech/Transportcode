<?php
include('config.php');
extract($_POST);
// echo "test";
//insert party data
if (isset($_POST['name']) && isset($_POST['amt'])) {
	$insertsql = "INSERT INTO `servicemaster`(`servicename`, `serviceamt`) VALUES ('$name','$amt')";

	// echo $insertsql;
	if (mysqli_query($con, $insertsql)) {
		$output = "Done";
	}
	echo $output;
}

//update party data
if (isset($_POST['hidden_id']) && isset($_POST['upname']) && isset($_POST['upamt'])) {
	$insertsql = "UPDATE  `servicemaster` SET `servicename`='$upname',`serviceamt`='$upamt' WHERE `id`='$hidden_id'";
	///echo $insertsql;
	if (mysqli_query($con, $insertsql)) {
		$output = "Done";
	}
	echo $output;
}

if (isset($_POST['updateid']))
	{


		$userid=$_POST['updateid'];
		$selectquery="SELECT * FROM `servicemaster` where id='$userid'";

		$result=mysqli_query($con, $selectquery);

		$responce=array();

		if(mysqli_num_rows($result)>0)
		{

			while ($row=mysqli_fetch_assoc($result))
			{
				$responce =$row;
			}
		}else
		{
					$responce['status']=200;
					$responce['message']="No Record Found";

		}
			echo json_encode($responce);
		}else
		{
			            $responce['status']=200;
						$responce['message']="Invalid Request";
		}




///delete data
if (isset($_POST['deleteid'])) {
	$deleteid = $_POST['deleteid'];
	$sql = "DELETE FROM `servicemaster` WHERE id='$deleteid'";
	//echo($sql);
	mysqli_query($con, $sql);
}



