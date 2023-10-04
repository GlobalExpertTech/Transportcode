<?php
include('config.php');
if(!isset($_GET['challanid']))
{
  header('Location:newchallan.php');
}

$challannumber=$_GET['challanid'];
$totalweight=0;
$totalpaidamt=0;
$totalpendingamt=0;

// $challannumber="KRANTI0021";



$selectchllanquery="select * from `challanrecord` where `billno`='$challannumber'";
//  echo $selectchllanquery;
 $result=mysqli_query($con,$selectchllanquery);
 // if($res)
 // {
     $row = mysqli_fetch_assoc($result);
     $vchdate=$row['date'];
     $billno=$row['billno'];
     $challanid=$row['challanNo'];
     $topartyname=$row['toparty'];
     $frompartname=$row['fromparty']; 
     $topartyaddress=$row['topartyaddress'];
     $frompartaddress=$row['frompartyaddress'];
     $payeename =$row['payingparty'];
     $truckno =$row['truckno'];
     $dileverdat =$row['dileverdat'];
     $comapanyid=$row['companyid'];
    //  $tandc =$row['tandc'];
    //  $topartyid=getlederid($con,$topartyname,"Party");
    //  $paymenttype=$row['billtype'];
   



?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style>
        div {
            border: 0.5px solid black;
            }

            th,td{
            font-size:12px;
            padding: -15px;
            }

            .address{
                font-size:14px;
                margin-top: -16px;
            }
            h1{
              font-size: 29px;
            }
    </style>

  </head>
  <body>
    
<div class="printablebody" >
  <div style="height: 741px;border:1px solid black"  class="">

  <div class="row">

<div class="col-2 text-center p-2"><h1><img src="images/logo.png" width=150px></h1></div>
<div class="col text-center">
  <h1 style="color: #0092CB;"><b>Kranti Transport</b></h1>
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
<div class="col text-right col-3 text-center pt-1"><h5>Mob: 9552529481 / 9552529483</h5><hr><h4><b><u>Bill No :<?php echo $billno ?></u></b></h4></div>
</div>



  <div class="row">
    <div class="col-5 pl-3">
      <b>  From : <?php echo $frompartname?></b><br>
        Address : <b><?php echo $frompartaddress?></b>
    </div>
    <div class="col-5 pl-3">
    <b> To : <?php echo $topartyname?></b><br>
        Address : <b><?php echo $topartyaddress?></b>
    </div>
    <div class="col-2 pl-3">
    <h6>Date : <?php echo $vchdate ?>  </h6>
    <h6>Challan No : <?php echo $challanid ?>  </h6>
   
    </div>
  </div>

  <div class="row">
    <div class="col">
        
<table class="table  table-bordered">
  <thead class="thead-light">
  <tr style="border-bottom: 2px solid black; color:#0092CB;">
  <th class="text-center"   width="5%" >Sr.No</th>
      <th class="text-center"   width="20%">Goods Said to Contain</th>
      <th class="text-center"   width="10%">Qty</th>
      <th class="text-center"   width="15%">Weight charged Per KGs</th>
      <th class="text-center"   width="15%">Extra Charges</th>
      <th scope="col"width="12%">Paid</th>
    <th scope="col"width="15%">To Pay</th>
      <!-- <th colspan="2" class="text-center" >Freight</th> -->
      
  </tr>

  </thead>
  <tbody>
   
     <?php
   
        $selectchllanquery="select * from `challangoodsentry` where `challanid`='$challannumber'";
        // echo $selectchllanquery;
        $result = mysqli_query($con, $selectchllanquery);
          
        if (mysqli_num_rows($result) > 0) {
            // OUTPUT DATA OF EACH ROW
            $num=1;
            $totalpaid=0;
            $totalpendingamt=0;
            while($row = mysqli_fetch_assoc($result)) 
            {
              $gdname="";
              // $gdname=$gdname=$row['goodname']." - ".$row['disc'];
              // if($row['qty']!="")
              // {
              //   $gdname=$row['goodname'].' ('.$row['qty'].')';
              // }
              // if($row['disc']!="")
              // {
              //   $gdname=$row['goodname']." - ".$row['disc'];
              // }else{
              //   $gdname=$row['goodname'];
              // }
              // if($row['qty'] && $row['disc']=="")
              //   {
              //     $gdname=$row['goodname'];
              //     // $gdname=$row['goodname']." - ".$row['disc'];
              //   }else{
              //     $numberofcount=$row['qty'];
              //     $itemdisc=$row['disc'];
              //     $gdname=$row['goodname'].' ('.$numberofcount.')'." - ".$itemdisc;
              //   } 
              $service="";
              $weight="";
          if($row['weight']==1)
          {
            $service=$row['goodname'];
            $weight="";
          }else{
            $gdname=$gdname=$row['goodname']." - ".$row['disc'];
            $weight=$row['weight'];
          }
            
           echo "<tr>
           <td class='text-center'>".$num."</td>
            <td class='text-center'>". $gdname."</td>
            <td class='text-center'>". $row['qty']."</td>
            <td class='text-center'>".$weight."</td>                
            <td class='text-center' >".$service."</td>
            <td class='text-center' ></td>
            <td class='text-center' >".$row['total']."</td>

            </tr>";
         if ($row['weight'] != "1") {
           $totalweight = $totalweight + $row['weight'];
         }
         $totalpendingamt=$totalpendingamt+$row['total'];
              $num++;  
          }
        } else {
            echo "0 results";
        }
     ?>
  
    
  </tbody>

  <!-- <tr>
    <th>

    </th>
    <th>

    </th>
    <td class="text-right"><b>TOTAL : </b></td>
    <td scope="col" width="10%" class="text-center">
      <b><?php// echo $totalweight." KG";?></b>
    </td>
    <td scope="col" width="10%" class="text-center">
     <b><?php //echo $totalpaid;?></b>
    </td>
    <td scope="col" width="10%" class="text-center">
     <b><?php// echo $totalpendingamt;?></b>
    </td>
  </tr> -->
</table>
<table class="table table-bordered">
<tr>
 
<td width="40%"><b>Payee Name : </b><b style="color:#0092CB"><?php echo $payeename;?> </b></td>
 <td width="30%"><b>Truck No :<?php echo $truckno;?></b> </td>
 <td width="12%"><b><?php echo $dileverdat ?></b> </td>
 <td width="15%" style="padding-left:20px"><b><?php echo "TOTAL : ".$totalpendingamt ?></b> </td>

</tr>
</table>
<table class="table table-bordered">
  <tr>
  <td width="20%" style="vertical-align: bottom">Receiver's Signature </td>
    <td  width="60%">
        <b>Terms And Conditions</b><br>
        <p>-Company will not Entertain any claim against transit any damage like glass items, Liquid and other fragile items etc. | -For each bounced cheque Rs.500 /- will be charged extra. | -All Online payment must be on company account otherwise company will not responsible for such payment. | -GST paid by consignor / consignee GTA is not responsible.</p>
        
    </td>
    <td width="20%" style="vertical-align: bottom; color: #0092CB;" ><b>For Kranti Transport </b></td>
     <!-- <td colspan="">For Kranti Transport </td> -->
  </tr>
</table>
    </div>
  </div>

</div>
  <div style="height: 741px;border:1px solid black" class="mt-4">
<!-- print two code is here -->
<div class="row">

<div class="col-2 text-center p-2"><h1><img src="images/logo.png" width=150px></h1></div>
<div class="col text-center">
  <h1 style="color: #0092CB;"><b>Kranti Transport</b></h1>
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
<div class="col text-right col-3 text-center pt-1"><h5>Mob: 9552529481 / 9552529483</h5><hr><h4><b><u>Bill No :<?php echo $billno ?></u></b></h4></div>
</div>



  <div class="row">
    <div class="col-5 pl-3">
      <b>  From : <?php echo $frompartname?></b><br>
        Address : <b><?php echo $frompartaddress?></b>
    </div>
    <div class="col-5 pl-3">
    <b> To : <?php echo $topartyname?></b><br>
        Address : <b><?php echo $topartyaddress?></b>
    </div>
    <div class="col-2 pl-3">
    <h6>Date : <?php echo $vchdate ?>  </h6>
    <h6>Challan No : <?php echo $challanid ?>  </h6>
   
    </div>
  </div>

  <div class="row">
    <div class="col">
        
<table class="table  table-bordered">
  <thead class="thead-light">
  <tr style="border-bottom: 2px solid black; color:#0092CB;">
      <th class="text-center"   width="5%" >Sr.No</th>
      <th class="text-center"   width="20%">Goods Said to Contain</th>
      <th class="text-center"   width="10%">Qty</th>
      <th class="text-center"   width="15%">Weight charged Per KGs</th>
      <th class="text-center"   width="15%">Extra Charges</th>
      <th scope="col"width="12%">Paid</th>
    <th scope="col"width="15%">To Pay</th>
      <!-- <th colspan="2" class="text-center" >Freight</th> -->
      
  </tr>
   
  </thead>
  <tbody>
   
     <?php
   
        $selectchllanquery="select * from `challangoodsentry` where `challanid`='$challannumber'";
        // echo $selectchllanquery;
        $result = mysqli_query($con, $selectchllanquery);
          
        if (mysqli_num_rows($result) > 0) {
            // OUTPUT DATA OF EACH ROW
            $num=1;
       $totalweight = 0;
       $totalpaid=0;
       $totalpendingamt=0;
            while($row = mysqli_fetch_assoc($result)) 
            {
              // $gdname=$gdname=$row['goodname']." - ".$row['disc'];
              $gdname="";
              // if($row['qty']>0)
              // {
              //   $gdname=$row['goodname']." (".$row['qty'].")";
              // }
              // if($row['disc']!="")
              // {
              //   $gdname=$row['goodname']." - ".$row['disc'];
              // }else{
              //   $gdname=$row['goodname'];
              // }
                  $service="";
                  $weight="";
              if($row['weight']==1)
              {
                $service=$row['goodname'];
                $weight="";
              }else{
                $gdname=$gdname=$row['goodname']." - ".$row['disc'];
                $weight=$row['weight'];
              }
                
               echo "<tr>
               <td class='text-center'>".$num."</td>
                <td class='text-center'>". $gdname."</td>
                <td class='text-center'>". $row['qty']."</td>
                <td class='text-center'>".$weight."</td>                
                <td class='text-center' >".$service."</td>
                <td class='text-center' ></td>
                <td class='text-center' >".$row['total']."</td>

                </tr>";
         if ($row['weight'] != "1") {
           $totalweight = $totalweight + $row['weight'];
         }
         $totalpendingamt=$totalpendingamt+$row['total'];

              $num++;  
          }
        } else {
            echo "0 results";
        }
     ?>
  
    
  </tbody>

  <!-- <tr>
    <th>

    </th>
    <th>

    </th>
    <td class="text-right"><b>TOTAL : </b></td>
    <td scope="col" width="10%" class="text-center">
      <b><?php //echo $totalweight." KG";?></b>
    </td>
    <td scope="col" width="10%" class="text-center">
     <b><?php// echo $totalpaid;?></b>
    </td>
    <td scope="col" width="10%" class="text-center">
     <b><?php //echo $totalpendingamt ;?></b>
    </td>
  </tr> -->
</table>
<table class="table table-bordered">
<tr>
 
 <td width="40%"><b>Payee Name : </b><b style="color:#0092CB"><?php echo $payeename;?> </b></td>
 <td width="30%"><b>Truck No :<?php echo $truckno;?></b> </td>
 <td width="12%"><b><?php echo $dileverdat ?></b> </td>
 <td width="15%" style="padding-left:20px"><b><?php echo "TOTAL : ".$totalpendingamt ?></b> </td>

</tr>
</table>
<table class="table table-bordered">
  <tr>
  <td width="20%" style="vertical-align: bottom">Receiver's Signature </td>
    <td  width="60%">
        <b>Terms And Conditions</b><br>
        <p>-Company will not Entertain any claim against transit any damage like glass items, Liquid and other fragile items etc. | -For each bounced cheque Rs.500 /- will be charged extra. | -All Online payment must be on company account otherwise company will not responsible for such payment. | -GST paid by consignor / consignee GTA is not responsible.</p>
        
    </td>
    <td width="20%" style="vertical-align: bottom; color: #0092CB;" ><b>For Kranti Transport </b></td>
     <!-- <td colspan="">For Kranti Transport </td> -->
  </tr>
</table>
    </div>
  </div>


</div>

</div>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <script>
$(document).ready(function () { 
  // printablebody 
  $("#printablebody").printElement();
  
});

// function printDiv(){
//         var printContents = document.getElementById("printablebody").innerHTML;
//         var originalContents = document.body.innerHTML;
//         document.body.innerHTML = printContents;
//         window.print();
//         document.body.innerHTML = originalContents;
// }
    </script>
  
  
  </body>
</html> 