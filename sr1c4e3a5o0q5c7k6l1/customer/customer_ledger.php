
<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
	include_once('../includes/address.php');	
	header('location:index.php');
	}
else{
	if(isset($_REQUEST['del']))
	{
		$did=intval($_GET['del']);
		$sql = "delete from medicine_list WHERE item_code=:did AND shopId=:shopId AND branchId=:branchId";
		$query = $dbh->prepare($sql);
		$query->bindParam(':did',$did, PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query -> execute();
		$msg="Record deleted Successfully";
        header("refresh:3;medicine_list.php");
	}
	if(isset($_POST['submit']))
	{
			
			$c_name=$_POST['c_name'];
			$c_phone=$_POST['c_phone'];
			$c_address=$_POST['c_address'];
			$status=$_POST['radio_value'];
			
			$sql="INSERT INTO customertable (Name, Phone,Address,Status,shopId,branchId) 
			VALUES(:c_name,:c_phone,:c_address,:radio_value,:shopId,:branchId)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':c_name',$c_name,PDO::PARAM_STR);
			$query->bindParam(':c_phone',$c_phone,PDO::PARAM_STR);
			$query->bindParam(':c_address',$c_address,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
			$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
			$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			
		}
	if(isset($_POST['paydue']))
	{
		
		$cusId=$_POST['cusID2'];
		$cusName=$_POST['cusName2'];
		$preDue=$_POST['preDue'];
		$newDue=$_POST['newDue'];
		$paidAmount=$_POST['paidAmount'];
		$comments=$_POST['comments'];
		$switch=$_POST['switch'];
		$cusPhone2=$_POST['cusPhone2'];
		$userid = $_SESSION['alogin'];
		$sql="INSERT INTO customerledger (AdminID,CustomerID,PreDue,Credit,Comments,shopId,branchId) 
		VALUES(:userid,:cusId,:preDue,:paidAmount,:comments,:shopId,:branchId)";

		$query = $dbh->prepare($sql);
		$query->bindParam(':userid',$userid,PDO::PARAM_STR);
		$query->bindParam(':cusId',$cusId,PDO::PARAM_STR);
		$query->bindParam(':preDue',$preDue,PDO::PARAM_STR);
		$query->bindParam(':paidAmount',$paidAmount,PDO::PARAM_STR);
		$query->bindParam(':comments',$comments,PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		date_default_timezone_set('Asia/Dhaka');
		$date = date('d/m/Y H:i');
		
		// $mssg = "Money recived. Amount tk:".urlencode($paidAmount)." TrxID: ".urlencode($lastInsertId)." Due amount : ".urlencode($newDue)."tk ".date('y/m/d')."-".date("h:i:s A").". Raha Phamacy";
		$mssg = "Money recived. Amount tk:".$paidAmount." TrxID: ".$lastInsertId." Due amount : ".$newDue."tk ".$date.". Raha Phamacy";

		if($switch==1){
			// $mssg = $_POST["message"];
			$url = "http://gsms.putulhost.com/smsapi";
			$data = [
			"api_key" => "C200114562795a9fbdc4e5.87112767",
			"type" => "text",
			"contacts" => "$cusPhone2",
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
		//return $response;
		echo "<script>window.location.href='customer_ledger.php'</script>";
		}
	}

 ?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>PMS-Customer Ledger  </title>
	<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://kit.fontawesome.com/b6e439dc17.js" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
	</style>

</head>
<body>
	<?php include('../includes/header.php');?>
	<div class="ts-main-content">
		<?php include('../includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						
						<!-- Zero Configuration Table -->
						<div class="card">
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Customer legder Information
									</div>
									<div >
										<a href="customer_list.php" class="btn btn-info"> <i class="fas fa-align-justify mr-2"></i> Customer List</a>
                                        <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Due</button>
									</div>
								</div>
                            </div>
							<div class="card-body">
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Customer list</a>
								<div class="row">
									<div class="col-12 col-md-8 col-lg-8 col-xl-9 d-flex row flex-sm-column table-responsive">
										<table  id="zctb" class="display table table-striped table-bordered table-hover" >
											<thead class="bg-style">
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>Address</th>
													<th>Mobile</th>
													<!-- <th>Total Debit</th> -->
													<!-- <th>Total Credit</th> -->
													<th class="text-end">Total Due</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>

												<?php 
												// $sql = "SELECT customertable.ID customertable.Name, customertable.Phone, customertable.Address, SUM(customerledger.Total) AS total, SUM(customerledger.Debit) AS total_debit, 
												// SUM(customerledger.NewDue) AS total_due FROM customertable INNER JOIN customerledger ON customertable.ID =customerledger.CustomerID where customertable.Status= 1	
												// GROUP BY customerledger.CustomerID";
												$sql = "SELECT customertable.ID, customertable.Name, customertable.Phone, customertable.Address, SUM(customerledger.Total) AS total, SUM(customerledger.Debit) AS total_debit, 
												SUM(customerledger.NewDue) AS total_due FROM customertable INNER JOIN customerledger ON customertable.ID =customerledger.CustomerID where customertable.Status= 1 AND customertable.shopId=:shopId AND customertable.branchId=:branchId GROUP BY customerledger.CustomerID ORDER BY customertable.Name";
												$query = $dbh -> prepare($sql);
												$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
												$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
												$totaldueamount=0;
												foreach($results as $result)
												{				?>	
												<tr id="cusid-<?php echo htmlentities($result->ID);?>">
													<td><?php echo htmlentities($cnt);?></td>
													<td id="cusname-<?php echo htmlentities($result->ID);?>" ><?php echo htmlentities($result->Name);?></td>
													<td id="cusadd-<?php echo htmlentities($result->ID);?>" ><?php echo htmlentities($result->Address);?></td>
													<td id="cusphone-<?php echo htmlentities($result->ID);?>" ><?php echo htmlentities($result->Phone);?></td>
													<?php 
													$sql2 = "SELECT * from customerledger WHERE CustomerID=:id ORDER BY ID DESC limit 1"; 
													$query = $dbh -> prepare($sql2);
													$query->bindParam(':id',$result->ID,PDO::PARAM_STR);
													$query->execute();
													$result2=$query->fetch(PDO::FETCH_OBJ);
													?>
													<td class="text-end" id="cusdue-<?php echo htmlentities($result->ID);?>" ><?php echo $result2->NewDue;?></td>
													<?php $totaldueamount+= $result2->NewDue; ?>
													<td class="text-center">
													<a href="custldinfo.php?custId=<?php echo htmlentities($result->ID);?>" title="<?php echo htmlentities($result->Name);?>" class="text-success mx-1" id="ledger-<?php echo htmlentities($result->ID);?>" onclick="paydues(event)"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
													<a class="mx-1" href="#" > <i class="fas fa-eye" aria-hidden="true"></i></a> 
													<p class="bg-warning btn p-1" onclick="paydues(this.id)" id="<?php echo htmlentities($result->ID);?>"> pay</p>
													</td>
												</tr>
												<?php $cnt=$cnt+1; }} ?>
											</tbody>
											<tfoot>
												<tr>
													<td class="text-end text-lg bg-black text-white fw-bold" colspan="4">Total Due</td>
													<td class="text-end text-lg bg-black text-white fw-bold"> <?php echo $totaldueamount ?></td>
												</tr>
											</tfoot>
										</table>
									</div>
									<div style="top:80px;" class="col-12 col-md-4 col-lg-4 col-xl-3 bg-info rounded p-2 h-75 position-sticky">
										<form action="" method="POST">
											<div class="info text-center pt-2">
												<h4 name="cusName" id="cusName">Name </h4>
												<input hidden name="cusName2" id="cusName2" type="text" class="form-control text-end">
												<h4 hidden name="cusID" id="cusId">ID: </h4>
												<input hidden name="cusID2" id="cusId2" type="text" class="form-control text-end">
												<h4 id="cusPhone">Phone </h4>
											</div>
											<!-- <div class="calculation">
												<div class="div">
													<label for="">Previous Due: </label>
													<input class="form-control" type="float" value="">
												</div>
											</div> -->
											
											<div class="col-12 d-flex flex-column justify-content-end pb-5 pt-2">
												<hr>
													<div class="row mb-2">
														<label  for="" class="fw-bold col-6 text-end">Privious Due : </label>
														<div class="col-6">
															<input id="preDue" name="preDue" type="text" class="form-control text-end" value="" placeholder="0.00" readonly>
														</div>
													</div>
													<div class="row mb-2">
														<label for="" class="fw-bold col-6 text-end">Paid Amount : </label>
														<div class="col-6">
															<input onkeyup="calculation()" id="paidAmount" name="paidAmount" type="number" class="form-control text-end" placeholder="0.00">
														</div>
													</div>
													<hr>
													<div class="row mb-2">
														<label for="" class="fw-bold col-6 text-end">New Due : </label>
														<div class="col-6">
															<input name="newDue" type="float" id="newDue" class="form-control text-end" value="" placeholder="0.00" readonly>
														</div>
													</div>
													<br><br>
													<div class="row mb-2">
														<label for="" class="fw-bold col-6 text-end">Comments : </label>
														<div class="col-6">
															<textarea name="comments" rows="3" id="" type="text" class="form-control" name="" value="" placeholder="Comments"></textarea>
														</div>
													</div>
													<div class="row mb-2">
														<div class="col-6 msg-btn d-flex justify-content-end">
															<div class="form-check form-switch text-end">
																<input class="form-check-input" value="1" type="checkbox" name="switch" id="flexSwitchCheckDefault">
																<label class="form-check-label" for="flexSwitchCheckDefault">Want messgae?</label>
															</div>
														</div>
														<div class="col-6">
															<input type="text" name="cusPhone2" id="cusPhone2" class="form-control"  value="" placeholder="Phone Number">
														</div>
													</div>
													<!-- <div class="row mb-2 justify-content-end">
														<div class="col-6 my-3">
															<p id="fullPaid" onclick="fullpaid()" class="form-control btn btn-warning" >Full Paid</p>
														</div>
														<div class="col-6 my-3">
															<button type="submit" class="form-control btn btn-success" name="paydue">submit</button>
														</div>
													</div> -->
												</div>
												<div class="row mb-2 justify-content-end">
														<div class="col-6 my-3">
															<p id="fullPaid" onclick="fullpaid()" class="form-control btn btn-warning" >Full Paid</p>
														</div>
														<div class="col-6 my-3">
															<button type="submit" class="form-control btn btn-success" name="paydue">submit</button>
														</div>
													</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<!-- <div class="modal-dialog modal-dialog-centered modal-xl"> -->
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Customer Information</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody2">
					<div class="card-body">
						<form method="post" class="row">
						<div class="">
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Name : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="c_name" placeholder="customer name">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Phone : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="c_phone" placeholder="phone number">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Address : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="c_address" placeholder="address">
								</div>
							</div>
							
						</div>																
						<div class="">
							<div class="row mb-3">
								<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Status :</label>
								<div class="col-sm-8 d-flex align-items-center">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="1" name="radio_value" id="inlineRadio1" value="option1">
										<label class="form-check-label" for="inlineRadio1">Active</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="0" name="radio_value" id="inlineRadio2" value="option2">
										<label class="form-check-label" for="inlineRadio2">Inactive</label>
									</div>
								</div>
							</div>
						</div>
						<div class="hr-dashed"></div>
						<div class="col-md-12">
							<div class="d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
								<button style="min-width: 150px;" class="btn btn-danger me-md-2" type="reset">Reset</button>
								<button style="min-width: 150px;" class="btn btn-success" onclick="customer_add()" name="submit" >Submit</button>
							</div>
						</div>					
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function paydues(clicked_id) {
			var name ="cusname-"+clicked_id;
			var phone ="cusphone-"+clicked_id;
			var due ="cusdue-"+clicked_id;
			// var address ="cusname-"+clicked_id;
			// alert(nameID);
			var names =  document.getElementById(name).innerText;
			var due =  document.getElementById(due).innerText;
			var phone =  document.getElementById(phone).innerText;

			// var names =  document.getElementById(name).innerText;
			var cusname = document.getElementById('cusName');
			var cusname2 = document.getElementById('cusName2');
			var cusid = document.getElementById('cusId');
			var cusid2 = document.getElementById('cusId2');
			var cusPhone = document.getElementById('cusPhone');
			var cusPhone2 = document.getElementById('cusPhone2');
			var preDue = document.getElementById('preDue');
			cusname.innerHTML = names;
			cusname2.value = names;
			cusPhone.innerHTML = phone;
			cusPhone2.value = phone;
			cusid.innerHTML = clicked_id;
			cusid2.value = clicked_id;
			preDue.value = due;
		}
		function calculation() {
			var paidAmount =  document.getElementById('paidAmount').value;
			var preDue =  document.getElementById('preDue').value;
			var newDue =  document.getElementById('newDue');
			var newDues = preDue - paidAmount;
			newDue.value = newDues.toFixed(2);
		}
		function fullpaid() {
			var paidAmount =  document.getElementById('paidAmount');
			var preDue =  document.getElementById('preDue').value;
			var newDue =  document.getElementById('newDue');
			// var newDues = preDue - paidAmount;
			paidAmount.value = preDue;
			newDue.value = "0.00";
		}
	</script>

	<!-- Loading Scripts -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap-select.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
		<script src="../js/Chart.min.js"></script>
		<script src="../js/fileinput.js"></script>
		<script src="../js/chartData.js"></script>
		<script src="../js/main.js"></script>
    
</body>
</html>

<?php } ?>