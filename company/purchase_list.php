
<?php
session_start();
error_reporting(0);
include('../includes/config.php');
	$url= $_SERVER['REQUEST_URI'];
	$hosts= $_SERVER['[HTTP_HOST] '];
	$value =explode("/",$url);
	$tesst = $value[2];
	$tesst3 = $value[3];
	$links= $hosts."/".$value[1];

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
		$query-> bindParam(':did',$did, PDO::PARAM_STR);
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
	
	<title>PMS-Purchase invoice List </title>
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
										Purchase Invoice Information
									</div>
									<div >
										<a href=<?php echo $links."/purchase/add_purchase.php"; ?> class="btn btn-info"> <i class="fas fa-align-justify mr-2"></i> Add Purchase List</a>
										<a href="#" class="btn btn-info"> <i class="fa fa-credit-card" aria-hidden="true"></i> Pay Dues</a>
                                        <!-- <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Due</button> -->
                                        
									</div>
								</div>
                            </div>
							<div class="card-body">
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Purchase list</a>
								<div class="row ">
									<div class="col-12 col-md-8 col-lg-8 col-xl-9 d-flex row flex-sm-column table-responsive">
								
										<table id="zctb" class="display table table-striped table-bordered table-hover" >
											<thead class="bg-style">
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>SR</th>
													<!-- <th class="text-center">Invoie</th> -->
													<th class="text-end">Subtotal</th>
													<th class="text-end">Vat</th>
													<th class="text-end">Discount</th>
													<th class="text-end">G_total</th>
													<th class="text-end">Paid</th>
													<th class="text-end">Due</th>
													<th class="text-center">Date</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>

												<?php 
												$sql = "SELECT company.name as cname, companyinvoice.ID, companyinvoice.InvoiceId , companyinvoice.Subtotal, companyinvoice.Vat, companyinvoice.Discount, companyinvoice.G_total,companyinvoice.Paid,companyinvoice.DueAmount,
												companyinvoice.Date,companyinvoice.Status FROM companyinvoice left JOIN company 
												ON company.ID = companyinvoice.CompanyId ORDER BY companyinvoice.ID DESC";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
												foreach($results as $result)
												{				?>	
												<tr id="invoice-<?php echo htmlentities($result->InvoiceId);?>">
													<td><?php echo htmlentities($cnt);?></td>
													<td id="name-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo htmlentities($result->cname);?>
														<p hidden><?php echo htmlentities($result->InvoiceId);?></p>
													</td>
													<td id="cusadd-<?php echo htmlentities($result->InvoiceId);?>" >SR</td>
													<td class="text-end" id="subtotal-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo $result->Subtotal;?></td>
													<td class="text-end" id="vat-<?php echo htmlentities($result->InvoiceId);?>" > <?php 
													$vat = ($result->Subtotal*$result->Vat)/100;
													echo $vat
													?></td>
													<td class="text-end" id="discount-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo $result->Discount;?></td>
													<td class="text-end" id="gtotal-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo $result->G_total;?></td>
													<td class="text-end" id="paid-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo $result->Paid;?></td>
													<td class="text-center" id="due-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo $result->DueAmount;?></td>
													<td class="text-center" id="date-<?php echo htmlentities($result->InvoiceId);?>" ><?php echo $result->Date;?></td>
													
													<td class="text-center">
													<!-- <a href="custldinfo.php?custId=<?php echo htmlentities($result->InvoiceId);?>" title="<?php echo htmlentities($result->Name);?>" class="text-success mx-1" id="ledger-<?php echo htmlentities($result->InvoiceId);?>" onclick="paydues(event)"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
													<a class="mx-1" href="#" > <i class="fas fa-eye" aria-hidden="true"></i></a>  -->
													<p class="bg-warning btn p-1" onclick="invodetails(this.id)" id="<?php echo htmlentities($result->InvoiceId);?>">Info</p>
													</td>
												</tr>
												<?php $cnt=$cnt+1; }} ?>
											</tbody>
										</table>
									</div>
									<div class="col-12 col-md-4 col-lg-4 col-xl-3 right-side rounded p-2 h-75">
											<div class="info text-center pt-2">
												<h4 >Indivisual Invoice Details </h4>
												<h4 name="cusName" id="cusName">Name</h4>
												<div class="d-flex justify-content-center">
													<p id="date">D: </p>
													<p id="invoids" class="ps-3"> Invoice ID</p>
												</div>
												
											</div>
											<hr>
											
											<div class="col-12 d-flex flex-column justify-content-end">
												<table class="display table table-striped table-bordered border border-dark table-hover">
													<thead class="bg-style">
														<tr>
															<th>SN</th>
															<th>Name</th>
															<th>Batch</th>
															<th>Qty</th>
															<th>Price</th>
															<th>Sell</th>
														</tr>
													</thead>
													<tbody id="invoice_details">
														<!-- show invoice information here using ajax-->
													</tbody>
													<tfoot>
														<tr>
															<td class="text-end" colspan="5">Total</td>
															<td id="invo1" class="text-end" >0.00</td>
														</tr>
														<tr>
															<td class="text-end" colspan="5">Vat</td>
															<td id="invo2" class="text-end" >0.00</td>
														</tr>
														<tr>
															<td class="text-end" colspan="5">Discount</td>
															<td id="invo3" class="text-end" >0.00</td>
														</tr>
														<tr>
															<td class="text-end" colspan="5">Grand Total</td>
															<td id="invo4" class="text-end" >0.00</td>
														</tr>
														<tr>
															<td class="text-end" colspan="5">Paid Amount</td>
															<td id="invo5" class="text-end" >0.00</td>
														</tr>
														<tr>
															<td class="text-end bg-info" colspan="5">Due Amount</td>
															<td id="invo6" class="text-end" >0.00</td>
														</tr>
													</tfoot>
												</table>
											</div>
												
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<script>
		function invodetails(clicked_id) {
			let cusname1 =  document.getElementById("name-"+clicked_id).innerText;
			let subtotal =  document.getElementById("subtotal-"+clicked_id).innerText;
			let vat =  document.getElementById("vat-"+clicked_id).innerText;
			let discount =  document.getElementById("discount-"+clicked_id).innerText;
			let gtotal =  document.getElementById("gtotal-"+clicked_id).innerText;
			let paid =  document.getElementById("paid-"+clicked_id).innerText;
			let due =  document.getElementById("due-"+clicked_id).innerText;
			let date =  document.getElementById("date-"+clicked_id).innerText;
			// alert(cusname1);
			
			let companyName = document.getElementById('cusName');
			let date2 = document.getElementById('date');
			let invoids = document.getElementById('invoids');
			document.getElementById('invo1').innerHTML=subtotal;
			document.getElementById('invo2').innerHTML=vat;
			document.getElementById('invo3').innerHTML=discount;
			document.getElementById('invo4').innerHTML=gtotal;
			document.getElementById('invo5').innerHTML=paid;
			document.getElementById('invo6').innerHTML=due;
			companyName.innerHTML = cusname1;
			date2.innerHTML = date;
			invoids.innerHTML = "Invoice : "+clicked_id;
			var tbody = document.getElementById('invoice_details');
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
						// alert("Ok 2");
						tbody.innerHTML = this.responseText;
						// $('#exampleModal3').modal('show');
				}
			};
			xmlhttp.open('GET', `query2.php?invodetails=${clicked_id}`, true);
			xmlhttp.send();
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