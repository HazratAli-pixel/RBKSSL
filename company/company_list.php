
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
	if(isset($_REQUEST['del']))
	{
		$did=intval($_GET['del']);
		$sql = "delete from medicine_list WHERE item_code=:did AND shopId=:shopId AND branchId=:branchId";
		$query = $dbh->prepare($sql);
		$query->bindParam(':did',$did, PDO::PARAM_STR);
		$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
		$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
		$query -> execute();
		$msg="Record deleted Successfully";
        header("refresh:1;company_list.php");
	}

 ?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="pharmacy management System">
	<meta name="author" content="Md. Hazrat Ali">
	<meta name="theme-color" content="#3e454c">
	
	<title>PMS-Company List</title>
	<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://kit.fontawesome.com/b6e439dc17.js" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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
						<div class="card ">
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Company Information
									</div>
									<div >
                                        <a href="company_add.php" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Company</a>    
										
										<a href="purchase_list.php" class="btn btn-success" ><i class="fas fa-align-justify mr-2" style="margin-right: 10px;"></i> Company Ledger</a>
									</div>
								</div>
                            </div>
							<div class="card-body">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Company List</a>
								<div class="col-12 table-responsive">
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Address</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>City</th>
												<th>Status</th>
												<th>Zip</th>
												<th>Action</th>
											</tr>
										</thead>
										
										<tbody>

											<?php $sql = "SELECT * from  company where shopId=:shopId";
											$query = $dbh -> prepare($sql);
											$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{				?>	
											<tr>
												<td><?php echo htmlentities($cnt);?></td>
												<td><?php echo htmlentities($result->name);?></td>
												<td><?php echo htmlentities($result->address1);?></td>
												<td><?php echo htmlentities($result->mobile);?></td>
												<td><?php echo htmlentities($result->email1);?></td>
												<td><?php echo htmlentities($result->city);?></td>
												<td>												
												<?php
												if ($result->status ==1)
													echo "Active";
												else echo "Inactive";
												?>
												</td>
												<td><?php echo htmlentities($result->zip);?></td>
												<td>
												
												<a href="company_edit.php?edit=<?php echo htmlentities($result->ID);?>" > <i class="fas fa-edit" aria-hidden="true"></i></a> 
												<a href="#" > <i class="fas fa-eye" aria-hidden="true"></i></a> 
												<a href="company_list.php?del=<?php echo htmlentities($result->ID);?>" onclick="return confirm('Do you really want to delete this record')"> <i style="color: red;" class="far fa-trash-alt" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php $cnt=$cnt+1; }} ?>
										</tbody>
										<?php if ($query->rowCount() >35){ ?>
										<tfoot>
											<tr>
											<th>#</th>
												<th>Name</th>
												<th>Address</th>
												<th>Mobile</th>
												<th>Email</th>
												<th>City</th>
												<th>Status</th>
												<th>Zip</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<?php }?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>


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