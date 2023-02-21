<?php
session_start();
error_reporting(0);
include('includes/config.php');
	
if(strlen($_COOKIE['Username'])==0 || strlen($_SESSION['alogin'])==0)
		{
		include_once('./includes/address.php');		
		header('location:index.php');
		}
	else{ 
		$id=$_GET['edit'];
		if(isset($_POST['submit']))
	  		{
			
			$category=$_POST['category'];
			$status=$_POST['radio_value'];

			$sql="UPDATE medicine_category SET MedicineCategory=:category, MedicineCategoryStatus=:radio_value WHERE ID=:id";
			$query = $dbh->prepare($sql);
			$query->bindParam(':category',$category,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
			$query->bindParam(':id',$id,PDO::PARAM_STR);

			$result = $query->execute();
			
		if($result)
			{
			$msg=" Your info Update successfull";
			header("refresh:3;medicine_category_list.php"); 
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			header("refresh:3;medicine_category_edit.php"); 
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
		
		<title>PMS| Medicine Add</title>
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
							<?php if($error){?><div class="errorWrap"><strong>ERROR </strong>: <?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCESS </strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
							<div class="row">
								<div class="col-md-12">
									<div class="card" style="width: 100%;">
										<div class="card-header d-flex justify-content-between align-items-center h-100px">
		  									<div style="font-size: 20px; " class="bg-primary;">
												Medicine Category
											</div>
											<div >
												<a href="medicine_category_list.php"><button type="button" class="btn btn-info"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Category List</button></a>
												
											</div>
										</div>
										<div class="card-body">
											<form method="post" class="row" enctype="multipart/form-data" onsubmit="return" >
												<?php 
												$sql ="SELECT * from medicine_category WHERE ID=:id";
												$query = $dbh -> prepare($sql);
												$query->bindParam(':id',$id,PDO::PARAM_STR);
												$query->execute();
												$result=$query->fetch(PDO::FETCH_OBJ);							   
												?>
												<div class="col-md-12">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Category Name : </label>
														<div class="col-sm-5">
														<input type="text" class="form-control" name="category" value="<?php echo htmlentities($result->MedicineCategory);?>"">
														</div>
													</div>
												</div>
																							
												<div class="col-md-12">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Status :</label>
														<div class="col-sm-8 d-flex align-items-center">
                                                            <?php                            
                                                            if($result->MedicineCategoryStatus==1){ ?>
                                                            <div class="form-check form-check-inline">
																<input class="form-check-input" checked type="radio" value="<?php echo htmlentities($result->MedicineCategoryStatus);?>" name="radio_value" id="inlineRadio1" value="option1">
																<label class="form-check-label" for="inlineRadio1">Active</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" value="0" name="radio_value" id="inlineRadio2">
																<label class="form-check-label" for="inlineRadio2">Inactive</label>
															</div>
                                                            <?php }
                                                            else if ($result->MedicineCategoryStatus==0){
                                                            ?> 
															<div class="form-check form-check-inline">
																<input class="form-check-input"  type="radio" value="1" name="radio_value" id="inlineRadio1" value="option1">
																<label class="form-check-label" for="inlineRadio1">Active</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" checked type="radio" value="<?php echo htmlentities($result->MedicineCategoryStatus);?>" name="radio_value" id="inlineRadio2">
																<label class="form-check-label" for="inlineRadio2">Inactive</label>
															</div>
                                                            <?php }?>
														</div>
													</div>
												</div>											
						
												<div class="hr-dashed"></div>

													<div class="col-md-6">
														<div class="d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
															<button style="min-width: 150px;" class="btn btn-success" type="submit" name="submit" >Update</button>
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
	</body>
	</html>
