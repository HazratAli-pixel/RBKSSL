<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(isset($_GET['userid']))
		{
        $phone1 = ($_GET['userid']);
        $userid = ($_GET['userid']);
		$sql ="SELECT * FROM users WHERE (Phone1=:phone1 or UserId=:userid)";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':phone1', $phone1, PDO::PARAM_STR);
		$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
		if($query -> rowCount() > 0)
			{
                echo 1;
			}
		else {
			echo 0;	
		}
	}
	if(isset($_GET['ItemId'])){
		$ItemId=$_GET['ItemId'];

		$sql = "SELECT medicine_list.medicine_name, medicine_list.status, stocktable.BatchNumber, stocktable.InQty, stocktable.OutQty, stocktable.PurPrice, 
		stocktable.SellPrice, stocktable.SellBoxPrice,stocktable.Date, stocktable.Status  FROM medicine_list Right JOIN stocktable ON
		medicine_list.item_code = stocktable.Item_code WHERE stocktable.Item_code=:ItemId && stocktable.Status!=0 && stocktable.RestQty!=0";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':ItemId', $ItemId, PDO::PARAM_STR);
		$query-> execute();
		$result = $query -> fetch(PDO::FETCH_OBJ);
	
			if($query -> rowCount() > 0)
			{
				// checked session set or not
                if(isset($_SESSION['items'])){
					$SelectedItems = array_column($_SESSION['items'],'ItemId');
					// checked added item
					if(in_array($_GET['ItemId'],$SelectedItems)){
						// echo 1;
						foreach($_SESSION['items'] as $key => $value){
							if($value['ItemId'] == $_GET['ItemId']){
								$currentQty = $_SESSION['items'][$key]['SellQty'];
								$Instock = $_SESSION['items'][$key]['InStock'];
								if($currentQty >= $Instock){
									echo 1;
								}
								else{
									$currentQty++;						
									$_SESSION['items'][$key]['SellQty'] = $currentQty;
								}
							}
						}
					}
					else if($result->InQty<=$result->OutQty){
						echo 2;
					}
					else{
						$count = count($_SESSION['items']);
						$qty=1;
						$stock = $result->InQty-$result->OutQty;
						$_SESSION['items'][$count] = array('ItemId'=>$ItemId,'ProductName'=>$result->medicine_name, 'SellQty'=>$qty,'Batch'=>$result->BatchNumber,'Exdate'=>$result->Date, 'InQty'=>$result->InQty,
						'OutQty'=>$result->OutQty,'InStock'=>$stock,'Price'=>$result->SellPrice, 'PursingPrice'=>$result->PurPrice,'Mstatus'=>$result->status,'SStatus'=>$result->Status);
					}
					
					
				}
				else if($result->InQty>$result->OutQty){
					$qty=1;
					$stock = $result->InQty-$result->OutQty;
					$_SESSION['items'][0]=array('ItemId'=>$ItemId,'ProductName'=>$result->medicine_name, 'SellQty'=>$qty,'Batch'=>$result->BatchNumber,'Exdate'=>$result->Date, 'InQty'=>$result->InQty,
					'OutQty'=>$result->OutQty,'InStock'=>$stock, 'Price'=>$result->SellPrice, 'PursingPrice'=>$result->PurPrice,'Mstatus'=>$result->status,'SStatus'=>$result->Status);
				}
				else{
					echo 2;
				}				
			}
			else {
				echo 3;
		}
	}
	if(isset($_GET['DataShow'])){
		if(isset($_SESSION['items'])){
			foreach($_SESSION['items'] as $key => $value){
				$Itotal = $value['SellQty']* $value['Price'];
				$Data.="<tr>						
							<td class='text-center'> <p class='form-control'>$value[ProductName]</p>  </td>
							<td class='text-center'> <p class='form-control'>$value[Batch]</p> </td>
							<td class='text-center'>
								<input type='number' class='form-control $value[SellQty] text-center' id='$value[ItemId]' onChange='changeQty(this.id,this.value)' value='$value[SellQty]' min='1' max='120'>
							</td>
							<td class='iprice text-center'>
								<p class='form-control' readonly>$value[Price]</p>  
								<input type='hidden'  id='$value[Price]'  min='1' max='120'>
							</td>
							<td class='itotal text-center'><p class='form-control' readonly>$Itotal</p> </td>
							<td class='text-center'>
								<p class='btn btn-outline-none tprice p-0 me-1' onClick='remove_item(this.id)' id='$value[ItemId]'><i style='color: red;' class='far fa-trash-alt p-0 m-0' aria-hidden='true'></i></p>
								<p class='btn btn-outline-none p-0 m-0' onClick='show_item(this.id)' id='$value[ItemId]'><i style='color: red;' class='far fa-eye p-0 m-0' aria-hidden='true'></i></p>
							</td>
						</tr>";
				}
			echo $Data;
		}
	}
	if(isset($_GET['showinfo'])){
		$value = $_GET['showinfo'];
		$sql = "SELECT medicine_list.medicine_name, medicine_list.status, stocktable.BatchNumber, stocktable.InQty, stocktable.OutQty, stocktable.PurPrice, 
		stocktable.SellPrice, stocktable.SellBoxPrice,stocktable.Date, stocktable.RestQty  FROM medicine_list Right JOIN stocktable ON
		medicine_list.item_code = stocktable.Item_code WHERE stocktable.Item_code=:ItemId AND stocktable.Status=1 AND stocktable.RestQty !=0 ORDER BY stocktable.ID DESC";
		$query = $dbh -> prepare($sql);
		$query-> bindParam(':ItemId', $value, PDO::PARAM_STR);
		$query->execute();
		// $results=$query->fetchAll(PDO::FETCH_OBJ);
		$results=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;
			$Data2="
			<p> <span class='fw-bold'>Name : </span> $results->medicine_name</p>
			<p> <span class='fw-bold'>Product Buy : </span> $results->InQty</p>
			<p> <span class='fw-bold'>Product Sale : </span> $results->OutQty</p>
			<p> <span class='fw-bold'>In Stock : </span> $results->RestQty</p>
			<p> <span class='fw-bold'>Pursing Price : </span> $results->PurPrice</p>";
			echo $Data2;

	}


	if(isset($_GET['RemoveItem'])){
		if(isset($_SESSION['items'])){
			foreach($_SESSION['items'] as $key => $value){
				if($value['ItemId'] == $_GET['RemoveItem']){
					unset ($_SESSION['items'][$key]);
					$_SESSION['items']= array_values($_SESSION['items']);
					echo 5;
				}
			}
		}
	}
	if(isset($_GET['UpItem'])){
		if(isset($_SESSION['items'])){
			foreach($_SESSION['items'] as $key => $value){
				if($value['ItemId'] == $_GET['UpItem']){
					$currentQty = $_SESSION['items'][$key]['SellQty'];
					$_SESSION['items'][$key]['SellQty'] = $_GET['itemvalue'];
				}
			}
		}
	}


	if(isset($_GET['ClearCard'])){
		if(isset($_SESSION['items'])){
			unset ($_SESSION['items']);	
		}
	}


	if(isset($_GET['ordersubmit'])){
		if(isset($_SESSION['items'])){

			$userid = $_SESSION['alogin'];
			
			//$customerid =rand(50,500000);      //$_GET['customerid'];
			if($_SESSION['C_ID']!=0){
				$customerid =$_SESSION['C_ID'];
			}
			else {
				$customerid =$_GET['customerid'];
			}
			
			$msgstatus = $_GET['msgstatus'];
			$totaldiscount = $_GET['totaldiscount'];
			$grandtotal = $_GET['grandtotal'];
			$paidamount = $_GET['paidamount'];
			$due = $_GET['due'];
			$PreDue = $_GET['predue'];

			$vat = $_GET['vat'];

			$sql="INSERT INTO invoice (CustomerID, SellerID, NetPayment, PreDue, discount, Tax, PaidAmount, DueAmount) 
			VALUES(:customerid,:userid,:grandtotal,:predue,:totaldiscount,:vat,:paidamount,:due)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':customerid',$customerid,PDO::PARAM_STR);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			$query->bindParam(':grandtotal',$grandtotal,PDO::PARAM_STR);
			$query->bindParam(':predue',$PreDue,PDO::PARAM_STR);
			$query->bindParam(':totaldiscount',$totaldiscount,PDO::PARAM_STR);
			$query->bindParam(':vat',$vat,PDO::PARAM_STR);
			$query->bindParam(':paidamount',$paidamount,PDO::PARAM_STR);			
			$query->bindParam(':due',$due,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			
			$i= count($_SESSION['items']);
			$sql2="INSERT INTO sellingproduct(InvoiceId, ProductId, BatchId, Qty, Price, NetPrice,SellerId) 
			VALUES(:lastInsertId,:ItemId,:Batch,:SellQty,:Price,:PursingPrice,:userid)";
			
			// $sql3="Update stocktable set SellQty=:SellQty where BatchNumber=:Batch";
			for($count = 0; $count<$i; $count++)
			{
				$T_price = $_SESSION['items'][$count]['SellQty']*$_SESSION['items'][$count]['Price'];
				$data = array(
				':lastInsertId'	=>	$lastInsertId,
				':ItemId'	=>	$_SESSION['items'][$count]['ItemId'],
				':Batch'	=>	$_SESSION['items'][$count]['Batch'],
				':SellQty'	=>	$_SESSION['items'][$count]['SellQty'],
				':Price'	=>	$T_price,
				':PursingPrice'	=>	$_SESSION['items'][$count]['Price'],
				':userid'	=>	$_SESSION['alogin']			
				); 
				$statement = $dbh->prepare($sql2);
				$statement->execute($data);
				
			}
			date_default_timezone_set('Asia/Dhaka');
			$date = date('d/m/Y H:i');
			$grandtotal= $grandtotal+$PreDue;
			$mssg = "Payment Successful. Amount: ".$grandtotal." Paid: ".$paidamount." TrxID: ".$lastInsertId." Due amount : ".$due."tk ".$date.". Raha Phamacy";

			if($msgstatus==1){
				$number = $_SESSION['cusPhone'];
				$url = "http://gsms.putulhost.com/smsapi";
				$data = [
				"api_key" => "C200114562795a9fbdc4e5.87112767",
				"type" => "text",
				"contacts" => "$number",
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
			}
			unset ($_SESSION['items']);
			unset ($_SESSION['C_ID']);
		}
		else {
				
			}
	}
	if(isset($_GET['edit_unit'])){
		$str = $_GET['edit_unit'];
		$value =explode("-",$str);
		$Rout = $value[0];
		$ID = $value[1];
		if($Rout == 'unit'){
			$sql = "SELECT * from medicine_unit WHERE ID=:id";;
			$query = $dbh -> prepare($sql);
			$query->bindParam(':id',$ID,PDO::PARAM_STR);
			$query->execute();
			$result=$query->fetch(PDO::FETCH_OBJ);
			$name = $result->MedicineUnit;
			$inqty = $result->Status;
			$title="Medicine Unit";
			$label="Unit Name: ";
		}

		else if($Rout == 'type'){
			$sql = "SELECT * from medicine_type WHERE ID=:id";;
			$query = $dbh -> prepare($sql);
			$query->bindParam(':id',$ID,PDO::PARAM_STR);
			$query->execute();
			$result=$query->fetch(PDO::FETCH_OBJ);
			$name = $result->MedicineType;
			$inqty = $result->Status;
			$title="Medicine Type";
			$label="Type Name: ";
		}
		else if($Rout == 'category'){
			$sql = "SELECT * from medicine_category WHERE ID=:id";;
			$query = $dbh -> prepare($sql);
			$query->bindParam(':id',$ID,PDO::PARAM_STR);
			$query->execute();
			$result=$query->fetch(PDO::FETCH_OBJ);
			$name = $result->MedicineCategory;
			$inqty = $result->Status;
			$title="Medicine Category";
			$label="Category Name: ";
		}

		if($result->Status==1){
			$Data2="<form method='post' class='row' onsubmit='return' >
			<div class='col-md-12'>
				<div class='row mb-3'>
					<label class='col-sm-4 col-form-label text-start text-sm-end'>$label</label>
					<div class='col-sm-5'>
					<input type='text' class='form-control' name='category' value='$name'>
					<input type='hidden' name='id' value='$ID'>
					</div>
				</div>
			</div>
														
			<div class='col-md-12'>
				<div class='row mb-3'>
					<label class='col-sm-4 col-form-label text-start text-sm-end'>Status :</label>
					<div class='col-sm-8 d-flex align-items-center'>
						
						<div class='form-check form-check-inline'>
							<input class='form-check-input' checked type='radio' value='$inqty ' name='radio_value' id='inlineRadio1' value='option1'>
							<label class='form-check-label' for='inlineRadio1'>Active</label>
						</div>
						<div class='form-check form-check-inline'>
							<input class='form-check-input' type='radio' value='0' name='radio_value' id='inlineRadio2'>
							<label class='form-check-label' for='inlineRadio2'>Inactive</label>
						</div>
					</div>
				</div>
			</div>											
	
			<div class='hr-dashed'></div>
	
				<div class='col-md-6'>
					<div class='d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end'>
						<button style='min-width: 150px;' class='btn btn-success' type='submit' name='update' >Update</button>
					</div>
			</div>						
		</form>";
		}else{
			$Data2="<form method='post' class='row' onsubmit='return' >
			<div class='col-md-12'>
				<div class='row mb-3'>
					<label class='col-sm-4 col-form-label text-start text-sm-end'>$label : </label>
					<div class='col-sm-5'>
					<input type='text' class='form-control' name='category' value='$name'>
					<input type='hidden' name='id' value='$ID'>
					</div>
				</div>
			</div>
														
			<div class='col-md-12'>
				<div class='row mb-3'>
					<label class='col-sm-4 col-form-label text-start text-sm-end'>Status :</label>
					<div class='col-sm-8 d-flex align-items-center'>
						<div class='form-check form-check-inline'>
							<input class='form-check-input'  type='radio' value='1' name='radio_value' id='inlineRadio1' value='option1'>
							<label class='form-check-label' for='inlineRadio1'>Active</label>
						</div>
						<div class='form-check form-check-inline'>
							<input class='form-check-input' checked type='radio' value='$inqty ' name='radio_value' id='inlineRadio2'>
							<label class='form-check-label' for='inlineRadio2'>Inactive</label>
						</div>
					</div>
				</div>
			</div>											
	
			<div class='hr-dashed'></div>
	
				<div class='col-md-6'>
					<div class='d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end'>
						<button style='min-width: 150px;' class='btn btn-success' type='submit' name='update' >Update</button>
					</div>
			</div>						
		</form>";
		}
		echo $Data2;

	}
	if(isset($_GET['CustomerID'])){
		$str = $_GET['CustomerID'];
		$value =explode("-",$str);
		$sql = "SELECT * from customertable WHERE (Name=:name AND Phone=:phone AND Address=:address) OR (Name=:name2 AND Phone=:phone2) 
		OR (Name=:name3 AND Address=:address3)";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':name',$phone[0],PDO::PARAM_STR);
		$query->bindParam(':phone',$value[1],PDO::PARAM_STR);
		$query->bindParam(':address',$value[2],PDO::PARAM_STR);
		$query->bindParam(':name2',$phone[0],PDO::PARAM_STR);
		$query->bindParam(':phone2',$value[1],PDO::PARAM_STR);
		$query->bindParam(':name3',$phone[0],PDO::PARAM_STR);
		$query->bindParam(':address3',$value[2],PDO::PARAM_STR);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		//$inqty = $result->Status;
		// if($result->Status==1){
		$Data4="$result->ID";
		// }else{
		// 	$Data2="";
		// }
		
		echo $Data4;
	}
	if(isset($_GET['DueAmount'])){
		$str = $_GET['DueAmount'];
		$value =explode("-",$str);
		$ID = $value[0];
		$_SESSION['C_ID'] = $value[0];
		$sql = "SELECT customerledger.NewDue, customertable.Phone from customerledger LEFT JOIN customertable ON 
		customerledger.CustomerID=customertable.ID WHERE customerledger.CustomerID=:id ORDER BY customerledger.ID DESC limit 1";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':id',$ID,PDO::PARAM_STR);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$_SESSION['cusPhone']= $result->Phone;
		$Data4="$result->NewDue";
		echo $Data4;

	}
	if(isset($_GET['invodetails'])){
		$invoId = $_GET['invodetails'];
		$sql = "SELECT sellingproduct.BatchId,sellingproduct.Qty,sellingproduct.Price,sellingproduct.NetPrice, medicine_list.medicine_name from 
		sellingproduct left join  medicine_list ON sellingproduct.ProductId = medicine_list.item_code WHERE InvoiceId=:id";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':id',$invoId,PDO::PARAM_STR);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{ $cnt=1;
			foreach($results as $result){
				$Data.="<tr>						
					<td class='text-center'>$cnt</td>
					<td class='text-center'>$result->medicine_name</td>
					<td class='text-center'>$result->BatchId</td>
					<td class='text-center'>$result->Qty</td>
					<td class='text-center'>$result->NetPrice</td>
					<td class='text-center'>$result->Price</td>
				</tr>";
				$cnt++;
			}
		}
		echo $Data;
	}
	
	if(isset($_GET['medicineName'])){
		$medicineName = $_GET['medicineName'];
		$value =explode("-",$medicineName);
		$medicineName = $value[0];
		$strength = $value[1];

		$manufacturer_id = $_GET['manufacturer_id'];

		$pattern = '%'.$medicineName.'%';
		$pattern2 = '%'.$strength.'%';
		$manufacturer_id = '%'.$manufacturer_id.'%';
		$sql = "SELECT * from  medicine_list WHERE medicine_name like :pattern and menufacturer like  :manufacturer_id";
		$query = $dbh -> prepare($sql);
		// $query->bindParam(':pattern',$pattern,PDO::PARAM_STR);
		// $stmt->execute(['limit' => $limit, 'offset' => $offset]); 
		$query->execute([':pattern' => $pattern,':manufacturer_id' => $manufacturer_id]);
		// $query->execute([':pattern' => $pattern, ':pattern2' => $pattern2,':manufacturer_id' => $manufacturer_id]);
		// $query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{ $cnt=1;
			foreach($results as $result){
				$Data.='
				<option value="'.$result->medicine_name.'-'.$result->strength.'"></option>
				<option hidden name="product_id[]" value="'.$result->item_code.'"></option>
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


