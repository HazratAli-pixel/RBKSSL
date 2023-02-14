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
		$sql = "delete from medicine_list WHERE  item_code=:did";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':did',$did, PDO::PARAM_STR);
		$query -> execute();
		$msg="Record deleted Successfully";
        header("refresh:3;medicine_list.php");
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
	
	<title>PMS | Medicine List  </title>
	<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
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
						
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Medicine Information
									</div>
									<div >
                                        <a href="medicine_add.php"><button type="button" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Medicine</button></a>
                                                
									</div>
								</div>
                            </div>
							<div class="panel-body">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Medicine List</a>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										    <th>#</th>
											<th>Medicine Name</th>
											<th>Generic Name</th>
											<th>Category</th>
											<th>Shelf</th>
											<th>Prics</th>
											<th>Company Price</th>
											<th>Strength</th>										
                                            <th>Company</th>
											<th>Status</th>
											<th>action </th>
										</tr>
									</thead>
									
									<tbody>

                                        <?php $sql = "SELECT * from  medicine_list ";
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
											<td><?php echo htmlentities($result->medicine_name);?></td>
											<td><?php echo htmlentities($result->generic_name);?></td>
                                            <td><?php echo htmlentities($result->category);?></td>
											<td><?php echo htmlentities($result->shelf);?></td>
											<td><?php echo htmlentities($result->selling_pricce);?></td>
											<td><?php echo htmlentities($result->company_price);?></td>
											<td><?php echo htmlentities($result->strength).($result->unit);?></td>  
											<td><?php echo htmlentities($result->menufacturer);?></td>	
											<td>
											<?php
											if($result->status == 1){
												echo "Active";
											}else { echo "Inactive";}									
											?></td>
											
											<td>											
											<a href="medicine_edit.php?edit=<?php echo htmlentities($result->item_code);?>" > <i class="fas fa-edit" aria-hidden="true"></i></a> 
                                            <a href="barcode.php?bcode=<?php echo htmlentities($result->item_code);?>" > <i class="fas fa-barcode" aria-hidden="true"></i></a> 
                                            <a href="medicine_view.php?view=<?php echo htmlentities($result->item_code);?>" > <i class="fas fa-eye" aria-hidden="true"></i></a>                                         
											<a href="medicine_list.php?del=<?php echo htmlentities($result->item_code);?>" onclick="return confirm('Do you really want to delete this record')"> 
											<i style="color: red;" class="far fa-trash-alt" aria-hidden="true"></i></a>
											</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
									</tbody>
                                    <?php if ($query->rowCount() >35){ ?>
                                    <tfoot>
										<tr>
											<td>#</td>
											<td>Medicine Name</td>
											<td>Generic Name</td>
											<td>Category</td>
											<td>Shelf</td>
											<td>Prics</td>
											<td>Company Price</td>
											<td>Strength</td>										
                                            <td>Company</td>
											<td>Status</td>
											<td>action </td>
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

