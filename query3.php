<?php

use Dflydev\DotAccessData\Data;

use function PHPSTORM_META\type;
use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\VarDumper\Dumper\esc;

session_start();
error_reporting(0);

include('includes/config.php');
// query3.php?day=${day}&type=${type}&starttime=${start_time}&month=${month}

if(isset($_GET['starttime'])){
	$day = $_GET['day'];
	$emi = $_GET['emi'];
	$loanamount = $_GET['loanamount'];
	$type = $_GET['type'];
	$starttime = $_GET['starttime'];
	$month = $_GET['month'];

	$given_year = strtotime("$starttime");
	$for_start = strtotime("$day", $given_year);
	$for_end = strtotime("$month month", $given_year);
	$y=1;

	$weekcount = 0;
	$daycount = 0;
	if($type =="week"){
		for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
			$weekcount++;
		}
		$temp = $emi*$month;
		$emi = number_format($temp/$weekcount,2);
	}
	else if($type =="day"){
		for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
			$daycount++;
		}
		$temp = $emi*$month;
		$emi = number_format($temp/$daycount,2);
	}


	for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
		//echo $y."--";
		$datess = date('Y-m-d', $i);
		$dates = date('l', $i);
		$Data.="<tr>						
		<td class='text-center'>$y</td>
		<td class='text-center'>$dates</td>
		<td class='text-center'>$datess</td>
		<td class='text-center'>$emi</td>
	</tr>";
		$y++;
	}
	echo $Data;



}

// foreach($results as $result){
// 	$Data.="<tr>						
// 		<td class='text-center'>$cnt</td>
// 		<td class='text-center'>$result->medicine_name</td>
// 		<td class='text-center'>$result->BatchId</td>
// 		<td class='text-center'>$result->Qty</td>
// 		<td class='text-center'>$result->NetPrice</td>
// 		<td class='text-center'>$result->Price</td>
// 	</tr>";
// 	$cnt++;
// }

	// $month="12";
	// $day="Sunday";
	// $given_year = strtotime("25-feb-2023");
	// $for_start = strtotime("$day", $given_year);
	// $for_end = strtotime("$month month", $given_year);
	// $type= "week";
	// $y=1;
	// for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
	// 	//echo $y."--";
	// 	echo date('l Y-m-d', $i) . '<br />';
	// 	$y++;
	// }


// if(isset($_GET['StatusCng'])){
// 	$batchNumber = $_GET['StatusCng'];
// 	$status = $_GET['Status'];
// 		$sql = "UPDATE stocktable set Status=:status WHERE BatchNumber=:batchNumber";
// 		$query = $dbh -> prepare($sql);
// 		$query->bindParam(':status',$status,PDO::PARAM_STR);
// 		$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
// 		$query->execute();
// 		echo "Update Successful";
// }



?>