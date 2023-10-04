<?php
include('config.php');
	extract($_POST);

    //insert party data
    if(isset($_POST['cname']) && isset($_POST['Oname'])&& isset($_POST['mob'])&& isset($_POST['emailid'])&& isset($_POST['address'])&& isset($_POST['acname'])&& isset($_POST['acnumber'])&& isset($_POST['IFSC'])&& isset($_POST['bankname']))
{

	$ledgerquery="INSERT INTO `ledgermaster`(`ledgername`, `type`, `address`, `mob`) VALUES ('$cname','Transport','$address','$mob')";
			echo $insertsql;
				if(mysqli_query($con,$ledgerquery))
				{
					$lastid=mysqli_insert_id($con);
					$insertsql="INSERT INTO `transporterdata`(`transcompanyname`, `ownername`, `email`, `mob`, `address`, `acname`, `acnumber`, `ifsccode`, `bankname`,`ledgerid`)
					VALUES ('$cname','$Oname','$emailid','$mob','$address','$acname','$acnumber','$IFSC','$bankname','$lastid')";
						if(mysqli_query($con,$insertsql))
						{
							$output="Done";

						}
				}
                echo $output;
}

//update party data
    if(isset($_POST['hidden_id']) && isset($_POST['upcname']) && isset($_POST['upOname'])&& isset($_POST['upmob'])&& isset($_POST['upemailid'])&& isset($_POST['upaddress'])&& isset($_POST['upacname'])&& isset($_POST['upacnumber'])&& isset($_POST['upIFSC'])&& isset($_POST['upbankname']))
{
    $insertsql="UPDATE `transporterdata` SET `transcompanyname`='$upcname',`ownername`='$upOname',`email`='$upemailid',`mob`='$upmob',`address`='$upaddress',`acname`='$upacname',`acnumber`='$upacnumber',`ifsccode`='$upIFSC',`bankname`='$upbankname' WHERE `id`='$hidden_id'";
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
		  $sql="DELETE FROM `transporterdata` WHERE id='$deleteid'";
		  //echo($sql);
		  mysqli_query($con,$sql);

		}





if (isset($_POST['updateid']))
	{


		$userid=$_POST['updateid'];
		$selectquery="SELECT * FROM `transporterdata` where id='$userid'";

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