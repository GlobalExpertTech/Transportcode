<?php
include('config.php');
extract($_POST);
date_default_timezone_set("Asia/Calcutta");

if (isset($_POST['partyid']))
	{


		$partyid=$_POST['partyid'];
		$selectquery="SELECT * FROM `vouchersdtls` where ledgerid='$partyid'";

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




		if(isset($_POST['partyidledgerid']))
		{

			
			$selectopeningquery="SELECT `openingbalance` FROM `ledgermaster` WHERE `ledgerid`='$partyidledgerid'";
			$responceopening= mysqli_query($con, $selectopeningquery);
			$legerrow = mysqli_fetch_assoc($responceopening);
	
			$openingbalance=$legerrow['openingbalance'];
	
			// echo "Opening Balance From Leger Record  --> ".$openingbalance;
	
	$date = date("Y-m-d");
			$subtotal =0;
			$selectquery = "SELECT `vouchersid`,`voucherstype`,`vouchersdate`, `ledgerid`, 
			`amount`, `DRCRtype`, `paymenttype` FROM `vouchersdtls` WHERE 
			`vouchersdate`<='$date' AND `ledgerid`='$partyidledgerid'
			AND `DRCRtype`='DR'
			  UNION ALL 
			SELECT `vouchersid`,`voucherstype`, `vouchersdate`,
			`ledgerid`, `amount`, `DRCRtype`, `paymenttype` FROM `vouchersdtls` WHERE 
			`vouchersdate`<='$date' AND `ledgerid`='$partyidledgerid'
			 AND `DRCRtype`='CR';";
			//    echo $selectquery;
	
			$result = mysqli_query($con, $selectquery);
			if (mysqli_num_rows($result) > 0) {
				$num = 1;
		
				while ($row = mysqli_fetch_row($result)) {
		//	echo $openingbalance."\n";
			$DRCRtype = $row[5];
			$amt = $row[4];
					if($DRCRtype=="DR")
					{
				$openingbalance = $openingbalance + $amt;
					}

					if($DRCRtype=="CR")
					{
				$openingbalance = $openingbalance - $amt;
					}



		//	echo $row[1]."-->".$DRCRtype." = ".$amt." >> ".$openingbalance."\n";
				}
			} 
			else {
				$subtotal = 0;
			}
			echo $openingbalance;
		
		}





?>