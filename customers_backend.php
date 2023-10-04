<?php
session_start();
include('config.php');
include('functions.php');
	extract($_POST);
	$loginuserid=$_SESSION['id'];
    //insert party data
    if(isset($_POST['cname']) && isset($_POST['Oname'])&& isset($_POST['mob'])&& isset($_POST['emailid'])&& isset($_POST['address'])&& isset($_POST['acname'])&& isset($_POST['acnumber'])&& isset($_POST['IFSC'])&& isset($_POST['bankname'])&& isset($_POST['gstno'])&& isset($_POST['opening']))
{
	$ledgerquery="INSERT INTO `ledgermaster`(`ledgername`, `type`, `address`, `mob`,`openingbalance`) VALUES ('$cname','Party','$address','$mob','$opening')";

	
			//echo $ledgerquery;
				if(mysqli_query($con,$ledgerquery))
				{
					$lastid=mysqli_insert_id($con);
					insertlog($con,$loginuserid, "leger record inserted Legder id : " . $lastid);

					$insertsql="INSERT INTO `partydata`(`companyname`, `ownername`, `email`, `mob`, `address`, `acname`, `acnumber`, `ifsccode`, `bankname`,`ledgerid`,`gst`)
					VALUES ('$cname','$Oname','$emailid','$mob','$address','$acname','$acnumber','$IFSC','$bankname','$lastid','$gstno')";
					if(mysqli_query($con,$insertsql))
					{
						$lastpartyid=mysqli_insert_id($con);
						insertlog($con,$loginuserid, "Party record inserted Party id : " . $lastpartyid);
						$output="Done";

					}
					
				}
                echo $output;
}

//update party data
    if(isset($_POST['hidden_id']) && isset($_POST['upcname']) && isset($_POST['upOname'])&& isset($_POST['upmob'])&& isset($_POST['upemailid'])&& isset($_POST['upaddress'])&& isset($_POST['upacname'])&& isset($_POST['upacnumber'])&& isset($_POST['upIFSC'])&& isset($_POST['upbankname'])&& isset($_POST['upgstno'])&& isset($_POST['upopening']))
{
   $updatelegerrecord="UPDATE `ledgermaster` SET `ledgername`='$upcname',`type`='Party',`address`='$upaddress',`mob`='$upmob',`openingbalance`='$upopening' WHERE `ledgerid`='$hidden_id'";
			///echo $insertsql;
				if(mysqli_query($con,$updatelegerrecord))
				{
					insertlog($con,$loginuserid, "leger record updated Legder id : " . $lastid);
					$updatepartydata = "UPDATE `partydata` SET `companyname`='$upcname',`ownername`='$upOname',`email`='$upemailid',`mob`='$upmob',`address`='$upaddress',`acname`='$upacname',`acnumber`='$upacnumber',`ifsccode`='$upIFSC',`bankname`='$upbankname',`gst`='$upgstno' WHERE `ledgerid`='$hidden_id'";
					if(mysqli_query($con,$updatepartydata))
					{
						insertlog($con,$loginuserid, "Party record updated Legder id : " . $lastid);
						$output = "done";
					}
				
				}
                echo $output;
}




		///delete data
		if(isset($_POST['deleteid']))
		{
				$deleteid=$_POST['deleteid'];
		  $sql="DELETE FROM `partydata` WHERE id='$deleteid'";
		  //echo($sql);
		  mysqli_query($con,$sql);

		}





if (isset($_POST['updateid']))
	{


		$userid=$_POST['updateid'];
		$selectquery="SELECT * FROM `partydata` where `ledgerid`='$userid'";

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


		if (isset($_POST['fpartyid']))
		{
			$sql="SELECT * FROM `partydata` WHERE id='$fpartyid'";
			// echo $sql;
			$result=mysqli_query($con, $sql);
			$address="ee";
			if($row = mysqli_fetch_assoc($result))
			{
				$address=$row['address'];
			}
			echo $address;
		}

		if (isset($_POST['partylegderid']))
		{
			$sql="SELECT * FROM `ledgermaster` WHERE `ledgerid`='$partylegderid'";
			//  echo $sql;
			$result=mysqli_query($con, $sql);
			 $openingbalance=00;
			if($row = mysqli_fetch_assoc($result))
			{
				$openingbalance=$row['openingbalance'];
			}
			echo $openingbalance;
		}

?>