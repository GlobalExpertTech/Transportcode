<?php
include('config.php');
error_reporting(0);
if(!isset($_GET['legerid']))
{
  header('Location:ledgerreport.php');
}


//getting data of company 
$selectchllanquery="SELECT * FROM `comapnymaster` where `id`='1'";
 $result=mysqli_query($con,$selectchllanquery);
     $row = mysqli_fetch_assoc($result);

$companyname = $row['name'];
$address = $row['address'];
$mob=$row['mob'];
$GSTIN = $row['gst'];

$partyid = $_GET['legerid'];
$fromdate = $_GET['fdate'];
$todate = $_GET['todate'];

$comapanyid=$_GET['companyid'];

$partyrow = getpartydetails($con,$partyid);
//  print_r($partyrow);
//  print_r($partyrow[2])   ;
$partyname = $partyrow['companyname'];
$partyaddress = $partyrow['address'];



$openingbalance = getopeningbalance($con, $fromdate, $partyid);

// echo $openingbalance;
$totalDR = 0;
$totalCR = $openingbalance;

function getopeningbalance($con,$fromdate,$partyidledgerid)
{
    $openingbalance = 0;

    $selectopeningquery="SELECT `openingbalance` FROM `ledgermaster` WHERE `ledgerid`='$partyidledgerid'";
        $responceopening= mysqli_query($con, $selectopeningquery);
        $legerrow = mysqli_fetch_assoc($responceopening);

        $openingbalance=$legerrow['openingbalance'];

        // echo "Opening Balance From Leger Record  --> ".$openingbalance;


    $selectquery = "SELECT `vouchersid`,`voucherstype`,`vouchersdate`, `ledgerid`, 
			`amount`, `DRCRtype`, `paymenttype` FROM `vouchersdtls` WHERE 
            `vouchersdate`<='$fromdate' AND `ledgerid`='$partyidledgerid'
			AND `DRCRtype`='DR'
			  UNION ALL 
			SELECT `vouchersid`,`voucherstype`, `vouchersdate`,
			`ledgerid`, `amount`, `DRCRtype`, `paymenttype` FROM `vouchersdtls` WHERE
             `vouchersdate`<='$fromdate' AND `ledgerid`='$partyidledgerid'
			 AND `DRCRtype`='CR';";
			    // echo $selectquery;

			$result = mysqli_query($con, $selectquery);
			if (mysqli_num_rows($result) > 0) {
				$num = 1;
		
				while ($row = mysqli_fetch_row($result)) {
		//	echo $openingbalance."\n";
			$DRCRtype = $row[5];
			$amt = $row[4];
					if($DRCRtype=="DR")
					{
				$openingbalance = $openingbalance - $amt;
					}

					if($DRCRtype=="CR")
					{
				$openingbalance = $openingbalance + $amt;
					}
			//echo $row[1]."-->".$DRCRtype." = ".$amt." >> ".$openingbalance."\n";
				}
			} 
			else {
				// $openingbalance = 0;
			}
    return $openingbalance;
}




function getpartydetails($con,$legerid)
{
    $sql = "SELECT * FROM `partydata` where `ledgerid`='$legerid'";
    $result=mysqli_query($con,$sql);
  
        $row = mysqli_fetch_assoc($result);


    return $row;
}










?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ledger</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
         .address{
                font-size:14px;
                margin-top: -16px;
            }
    </style>
    </head>
<body style="font-family: Arial, Helvetica, sans-serif;">
    <div class="container">
    <div class="row">
        <div class="col-2">
            <img src="images/logo.png" height="150px">
        </div>
        <div class="col-10 text-right">
        <h1 style="color: #0092CB;"><b><?php echo $companyname;?></b></h1>
        <p>Mumbai Off. : 4th Khethwadi, Near Alankar Cinema, S.V.P. Road ,Mumbai-04 </p>
  <p class="address">Kalamboli Off : Kalamboli Steel Market , Near Godown No.163, Kalamboli</p>
  <p class="address">HOD Off : Durganagr chowk , Near shrinarayan Tyres, Akurdi</p>
  <?php 
    if( $comapanyid==1)
    {
      // <!-- old GST 
      echo '<p class="address">GSTIN :27AOUPB6592C1ZO  PAN No : AOUPB6592C</p>  ';
    }elseif($comapanyid==2)
    {
      // <!-- New GST -->
      echo '<p class="address">GSTIN :27AQIPB7661A1Z4  PAN No : AQIPB7661A</p>';
    }
  ?>
        </div>
       
    </div>
    <hr>
        <center>
            <h3><b>Ledger Report</b></h3>           
        </center>
    </div>
    
<div class="container">
    <br>
<div class="row">
    <div class="col">
    <h5><b><?php echo $partyname;?></b></h5>
    <p style="margin-top: -10px;"><?php echo $partyaddress;?></p>
    </div>
    <div class="col text-right">
        <br>
    <p class="" style="color:#0092CB">Date : <?php echo $fromdate." TO ".$todate;?> </p>
    </div>
</div>
</div>
    
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>Voucher Date</th>
            <th>Narration</th>
            <th>Voucher type</th>
            <th>Credit</th>
            <th>Debit</th>
            <th>Balance</th>
        </tr>
        <tr>
            <td colspan='5' class="text-right">Opening Balance</td>
            <td><b><?php echo $openingbalance;?></b></td>
        </tr>
                <?php
                $subtotal =0;
                $selectquery = "SELECT `vouchersid`,`voucherstype`,`vouchersdate`, `ledgerid`, 
                `amount`, `DRCRtype`, `paymenttype`,`narration` FROM `vouchersdtls` WHERE 
                `vouchersdate`>='$fromdate' AND `vouchersdate`<='$todate' AND `ledgerid`='$partyid'
                AND `DRCRtype`='DR'
                  UNION ALL 
                SELECT `vouchersid`,`voucherstype`, `vouchersdate`,
                `ledgerid`, `amount`, `DRCRtype`, `paymenttype`,`narration`  FROM `vouchersdtls` WHERE 
                `vouchersdate`>='$fromdate' AND `vouchersdate`<='$todate' AND `ledgerid`='$partyid'
                 AND `DRCRtype`='CR' ORDER BY `vouchersid` ASC;";
                //    echo $selectquery;
                // $openingbalance = 0;
            

                $result = mysqli_query($con, $selectquery);
                if (mysqli_num_rows($result) > 0) {
                    $num = 1;
                    
                    while ($row = mysqli_fetch_row($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row[2]?></td>
                        <td><?php echo $row[7]?></td>
                        <td><?php echo $row[1]?></td>
                    <?php
                // echo $openingbalance."\n";
                $DRCRtype = $row[5];
                $amt = $row[4];
                       
    
                        if($DRCRtype=="CR")
                        {
                    $openingbalance = $openingbalance - $amt;
                        $totalCR = $totalCR + $amt;
                    echo "
                    <td>0.00</td>
                            <td class='text-danger'>".$amt."</td>
                            
                            ";
                        }
                        if($DRCRtype=="DR")
                        {
                    $openingbalance = $openingbalance + $amt;
                        $totalDR = $totalDR + $amt;
                        echo "
                            <td class='text-success'>" . $amt . "</td>
                            <td>0.00</td>
                            ";
                        }
    
                        
    
                // echo $row[1]."-->".$DRCRtype." = ".$amt." >> ".$openingbalance."\n";

 ?>
                    <td><b><?php echo $openingbalance;?></b></td>
                </tr>
 <?php               
                    }
                } 
                

                ?>

                <tr>
                    <td colspan="5" class="text-right text-danger"> <b>Total Credit</b> </td>
                    <td class="text-danger" ><b><?php echo $totalCR;?></b></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right text-success"><b>Total Debit</b></td>
                    <td class="text-success"><b><?php echo $totalDR;?></b></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right"><b>Closing Bal</b></td>
                    <td ><b><?php 

                        // $clobal=$totalCR-$totalDR;
                        $clobal=$totalDR-$totalCR;

                        if($clobal>0)
                        {
                        echo "+ " . $clobal;
                        }else
                        {
                            echo $clobal;
                        }

                    
                    ?></b></td>
                </tr>

    </table>
                    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</body>
</html>