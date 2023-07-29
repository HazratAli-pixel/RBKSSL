<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
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
	
	<title>PMS | Admin Dashboard</title>
	<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://kit.fontawesome.com/b6e439dc17.js" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	
	
	<style>
		.panel{
			border-radius: 10px;
		}
	</style>

</head>

<body>
		<?php include('includes/header.php');?>
		<div class="ts-main-content">
		<?php 
		include('includes/leftbar.php');
		date_default_timezone_set('Asia/Dhaka');
		$date = date('Y-m-d');
		
		?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="col-12 text-center">
						<h2 class="page-title">Dashboard</h2>
					</div>	
					<div class="row">
						<div class="col-12">
							<?php 
							if($_SESSION['user']['position']== 'Admin' || $_SESSION['user']['position']== 'Sales' || $_SESSION['user']['position']== 'Cashier') { 
								?>
							<div class="row">
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
									<?php
										$sql ="SELECT id from customertable where shopId=:shopId";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$query=$query->rowCount();
									?>
									<div class="card text-center rounded-3">
										<div class="card-header bg-style2">
										<h5 class="fw-bold">Total Listed Customer</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
												<h1 class=""><?php echo $query ?></h1>
												<p class="ms-2">Person</p>
											</div>
											<a href="<?php echo $BaseUrl;?>/customer/customer_list.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
												<?php 
													$sql ="SELECT id from  medicine_list where shopId=:shopId";;
													$query = $dbh -> prepare($sql);
													$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$query=$query->rowCount();
												?>
									<div class="card text-center">
										<div class="card-header bg-style2">
										<h5 class="fw-bold">Total Listed Products</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
												<h1 class=""><?php echo $query ?></h1>
												<p class="ms-2">items</p>
											</div>											
											<a href="<?php echo $BaseUrl;?>/products/products_list.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
												<?php
													$sql ="SELECT emi_table.ID, emi_table.loanID, emi_table.EMI_SL, emi_table.Date, emi_table.Status as emitablestatus, emi_table.Day, emi_table.Balance,emi_table.EMI, emi_table.R_balance, loan_table.ID as loantableid, loan_table.EMItype, customertable.Name,customertable.Phone, customertable.Address FROM emi_table RIGHT JOIN loan_table ON loan_table.ID = emi_table.loanID JOIN customertable ON loan_table.CustomerID = customertable.ID WHERE emi_table.Status = 0 AND emi_table.Date=:date AND  emi_table.shopId=:shopId";
													$query = $dbh -> prepare($sql);;
													$query->bindParam(':date',$date,PDO::PARAM_STR);
													$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
													$query->execute();
													$query=$query->rowCount();
												?>
									<div class="card text-center">
										<div class="card-header bg-style2">
										<h5 class="fw-bold">Todays EMI list</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
												<h1 class=""><?php echo $query ?></h1>
												<p class="ms-2">items</p>
											</div>
											
											<a href="<?php echo $BaseUrl;?>/emi/todaysemi.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
												<?php 
												date_default_timezone_set('Asia/Dhaka');
												$date = date('Y-m-d');
												$sql ="SELECT emi_table.ID, emi_table.loanID, emi_table.EMI_SL, emi_table.Date, emi_table.Status as emitablestatus, emi_table.Day, 
												emi_table.Balance,emi_table.EMI, emi_table.R_balance, loan_table.ID as loantableid, loan_table.EMItype, customertable.Name,customertable.Phone,
												customertable.Address FROM emi_table RIGHT JOIN loan_table ON loan_table.ID = emi_table.loanID JOIN customertable ON 
												loan_table.CustomerID = customertable.ID WHERE emi_table.Status = 0 AND emi_table.Date<:date AND emi_table.shopId=:shopId";
												$query = $dbh -> prepare($sql);;
												$query->bindParam(':date',$date,PDO::PARAM_STR);
												$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
												$query->execute();
												$query=$query->rowCount();
												?>
									<div class="card text-center">
										<div class="card-header bg-style2">
										<h5 class="fw-bold">Due EMI list</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
												<h1 class=""><?php echo $query ?></h1>
												<p class="ms-2">items</p>
											</div>
											
											<a href="<?php echo $BaseUrl;?>/emi/emiduelist.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="row mt-3">
								<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-2">
									<div class="panel panel-default">
										<div class="panel-body bk-white text-black">
											<div class="stat-panel text-center" style="padding-left: 15px;">
											<?php 
												$sql6 ="SELECT medicine_list.medicine_name, sum(sellingproduct.Qty) AS Qty FROM (sellingproduct RIGHT JOIN medicine_list ON sellingproduct.ProductId = medicine_list.item_code) where sellingproduct.shopId=:shopId GROUP BY ProductId ORDER BY COUNT(ProductId) DESC limit 10";
												$query6 = $dbh -> prepare($sql6);
												$query6->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
												$query6->execute();
												$results6=$query6->fetchAll(PDO::FETCH_OBJ);
												
												foreach($results6 as $result){
													$names[] = $result->medicine_name;
													$price[] = $result->Qty;
												}
												?>
												<div style="overflow: hidden;" >
													<canvas id="myChart"  style="width:100%;max-width:780px"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
									<div class="card text-center">
										<div class="card-body bg-style3 p-1">
											<div style="overflow: hidden;" class="w-100 rounded-3" id="myChart2" >
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
									<div class="panel panel-default">
										<div class="panel-body bk-white text-black">
											<div class="stat-panel text-center">
												<h1  style="margin:0%; " class="card-text pt-2"> Todays Report </h1>
												<div class="p-4">
													<table class="table table-bordered table-hover" style="width:100%; min-width:300px;">
														<thead  class="table-success">
															<tr class="">
																<th>Todays Report</th>
																<th>Amount</th>
															</tr>
														</thead>
															<?php
															date_default_timezone_set('Asia/Dhaka');
															$date = date('Y-m-d');
																$sql ="SELECT sum(NetPayment) as amount, sum(PaidAmount) as PAmount from invoice where date=:date AND shopId=:shopId";
																$query = $dbh->prepare($sql);
																$query->bindParam(':date',$date,PDO::PARAM_STR);
																$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
																$query->execute();
																$result=$query->fetch(PDO::FETCH_OBJ);
																
																$sql2 ="SELECT sum(G_total) as total from companyinvoice where Date=:date AND shopId=:shopId";
																$query2 = $dbh->prepare($sql2);
																$query2->bindParam(':date',$date,PDO::PARAM_STR);
																$query2->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
																$query2->execute();
																$result2=$query2->fetch(PDO::FETCH_OBJ);
															?>
														<tbody>
															<tr>
																<td>Total Sales</td>
																<td id="tsale"><?php $amount = $result->amount;
																echo round($amount, 2); ?></td>
															</tr>
															<tr>
																<td>Total Purchase</td>
																<td id="totalPurchase"><?php $purchase = $result2->total;
																echo round($purchase, 2); ?></td>
															</tr>
															<tr>
																<td>Cash Received</td>
																<td><?php $amount = $result->PAmount;
																echo round($amount, 2); ?></td>
															</tr>
															<tr>
																<td>Bank Receive</td>
																<td>Comming....</td>
															</tr>
															<tr>
																<td>Total Service</td>
																<td>Comming....</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row mt-4">
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
									<?php
									$sql = "SELECT customertable.ID FROM customertable INNER JOIN customerledger ON customertable.ID =customerledger.CustomerID where customertable.Status= 1 AND customerledger.shopId=:shopId	
									GROUP BY customerledger.CustomerID ORDER BY customertable.Name";
									$query = $dbh -> prepare($sql);
									$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									if($query->rowCount() > 0)
									{
									$dueamount=0;
									$duePerson =0;
									foreach($results as $result)
									{	
										$sql2 = "SELECT NewDue from customerledger WHERE CustomerID=:id AND shopId=:shopId ORDER BY ID DESC limit 1"; 
										$query2 = $dbh -> prepare($sql2);
										$query2->bindParam(':id',$result->ID,PDO::PARAM_STR);
										$query2->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
										$query2->execute();
										$result2=$query2->fetch(PDO::FETCH_OBJ);
										if($result2->NewDue>0){
											$duePerson++;
										}
										$dueamount += $result2->NewDue;
										
									}}	
									?>
												
									<div class="card text-center">
										<div class="card-header bg-style2">
										<h5 class="fw-bold">Total Due Customer</h5>
										</div>
										<div class="card-body ">
											<div class="d-flex justify-content-center align-items-center">
												<h1 class=""><?php echo $duePerson; ?></h1>
												<p class="ms-2">Person</p>
											</div>
											
											<a href="<?php echo $BaseUrl;?>/customer/customer_ledger.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
									<div class="card text-center">
										<div class="card-header bg-style2">
											<h5 class="fw-bold">Total Due Amount</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
												<h1 class=""><?php echo $dueamount ?></h1>
												<p class="ms-2">Taka</p>
											</div>
											
											<a href="<?php echo $BaseUrl;?>/customer/customer_ledger.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
								<?php 
									date_default_timezone_set('Asia/Dhaka');
									$date = date('Y-m-d');
									$sql ="SELECT SUM(PaidAmount) as PaidAmount FROM emi_table WHERE CollectedDate=:date AND Status=1 AND shopId=:shopId";
									$query = $dbh -> prepare($sql);;
									$query->bindParam(':date',$date,PDO::PARAM_STR);
									$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
									$query->execute();
									$result=$query->fetch(PDO::FETCH_OBJ);
								?>
									<div class="card text-center">
										<div class="card-header bg-style2">
											<h5 class="fw-bold">Todays EMI Collection</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
											<?php 
											if($result->PaidAmount > 0){

												?> 
												<h1 class=""><?php echo round($result->PaidAmount,2); ?></h1>
												<p class="ms-2">Taka</p>
												<?php

											}else{ ?> 
											<h1 class="">No Colletion</h1>
											<?php } ?>	
											</div>
											<a href="<?php echo $BaseUrl;?>/emi/emisellslist.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
									<?php 
										date_default_timezone_set('Asia/Dhaka');
										$endDate = $date = date('Y-m-d');
										$date=date_create($date);
										date_add($date,date_interval_create_from_date_string("-7 days"));
										$startDate = date_format($date,"Y-m-d");
										
										$sql2 ="SELECT SUM(PaidAmount) as PaidAmount8 FROM emi_table WHERE Status=1 AND CollectedDate BETWEEN :startDate AND :endDate AND shopId=:shopId ";
										$query8 = $dbh -> prepare($sql2);;
										$query8->bindParam(':startDate',$startDate,PDO::PARAM_STR);
										$query8->bindParam(':endDate',$endDate,PDO::PARAM_STR);
										$query8->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
										$query8->execute();
										$result8=$query8->fetch(PDO::FETCH_OBJ);
									?>
									<div class="card text-center">
										<div class="card-header bg-style2">
											<h5 class="fw-bold">7 Days Collection</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
												<?php 
												if($result8->PaidAmount8 > 0){

													?> 
													<h1 class=""><?php echo round($result8->PaidAmount8,2); ?></h1>
													<p class="ms-2">Taka</p>
													<?php

												}else{ ?> 
												<h1 class="text-red">No Colletion</h1>
												<?php } ?>	
											</div>
											
											<a href="<?php echo $BaseUrl;?>/emi/emisellslist.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mb-2">
									<?php 
										date_default_timezone_set('Asia/Dhaka');
										$startDate = $date = date('Y-m-d');
										$date=date_create($date);
										date_add($date,date_interval_create_from_date_string("-7 days"));
										$endDate = date_format($date,"Y-m-d");
										
										$sql ="SELECT SUM(EMI) as DueAmount FROM emi_table WHERE Status=0 AND shopId=:shopId";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
										$query->execute();
										$result=$query->fetch(PDO::FETCH_OBJ);
									?>
									<div class="card text-center">
										<div class="card-header bg-style2">
											<h5 class="fw-bold">Due EMI Amount</h5>
										</div>
										<div class="card-body">
											<div class="d-flex justify-content-center align-items-center">
											<?php 
												if($result->DueAmount > 0){

													?> 
													<h1 class=""><?php echo round($result->DueAmount,2); ?></h1>
													<p class="ms-2">Taka</p>
													<?php

												}else{ ?> 
												<h1 class="text-red">No Colletion</h1>
												<?php } ?>
											</div>
											<a href="<?php echo $BaseUrl;?>/emi/emisellslist.php" class="btn btn-primary">Full Detail</a>
										</div>
									</div>
								</div>
							</div>
							
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<!-- Loading Scripts -->
	<script>
	var xValues = <?php echo json_encode($names);  ?>;
	var yValues = <?php echo json_encode($price);  ?>;
	var barColors = ["red", "green","blue","orange","black","red", "green","blue","orange","black"];

	new Chart("myChart", {
	type: "bar",
	data: {
		labels: xValues,
		datasets: [{
		backgroundColor: barColors,
		data: yValues
		}]
	},
	options: {
		legend: {display: false},
		title: {
		display: true,
		text: "Best Sales of the month (Products)"
		}
	}
	});
	</script>


	<script>
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	let tpurchase = document.getElementById('totalPurchase');
	let tsale = document.getElementById('tsale');
	tpurchase = Number(tpurchase.innerText);
	tsale = Number(tsale.innerText);

	function drawChart() {
	var data = google.visualization.arrayToDataTable([
	['Contry', 'Mhl'],
	['Total Sale',tsale],
	['Total Service',2645],
	['Total Purchase',tpurchase],
	['Total Income',4521]
	]);

	var options = {
	title:'Income Expense Statement',
	is3D:true
	};

	var chart = new google.visualization.PieChart(document.getElementById('myChart2'));
	chart.draw(data, options);
	}
	</script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
</body>
</html>
<?php } ?>