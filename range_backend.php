<?php
include('config.php');
	extract($_POST);

    //insert party data
    if(isset($_POST['lable']) && isset($_POST['unit']))
{
    $insertsql="INSERT INTO `rangedata`(`range`, `unit`) VALUES ('$lable','$unit')";

			// echo $insertsql;
				if(mysqli_query($con,$insertsql))
				{
					$output="Done";
				}
                echo $output;
}

//update party data
    if(isset($_POST['hidden_id']) && isset($_POST['uplable']) && isset($_POST['upunit']))
{
    $insertsql="UPDATE `rangedata` SET `range`='$uplable',`unit`='$upunit' WHERE `id`='$hidden_id'";
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
		  $sql="DELETE FROM `rangedata` WHERE id='$deleteid'";
		  //echo($sql);
		  mysqli_query($con,$sql);

		}





if (isset($_POST['updateid']))
	{


		$userid=$_POST['updateid'];
		$selectquery="SELECT * FROM `rangedata` where id='$userid'";

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