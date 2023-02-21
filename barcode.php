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
	
	<title>PMS | Barcode  </title>
	<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Product Barcode
									</div>
									<div >
										<button onclick="window.print();"  type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-print mr-2" style="margin-right: 10px;"></i> Print</button>
                                        <a href="products_list.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Products List</button></a>
									</div>
									
								</div>
								
                            </div>
							<div class="panel-body">                                
								<div >

									<?php
									$did=$_GET['bcode'];	
																	
									$sql = "SELECT * FROM medicine_list WHERE  item_code=:did";
									$query = $dbh->prepare($sql);
									$query-> bindParam(':did',$did, PDO::PARAM_STR);
									$query -> execute();
									$result=$query->fetch(PDO::FETCH_OBJ);									
									 $product = $result->medicine_type ;
									 $product_id = $result->item_code ;									 
									 $rate = $result->selling_pricce;
									?> 
									 <div style="text-align: center; font-size:large;" >
									  <?php echo $product = $result->medicine_name ;?>
									</div>
									<?php

									for($i=1;$i<=60;$i++){	
																			
										echo "<img alt='$product_id' style ='padding:10px;' src='barcode128.php?codetype=Code39&size=55&text=$product_id&print=true'/>";
										
									}
									?>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
    
</body>
</html>
<?php } ?>
