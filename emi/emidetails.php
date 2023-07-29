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
	if(isset($_GET['loanid'])){
		if(isset($_POST['submit'])){
			
			$userid = $_SESSION['alogin'];
			$cusId = $_GET['customerID'];
			// $cusId=$_POST['c_id'];
			$preDue=$_POST['c_p_total_due'];
			$paidAmount=$_POST['c_paid'];

			$newDue=$_POST['c_new_due'];
			$emiID=$_POST['emiID'];

			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d');
			
			
			$status=1;

			$sql = "UPDATE emi_table SET PaidAmount=:paidAmount, DueAmount=:newDue, CollectorID=:userid,CollectedDate=:date, Status=:status WHERE ID=:emiID AND shopId=:shopId AND branchId=:branchId";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':paidAmount',$paidAmount,PDO::PARAM_STR);
			$query->bindParam(':newDue',$newDue,PDO::PARAM_STR);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			$query->bindParam(':date',$date,PDO::PARAM_STR);
			$query->bindParam(':status',$status,PDO::PARAM_STR);
			$query->bindParam(':emiID',$emiID,PDO::PARAM_STR);
			$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
			$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
			$query->execute();
			
			$cusName=$_POST['cusName2'];

			$sql2="INSERT INTO customerledger (AdminID,CustomerID,PreDue,Credit,shopId,branchId) 
			VALUES(:userid,:cusId,:preDue,:paidAmount,:shopId,:branchId)";

			$query2 = $dbh->prepare($sql2);
			$query2->bindParam(':userid',$userid,PDO::PARAM_STR);
			$query2->bindParam(':cusId',$cusId,PDO::PARAM_STR);
			$query2->bindParam(':preDue',$preDue,PDO::PARAM_STR);
			$query2->bindParam(':paidAmount',$paidAmount,PDO::PARAM_STR);
			$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
			$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
			$query2->execute();
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
	
	<title>D-shop-Indivisual EMI List </title>
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
										Indivisual Loan (EMI) Information
									</div>
									<div >
										<a href="emisellslist.php" class="btn btn-info"> <i class="fas fa-align-justify mr-2"></i> Loan List</a>
										<!-- <a href="#" class="btn btn-info"> <i class="fa fa-credit-card" aria-hidden="true"></i> Pay Dues</a> -->
                                        <!-- <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Due</button> -->
                                        
									</div>
								</div>
                            </div>
							<div class="card-body">
                                <!-- <a href="download-records.php" style="color:red; font-size:16px;">Download Purchase list</a> -->
								

								<?php
								$id = $_GET['customerID'];
								$sql = "SELECT customertable.Name,customertable.Address, customertable.Phone, customerledger.NewDue FROM customertable LEFT JOIN customerledger ON customerledger.CustomerID =customertable.ID WHERE customerledger.CustomerID=:id ORDER BY customerledger.ID DESC limit 1"; 
								$query = $dbh -> prepare($sql);
								$query->bindParam(':id',$id,PDO::PARAM_STR);
								$query->execute();
								$result2=$query->fetch(PDO::FETCH_OBJ);
								
								?>
								<div class="row">
									<div class="col-12  d-flex">
										<table>
											<thead>
												<tr>
													<th>Name</th>
													<td>:</td>
													<td id="name"><?php echo htmlentities($result2->Name);?></td>
												</tr>
												<tr>
													<th>Phone</th>
													<td>:</td>
													<td id="phone"><?php echo htmlentities($result2->Phone);?></td>
												</tr>
												<tr>
													<th>Address</th>
													<td>:</td>
													<td><?php echo htmlentities($result2->Address);?></td>
												</tr>
												<tr>
													<th>Total Due</th>
													<td>:</td>
													<td id="totalDue"><?php echo htmlentities($result2->NewDue);?></td>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<br>
								<div class="row table-responsive">
									<div class="col-12 col-md-12 col-lg-12 col-xl-12 d-flex row flex-sm-column">
								
										<table id="zctb" class="display table table-striped table-bordered table-hover" >


											<thead class="bg-style">
												<tr>
													<th class="text-center">#</th>
													<th class="text-center">EMI No</th>
													<th class="text-center">Date</th>
													<th class="text-center">Day</th>
													<th class="text-center">Balance</th>
													<th class="text-center">EMI</th>
													<th class="text-center">R_Balance</th>
													<th class="text-center">Paid</th>
													<th class="text-center">Due</th>
													<th class="text-center">Collector</th>
													<th class="text-center">Collect Date</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>

												<?php
												date_default_timezone_set('Asia/Dhaka');
												$date = date('Y-m-d');
												$loanid = $_GET['loanid'];
												$sql = "SELECT * from emi_table WHERE loanID=:loanid ORDER By Status ASC";
												$query = $dbh -> prepare($sql);
												$query->bindParam(':loanid',$loanid,PDO::PARAM_STR);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 1)
												{
												foreach($results as $result)
												{				
													if($result->Date < $date & $result->Status==0 ){
														$bgclr = 'bg-danger';
														$text = 'text-white';
													}
													else if($result->Date == $date & $result->Status==0 ){
														$bgclr = 'bg-info';
														$text = '';
													}
													else{
														$bgclr = '';
														$text = '';
													}	
												
												?>	
												<tr id="row-<?php echo $cnt;?>" class="align-middle <?php echo $bgclr; echo " "; echo $text; ?>">
													<td class="text-center"><?php echo htmlentities($cnt);?></td>
													<td class="text-center" id="emisl-<?php echo htmlentities($result->ID);?>" ><?php echo $result->EMI_SL;?> </td>
													<td class="text-center" id="date-<?php echo htmlentities($result->ID);?>" ><?php echo $result->Date;?> </td>
													<td class="text-center" id="day-<?php echo htmlentities($result->ID);?>"><?php echo $result->Day;?></td>
													<td class="text-center" id="balance-<?php echo htmlentities($result->ID);?>" ><?php echo $result->Balance;?></td>
													<td class="text-center" id="emi-<?php echo htmlentities($result->ID);?>" ><?php echo $result->EMI;?></td>
													<td class="text-center" id="rbal-<?php echo htmlentities($result->ID);?>" ><?php echo $result->R_balance;?></td>
													<td class="text-center" id="paid-<?php echo htmlentities($result->ID);?>" ><?php echo $result->PaidAmount;?></td>
													<td class="text-center" id="due-<?php echo htmlentities($result->ID);?>" ><?php echo $result->DueAmount;?></td>
													<td class="text-center" id="collector-<?php echo htmlentities($result->ID);?>" >
													<?php 
														if($result->Status==1){
															echo $result->CollectorID;
														}
														else { 
															echo "---";
														}
														?>
													</td>
													<td class="text-center" id="status-<?php echo htmlentities($result->ID);?>" >
													<?php 
														if($result->Status==1){
															echo substr($result->updateDate,0,10);
														}
														else { 
															echo "----";
														}
														?>
													</td>
													
													<td class="text-center" id="action-<?php echo htmlentities($result->ID);?>">
													<?php 
														if($result->Status==1){
															?>
															<button disabled type="button" class="btn btn-success">Paid</button>
															<?php
														}
														else { ?>
															<p type="button" id="<?php echo htmlentities($result->ID);?>" onclick="payemi(event)" class="btn btn-warning">Pay</p>
															<?php
														}
														
														?>
													</td>
												</tr>
												<?php $cnt=$cnt+1; }}
												else{
													header('location:emisellslist.php');
												} ?>
											</tbody>
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
	<!-- Modal -->

	<div class="modal fade" id="emipaymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<!-- <div class="modal-dialog modal-dialog-centered modal-xl"> -->
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">EMI Payment</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody2">
					<div class="card-body">
						<form method="post" class="row">
						<div class="">
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Name : </label>
								<div class="col-sm-9">
									<input id="c_name" name="c_name" type="text" class="form-control" readonly>
									<input id="c_id" name="c_id" type="text" class="form-control" hidden >
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Phone : </label>
								<div class="col-sm-9">
									<input id="c_phone" name="c_phone" type="text" class="form-control"  placeholder="Enter phone number">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Date : </label>
								<div class="col-sm-9">
									<input id="c_date"  type="text" class="form-control" name="c_date" readonly>
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">EMI No : </label>
								<div class="col-sm-9">
									<input id="c_emi_no" name="c_emi_no" type="text" class="form-control" readonly>
								</div>
							</div>
						
							<div class="hr-dashed"></div>
								
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">EMI : </label>
								<div class="col-sm-9">
									<input id="c_emi" name="c_emi" type="text" class="form-control" name="c_address" readonly>
									<input id="emiID" name="emiID" type="text" class="form-control" hidden>
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Previous Due : </label>
								<div class="col-sm-9">
									<input id="c_p_due" name="c_p_due" type="text" class="form-control"  readonly>
									<input id="c_p_total_due" name="c_p_total_due" type="text" class="form-control" hidden>
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Paid : </label>
								<div class="col-sm-9">
									<input id="c_paid" name="c_paid" onkeyup="emipay(event)" type="double" class="form-control" placeholder="0.00">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Current Due : </label>
								<div class="col-sm-9">
									<input id="c_new_due" name="c_new_due" type="text" class="form-control" readonly>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-6 msg-btn d-flex justify-content-end">
									<div class="form-check form-switch text-end">
										<input class="form-check-input" value="1" type="checkbox" name="switch" id="flexSwitchCheckDefault">
										<label class="form-check-label" for="flexSwitchCheckDefault">Want messgae?</label>
									</div>
								</div>
							</div>
							
						</div>	
						<div class="hr-dashed"></div>
						<div class="col-md-12">
							<div class="d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
								<button id="fullPaid" onclick="fullemipay()" style="min-width: 150px;" class="btn btn-info me-md-2" type="button">Full Paid</button>
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
		// emipaymodal
		const payemi = (event)=>{
			let id = event.target.id;
			$('#emipaymodal').modal('show');
			let name, phone, date, emiNo, emi, predue, preEmiDue,NewDue;
			name= document.getElementById('name').innerText;
			phone= document.getElementById('phone').innerText;
			predue= document.getElementById('totalDue').innerText;
			date= document.getElementById("date-"+id).innerText;
			emiNo= document.getElementById("emisl-"+id).innerText;
			emi= document.getElementById("emi-"+id).innerText;
		

			let c_name = document.getElementById('c_name');
			let c_phone = document.getElementById('c_phone');
			let c_date = document.getElementById('c_date');
			let c_emi_no = document.getElementById('c_emi_no');
			let c_emi = document.getElementById('c_emi');
			let emiID = document.getElementById('emiID');
			let c_p_total_due = document.getElementById('c_p_total_due');

			emiID.value = id;
			c_p_total_due.value = predue;
			c_name.value = name;
			c_phone.value = phone;
			c_date.value = date;
			c_emi_no.value = emiNo;
			c_emi.value = emi;
		}
		const emipay = (event) =>{
			// let val = event.target.value;
			let emi= document.getElementById('c_emi').value;
			let c_paid= document.getElementById('c_paid').value;
			let c_new_due= document.getElementById('c_new_due');
			c_new_due.value = (emi-c_paid).toFixed(2);

		}
		const fullemipay = (event) =>{
			let emi= document.getElementById('c_emi').value;
			let c_paid= document.getElementById('c_paid');
			let c_new_due= document.getElementById('c_new_due');
			c_paid.value = emi;
			c_new_due.value = (emi-(c_paid.value)).toFixed(2);



		}
		const StatusCng = (event)=>{
			let clickedId = event.target.id
			// event.target.classList.add('bg-success');
			// event.target.setAttribute('disabled', true);
			// event.target.innerText="Added";
			let ProductId2 = document.getElementById("productID-"+clickedId).innerHTML;
			let Pdate = document.getElementById("date-"+clickedId).innerHTML
			let PQty = document.getElementById("Qty-"+clickedId).innerHTML
			let PMprice = document.getElementById("Mprice-"+clickedId).innerHTML
			let PMRP = document.getElementById("MRP-"+clickedId).innerHTML
			const xmlhttp = new XMLHttpRequest();
			// alert(ProductId);
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					event.target.classList.add('bg-success');
					event.target.setAttribute('disabled', true);
					event.target.innerText="Added";
					swal({
						title: 'Stock Medicine',
						text: this.responseText,
						icon: 'success',
						dangerMode: true,
					});
				}
			};
			xmlhttp.open('GET', `query2.php?StockManagment=${clickedId}&date=${Pdate}&Qty=${PQty}&Mprice=${PMprice}&MRP=${PMRP}&productid=${ProductId2}`, true);
			xmlhttp.send();

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

<?php 
		}
		else{
			include_once('./includes/address.php');		
			header('location:emisellslist.php');
		}
	} 
?>