
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
	
	<title>Dshop - Stock Information</title>
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
									  Monthly Sales Report
									</div>
									<div >
									<a href="<?php echo $value[2]=='stock' ? $links."/purchase/add_purchase.php": $links.'./add_purchase.php' ?>"  class="btn btn-info"> <i class="fas fa-plus mr-2"></i> Add Purchase</a>
										<a href="stockavailable.php" class="btn btn-info"> <i class="fa fa-credit-card" aria-hidden="true"></i> Available Stock</a>
                                        <!-- <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Due</button> -->
                                        
									</div>
								</div>
                            </div>
							<div class="card-body">	
							<?php 
								date_default_timezone_set('Asia/Dhaka');
								$date = date('Y-m-d');
								?>							
								<div class="form-group d-flex row p-2 gap-2 align-items-end">
									<div class="col-lg-2 col-md-6 col-sm-5">
										<div class="">
											<label class="text-bold" for="StartDate">Start Date</label>
											<input type="date" class="form-control p-2" name="startDate" id="startDate" placeholder="Details" value="<?php echo $date?>" tabindex="4">								
										</div>
									</div>
									<div class="col-lg-2 col-md-6 col-sm-5">
										<div class="">
											<label class="text-bold" for="endDate">End Date</label>
											<input type="date" name="endDate" class="form-control p-2 datepicker" id="endDate" placeholder="" value="<?php echo $date?>" tabindex="2" >
										</div>
									</div>	
									<div class="col-lg-2 col-md-6 col-sm-5">
										<div class=""> 
											<label class="text-bold" for="seller_id">Seller ID</label>
											<input type="text" class="form-control p-2 valid_number" name="seller_id" id="seller_id" placeholder="Seller ID" value="" tabindex="3">
										</div>
									</div>
									<div class="col-lg-2 col-md-6 col-sm-5">
										<div class="">
											<label class="text-bold" for="product_id">Product ID</label>
											<input type="text" class="form-control p-2" name="product_id" id="product_id" placeholder="Product ID" value="" tabindex="4">
										</div>
									</div>								
									
								</div>
								<div class="p-2 gap-3">
									<!-- <a href="download-records.php?" style="color:red; font-size:16px;">Download Monthly sells Report</a> -->
									<button onclick='serachFunction()' name='searchButton' type='button' id='searchButton' class='btn btn-success'><i class='fas fa-search mr-2' style='margin-right: 10px;'></i> Search</button>
									<button onclick='InvoicePrint(event)' name='P' type='button' id='printButton' class='btn btn-warning'><i class='fas fa-print mr-2' style='margin-right: 10px;'></i> Print</button>
									<button onclick='InvoicePrint(event)' name='D' type='button' id='downloadButton' class='btn btn-info'><i class='fas fa-download mr-2' style='margin-right: 10px;'></i> Download</button>
								</div>
								<div class="row ">
									<div class="col-12 col-md-12 col-lg-12 col-xl-12 d-flex row flex-sm-column table-responsive" id="customReportDiv">
								
										<table id="zctb" class="display table bg-light table-bordered table-hover" >
											<thead class="bg-style">
												<tr>
													<th>#</th>
													<th>P Name</th>
													<th class="text-center">P ID</th>
													<th class="text-center">B ID</th>
													<th class="text-center">Invoce No</th>
													<th class="text-center">Qty</th>
													<th class="text-center">Price</th>
													<th class="text-center">T Price</th>
													<th class="text-center">Date</th>
													<th class="text-center">Seller</th>
												</tr>
											</thead>
											<tbody>

												<?php 
												date_default_timezone_set('Asia/Dhaka');
												$sellEnddate = date('Y-m-d');													 
												$sellStartDate = date("Y-m")."-01";

												$sql = "SELECT sellingproduct.InvoiceId, sellingproduct.ProductId as PID, sellingproduct.BatchId as BID, sellingproduct.Qty,sellingproduct.Date,sellingproduct.NetPrice as Price, sellingproduct.Price as totalPrice, sellingproduct.shopId, sellingproduct.branchId, medicine_list.medicine_name as Pname, users.UserId as UID, users.Name as Uname FROM sellingproduct JOIN medicine_list ON sellingproduct.ProductId = medicine_list.item_code JOIN users ON users.UserId = sellingproduct.SellerId WHERE sellingproduct.shopId=:shopId  AND sellingproduct.Date BETWEEN :sellStartDate  AND :sellEndDate";
												$query = $dbh -> prepare($sql);
												$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
												$query->bindParam(':sellStartDate',$sellStartDate,PDO::PARAM_STR);
												$query->bindParam(':sellEndDate',$sellEnddate,PDO::PARAM_STR);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												
												$cnt=1;
												$TotalSeals= 0;
												if($query->rowCount() > 0)
												{
												foreach($results as $result)
												{				?>	
												<tr id="row-<?php echo $cnt;?>">
													<td class="text-center"><?php echo htmlentities($cnt);?></td>
													<td >
														<p id="name-<?php echo htmlentities($result->ID);?>" class="form-control"><?php echo htmlentities($result->Pname);?></p>
													</td>
													<td class="text-center">
														<p id="Batch-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->PID;?></p>
													</td>
													<td class="text-end">
														<p id="InQty-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->BID;?></p>
													</td>
													<td class="text-end">
														<p id="OutQty-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->InvoiceId;?></p>
													</td>
													<td class="text-end">
														<p id="RestQty-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->Qty;?></p>
													</td>
													<td class="text-end">
														<p id="Mprice-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->Price;?></p>
													</td>
													<td class="text-end">
														<p id="MRP-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->totalPrice;?></p>
													</td>
													<td class="text-center">
														<p id="MRP-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->Date;?></p>
													</td>
													<td class="text-center">
														<p id="MRP-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->Uname;?></p>
													</td>
												</tr>
												<?php 
												$cnt=$cnt+1; 
												$TotalSeals = $TotalSeals+$result->totalPrice;
												}} ?>
											</tbody>
										</table>
										<div>
											<br/>
											<h2>Total Sell Amount in month:</h2>
											<h1><?php echo $TotalSeals;?></h1>
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
	<!-- Modal -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<!-- <div class="modal-dialog modal-dialog-centered modal-xl"> -->
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody2">
				</div>
			</div>
		</div>
	</div>
	<script>
		const serachFunction = ()=>{
			const startDate =document.getElementById('startDate').value;
			const endDate =document.getElementById('endDate').value;
			const PID = document.getElementById('product_id').value;
			const SID = document.getElementById('seller_id').value;
			const customReportDiv = document.getElementById('customReportDiv');
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {					
				if (this.readyState == 4 && this.status == 200) {
					customReportDiv.innerHTML=this.responseText;
				}
			};
			xmlhttp.open('GET', `./reportquerysales.php?customReport&startDate=${startDate}&endDate=${endDate}&SID=${SID}&PID=${PID}`, true);
			xmlhttp.send();
		}
		const InvoicePrint = (event)=>{
			const startDate =document.getElementById('startDate').value;
			const endDate =document.getElementById('endDate').value;
			const PID = document.getElementById('product_id').value;
			const SID = document.getElementById('seller_id').value;
			const name =event.target.name
			const id =event.target.id
			window.open(`./reportprint.php?customReport&startDate=${startDate}&endDate=${endDate}&SID=${SID}&PID=${PID}&ptype=${name}`, "_blank")
		}
	</script>


	<!-- Loading Scripts -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<script src="../js/sweetalert.js"></script>
		<script src="../js/query.js"></script>
		<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
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