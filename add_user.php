<?php
session_start();
error_reporting(0);
include('includes/config.php');
	
	if(strlen($_SESSION['alogin'])==0)
		{	
		header('location:index.php');
		}
	else{ 
	
		if(isset($_POST['submit']))
	  		{
			$name=$_POST['name'];
			$fname=$_POST['fname'];
			$mname=$_POST['mname'];
			$email=$_POST['email'];
			$address=$_POST['address'];
			$nid=$_POST['nid'];
			$userid=$_POST['userid'];
			$phone1=$_POST['phone1'];
			$phone2=$_POST['phone2'];
			$status=$_POST['radio_value'];

			$file_name = $_FILES['photo']['name'];
			$file_tmp_name = $_FILES['photo']['tmp_name'];
			if( empty($file_name) )
			{
			$file_name = 'awoman.jpg';
			}
		else
			{
			$location = "UserPhoto/".$file_name;
			move_uploaded_file($file_tmp_name, $location);
			}

			//$status=1;
		
			$sql="INSERT INTO user_info (UserId, NidNumber,Name, FName, MName, Phone1, Phone2, Email1,Address, Photo, Status) 
			VALUES(:userid,:nid,:name,:fname,:mname,:phone1,:phone2,:email,:address,:photo,:status)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			$query->bindParam(':nid',$nid,PDO::PARAM_STR);
			$query->bindParam(':name',$name,PDO::PARAM_STR);
			$query->bindParam(':fname',$fname,PDO::PARAM_STR);
			$query->bindParam(':mname',$mname,PDO::PARAM_STR);
			$query->bindParam(':phone1',$phone1,PDO::PARAM_STR);
			$query->bindParam(':phone2',$phone2,PDO::PARAM_STR);
			$query->bindParam(':email',$email,PDO::PARAM_STR);
			$query->bindParam(':address',$address,PDO::PARAM_STR);
			$query->bindParam(':photo',$file_name,PDO::PARAM_STR);
			$query->bindParam(':status',$status,PDO::PARAM_STR);

			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
			{
			$msg=" Your info submitted successfully";
			header("refresh:3;user_info.php"); 
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			header("refresh:3;user_info.php"); 
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
		
		<title>PMS-Add User</title>
		<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">

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
							
							<div class="card">
								<div class="card-header d-flex justify-content-between align-items-center h-100px">
		  									<div style="font-size: 20px; " class="bg-primary;">
												Add User
											</div>
											<div >
												<a href="user_list.php"><button type="button" class="btn btn-info"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> User List</button></a>
												
											</div>
								</div>
								<div class="card-body">
											<form method="post" class="row" enctype="multipart/form-data" onsubmit="return" >
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Name : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="name" placeholder="Enter name">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">NID Number<i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="nid" placeholder="Enter nid number">
														</div>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Father Name :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="fname" placeholder="Father Name">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">User ID : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="userid" placeholder="User ID">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Mother Name <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="mname" placeholder="Mother Name">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Phone 1 <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="phone1" placeholder="Phone number 1">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Email :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="email" placeholder="Email address 1">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Phone 2 <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="phone2" placeholder="Phone number 2">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Photo <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="file" class="form-control" name="photo">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Address:</label>
														<div class="col-sm-8">
														<textarea style="resize: none;" class="form-control" name="address" rows="2"></textarea>
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

