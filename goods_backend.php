<?php
include('config.php');
extract($_POST);
// echo "test";
//insert party data
if (isset($_POST['lable']) && isset($_POST['unit'])) {
	$insertsql = "INSERT INTO `gooddata`(`goodno`, `goodname`) VALUES ('$lable','$unit')";

	// echo $insertsql;
	if (mysqli_query($con, $insertsql)) {
		$output = "Done";
	}
	echo $output;
}

//update party data
if (isset($_POST['hidden_id']) && isset($_POST['uplable']) && isset($_POST['upunit'])) {
	$insertsql = "UPDATE `gooddata` SET `goodno`='$uplable',`goodname`='$upunit' WHERE `id`='$hidden_id'";
	///echo $insertsql;
	if (mysqli_query($con, $insertsql)) {
		$output = "Done";
	}
	echo $output;
}




///delete data
if (isset($_POST['deleteid'])) {
	$deleteid = $_POST['deleteid'];
	$sql = "DELETE FROM `gooddata` WHERE id='$deleteid'";
	//echo($sql);
	mysqli_query($con, $sql);
}





if (isset($_POST['updateid'])) {


	$userid = $_POST['updateid'];
	$selectquery = "SELECT * FROM `gooddata` where id='$userid'";

	$result = mysqli_query($con, $selectquery);

	$responce = array();

	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			$responce = $row;
		}
	} else {
		$responce['status'] = 200;
		$responce['message'] = "No Record Found";
	}
	echo json_encode($responce);
} else {
	$responce['status'] = 200;
	$responce['message'] = "Invalid Request";
}



// if (isset($_POST['id'])) {
// 	echo "id is here";
// }





//insert range and rate data of goods

if (isset($_POST['id']) && isset($_POST['range']) && isset($_POST['price'])) {

	 echo "test";
	$insertsql = "INSERT INTO `goodsrangeandrate`(`goodid`, `goodname`, `range`, `rate`) VALUES ('$id',(SELECT `goodname` from gooddata where id='$id'),'$range','$price')";
	//  $insertsql = "INSERT INTO `goodsrangeandrate`(`goodid`, `range`, `rate`) VALUES ('$id','$range','$price')";
	 echo $insertsql;
	if (mysqli_query($con, $insertsql)) {
		$output = "Done";
	}else{
		$output = "Error";

	}
	echo $output;
}

if (isset($_POST['idgood'])) {
	$output = "";
	$selectquery = "SELECT * FROM `goodsrangeandrate` where `goodid`='$idgood'";
	//    echo $selectquery;
	$result = mysqli_query($con, $selectquery);
	if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_row($result)) {
			$output .= "
						 <tr>
								<td>" . $row[0] . "</td>
                               
                                <td>" . $row[3] . "</td>
                                <td>" . $row[4] . "</td>
                                <td><button class='btn btn-danger' onclick='deleterangesdata(" . $row[0] . ")'> <i class='fas fa-trash-alt'></i ></button></td>
						 </tr>

						   
						   ";
			$num++;
		}
	} else {
		$output = "<tr>
						                    <td colspan=3>No Data Found</td>
						</tr>";
	}
	echo $output;
}


//getting data from goods record table
if (isset($_POST['challanID'])) {
	$output = "";
	$selectquery = "SELECT * FROM `challangoodsentry` where `challanid`='$challanID'";
	//    echo $selectquery;
	$result = mysqli_query($con, $selectquery);
	if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_row($result)) {
			$output .= "
						 <tr>
								<td>" . $num . "</td>
                               
                                <td>" . $row[2] . "</td>
                                <td>" . $row[3] . "</td>
                                <td><button class='btn btn-danger' onclick='deletegooditem(" . $row[0] . ")'> <i class='fas fa-trash-alt'></i ></button></td>
						 </tr>

						   
						   ";
			$num++;
		}
	} else {
		$output = "<tr>
						                    <td colspan=3>No Data Found</td>
						</tr>";
	}
	echo $output;
}


//getting data from goods record table
if (isset($_POST['upchallanID']) && isset($_POST['updatecheck'])) {
	$output = "";
	$selectquery = "SELECT * FROM `challangoodsentry` where `challanid`='$upchallanID'";
	    echo $selectquery;
	$result = mysqli_query($con, $selectquery);
	if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_row($result)) {
			$output .= "
						 <tr>
								<td>" . $num . "</td>
                               
                                <td>" . $row[2] . "</td>
                                <td>" . $row[3] . "</td>
                                <td>" . $row[4] . "</td>
                                <td>" . $row[5] . "</td>
                                <td>" . $row[6] . "</td>
                                <td>" . $row[7] . "</td>
                                <td>
								<button class='btn btn-warning' id='btnpencil' onclick='getdata(" . $row[0] . ")'> 
									<i class='fas fa-pencil-alt'></i >
								</button>
								<button class='btn btn-danger' onclick='deletegooditem(" . $row[0] . ")'> 
									<i class='fas fa-trash-alt'></i >
								</button>
								</td>
                               
						 </tr>

						   
						   ";
			$num++;
		}
	} else {
		$output = "<tr>
						                    <td colspan=3>No Data Found</td>
						</tr>";
	}
	echo $output;
}


//delete range and rate data from database

///delete data
if (isset($_POST['deleterangeid'])) {
	$deleteid = $_POST['deleterangeid'];
	$sql = "DELETE FROM `goodsrangeandrate` WHERE id='$deleteid'";
	//echo($sql);
	mysqli_query($con, $sql);
}

///delete item data from table 'challangoodsentry'
if (isset($_POST['itemid'])) {
	$deleteid = $_POST['itemid'];
	$sql = "DELETE FROM `challangoodsentry` WHERE id='$itemid'";
	//echo($sql);
	mysqli_query($con, $sql);
}


if(isset($_POST['challanid']) && isset($_POST['goodname']) && isset($_POST['weight'])&& isset($_POST['qty'])&& isset($_POST['disc']))
{
	 echo "recived";	

	$selectquery = "SELECT * FROM `goodsrangeandrate` where goodid='$goodname'";

	$result = mysqli_query($con, $selectquery);

	// $responce = array();

	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {
			// $responce = $row;

			$range=$row['range'];

			$str_arr = explode ("-", $range);

				$first=$str_arr[0];
				$Last=$str_arr[1];

				if($weight>=$first && $weight<=$Last)
				{
				$rate = $row['rate'];
					$pricerate=$rate*$weight;

					$insertdata="INSERT INTO `challangoodsentry`(`challanid`, `goodname`, `weight`, `price`,`total`,`qty`,`disc`) 
					VALUES ('$challanid',(SELECT `goodname` from gooddata where id='$goodname'),'$weight','$rate','$pricerate','$qty','$disc')";
				echo $insertdata;
					if(mysqli_query($con,$insertdata))
					{
						echo "data";
					}else{
						echo "Error";
					}
				}else
				{
					echo " No record Found";
				}
				

		}
	}

}



//service Charges Entery in challan
if(isset($_POST['challanid']) && isset($_POST['servicename']) && isset($_POST['servicevalue']))
{
	// echo "recived";	

	
					$insertdata="INSERT INTO `challangoodsentry`(`challanid`, `goodname`, `weight`, `price`,`total`) 
					VALUES ('$challanid','$servicename','$servicevalue',(SELECT `serviceamt` FROM `servicemaster` where `servicename`='$servicename'),(SELECT `serviceamt` FROM `servicemaster` where `servicename`='$servicename'))";
	echo $insertdata;
					if(mysqli_query($con,$insertdata))
					{
						echo "data";
					}else{
						echo "Error";
					}
}
		







//------------------------------------------getting below data for update challan page-----------------------------------------------

if (isset($_POST['challangoodid']))
	{


		$challangoodid=$_POST['challangoodid'];
		$selectquery="SELECT * FROM `challangoodsentry` where id='$challangoodid'";

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

if (isset($_POST['itemids']) && isset($_POST['upweight']) && isset($_POST['upgoodname']) && isset($_POST['uptotal']) && isset($_POST['upprice']) && isset($_POST['upqty']) && isset($_POST['updisc'])) {
	
	$updatesql = "UPDATE `challangoodsentry` SET `goodname`='$upgoodname',`weight`='$upweight',`price`='$upprice',`total`='$uptotal',`qty`='$upqty',`disc`='$updisc' WHERE `id`='$itemids'";
	///echo $insertsql;
	if (mysqli_query($con, $updatesql)) {
		$output = "Done";
	}
	echo $output;
}
