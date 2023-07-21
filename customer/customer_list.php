
<?php
	session_start();
	error_reporting(0);
	include('../includes/config.php');
	if(strlen($_SESSION['alogin'])==0)
		{
		include_once('../includes/address.php');	
		header('location:index.php');
		}

	else
	{
		if(isset($_REQUEST['del']))
		{
			$did=intval($_GET['del']);
			$sql = "delete from customertable WHERE  ID=:did";
			$query = $dbh->prepare($sql);
			$query-> bindParam(':did',$did, PDO::PARAM_STR);
			$query -> execute();
			$msg="Record deleted Successfully";
		}
		if(isset($_POST['submit']))
	  		{
			
			$c_name=$_POST['c_name'];
			$c_phone=$_POST['c_phone'];
			$c_address=$_POST['c_address'];
			$status=$_POST['radio_value'];

			$sql="INSERT INTO customertable (Name, Phone,Address,Status) 
			VALUES(:c_name,:c_phone,:c_address,:radio_value)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':c_name',$c_name,PDO::PARAM_STR);
			$query->bindParam(':c_phone',$c_phone,PDO::PARAM_STR);
			$query->bindParam(':c_address',$c_address,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);

			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
	
		}
		if(isset($_GET['close'])){    
			$cmpid=$_GET['close'];
			$sts=0;
			$sql ="update customertable set Status=:status where ID=:cusId";
			$query = $dbh->prepare($sql);
			$query-> bindParam(':status',$sts, PDO::PARAM_STR);
			$query-> bindParam(':cusId',$cmpid, PDO::PARAM_STR);
			$query -> execute();
			echo "<script>window.location.href='customer_list.php'</script>";
			}
		if(isset($_GET['active'])){    
			$cmpid=$_GET['active'];
			$sts=1;
			$sql ="update customertable set Status=:status where ID=:cusId";
			$query = $dbh->prepare($sql);
			$query-> bindParam(':status',$sts, PDO::PARAM_STR);
			$query-> bindParam(':cusId',$cmpid, PDO::PARAM_STR);
			$query -> execute();
			echo "<script>window.location.href='customer_list.php'</script>";
			}
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
	
	<title>PMS-Customer List</title>
	<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">

</head>
<body>
	<?php include('../includes/header.php');?>
	<div class="ts-main-content">
		<?php include('../includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						
						<!-- Zero Configuration Table -->
						<div class="card">
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Customer Information
									</div>
									<div >
                                        <a href="customer_ledger.php" class="btn btn-warning mr-3"><i class="fa fa-info-circle me-3" aria-hidden="true"></i> Customer Ledger</a>                                              
                                        <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Customer</button>                                              
									</div>
								</div>
                            </div>
							<div class="card-body">
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Customer list</a>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th>SL</th>
										    <th>ID</th>
											<th>Name</th>
											<th>Father</th>
											<th>Mother</th>
											<th>NID</th>
											<th>Phone</th>
											<th>Address</th>
											<th class="text-center">Status</th>
                                            <th>Action</th>
										</tr>
									</thead>
									
									<tbody>

                                        <?php $sql = "SELECT * from  customertable";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $result)
                                        {				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->ID);?></td>
											<td><?php echo htmlentities($result->Name);?></td>
											<td><?php echo htmlentities($result->Fname);?></td>
											<td><?php echo htmlentities($result->Mname);?></td>
											<td><?php echo htmlentities($result->NID);?></td>
											<td><?php echo htmlentities($result->Phone);?></td>
											<td><?php echo htmlentities($result->Address);?></td>
											<td class="text-center"><?php 
											// $rno=mt_rand(10000,99999);  
											if($result->Status==1){
												?>
												<a href="customer_list.php?close=<?php echo $result->ID?>" class="mr-25" data-toggle="tooltip" data-original-title="want to close?"> <button type="button" class="btn btn-success">Active</button></a>
												<?php
											}
											else { ?>
												<a href="customer_list.php?active=<?php echo $result->ID;?>" class="mr-25" data-toggle="tooltip" data-original-title="want to active?"><button type="button" class="btn btn-warning">Close</button></a>
												<?php
											}
											
											?></td>
											<td>
											
											<a href="customer_list.php?edit=<?php echo htmlentities($result->ID);?>" > <i class="fas fa-edit" aria-hidden="true"></i></a> 
                                            <a href="#" > <i class="fas fa-eye" aria-hidden="true"></i></a> 
											<a href="customer_list.php?del=<?php echo htmlentities($result->ID);?>" onclick="return confirm('Do you really want to delete this record')"> <i style="color: red;" class="far fa-trash-alt" aria-hidden="true"></i></a>
											</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Customer Information</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody2">
					<div class="card-body">
						<form method="post" class="row">
						<div class="">
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Name : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="c_name" placeholder="customer name">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Phone : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="c_phone" placeholder="phone number">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Address : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="c_address" placeholder="address">
								</div>
							</div>
							
						</div>																
						<div class="">
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
								<button style="min-width: 150px;" class="btn btn-success" onclick="customer_add()" name="submit" >Submit</button>
							</div>
						</div>					
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap-select.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
		<script src="../js/Chart.min.js"></script>
		<script src="../js/fileinput.js"></script>
		<script src="../js/chartData.js"></script>
		<script src="../js/main.js"></script>
    
</body>
</html>
<?php } ?>

