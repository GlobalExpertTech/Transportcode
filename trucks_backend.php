<?php
include('config.php');
	extract($_POST);

    //insert party data
    if(isset($_POST['transname']) && isset($_POST['trucknum'])&& isset($_POST['load'])&& isset($_POST['drname'])&& isset($_POST['drmob']))
{
    $insertsql="INSERT INTO `trucksdata`(`transportname`, `trucknumber`, `loadcapacity`, `drivername`, `drivermob`) VALUES ('$transname','".strtoupper($trucknum)."','$load','$drname','$drmob')";

			// echo $insertsql;
				if(mysqli_query($con,$insertsql))
				{
					$output="Done";
				}
                echo $output;
}

//update party data
    if(isset($_POST['hidden_id']) && isset($_POST['uptransname']) && isset($_POST['uptrucknum'])&& isset($_POST['upload'])&& isset($_POST['updrname'])&& isset($_POST['updrmob']))
{
    $insertsql="UPDATE `trucksdata` SET `transportname`='$uptransname',`trucknumber`='".strtoupper($uptrucknum)."',`loadcapacity`='$upload',`drivername`='$updrname',`drivermob`='$updrmob' WHERE `id`='$hidden_id'";
			///echo $insertsql;
				if(mysqli_query($con,$insertsql))
				{
					$output="Done";
				}
                echo $output;
}




		///delete data
		if(isset($_POST['deleteid']))
		{
				$deleteid=$_POST['deleteid'];
		  $sql="DELETE FROM `trucksdata` WHERE id='$deleteid'";
		  //echo($sql);
		  mysqli_query($con,$sql);

		}





if (isset($_POST['updateid']))
	{


		$userid=$_POST['updateid'];
		$selectquery="SELECT * FROM `trucksdata` where id='$userid'";

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



?>