<?php
include('config.php');
extract($_POST);
// echo "test";

//update challan status
if (isset($_POST['challanid']) && isset($_POST['status']) ) {
	$insertsql = "UPDATE  `challanrecord` SET `status`='$status' WHERE `challanNo`='$challanid'";
	///echo $insertsql;
	if (mysqli_query($con, $insertsql)) {
		$output = "Done";
	}
	echo $output;
}
