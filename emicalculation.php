<?php
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
			$name=$_POST['name'];
			$father=$_POST['father'];
			$mother=$_POST['mother'];
			$nid=$_POST['nid'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$state=$_POST['state'];
			$status=$_POST['radio_value'];

			$sql="INSERT INTO customertable (Name,Fname,Mname,NID,Phone,Address,State,Status) 
			VALUES(:name,:father,:mother,:nid,:phone,:address,:state,:status)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':name',$name,PDO::PARAM_STR);
			$query->bindParam(':father',$father,PDO::PARAM_STR);
			$query->bindParam(':mother',$mother,PDO::PARAM_STR);
			$query->bindParam(':nid',$nid,PDO::PARAM_STR);
			$query->bindParam(':phone',$phone,PDO::PARAM_STR);
			$query->bindParam(':address',$address,PDO::PARAM_STR);
			$query->bindParam(':state',$state,PDO::PARAM_STR);
			$query->bindParam(':status',$status,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
			{
			$msg=" Your info submitted successfully";
			header("refresh:2;customer_list.php"); 
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			header("refresh:2;add_customer.php"); 
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
		<!-- Sandstone Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<!-- Bootstrap Datatables -->
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">

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
											<form method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-between align-items-center" >
                                                <div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Loan Amount : </label>
														<div class="col-sm-8">
														<input type="number" id="amount" onkeyup="calculation()" class="form-control" name="loan" placeholder="Loan Amount">
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Interest Rate : <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="Number" id="rate" onkeyup="calculation()" class="form-control" name="interestrate" placeholder="Interest Rate" required>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Time : <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="Number" id="month" onkeyup="calculation()" class="form-control" name="month" placeholder="Enter time in month" required>
														</div>
													</div>
												</div>

												<?php
													$month="12";
													$day="Sunday";
													$given_year = strtotime("25-feb-2023");
													$for_start = strtotime("$day", $given_year);
													$for_end = strtotime("$month month", $given_year);
													$type= "week";
													$y=1;
													for ($i = $for_start; $i <= $for_end; $i = strtotime("+1 $type", $i)) {
														//echo $y."--";
														//echo date('l Y-m-d', $i) . '<br />';
														$y++;
													}
												?>

												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">EMI Type <i class="text-danger">* </i>:</label>
														<div class="col-sm-8 ">															
															<select id="type" onchange="calculation()" name="type" class="form-control form-select form-select-md" required>
																<option value="" Disabled selected class="">Select Type</option>
																<option Value="Everyday">Everyday</option>
																<option Value="Weekly">Weekly</option>
																<option Value="Monthly">Monthly</option>
															</select>
														</div>
													</div>
												</div>

												<div id="day2" class="col-12 col-md-6" hidden>
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Day <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">															
															<select id="day" onkeyup="calculation()" name="day" class="form-control form-select form-select-md" required>
																<option value="" Disabled selected class="">Select Day</option>
																<option Value="1"><?php echo $y-1; ?></php></option>
																<option Value="1">Saturday</option>
																<option Value="7">Sunday</option>
																<option Value="30">Monday</option>
																<option Value="30">Tuesday</option>
																<option Value="30">Wenesday</option>
																<option Value="30">Thursday</option>
																<option Value="30">Friday</option>
															</select>
														</div>
													</div>
												</div>
												
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Start Time : </label>
														<div class="col-sm-8">
														<input type="date" class="form-control" id="start_time" name="start_time" required>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Total EMI : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" id="total_emi" name="total_emi" value="0.00" readonly>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Total Interest : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" id="total_interest" name="total_interest" value="0.00" readonly>
														</div>
													</div>
												</div>			
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">EMI : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" id="emi" name="emi" value="0.00" readonly>
														</div>
													</div>
												</div>			
												<div class="hr-dashed"></div>

												<div class="col-12 col-md-6">
														<div class="d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
														<button style="min-width: 150px;" class="btn btn-danger me-md-2" type="reset">Reset</button>
														<button style="min-width: 150px;" class="btn btn-success" type="submit" name="submit" >Submit</button>
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
	
		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
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
			let day2 = document.getElementById('day2');
			let total_interest = document.getElementById('total_interest');
			let emi = document.getElementById('emi');

			toString

			function calculation() {
				let emi_amount= (Number(amount.value) * (Number(rate.value)/100)*(Number(month.value)/12)+Number(amount.value))/Number(month.value);
				total_interest.value = Number(amount.value) * (Number(rate.value)/100)*(Number(month.value)/12);
				emi.value=emi_amount;
				if(type.value.toString() == "Weekly"){
					day2.removeAttribute("hidden");
				}
				else{
					day2.setAttribute("hidden","");
				}
			}

		</script>
	</body>
	</html>
