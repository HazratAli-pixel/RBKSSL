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
	$emi = round($_GET['emi'],2);
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
		$temp =round($emi*$month,2) ;
		$emi = round($temp/$weekcount,2);
	}
	else if($type =="day"){
		for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
			$daycount++;
		}
		$temp =round($emi*$month,2) ;
		$emi = round($temp/$daycount,2);
	}
	else{
		$temp =round($emi*$month,2) ;
	}
	
	$temp2=round($temp-$emi,2);
	for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
		//echo $y."--";
		$datess = date('Y-m-d', $i);
		$dates = date('l', $i);
		$Data.="<tr>						
		<td class='text-center'>$y</td>
		<td class='text-center'>$datess</td>
		<td class='text-center'>$dates</td>
		<td class='text-center'>$temp</td>
		<td class='text-center'>$emi</td>
		<td class='text-center'>$temp2</td>
		</tr>";
		if($temp2<0){
			break;
		}
		$temp=round($temp-$emi,2);
		$temp2=round($temp-$emi,2);
		$y++;
	}
	$Data = $Data."^".($y-1);
	echo $Data;



}





?>