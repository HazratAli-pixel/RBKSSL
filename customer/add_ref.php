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
	
		if(isset($_POST['submit']))
	  		{
			$name=$_POST['name'];
			$father=$_POST['father'];
			$mother=$_POST['mother'];
			$nid=$_POST['nid'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$status=1;

			$sql="INSERT INTO reference (Name,Father,Mother,Phone,NID,Address,Status) 
			VALUES(:name,:father,:mother,:phone,:nid,:address,:status,:shopId,:branchId)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':name',$name,PDO::PARAM_STR);
			$query->bindParam(':father',$father,PDO::PARAM_STR);
			$query->bindParam(':mother',$mother,PDO::PARAM_STR);
			$query->bindParam(':phone',$phone,PDO::PARAM_STR);
			$query->bindParam(':nid',$nid,PDO::PARAM_STR);
			$query->bindParam(':address',$address,PDO::PARAM_STR);
			$query->bindParam(':status',$status,PDO::PARAM_STR);
			$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
			$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
			{
			$msg=" Your info submitted successfully";
			header("refresh:2;ref_list.php"); 
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			header("refresh:2;add_ref.php"); 
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
		
		<title>PMS-Add Customer information</title>
		<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
		<!-- Font awesome -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<!-- Sandstone Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<!-- Bootstrap Datatables -->
		<!-- Admin Stye -->
		<link rel="stylesheet" href="../css/style.css">
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
		<?php include('../includes/header.php');?>
		<div class="ts-main-content">
		<?php include('../includes/leftbar.php');?>
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
												Reference Information
											</div>
											<div >
												<a href="customer_list.php"><button type="button" class="btn btn-info"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Customer List</button></a>
												
											</div>
										</div>
										<div class="card-body">
											<form method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-between align-items-center" >
                                                <div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Name : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="name" placeholder="Enter name">
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Father/ Husband : <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="father" placeholder="Father/ Husband" required>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Mother/ Spouse : <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="mother" placeholder="Mother / spouse" required>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Phone : <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="phone" placeholder="Phone number" required>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Address : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="address" placeholder="Customer address" required>
														</div>
													</div>
												</div>
                                                <div class="col-12 col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">NID :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="nid" placeholder="NID">
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
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap-select.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="../js/dataTables.bootstrap.min.js"></script>
		<script src="../js/Chart.min.js"></script>
		<script src="../js/fileinput.js"></script>
		<script src="../js/chartData.js"></script>
		<script src="../js/main.js"></script>
	</body>
	</html>
