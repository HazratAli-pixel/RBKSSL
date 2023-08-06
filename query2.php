<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');

if(isset($_GET['invodetails'])){
	$invoId = $_GET['invodetails'];
	$sql = "SELECT purchaseslist.BatchId,purchaseslist.Qty,purchaseslist.Mprice,purchaseslist.MRP,purchaseslist.date,
	medicine_list.medicine_name from purchaseslist LEFT JOIN medicine_list ON purchaseslist.ProductId = medicine_list.item_code 
	WHERE purchaseslist.InvoiceId =:id AND purchaseslist.shopId=:shopId AND purchaseslist.branchId=:branchId";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':id',$invoId,PDO::PARAM_STR);
	$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
	$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{ $cnt=1;
		foreach($results as $result){
			$total = $result->Qty*$result->Mprice;
			$Data.="<tr>						
				<td class='text-center'>$cnt</td>
				<td class='text-center'>$result->medicine_name</td>
				<td class='text-center'>$result->BatchId</td>
				<td class='text-center'>$result->Qty</td>
				<td class='text-center'>$result->Mprice</td>
				<td class='text-center'>$total</td>
			</tr>";
			$cnt++;
		}
	}
	echo $Data;
}
if(isset($_GET['StatusCng'])){
	$batchNumber = $_GET['StatusCng'];
	$status = $_GET['Status'];
		$sql = "UPDATE stocktable set Status=:status WHERE BatchNumber=:batchNumber AND shopId=:shopId AND branchId=:branchId";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query->execute();
		echo "Update Successful";
}
if(isset($_GET['DeleteBatch'])){
	$batchNumber = $_GET['DeleteBatch'];
	$sql = "DELETE FROM stocktable WHERE BatchNumber=:batchNumber AND shopId=:shopId AND branchId=:branchId";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
	$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
	$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
	$query->execute();
	echo "Record Delete Successful";
}

if(isset($_GET['updatePrice'])){
	$batchNumber = $_GET['updatePrice'];
	$price = $_GET['price'];
	$sql = "update stocktable SET SellPrice=:price WHERE BatchNumber=:batchNumber AND shopId=:shopId AND branchId=:branchId";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':price',$price,PDO::PARAM_STR);
	$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
	$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
	$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
	$query->execute();
	echo "Record update Successful";
}

if(isset($_GET['StockManagment'])){
	$batchNumber = $_GET['StockManagment'];
	$sql = "SELECT * FROM stocktable WHERE BatchNumber=:batchNumber";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetch(PDO::FETCH_OBJ);
	$date = $_GET['date'];
	$PQty = $_GET['Qty'];
	$PQty = $PQty + $result->InQty;
	$productid = $_GET['productid'];
	$Mprice = $_GET['Mprice'];
	$MRP = $_GET['MRP'];
	// echo "ok this line";
	if($query->rowCount() > 0)
	{
		$sts = 1;
		$sql = "update stocktable SET InQty=:PQty WHERE BatchNumber=:batchNumber AND shopId=:shopId AND branchId=:branchId";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':PQty',$PQty,PDO::PARAM_STR);
		$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query->execute();
		$sql = "update purchaseslist SET Status=:sts WHERE BatchId=:batchNumber AND shopId=:shopId AND branchId=:branchId";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':sts',$sts,PDO::PARAM_STR);
		$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query->execute();
		echo "Product updated";
	}
	else{
		$sts = 1;
		$sql = "INSERT INTO stocktable (Item_code, BatchNumber,InQty,PurPrice,SellPrice,Date,Status, shopId, branchId) 
		VALUES(:productid,:batchNumber,:PQty,:Mprice,:MRP,:date,:sts, :shopId, :branchId)";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':productid',$productid,PDO::PARAM_STR);
		$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
		$query->bindParam(':PQty',$PQty,PDO::PARAM_STR);
		$query->bindParam(':Mprice',$Mprice,PDO::PARAM_STR);
		$query->bindParam(':MRP',$MRP,PDO::PARAM_STR);
		$query->bindParam(':date',$date,PDO::PARAM_STR);
		$query->bindParam(':sts',$sts,PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query->execute();
		$sql = "UPDATE purchaseslist SET Status=:sts WHERE BatchId=:batchNumber AND shopId=:shopId AND branchId=:branchId";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':sts',$sts,PDO::PARAM_STR);
		$query->bindParam(':batchNumber',$batchNumber,PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query->execute();
		echo "Product Newly Inserted";
	}
}

if(isset($_GET['otpsend'])){
	$receiver = $_GET["otpsend"];
	$userid =$_SESSION['forgetuserid'];
	$code = rand(1000,9999);
	$mssg ='PMS, '.$code.' is your password recovery code. Valid for 5 minute';
	$url = "http://gsms.putulhost.com/smsapi";
	$data = [
		"api_key" => "C200114562795a9fbdc4e5.87112767",
		"type" => "text",
		"contacts" => "$receiver",
		"senderid" => "8809601001536",
		"msg" => "$mssg"
	];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	curl_close($ch);
	$milliseconds = floor(microtime(true) * 1000+300000);
	$sql = "INSERT INTO otptable (UserId,Code,time) VALUES(:userid,:code,:milliseconds, :shopId, :branchId) ";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':userid',$userid,PDO::PARAM_STR);
	$query->bindParam(':code',$code,PDO::PARAM_STR);
	$query->bindParam(':milliseconds',$milliseconds,PDO::PARAM_STR);
	$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
	$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
	$query->execute();
	$_SESSION['lastInsertId'] = $dbh->lastInsertId();
}



?>