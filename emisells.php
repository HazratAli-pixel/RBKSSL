<?php

use LDAP\Result;

session_start();
error_reporting(0);
include('includes/config.php');
	
	if(strlen($_SESSION['alogin'])==0)
		{
		include_once('./includes/address.php');		
		header('location:index.php');
		}
	else{ 
	
		if(isset($_POST['submit']))
	  		{
			$userid = $_SESSION['alogin'];
			$customerID=$_POST['customerName'];
			$ref_1=$_POST['ref_1'];
			$ref_2=$_POST['ref_2'];
			$inoviceId=$_POST['inoviceId'];
			$loanamount=$_POST['loanamount'];
			$interestrate=$_POST['interestrate'];
			$month=$_POST['month'];
			$type=$_POST['type'];
			$day=$_POST['day'];
			$start_time=$_POST['start_time'];
			$total_emi=$_POST['total_emi'];
			$total_interest=$_POST['total_interest'];
			$usualEMI=$_POST['emi'];
			$emi=$_POST['monthlyEMI'];
			$status=0;

			$sql="INSERT INTO loan_table (SellerID, InvoiceID, CustomerID, Ref1_id, Ref2_id, loanAmount, EMItype, Day, Duration, InterestRate, Interest, EMI, totalEMI, Status) 
			VALUES(:userid,:inoviceId,:customerID,:ref_1,:ref_2,:loanamount,:type,:day,:month,:interestrate,:total_interest,:usualEMI,:total_emi,:status)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			$query->bindParam(':inoviceId',$inoviceId,PDO::PARAM_STR);
			$query->bindParam(':customerID',$customerID,PDO::PARAM_STR);
			$query->bindParam(':ref_1',$ref_1,PDO::PARAM_STR);
			$query->bindParam(':ref_2',$ref_2,PDO::PARAM_STR);
			$query->bindParam(':loanamount',$loanamount,PDO::PARAM_STR);
			$query->bindParam(':type',$type,PDO::PARAM_STR);
			$query->bindParam(':day',$day,PDO::PARAM_STR);
			$query->bindParam(':month',$month,PDO::PARAM_STR);
			$query->bindParam(':interestrate',$interestrate,PDO::PARAM_STR);
			$query->bindParam(':total_interest',$total_interest,PDO::PARAM_STR);
			$query->bindParam(':usualEMI',$usualEMI,PDO::PARAM_STR);
			$query->bindParam(':total_emi',$total_emi,PDO::PARAM_STR);
			$query->bindParam(':status',$status,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
			{

				
				$given_year = strtotime("$start_time");
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


				$sql2="INSERT INTO emi_table(loanID, EMI_SL, Date, Day, Balance, EMI,R_balance) 
				VALUES(:loanID,:EMI_SL,:Date,:Day,:Balance,:EMI,:R_balance)";

				for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
					$datess = date('Y-m-d', $i);
					$dates = date('l', $i);
					$data = array(
						':loanID'	=>	$lastInsertId,
						':EMI_SL'	=>	$y,
						':Date'	=>	$datess,
						':Day'	=>	$dates,
						':Balance'	=>	$temp,
						':EMI'	=>	$emi,
						':R_balance'	=>	$temp2
						); 
						$statement = $dbh->prepare($sql2);
						$statement->execute($data);
					$y++;
					if($temp2<=0){
						break;
					}
					$temp=round($temp-$emi,2);
					$temp2=round($temp-$emi,2);
				}
				$lastInsertId2 = $dbh->lastInsertId();
				if($lastInsertId2){
					$msg=" Your info submitted successfully";
					header("refresh:2;emisells.php"); 
				}
				else 
					{
					$error=" Something went wrong. Please try again";
					header("refresh:2;emisells.php"); 
					}
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			header("refresh:2;emisells.php"); 
			}
	
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
		<meta name="author" content="Hazrat Ali">
		<meta name="theme-color" content="#3e454c">
		
		<title>RBKSSL-EMI Calculation</title>
		<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="https://kit.fontawesome.com/b6e439dc17.js" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<script language="javascript">
			function isNumberKey(evt)
			{
				
				var charCode = (evt.which) ? evt.which : event.keyCode
						
				if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
				return false;
		
				return true;
			}
		  </script>
	</head>
	
	<body>
		<?php include('includes/header.php');?>
		<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							
							<div class="col-12 p-2">
							<?php if($error){?><div class="errorWrap"><strong>ERROR </strong>: <?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCESS </strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card" style="width: 100%;">
										<div class="card-header d-flex justify-content-between align-items-center h-100px">
		  									<div style="font-size: 20px; " class="bg-primary;">
												EMI Calculation
											</div>
											<div >
												<!-- <a href="customer_list.php"><button type="button" class="btn btn-info"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Customer List</button></a> -->
												
											</div>
										</div>
										<div class="card-body">
											<form method="post" enctype="multipart/form-data" class="" >
                                                <div class="d-flex flex-column flex-md-row justify-content-between">
													<div class="col-12 col-md-6 col-lg-6">
														<?php 
															$sql ="SELECT * from customertable ";
															$query = $dbh -> prepare($sql);;
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
														?>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Name : </label>
															<div class="col-sm-8 ">															
																<select name="customerName"  class="form-control form-select form-select-md" required>
																<?php
																foreach($results as $result){?>
																	<option Value="<?php echo $result->ID;?>"><?php echo $result->ID."-".$result->Name."-".$result->Phone."-".$result->Address;?></option>
																<?php } ?>	
																</select>
															</div>
														</div>
														<?php 
															$sql ="SELECT * from reference ";
															$query = $dbh -> prepare($sql);;
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
														?>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Reference-1 : </label>
															<div class="col-sm-8 ">															
																<select name="ref_1" class="form-control form-select form-select-md" required>
																<option Value="0" selected>No Need</option>
																<?php
																foreach($results as $result){?>
																	<option Value="<?php echo $result->ID;?>"><?php echo $result->ID."-".$result->Name."-".$result->Phone."-".$result->Address;?></option>
																<?php } ?>	
																</select>
															</div>
														</div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Reference-2 : </label>
															<div class="col-sm-8 ">															
																<select name="ref_2" class="form-control form-select form-select-md" required>
																<option Value="0" selected>No Need</option>
																<?php
																foreach($results as $result){?>
																	<option Value="<?php echo $result->ID;?>"><?php echo $result->ID."-".$result->Name."-".$result->Phone."-".$result->Address;?></option>
																<?php } ?>	
																</select>
															</div>
														</div>
														<?php 
															$sql ="SELECT * from invoice ORDER BY ID DESC limit 15 ";
															$query = $dbh -> prepare($sql);;
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
															$query=$query->rowCount();
														?>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Invoice ID : </label>
															<div class="col-sm-8 ">															
																<select name="inoviceId" class="form-control form-select form-select-md" required>
																<?php
																foreach($results as $result){?>
																	<option Value="<?php echo $result->ID;?>"><?php echo $result->ID."-".$result->CustomerID."-".$result->NetPayment;?></option>
																<?php } ?>	
																</select>
															</div>
														</div>

														<div class="hr-dashed"></div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Loan Amount : </label>
															<div class="col-sm-8">
															<input type="number" id="amount" onkeyup="calculation()" onchange="emicalculation()" class="form-control" name="loanamount" placeholder="Loan Amount">
															</div>
														</div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Interest Rate : <i class="text-danger">* </i>:</label>
															<div class="col-sm-8">
															<input type="Number" id="rate" onkeyup="calculation()" onchange="emicalculation()" class="form-control" name="interestrate" placeholder="Interest Rate" required>
															</div>
														</div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Time (Month) : <i class="text-danger">* </i>:</label>
															<div class="col-sm-8">
																<input type="Number" id="month" onkeyup="calculation()" onchange="emicalculation()" class="form-control" name="month" placeholder="Enter time in month" required>
															</div>
														</div>
													</div>
													<div class="col-12 col-md-6 col-lg-6">
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">EMI Type <i class="text-danger">* </i>:</label>
															<div class="col-sm-8 ">															
																<select id="type" onchange="emicalculation()" name="type" class="form-control form-select form-select-md" required>
																	<option Value="day">Everyday</option>
																	<option Value="week">Weekly</option>
																	<option Value="month" selected>Monthly</option>
																</select>
															</div>
														</div>

														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Day <i class="text-danger">* </i>:</label>
															<div class="col-sm-8">															
																<select id="day" onchange="emicalculation()" name="day" class="form-control form-select form-select-md" required>
																	<option Value="Saturday" selected>Saturday</option>
																	<option Value="Sunday">Sunday</option>
																	<option Value="Monday">Monday</option>
																	<option Value="Tuesday">Tuesday</option>
																	<option Value="Wednesday">Wednesday</option>
																	<option Value="Thursday">Thursday</option>
																	<option Value="Friday">Friday</option>
																</select>
															</div>
														</div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Start Time : </label>
															<div class="col-sm-8">
																<?php date_default_timezone_set('Asia/Dhaka'); ?>
															<input type="date" onchange="emicalculation()" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="start_time" name="start_time" required>
															</div>
														</div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Total EMI : </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" id="total_emi" name="total_emi" value="0.00" readonly>
															</div>
														</div>
														<div class="row mb-3">
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Total Interest : </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" id="total_interest" name="total_interest" value="0.00" readonly>
															</div>
														</div>
														<div class="row mb-3" hidden>
															<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Monthly EMI : </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" id="emi" name="monthlyEMI" value="0.00" readonly>
															</div>
														</div>
														<div class="row mb-3">
															<label for="" id="emi_label" class="col-sm-4 col-form-label text-start text-sm-end"> EMI : </label>
															<div class="col-sm-8">
															<input type="text" class="form-control" id="usual_emi" name="emi" value="0.00" readonly>
															</div>
														</div>
													</div>
												</div>
												

												<div class="col-12">
														<div class="d-grid gap-2 d-flex justify-content-end ">
														<button style="min-width: 150px;" class="btn btn-danger me-md-2" type="reset">Reset</button>
														<button style="min-width: 150px;" class="btn btn-success" type="submit" name="submit" >Submit</button>
												</div>
												</div>						
											</form>	
											<br>
											<div class="p-1">
												<div class="col-12 table-responsive">
													<table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
														<thead class="bg-black text-white">
															<tr>
																<th class="text-center">SL</th>
																<th class="text-center">Date</th>
																<th class="text-center">Day</th>
																<th class="text-center">Balance</th>
																<th class="text-center">EMI</th>
																<th class="text-center">Rest Balance</th>
															</tr>
														</thead>	
														<tbody id="emilist2">
															
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
			</div>
		</div>
	
		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
		<script>
			let amount = document.getElementById('amount');
			let rate = document.getElementById('rate');
			let month = document.getElementById('month');
			let type = document.getElementById('type');
			let day = document.getElementById('day');
			let emilist2 = document.getElementById('emilist2');
			let start_time = document.getElementById('start_time');
			let total_interest = document.getElementById('total_interest');
			let totalemi = document.getElementById('total_emi');
			let emi = document.getElementById('emi');
			let usual_emi = document.getElementById('usual_emi');

			function calculation() {
				let monthlyinterest = Number(rate.value)/12/100;
				let number1= Number(amount.value)* monthlyinterest;
				let number2= Math.pow((1+monthlyinterest), Number(month.value));
				let number3= Math.pow((1+monthlyinterest), Number(month.value))-1;
				let emi_amount = number1 * (number2/number3)
				total_interest.value = (emi_amount*Number(month.value) - Number(amount.value)).toFixed(2)
				emi.value= emi_amount.toFixed(2);
				
			}
			function emicalculation (){
				// alert('fsdaf')
				let day5 = day.value
				let type2 = type.value
				let start_time2 = start_time.value
				let month2 = month.value
				let loanamount = Number(amount.value);
				let emi2 = Number(emi.value);
				if(type2 == "day"){
					emi_label.innerHTML = "Daily EMI :";
				}
				else if(type2 == "week"){
					emi_label.innerHTML = "Weekly EMI :";
				}
				else{
					emi_label.innerHTML = "Monthly EMI :";
				}

				const xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						let data = this.responseText.split("^");
						emilist2.innerHTML = data[0];
						totalemi.value = data[1];
						usual_emi.value= data[2]
					}
				};
				xmlhttp.open('GET', `query3.php?day=${day5}&type=${type2}&starttime=${start_time2}&month=${month2}&emi=${emi2}&loanamount=${loanamount}`, true);
				xmlhttp.send();
			}

		</script>
	</body>
	</html>
