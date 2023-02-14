
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
	if(isset($_REQUEST['del']))
	{
		$did=intval($_GET['del']);
		$sql = "delete from user_info WHERE  Status=:did";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':did',$did, PDO::PARAM_STR);
		$query -> execute();
		$msg="Record deleted Successfully";
        header("refresh:1;user_list.php");
	}
	else if(isset($_GET['close'])){    
		$cmpid=$_GET['close'];
		$sts=0;
		$sql ="update user_info set Status=:status where ID=:cusId";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':status',$sts, PDO::PARAM_STR);
		$query-> bindParam(':cusId',$cmpid, PDO::PARAM_STR);
		$query -> execute();
		echo "<script>window.location.href='user_list.php'</script>";
		}
	else if(isset($_GET['active'])){    
		$cmpid=$_GET['active'];
		$sts=1;
		$sql ="update user_info set Status=:status where ID=:cusId";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':status',$sts, PDO::PARAM_STR);
		$query-> bindParam(':cusId',$cmpid, PDO::PARAM_STR);
		$query -> execute();
		echo "<script>window.location.href='user_list.php'</script>";
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
	<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	
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
						<div class="card ">
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										System User List
									</div>
									<div >
                                        <a href="add_user.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add User</button></a>                                                
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
												<th>UserID</th>
												<th>Phone 1</th>
												<th>Phone 2</th>
												<th>User Role</th>
												<th class="text-center">Status</th>
												<th class="text-center">Photo</th>
												<th>Action</th>
											</tr>
										</thead>
										
										<tbody>

											<?php $sql = "SELECT * from  user_info";
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
												<td><?php echo htmlentities($result->Name);?></td>
												<td><?php echo htmlentities($result->UserId);?></td>
												<td><?php echo htmlentities($result->Phone1);?></td>
												<td><?php echo htmlentities($result->Phone2);?></td>
												<td>Updating</td>
												<td class="text-center"><?php 
											// $rno=mt_rand(10000,99999);  
											if($result->Status==1){
												?>
												<a href="user_list.php?close=<?php echo $result->ID?>" class="mr-25" data-toggle="tooltip" data-original-title="want to close?"> <button type="button" class="btn btn-success">Active</button></a>
												<?php
											}
											else { ?>
												<a href="user_list.php?active=<?php echo $result->ID;?>" class="mr-25" data-toggle="tooltip" data-original-title="want to active?"><button type="button" class="btn btn-warning">Close</button></a>
												<?php
											}
											
											?></td>
												<td class="text-center"><img class="rounded-pill" style="width: 50px;" src="UserPhoto/<?php echo htmlentities($result->Photo);?>" alt="<?php echo htmlentities($result->Photo);?>"></td>
												<td>
													<a href="company_edit.php?edit=<?php echo htmlentities($result->ID);?>" > <i class="fas fa-edit" aria-hidden="true"></i></a> 
													<a href="#" > <i class="fas fa-eye" aria-hidden="true"></i></a> 
													<a href="company_list.php?del=<?php echo htmlentities($result->ID);?>" onclick="return confirm('Do you really want to delete this record')"> <i style="color: red;" class="far fa-trash-alt" aria-hidden="true"></i></a>
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
	</div>


	<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
    
</body>
</html>

<?php } ?>