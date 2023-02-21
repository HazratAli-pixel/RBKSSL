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
	
		if(isset($_POST['submit']))
	  		{
			$barcode=$_POST['barcode'];
			$medicinename=$_POST['medicinename'];
			$companyID=$_POST['companyID'];;
			$medicinedetails=$_POST['medicinedetails'];
			$boxsize=$_POST['boxsize'];
			$strength=$_POST['strength'];
			$unit=$_POST['unit'];
			$category=$_POST['category'];
			$medicinephoto=$_POST['medicinephoto'];
			$status=$_POST['radio_value'];

			$file_name = $_FILES['medicnephoto']['name'];
			$file_tmp_name = $_FILES['medicinephoto']['tmp_name'];
			$location = "Medicinephoto/".$file_name;
			move_uploaded_file($file_tmp_name, $location);
			//$status=1;
		
			$sql="INSERT INTO medicine_list (medicine_name, unit, box_size,strength, medicine_details, category, menufacturer, item_code, status) 
			VALUES(:medicinename,:unit,:boxsize,:medicinedetails,:category,:companyID,:barcode,:radio_value)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':medicinename',$medicinename,PDO::PARAM_STR);
			$query->bindParam(':unit',$unit,PDO::PARAM_STR);
			$query->bindParam(':boxsize',$boxsize,PDO::PARAM_STR);
			$query->bindParam(':strength',$strength,PDO::PARAM_STR);
			$query->bindParam(':shelf',$shelf,PDO::PARAM_STR);
			$query->bindParam(':medicinedetails',$medicinedetails,PDO::PARAM_STR);
			$query->bindParam(':category',$category,PDO::PARAM_STR);
			$query->bindParam(':companyID',$companyID,PDO::PARAM_STR);
			$query->bindParam(':barcode',$barcode,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
			{
			$msg=" Your info submitted successfully";
			header("refresh:2;products_add.php"); 
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			//header("refresh:3;medicine_add.php"); 
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
		
		<title>D_shop | Products Add</title>
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
											  Product Information
											</div>
											<div >
												<a href="products_list.php"><button type="button" class="btn btn-info"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i>Products List</button></a>
												
											</div>
										</div>
										<div class="card-body">
											<form method="post" class="row" enctype="multipart/form-data" onsubmit="return" >
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Bar Code/ Item code<i class="text-danger">* </i> : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="barcode" placeholder="Bar code / Item Code" required>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Name <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="medicinename" placeholder="Product Name" required>
														</div>
													</div>
												</div>
												<?php 
													$companyname ="SELECT * from company";
													$cquery = $dbh -> prepare($companyname);
                                                    $cquery->bindParam(':barcode',$id,PDO::PARAM_STR);
													$cquery->execute();
													$results=$cquery->fetchAll(PDO::FETCH_OBJ);							   
												?>
												
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Company Name <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<select name="companyID" class="form-control form-select form-select-md" required>
																<option value="" Disabled selected class="">Select Company</option>
																<?php																
																foreach($results as $result){
																	if($result->status==1){
																	?>																
																	<option  value="<?php echo htmlentities($result->ID);?>"><?php echo htmlentities($result->name);?></option>
																<?php } 
																else{  ?>
																	<option disabled><?php echo htmlentities($result->name)." --Need to active";?></option>
															 <?php } 
															 }?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Details:</label>
														<div class="col-sm-8">
														<textarea style="resize: none;" rows="5" cols="50" class="form-control" name="medicinedetails" placeholder="Product Details" rows="1"></textarea>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
													<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Box Size :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="boxsize" placeholder="Box Size">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Strength<i class="text-danger">* </i> : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="strength" placeholder="Strength" required>
														</div>
													</div>
												</div>
												<?php 
													$medcinetype ="SELECT * from medicine_unit";
													$cquery = $dbh -> prepare($medcinetype);
													$cquery->execute();
													$results=$cquery->fetchAll(PDO::FETCH_OBJ);							   
												?>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Unit <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">															
															<select name="unit" class="form-control form-select form-select-md" required>
																<option value="" Disabled selected class="">Select Unit</option>
																<?php																
																foreach($results as $result){
																	if($result->Status==1){
																	?>																
																	<option date-tokens="<?php echo htmlentities($result->MedicineUnit);?>"><?php echo htmlentities($result->MedicineUnit);?></option>
																<?php } 
																else{  ?>
																	<option disabled><?php echo htmlentities($result->MedicineUnit)." --Need to active";?></option>
															 <?php } 
															 }?>
															</select>
														</div>
													</div>
												</div>
													
												<?php 
													$medcinetype ="SELECT * from medicine_category";
													$cquery = $dbh -> prepare($medcinetype);
													$cquery->execute();
													$results=$cquery->fetchAll(PDO::FETCH_OBJ);							   
												?>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Category <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">															
															<select name="category" class="form-control form-select form-select-md " required>
																<option value="" Disabled selected class="">Select category</option>
																<?php																
																foreach($results as $result){
																	if($result->Status==1){
																	?>																
																	<option date-tokens="<?php echo htmlentities($result->MedicineCategory);?>"><?php echo htmlentities($result->MedicineCategory);?></option>
																<?php } 
																else{  ?>
																	<option disabled><?php echo htmlentities($result->MedicineCategory)." --Need to active";?></option>
															 <?php } 
															 }?>
															</select>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Photo :</label>
														<div class="col-sm-8">
														<input type="file" class="form-control" name="medicinephoto">
														</div>
													</div>
												</div>


												
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Status<i class="text-danger">* </i> :</label>
														<div class="col-sm-8 d-flex align-items-center">
															<div class="form-check form-check-inline">
																<input class="form-check-input" checked type="radio" value="1" name="radio_value" id="inlineRadio1" value="option1">
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
