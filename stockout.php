
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
	
	<title>PMS-Purchase invoice List </title>
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
										Stock Out Medicine Information
									</div>
									<div >
										<a href="stockavailable.php" class="btn btn-info"> <i class="fas fa-align-justify mr-2"></i> Available Stock List</a>
										<a href="add_purchase.php" class="btn btn-info"> <i class="fa fa-credit-card" aria-hidden="true"></i> Add Purchase</a>
                                        <!-- <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Due</button> -->
                                        
									</div>
								</div>
                            </div>
							<div class="card-body">
                                <a href="download-records.php" style="color:red; font-size:16px;">Download Stock out Medicine list</a>
								<div class="row ">
									<div class="col-12 col-md-12 col-lg-12 col-xl-12 d-flex row flex-sm-column table-responsive">
								
										<table id="zctb" class="display table bg-light table-bordered table-hover" >
											<thead class="bg-style">
												<tr>
													<th>#</th>
													<th>Name</th>
													<th class="text-center">Batch</th>
													<th class="text-center">InQty</th>
													<th class="text-center">OutQty</th>
													<th class="text-center">RestQty</th>
													<th class="text-center">Mprice</th>
													<th class="text-center">MRP</th>
													<th class="text-center">ExDate</th>
													<th class="text-center">Status</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>

												<?php 
												$sql = "SELECT stocktable.BatchNumber, stocktable.InQty,stocktable.OutQty, stocktable.RestQty,stocktable.PurPrice,stocktable.SellPrice,
												stocktable.Date,stocktable.Status, medicine_list.medicine_name from stocktable LEFT JOIN medicine_list ON stocktable.Item_code = 
												medicine_list.item_code WHERE stocktable.RestQty = 0 ORDER BY stocktable.ID DESC";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												
												$cnt=1;
												if($query->rowCount() > 0)
												{
												foreach($results as $result)
												{				?>	
												<tr id="row-<?php echo $cnt;?>">
													<td><?php echo htmlentities($cnt);?></td>
													<td ><p id="name-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo htmlentities($result->medicine_name);?></p>
														<p hidden><?php echo htmlentities($result->BatchNumber);?></p>
													</td>
													<td class="text-end"><p id="Batch-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->BatchNumber;?></p></td>
													<td class="text-end"><p id="InQty-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->InQty;?></p></td>
													<td class="text-end"><p id="OutQty-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->OutQty;?></p></td>
													<td class="text-end"><p id="RestQty-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->RestQty;?></p></td>
													<td class="text-end"><p id="Mprice-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->PurPrice;?></p></td>
													<td class="text-end" ><p id="MRP-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->SellPrice;?></p></td>
													<td class="text-center"><p id="Date-<?php echo htmlentities($result->BatchNumber);?>" class="form-control"><?php echo $result->Date;?></p></td>
													<td class="text-center">
													<?php 
														if($result->Status==0){
															?>
															<button id="<?php echo htmlentities($result->BatchNumber);?>" onclick="StatusCng(event, '1')" type="button" class="btn btn-warning btn-sm">Deactive</button>
															<?php
														}
														else { ?>
															<button id="<?php echo htmlentities($result->BatchNumber);?>" type="button" onclick="StatusCng(event, '0')" class="btn btn-success btn-sm">Active</button>
															<?php
														}
														
														?>
													</td>
													<td class="text-center">
														<p id="<?php echo htmlentities($result->BatchNumber);?>" type="button" onclick="editPrice(event)" class="btn btn-warning btn-sm">edit</p>
														<button id="<?php echo htmlentities($result->BatchNumber);?>" type="button" onclick="DeleteBatch(event)" class="btn btn-dark btn-sm">Del
													</button>
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
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<!-- <div class="modal-dialog modal-dialog-centered modal-xl"> -->
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody2">
			
				</div>
			</div>
		</div>
	</div>
	<script>
		const StatusCng = (event, status)=>{
			let clickedId = event.target.id;
			let BatchNumber = document.getElementById("Batch-"+clickedId).innerHTML;
			if(status ==1){
				event.target.innerHTML = "active"
				event.target.classList.remove("btn-warning");
				event.target.classList.add("btn-success");
			} else{
				event.target.innerHTML = "Deactive"
				event.target.classList.remove("btn-success");
				event.target.classList.add("btn-warning");

			}
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					swal({
						title: 'Stock Medicine',
						text: this.responseText,
						icon: 'success',
						dangerMode: true,
					});
				}
			};
			xmlhttp.open('GET', `query2.php?StatusCng=${BatchNumber}&Status=${status}`, true);
			xmlhttp.send();

		}
		const DeleteBatch = (event) =>{
			let clickedId = event.target.id;
			const xmlhttp = new XMLHttpRequest();
			if(clickedId.length>=2){
				let text = "Want to delete?\nEither OK or Cancel.";
				if (confirm(text) == true) {
					xmlhttp.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							event.target.parentNode.parentNode.remove(event.target.parentNode.parentNode)
							swal({
							title: 'Stock Delete',
							text: this.responseText,
							icon: 'success',
							dangerMode: true,
						});
					}
				};
				xmlhttp.open('GET', `query2.php?DeleteBatch=${clickedId}`, true);
				xmlhttp.send();
				} else {
					return;
				}
			}
		}
		const editPrice = (event) =>{
			let clickedId = event.target.id;
			let Mprice = document.getElementById("Mprice-"+clickedId).innerHTML;
			let MRP = document.getElementById("MRP-"+clickedId).innerHTML;
			let name = document.getElementById("name-"+clickedId).innerHTML;
			let Date = document.getElementById("Date-"+clickedId).innerHTML;
			let RestQty = document.getElementById("RestQty-"+clickedId).innerHTML;
			$('#mbody2').html(`
			<div class="card-body">
						<div class="">
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Name : </label>
								<div class="col-sm-9">
									<input id="medicineName" type="text" value="${name}" readonly class="form-control">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Batch : </label>
								<div class="col-sm-9">
									<input id="Batch" type="text" value="${clickedId}" readonly class="form-control">
								</div>
							</div>
							<div class="row mb-3">
								<label for="" class="col-sm-3 col-form-label text-start text-sm-end">Rate : </label>
								<div class="col-sm-9">
									<input id="MRP" type="text" value="${MRP}"  class="form-control">
								</div>
							</div>
							
						</div>
						<div class="hr-dashed"></div>
						<div class="col-md-12">
							<div class="update d-grid gap-2 d-md-flex d-sm-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
								<button style="min-width: 150px;" class="btn btn-danger me-md-2" type="reset">Reset</button>
								<button style="min-width: 150px;" id="${clickedId}" class="btn btn-success" onclick="updatePrice(this.id)" name="submit" >Submit</button>
							</div>
						</div>	
					</div>`)
			$('#exampleModal2').modal('show');
			
		}
		const updatePrice =(batch) =>{
			let updateRate = document.getElementById('MRP').value;
			const xmlhttp = new XMLHttpRequest()
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					$('#exampleModal2').modal('hide');
					document.getElementById('MRP-'+batch).innerHTML=updateRate;
					swal({
						title: 'Update Price',
						text: this.responseText,
						icon: 'success',
						dangerMode: true,
					});
				}
			};
			xmlhttp.open('GET', `query2.php?updatePrice=${batch}&price=${updateRate}`, true);
			xmlhttp.send();
		}
	</script>


	<!-- Loading Scripts -->
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

<?php } ?>