<?php

	use Dflydev\DotAccessData\Data;

use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\VarDumper\Dumper\esc;

	session_start();
	error_reporting(0);
	include('includes/config.php');
	
	
	if(isset($_GET['CustomberName'])){
		$CustomberName = $_GET['CustomberName'];
		$value =explode("-",$medicineName);

		$ID = $value[0];
		$Name = $value[1];
		$Phone = $value[2];
		$Address = $value[3];
		

		$NamePattern = '%'.$Name.'%';
		$PhonePattern = '%'.$Phone.'%';
		$AddressPattern = '%'.$Address.'%';
		$IDPattern = '%'.$ID.'%';
		
		$sql = "SELECT * from  customertable WHERE Name like :NamePattern or Phone like  :PhonePattern or Address like  :AddressPattern or ID like  :IDPattern";
		$query = $dbh -> prepare($sql);
		$query->execute([':NamePattern' => $NamePattern,':PhonePattern' => $PhonePattern,':AddressPattern' => $AddressPattern,':IDPattern' => $IDPattern]);

		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{ $cnt=1;
			// <option hidden name="product_id[]" value="'.$result->item_code.'"></option>
			foreach($results as $result){
				$Data.='
				<option value="'.$result->ID.'-'.$result->Name.'-'.$result->Phone.'-'.$result->Address.'">
				';
				$cnt++;
			}
		}
		echo $Data;
	}
	if(isset($_GET['medicineName2'])){
		$medicineName = $_GET['medicineName2'];
		$value =explode("-",$medicineName);
		$medicineName = $value[0];
		$strength = $value[1];

		$manufacturer_id = $_GET['manufacturer_id'];

		$pattern = '%'.$medicineName.'%';
		$pattern2 = '%'.$strength.'%';
		$manufacturer_id = '%'.$manufacturer_id.'%';

		$sql = "SELECT item_code from  medicine_list WHERE medicine_name like :pattern and strength like :pattern2  and menufacturer like  :manufacturer_id";
		$query = $dbh -> prepare($sql);
		$query->execute([':pattern' => $pattern, ':pattern2' => $pattern2,':manufacturer_id' => $manufacturer_id]);
		// $results=$query->fetchAll(PDO::FETCH_OBJ);
		$result=$query->fetch(PDO::FETCH_OBJ);
		$item_code= $result->item_code;
		echo $item_code;


		// if($query->rowCount() > 0)
		// { $cnt=1;
		// 	foreach($results as $result){
		// 		$Data="$result->item_code";
		// 		$cnt++;
		// 	}
		// }
		// echo $Data;
	}
	
?>


