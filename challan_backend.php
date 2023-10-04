<?php
session_start();
include('config.php');
extract($_POST);
include('functions.php');
$loginuserid=$_SESSION['id'];
if(isset($_POST['challannumber']) && isset($_POST['subtotal']))
{
	

    $selectchllanquery="select * from `challanrecord` where `billno`='$challannumber'";
   // echo $selectchllanquery;
    $result=mysqli_query($con,$selectchllanquery);
        $row = mysqli_fetch_assoc($result);

        $vchdate=$row['date'];
        $topartyname=$row['payingparty'];
        $topartyid=getlederid($con,$topartyname,"Party");
        $paymenttype=$row['billtype'];
        $paymentdisc=$row['chequeenumber'];
        // $customerchallanid=$row['chequeenumber'];

        $amount=getsubtotalofchallan($con,$challannumber);

    $narrationchallan = "Challan Voucher for challan No. : " . $challannumber;
    
    $sub_vchtype="challan";
            if(checkvoucherexist($con,$challannumber))
            {
                insertlog($con,$loginuserid,"Leger Record Updated challan No : ". $challannumber);
                updatevoucher($con,$challannumber,$amount,$vchdate,$paymenttype,$paymentdisc,'Challan','2',$topartyid,$narrationchallan,$sub_vchtype);
                if($paymenttype!="credit")
                {
                    insertlog($con,$loginuserid,"Leger Recipt Record Updated challan No : ". $challannumber);
                    $narrationchallan = "Challan Recipt for challan No. : " . $challannumber;
                    updatevoucher($con,$challannumber,$amount,$vchdate,$paymenttype,$paymentdisc,'Receipt',$topartyid,'1',$narrationchallan,$sub_vchtype);
    
                }
            }else{
                insertlog($con,$loginuserid,"Leger Record created challan No : ". $challannumber);
                inservoucher($con,$challannumber,$amount,$vchdate,$paymenttype,$paymentdisc,'Challan','2',$topartyid,$narrationchallan,$sub_vchtype);

            if($paymenttype!="credit")
            {
                insertlog($con,$loginuserid,"Leger Recipt Record Created challan No : ". $challannumber);
                $narrationchallan = "Challan Recipt for challan No. : " . $challannumber;
                inservoucher($con,$challannumber,$amount,$vchdate,$paymenttype,$paymentdisc,'Receipt',$topartyid,'1',$narrationchallan,$sub_vchtype);

            }
       
            }



       


    $_SESSION['validid'] = "";
        
   // }






}


if(isset($_POST['party']) && isset($_POST['rdate']) && isset($_POST['Amount'])&&isset($_POST['paymenttype']) && isset($_POST['disc'])&& isset($_POST['narration']))
{
     $vchdate =$rdate;
     $sub_vchtype="recipt";
    // // inservoucher($con,"",$Amount,$vchdate,$paymenttype,$disc,'Receipt',$party,'1');
    // $insertreciptentry="INSERT INTO `reciptmaster`( `partyid`, `amt`, `recipttype`, `narration`, `disc`) 
    //                                         VALUES ('$party','$Amount','$paymenttype','$narration','$disc')";
    //                                         if(mysqli_query($con,$insertreciptentry))
    //                                         {
                                                inservoucher($con,"",$Amount,$vchdate,$paymenttype,$disc,'Recipt',$party,"1",$narration, $sub_vchtype);

                                            // }else
                                            // {
                                            //     echo "Error To insert Recipt";
                                            // }
   
}





function checkvoucherexist($con,$refrancenno)
{
    $selectvoucherquery = "SELECT * FROM `vouchers` WHERE `refchallanid`='$refrancenno'";
   //  echo $selectvoucherquery;
    $numbers = mysqli_query($con, $selectvoucherquery);
     if(mysqli_num_rows($numbers)>0)
     {
        while($row = mysqli_fetch_assoc($numbers))
        {
            $deleteid=$row['vouchersid'];
         
                $voucherdtls = "DELETE FROM `vouchersdtls` WHERE `vouchersid`='$refrancenno'";
                if (mysqli_query($con, $voucherdtls)) 
                {
                        
                } 
                else
                {
                     echo " Echo error to delete the row";
                }
          
        }

    }
    else
    {
        return false;
    }
}



function getsubtotalofchallan($con,$challannumber)
{
    $subtotal =0;
	$selectquery = "SELECT * FROM `challangoodsentry` where `challanid`='$challannumber'";
	   // echo $selectquery;
	$result = mysqli_query($con, $selectquery);
	if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_row($result)) {
			$subtotal=$subtotal+$row[5];
		}
	} else {
		$subtotal = 0;
	}
	return $subtotal;

}




function getlederid($con,$name,$type)
{
    $selectquery = "SELECT * FROM `ledgermaster` where `ledgername`='$name' and `type`='$type'";
	 //   echo $selectquery;
	$result = mysqli_query($con, $selectquery);
    $row = mysqli_fetch_assoc($result);
    $legerid=$row['ledgerid'];
	return $legerid;

}


function inservoucher($con,$challanid,$amount,$vchdate,$paymenttype,$paymentdisc,$vchtype,$DRledgerid,$CRledgerid,$narrationchallan, $sub_vchtype)
{
	$lastid=0;
	$insertvoucher="INSERT INTO `vouchers`(`vouchersdate`, `voucherstype`, `vouchersamount`, `refchallanid`, `paymenttype`,`sub_vchtype`) 
								   VALUES ('$vchdate','$vchtype','$amount','$challanid','$paymenttype','$sub_vchtype')";

			if(mysqli_query($con,$insertvoucher))
			{
				$lastid=mysqli_insert_id($con);


                    //voucher DR entry
                $insertDR="INSERT INTO `vouchersdtls`(`vouchersid`, `voucherstype`, `vouchersdate`, `ledgerid`, `amount`, `DRCRtype`, `paymenttype`, `paymentdescription`,`narration`,`sub_vchtype`) 
                                               VALUES('$lastid','$vchtype','$vchdate','$DRledgerid','$amount','DR','$paymenttype','$paymentdisc','$narrationchallan','$sub_vchtype')";
                    mysqli_query($con,$insertDR);
                    //voucher cr entry
                $insertCR="INSERT INTO `vouchersdtls`(`vouchersid`, `voucherstype`, `vouchersdate`, `ledgerid`, `amount`, `DRCRtype`, `paymenttype`, `paymentdescription`,`narration`,`sub_vchtype`) 
                                               VALUES('$lastid','$vchtype','$vchdate','$CRledgerid','$amount','CR','$paymenttype','$paymentdisc','$narrationchallan','$sub_vchtype')";
                    mysqli_query($con,$insertCR);

			}					   

// return $lastid;

}
function updatevoucher($con,$vouchersid,$challanid,$amount,$vchdate,$paymenttype,$paymentdisc,$vchtype,$DRledgerid,$CRledgerid,$narrationchallan)
{
	$lastid=0;
	// $insertvoucher="INSERT INTO `vouchers`(`vouchersdate`, `voucherstype`, `vouchersamount`, `refchallanid`, `paymenttype`) 
	// 							   VALUES ('$vchdate','$vchtype','$amount','$challanid','$paymenttype')";
    $updatevoucher = "UPDATE `vouchers` SET `vouchersdate`='$vchdate',`voucherstype`='$vchtype',`vouchersamount`='$amount',`refchallanid`='$challanid',`paymenttype`='$paymenttype' WHERE `vouchersid`='$vouchersid'";

			if(mysqli_query($con,$updatevoucher))
			{
				$lastid=mysqli_insert_id($con);
                    //voucher DR entry
                $insertDR="INSERT INTO `vouchersdtls`(`vouchersid`, `voucherstype`, `vouchersdate`, `ledgerid`, `amount`, `DRCRtype`, `paymenttype`, `paymentdescription`,`narration`) 
                                               VALUES('$lastid','$vchtype','$vchdate','$DRledgerid','$amount','DR','$paymenttype','$paymentdisc','$narrationchallan')";
                    mysqli_query($con,$insertDR);
                    //voucher cr entry
                $insertCR="INSERT INTO `vouchersdtls`(`vouchersid`, `voucherstype`, `vouchersdate`, `ledgerid`, `amount`, `DRCRtype`, `paymenttype`, `paymentdescription`,`narration`) 
                                               VALUES('$lastid','$vchtype','$vchdate','$CRledgerid','$amount','CR','$paymenttype','$paymentdisc','$narrationchallan')";
                    mysqli_query($con,$insertCR);

			}					   

// return $lastid;

}
?>