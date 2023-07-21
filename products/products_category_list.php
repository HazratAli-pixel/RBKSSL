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
	if(isset($_REQUEST['del']))
	{
		$did=intval($_GET['del']);
		$sql = "delete from medicine_category WHERE ID=:did";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':did',$did, PDO::PARAM_STR);
		$query -> execute();
		// $msg="Record deleted Successfully";
        // header("refresh:3;medicine_unit_list.php");
	}
	if(isset($_POST['submit']))
	  		{
			
			$type=$_POST['type'];
			$status=$_POST['radio_value'];

			$sql="INSERT INTO medicine_category (MedicineCategory, Status) 
			VALUES(:type,:radio_value)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':type',$type,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);

			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
	
		}
		$id=$_POST[''];
		if(isset($_POST['update']))
	  		{
			
			$category=$_POST['category'];
			$status=$_POST['radio_value'];
			$id=$_POST['id'];

			$sql="UPDATE medicine_category SET MedicineCategory=:category, Status=:radio_value WHERE ID=:id";
			$query = $dbh->prepare($sql);
			$query->bindParam(':category',$category,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
			$query->bindParam(':id',$id,PDO::PARAM_STR);
			$result = $query->execute();	
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
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>D-shop | Products category List  </title>
	<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
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
						<div class="card">
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
									  Products Category List
									</div>
									<div >
                                        <!-- <a href="medicine_unit_add.php"><button style="margin-right: 15px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Unit</button></a> -->
										<button style="margin-right: 15px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Unit</button>
									</div>
								</div>
                            </div>
							<div class="card-body">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr class="bg-info">
										    <th class="">#</th>
											<th>Category Name</th>
											<th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
										</tr>
									</thead>
									
									<tbody>

                                        <?php $sql = "SELECT * from  medicine_category ";
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
											<td><?php echo htmlentities($result->MedicineCategory);?></td>
											<td class="text-center"><?php                                             
                                            $status = $result->Status;
                                            if($status == 1){
                                                echo "Active";
                                            }
                                            else echo "Inactive";
                                            ?>
                                            
                                            
                                            </td>
											<td class="text-center">
											 <p class="px-2 btn btn-info" type="button"  onClick="edit_unit(this.id)" id="category-<?php echo htmlentities($result->ID);?>"><i class="fas fa-edit" aria-hidden="true"></i></p> 
                                            <a  class="px-2" href="#" > <i class="fas fa-eye" aria-hidden="true"></i></a> 
											<a  class="px-2" href="medicine_category_list.php?del=<?php echo htmlentities($result->ID);?>" onclick="return confirm('Do you really want to delete this record')"> <i style="color: red;" class="far fa-trash-alt" aria-hidden="true"></i></a>
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
					<h5 class="modal-title" id="exampleModalLabel">Products Information</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody2">
					<div class="card-body">
						<form method="post" class="row" onsubmit="return" >
						<div class="">
							<div class="row mb-3">
								<label for="" class="col-sm-4 col-form-label text-start text-sm-end">Products Category : </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="type" placeholder="Products Category">
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
								<button style="min-width: 150px;" class="btn btn-success" type="submit" name="submit" >Submit</button>
							</div>
						</div>					
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Modal -->
	<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Products Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody3">

				</div>
			</div>
		</div>
	</div>	


		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<script src="./js/sweetalert.js"></script>
		<script src="./js/query.js"></script>
		<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
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

