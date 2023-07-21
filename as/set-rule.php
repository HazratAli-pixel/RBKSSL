<?php
session_start();
error_reporting(0);
include('includes/config.php');
	if(strlen($_SESSION['alogin'])==0)
		{
		include('./includes/address.php');
		header('location:index.php');
		}
	else{ 
	
		if(isset($_POST['submit']))
	  		{
			$pass1=$_POST['password'];
			$pass2=$_POST['cpassword'];
			$userid=$_POST['userid'];
			$position=$_POST['position'];
			$status=$_POST['radio_value'];
			if($pass1 == $pass2){
				$pass = md5($pass1);
			
				$sql="INSERT INTO admin (Password,UserId,Position, ActiveStatus) 
				VALUES(:pass,:userid,:position,:status)";
				$query = $dbh->prepare($sql);
				$query->bindParam(':pass',$pass,PDO::PARAM_STR);
				$query->bindParam(':userid',$userid,PDO::PARAM_STR);
				$query->bindParam(':position',$position,PDO::PARAM_STR);
				$query->bindParam(':status',$status,PDO::PARAM_STR);
	
				$query->execute();
				$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId)
				{
				$msg=" Your info submitted successfully";
				header("refresh:1;user_info.php"); 
				}
			else 
				{
				$error=" Something went wrong. Please try again";
				header("refresh:1;user_info.php"); 
				}
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
		
		<title>PMS| Set Rule</title>
		<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
		<!-- Font awesome -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<!-- Sandstone Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	}
		.succWrap{
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			
	}
</style>

	</head>
	
	<body>
		<?php include('includes/header.php');?>
		<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">							
							<?php if($error){?><div class="errorWrap"><strong>ERROR </strong>: <?php echo htmlentities($error); ?> </div>
							<?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCESS </strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
							<div class="row">
								<div class="col-md-12">
									<div class="card" style="width: 100%;">
										<div class="card-header d-flex justify-content-between align-items-center h-100px">
		  									<div style="font-size: 20px; " class="bg-primary;">
												Set User Rule
											</div>
											<div >
												<a href="add_user.php"><button type="button" class="btn btn-info"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add User</button></a>
												
											</div>
										</div>
										<div class="card-body">
											<form method="post" class="row" enctype="multipart/form-data" onsubmit="return" >
												
												<div class="col-md-6">
												<?php $sql = "SELECT * FROM user_info WHERE NOT EXISTS (SELECT admin.UserId FROM admin WHERE user_info.UserId = admin.UserId)";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													?>	
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Select Name <i class="text-danger">* </i>: </label>
														<div class="col-sm-8">
														<select name="userid" class="form-control form-select form-select-md ">
															<?php if($query->rowCount() > 0)
															{
																foreach($results as $result)
																{	?>
																<option value="<?php echo $result->UserId; ?>"><?php echo $result->Name."-".$result->UserId; ?></option>
																<?php }}?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Position <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<select name="position" class="form-control form-select form-select-md ">
																<option value="" Disabled selected class="">Select Posciton</option>
																<option value="Admin">Admin</option>																
																<option value="Cashier">Cashier</option>
																<option value="Pharmacist">Pharmacist</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Password <i class="text-danger">* </i> :</label>
														<div class="col-sm-8">
														<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Confirm Password <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Password" required>
														<input type="checkbox" id="showhidepass" class="mt-2"> Show Password</input>
														</div>
													</div>
												</div>
												<div class="col-md-6">
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
		<script>
			$(document).ready(function(){
				$("#cpassword").blur(()=>{
					if($("#password").val() == $("#cpassword").val()){
						$("#passcheck").text("Password matched.");
						$("#passcheck").css("color", "green");
					}
					else{ 
						$("#passcheck").text("Password not matched!");
						$("#passcheck").css("color", "red");
					}
				});
				$("#showhidepass").click(function(){
				var pass1 = document.getElementById("password");
				var pass2 = document.getElementById("cpassword");
				if(pass2.type == "password" && pass1.type=="password"){
				pass2.type = "text";
				pass1.type = "text";
				}
				else{
					pass2.type = "password";
					pass1.type = "password";
				}
				});
			});
		</script>

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
	</body>
	</html>