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
        header("refresh:3;products_list.php");
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
	<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="../css/bootstrap-social.css">
	<link rel="stylesheet" href="../css/bootstrap-select.css">
	<link rel="stylesheet" href="../css/fileinput.min.css">
	<link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
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
							<div class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
									  Products Information
									</div>
									<div >
                                        <a href="products_add.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Product</button></a>
                                                
									</div>
								</div>
                            </div>
							<div class="card-body">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Medicine List</a>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th class="text-center">#</th>
											<th>Product Name</th>
											<th>P Code</th>
											<th class="text-center">Category</th>
											<th class="text-center">Strength</th>										
                                            <th class="text-center">Company</th>
											<th class="text-center">Status</th>
											<th class="text-center">action </th>
										</tr>
									</thead>
									
									<tbody>

                                        <?php $sql = "SELECT medicine_list.medicine_name,medicine_list.item_code, medicine_list.category, medicine_list.strength, medicine_list.unit, medicine_list.status, medicine_list.medicine_type, medicine_list.menufacturer, medicine_list.medicine_details, company.name as companyName, company.ID as companyId FROM medicine_list LEFT JOIN company ON medicine_list.menufacturer = company.ID WHERE medicine_list.status = 1 AND medicine_list.shopId=:shopId AND medicine_list.branchId=:branchId";
                                        $query = $dbh -> prepare($sql);
										$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
										$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $result)
                                        {				?>	
										<tr>
											<td class="text-center"><?php echo htmlentities($cnt);?></td>
											<td ><?php echo htmlentities($result->medicine_name);?></td>
											<td ><?php echo htmlentities($result->item_code);?></td>
                                            <td class="text-center"><?php echo htmlentities($result->category);?></td>
											<td class="text-center"><?php echo htmlentities($result->strength)." ".($result->unit);?></td>  
											<td class="text-center"><?php echo htmlentities($result->companyName);?></td>	
											<td class="text-center"> 
											<?php
											if($result->status == 1){
												echo "Active";
											}else { echo "Inactive";}									
											?></td>
											
											<td class="text-center">											
											<a class="px-2" href="products_edit.php?edit=<?php echo htmlentities($result->item_code);?>" > <i class="fas fa-edit" aria-hidden="true"></i></a> 
                                            <a class="px-2" href="barcode.php?bcode=<?php echo htmlentities($result->item_code);?>" > <i class="fas fa-barcode" aria-hidden="true"></i></a> 
                                            <a class="px-2" href="products_view.php?view=<?php echo htmlentities($result->item_code);?>" > <i class="fas fa-eye" aria-hidden="true"></i></a>                                         
											<a class="px-2" href="products_list.php?del=<?php echo htmlentities($result->item_code);?>" onclick="return confirm('Do you really want to delete this record')"> 
											<i style="color: red;" class="far fa-trash-alt" aria-hidden="true"></i></a>
											</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
									</tbody>
                                    <?php if ($query->rowCount() >35){ ?>
                                    <tfoot>
										<tr>
										<th>#</th>
											<th>Product Name</th>
											<th>Category</th>
											<th>Strength</th>										
                                            <th>Company</th>
											<th>Status</th>
											<th>action </th>
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

	<!-- Loading Scripts -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<script src="../js/sweetalert.js"></script>
		<script src="../js/query.js"></script>
		<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
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

