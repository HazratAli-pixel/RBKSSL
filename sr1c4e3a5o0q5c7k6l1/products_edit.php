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
        $id = ($_GET['edit']);
		if(isset($_POST['submit']))
	  		{			
            $barcode=$_POST['barcode'];
			$medicinename=$_POST['medicinename'];
			$strength=$_POST['strength'];
			$boxsize=$_POST['boxsize'];
			$unit=$_POST['unit'];
			$medicinedetails=$_POST['medicinedetails'];
			$category=$_POST['category'];
			$price=$_POST['price'];
			$medicinetype=$_POST['medicinetype'];
			$companyname=$_POST['companyname'];
			$companyprice=$_POST['companyprice'];
			$status=$_POST['radio_value'];

			$file_name = $_FILES['medicnephoto']['name'];
			$file_tmp_name = $_FILES['medicinephoto']['tmp_name'];

			$location = "Medicinephoto/".$file_name;
			move_uploaded_file($file_tmp_name, $location);

			$sql="UPDATE medicine_list SET medicine_name=:medicinename, unit=:unit, box_size=:boxsize, strength=:strength,  
            medicine_details=:medicinedetails, category=:category, medicine_type=:medicinetype, menufacturer=:companyname, company_price=:companyprice, 
            selling_pricce=:price, status=:radio_value WHERE item_code=:barcode";
			$query = $dbh->prepare($sql);
			$query->bindParam(':medicinename',$medicinename,PDO::PARAM_STR);
			$query->bindParam(':unit',$unit,PDO::PARAM_STR);
			$query->bindParam(':boxsize',$boxsize,PDO::PARAM_STR);
			$query->bindParam(':strength',$strength,PDO::PARAM_STR);
			$query->bindParam(':medicinedetails',$medicinedetails,PDO::PARAM_STR);
			$query->bindParam(':category',$category,PDO::PARAM_STR);
			$query->bindParam(':medicinetype',$medicinetype,PDO::PARAM_STR);
			$query->bindParam(':companyname',$companyname,PDO::PARAM_STR);
			$query->bindParam(':companyprice',$companyprice,PDO::PARAM_STR);
			$query->bindParam(':price',$price,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
            $query->bindParam(':barcode',$id,PDO::PARAM_STR);
			$result= $query->execute();
            //$lastInsertId = $dbh->lastInsertId();
        if($result)
        {
            $msg=" Update successfully"; 
            header("refresh:3;products_list.php");
            
        }			
		else {
            $error=" Something went wrong. Please try again";
            header("refresh:3;products_edit.php");
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
		
		<title>D-shop| Edit Proudcts Info</title>
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
							
                            <?php if($error){?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>ERROR !</strong> : <?php echo htmlentities($error);?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } 
                            else if($msg){?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>SUCCESS !</strong> : <?php echo htmlentities($msg); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php }?>

							<div class="row">
								<div class="col-md-12">
									<div class="card" style="width: 100%;">
										<div class="card-header d-flex justify-content-between align-items-center h-100px">
		  									<div style="font-size: 20px; " class="bg-primary;">
											  Edited Product Information
											</div>
											<div >
                                                <a href="products_add.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Product</button></a>
                                                <a href="products_list.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Product List</button></a>
											</div>
										</div>
										<div class="card-body">
											<form method="post" class="row" enctype="multipart/form-data" >
                                                <?php 
													$sql ="SELECT * from medicine_list WHERE item_code=:barcode";
													$query = $dbh -> prepare($sql);
                                                    $query->bindParam(':barcode',$id,PDO::PARAM_STR);
													$query->execute();
													$result=$query->fetch(PDO::FETCH_OBJ);							   
												?>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Bar Code/ Item code : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="barcode" value="<?php echo htmlentities($result->item_code);?>">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Name <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="medicinename" value="<?php echo htmlentities($result->medicine_name);?>">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Strength : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="strength" value="<?php echo htmlentities($result->strength);?>">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Box Size <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">														
															<select name="boxsize" class="form-control form-select form-select-md " >
																<option value="<?php echo htmlentities($result->box_size);?>"selected class=""><?php echo htmlentities($result->box_size);?></option>
																<!-- <option value="11">11</option>																 -->
															</select>														
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Unit <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<select name="unit" class="form-control form-select form-select-md ">
                                                            <option value="<?php echo htmlentities($result->unit);?>"selected class=""><?php echo htmlentities($result->unit);?></option>
																<!-- <option value="11">11</option>																 -->
															</select>
														</div>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Details:</label>
														<div class="col-sm-8">
														<textarea style="resize: none;" class="form-control" name="medicinedetails" rows="5" ><?php echo htmlentities($result->medicine_details);?></textarea>
														</div>
													</div>
												</div>							
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Category <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
															<select name="category" class="form-control form-select form-select-md ">
                                                            <option value="<?php echo htmlentities($result->category);?>"selected class=""><?php echo htmlentities($result->category);?></option>
																<!-- <option value="11">11</option> -->
																
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Price <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="float" name="price" class="form-control" value="<?php echo htmlentities($result->selling_pricce);?>" id="">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Product Type <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
															<select name="medicinetype" class="form-control form-select form-select-md ">
                                                            <option value="<?php echo htmlentities($result->medicine_type);?>"selected class=""><?php echo htmlentities($result->medicine_type);?></option>
																<!-- <option value="11">11</option>																 -->
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Company Name <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
															<select name="companyname" class="form-control form-select form-select-md ">
                                                            <option value="<?php echo htmlentities($result->menufacturer);?>"selected class=""><?php echo htmlentities($result->menufacturer);?></option>
																<option value="11">1</option>
																
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Company Price <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="float" name="companyprice" class="form-control" id="" value="<?php echo htmlentities($result->company_price);?>">
														</div>
													</div>
												</div>
											
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Status :</label>
														<div class="col-sm-8 d-flex align-items-center">
                                                            <?php                            
                                                            if($result->status==1){ ?>
                                                            <div class="form-check form-check-inline">
																<input class="form-check-input" checked type="radio" value="<?php echo htmlentities($result->status);?>" name="radio_value" id="inlineRadio1" value="option1">
																<label class="form-check-label" for="inlineRadio1">Active</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" type="radio" value="0" name="radio_value" id="inlineRadio2">
																<label class="form-check-label" for="inlineRadio2">Inactive</label>
															</div>
                                                            <?php }
                                                            else if ($result->status==0){
                                                            ?> 
															<div class="form-check form-check-inline">
																<input class="form-check-input"  type="radio" value="1" name="radio_value" id="inlineRadio1" value="option1">
																<label class="form-check-label" for="inlineRadio1">Active</label>
															</div>
															<div class="form-check form-check-inline">
																<input class="form-check-input" checked type="radio" value="<?php echo htmlentities($result->status);?>" name="radio_value" id="inlineRadio2">
																<label class="form-check-label" for="inlineRadio2">Inactive</label>
															</div>
                                                            <?php }?>
														</div>
													</div>
												</div>	
				
												<div class="hr-dashed"></div>

													<div class="col-md-12">
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
