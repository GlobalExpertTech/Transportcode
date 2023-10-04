<?php
include('config.php');


// $selectquery="SELECT * FROM `partydata`";

// $result=mysqli_query($con, $selectquery);

// $responce=array();

// if(mysqli_num_rows($result)>0)
// {

//     while ($row=mysqli_fetch_assoc($result))
//     {
//         // $responce =$row;
//         $rowid=$row['id'];
//         $name=$row['companyname'];
//         $type="Party";

//         // echo $name."<br>";

//          $ledgerquery="INSERT INTO `ledgermaster`(`ledgername`, `type`) VALUES ('$name','Party')";

   
// 			//echo $ledgerquery;
//         if (mysqli_query($con, $ledgerquery)) {
//             $lastid = mysqli_insert_id($con);

//             $insertsql = "UPDATE `partydata` SET `ledgerid`='$lastid' WHERE `id`='$rowid'";
//             if (mysqli_query($con, $insertsql)) {

//                 $output = "Done";

//             }

//         }


//     }
// }

?>