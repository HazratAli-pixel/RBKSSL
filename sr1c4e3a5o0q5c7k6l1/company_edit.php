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
        $id=$_GET['edit'];
		if(isset($_POST['submit']))
	  		{
			$cname=$_POST['cname'];
			$mobile=$_POST['mobile'];
			$email1=$_POST['email1'];
			$email2=$_POST['email2'];
			$phone=$_POST['phone'];
			$contact=$_POST['contact'];
			$address1=$_POST['address1'];
			$address2=$_POST['address2'];
			$fax=$_POST['fax'];
			$city=$_POST['city'];
			$state=$_POST['state'];
			$zipcode=$_POST['zipcode'];
			$country=$_POST['country'];
            $companyid=$_POST['companyid'];            
			$priviousbal=$_POST['priviousbal'];
			$status=$_POST['radio_value'];

			$sql="UPDATE company SET name=:cname, mobile=:mobile, email1=:email1, email2=:email2, phono=:phone,contact=:contact, address1=:address1, address2=:address2, fax=:fax, 
			city=:city, state=:state, zip=:zipcode, country=:country, priviousbal=:priviousbal,companyid=:companyid, status=:radio_value WHERE ID=:id";
			
			$query = $dbh->prepare($sql);
			$query->bindParam(':cname',$cname,PDO::PARAM_STR);
			$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
			$query->bindParam(':email1',$email1,PDO::PARAM_STR);
			$query->bindParam(':email2',$email2,PDO::PARAM_STR);
			$query->bindParam(':phone',$phone,PDO::PARAM_STR);
			$query->bindParam(':contact',$contact,PDO::PARAM_STR);
			$query->bindParam(':address1',$address1,PDO::PARAM_STR);
			$query->bindParam(':address2',$address2,PDO::PARAM_STR);
			$query->bindParam(':fax',$fax,PDO::PARAM_STR);
			$query->bindParam(':city',$city,PDO::PARAM_STR);
			$query->bindParam(':state',$state,PDO::PARAM_STR);
			$query->bindParam(':zipcode',$zipcode,PDO::PARAM_STR);
			$query->bindParam(':country',$country,PDO::PARAM_STR);
            $query->bindParam(':priviousbal',$priviousbal,PDO::PARAM_STR);
            $query->bindParam(':companyid',$companyid,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
			$query->bindParam(':id',$id,PDO::PARAM_STR);

			
		if($query->execute())
			{
			$msg=" Your info submitted successfully";
			header("refresh:3;company_list.php"); 
			}
		else 
			{
			$error=" Something went wrong. Please try again";
			header("refresh:3;company_edit.php"); 
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
		
		<title>PMS-Edit company info</title>
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
		<script language="javascript">
			function isNumberKey(evt)
			{
				var charCode = (evt.which) ? evt.which : event.keyCode		
				if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
				{
					return false;
				}
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
							
							<?php if($error){?><div class="errorWrap"><strong>ERROR </strong>: <?php echo htmlentities($error); ?> </div><?php } 
					else if($msg){?><div class="succWrap"><strong>SUCCESS </strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
							<div class="row">
								<div class="col-md-12">
									<div class="card" style="width: 100%;">
										<div class="card-header d-flex justify-content-between align-items-center h-100px">
		  									<div style="font-size: 20px; " class="bg-primary;">
												Company Information
											</div>
											<div >
                                            <a href="company_add.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Company</button></a>
												<a href="company_list.php"><button type="button" class="btn btn-info"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Company List</button></a>
												
											</div>
										</div>
										<div class="card-body">
											<form method="post" class="row" enctype="multipart/form-data" >
                                                <?php 
													$sql ="SELECT * from company WHERE ID=:companyid";
													$query = $dbh -> prepare($sql);
                                                    $query->bindParam(':companyid',$id,PDO::PARAM_STR);
													$query->execute();
													$result=$query->fetch(PDO::FETCH_OBJ);							   
												?>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Company Id : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" value="<?php echo htmlentities($result->companyid);?>" name="companyid" placeholder="Company Unique ID">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Company Name : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="cname"  value="<?php echo htmlentities($result->name);?>">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Mobile No <i class="text-danger">* </i>:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="mobile" value="<?php echo htmlentities($result->mobile);?>">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Email-1 : </label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="email1" value="<?php echo htmlentities($result->email1);?>">
														</div>
													</div>
												</div>
                                                
												<div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Email-2 :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="email2" value="<?php echo htmlentities($result->email2);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">phone :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="phone" value="<?php echo htmlentities($result->phono);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Contact :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="contact" value="<?php echo htmlentities($result->contact);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end"> Address 1:</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="address1" value="<?php echo htmlentities($result->address1);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Address 2 :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="address2" value="<?php echo htmlentities($result->address2);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Fax :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="fax" value="<?php echo htmlentities($result->fax);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">City :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="city" value="<?php echo htmlentities($result->city);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">State :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="state" value="<?php echo htmlentities($result->state);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Zip Code :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="zipcode" value="<?php echo htmlentities($result->zip);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Country :</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="country" value="<?php echo htmlentities($result->country);?>">
														</div>
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="row mb-3">
														<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Privous Balance :</label>
														<div class="col-sm-8">
														<input type="float" class="form-control text-end" name="priviousbal" value="<?php echo htmlentities($result->priviousbal);?>">
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

<!-- 
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
												</div>												 -->
																
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
