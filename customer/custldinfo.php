
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
	
	if(isset($_POST['custldinfo']))
	  	{
			$id = $_GET['custId'];
	
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
	
	<title>PMS | Individual Ledger </title>
	<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<!-- Sandstone Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
	<!-- Bootstrap Datatables -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="../css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
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
						<?php
						// $id = $_GET['custId'];
						// $sql = "SELECT Name,Address, Phone FROM customertable WHERE ID=:id"; 
						// $query = $dbh -> prepare($sql);
						// $query->bindParam(':id',$id,PDO::PARAM_STR);
						// $query->execute();
						// $result2=$query->fetch(PDO::FETCH_OBJ);
						
						?>
						<div class="card">
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Individual Ledger Information
									</div>
									<div >
                                    <a href="customer_ledger.php" class="btn btn-primary mr-3"><i class="fas fa-list mr-2" style="margin-right: 10px;"></i>ledger list</a>    
									<button type="button" class="btn btn-success mr-3"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i>Customer ledger</button>                                              
									</div>
								</div>
                            </div>
							<div class="card-body">
                                <a href="#" style="color:red; font-size:16px;">Download Individual ledger info</a>
								<table id="" class="display table table-striped table-bordered table-hover" cellspacing="0">
								<?php
									$id = $_GET['custId'];
									$sql = "SELECT Name,Address, Phone FROM customertable WHERE ID=:id AND shopId=:shopId AND branchId=:branchId"; 
									$query = $dbh -> prepare($sql);
									$query->bindParam(':id',$id,PDO::PARAM_STR);
									$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
									$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);
									$query->execute();
									$result2=$query->fetch(PDO::FETCH_OBJ);
									
									?>
									<div class="row">
										<div class="col-12  d-flex">
											<div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-1">
												<h5 class="">Name : </h5> 
												<h5 class="">Phone : </h5> 
												<h5 class="">Address : </h5> 
											</div>
											<div class="col-6">
												<h5 class=""><?php echo htmlentities($result2->Name);?></h5> 
												<h5 class=""><?php echo htmlentities($result2->Phone);?></h5> 
												<h5 class=""><?php echo htmlentities($result2->Address);?></h5> 
											</div>											
										</div>
									</div>
									<thead class="bg-info">
										<tr class="text-end">
										    <th>#</th>
                                            <th class="text-center">Date</th>
											<th>Debit</th>
											<th>Pre Due</th>
											<th>Total</th>
											<th>Credit</th>
											<th>New Due</th>
											<th class="text-center">Invoice ID</th>
										</tr>
									</thead>
									
									<tbody style="overflow-x: hidden;overflow-y: scroll;">

                                        <?php 
                                        $cnt=1;
										$id = $_GET['custId'];
										$sql = "SELECT * from customerledger WHERE CustomerID=:id";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':id',$id,PDO::PARAM_STR);
										$query->execute(); 
										$results=$query->fetchAll(PDO::FETCH_OBJ);
                                        if($query->rowCount() > 0)
                                        {
											foreach($results as $result)
											{				?>	
											<tr class="text-end">
												<td class="bg-info"><?php echo htmlentities($cnt);?></td>
												<td class="text-center" style="background-color: rgb(189, 242, 237);"><?php echo $result->Date;?></td>
												<td style="background-color: rgb(189, 242, 212);"><?php echo htmlentities($result->Debit);?></td>
												<td style="background-color: rgba(242, 189, 236,0.5);"><?php echo htmlentities($result->PreDue);?></td>
												<td style="background-color: rgb(189, 242, 237);"><?php echo htmlentities($result->Total);?></td>
												<td style="background-color: rgb(189, 242, 212);"><?php echo htmlentities($result->Credit);?></td>
												<td style="background-color: rgba(242, 189, 236,0.5);"><?php echo htmlentities($result->NewDue);?></td>
												<td style="background-color: rgba(189, 242, 237, 0.8);" class="text-center"> 
													<?php 
													if($result->Debit != 0){
														?> 
															<p onclick="invodetails(this.id)" id="<?php echo htmlentities($result->InvoiceId);?>" class="btn btn-info btn-sm">details</p>
															<!-- <p onclick="invodetails(this.id)" id="<?php echo htmlentities($result->InvoiceId);?>" class="btn btn-info btn-sm">details</p> -->
														<?php
													}
													else{
														?> 
															<p title="Only Due Paid" style="cursor: not-allowed;" id="<?php echo htmlentities($result->InvoiceId);?>" class="btn btn-warning btn-sm">No details</p>
														<?php
													}
													
													?>
												</td>
												
											</tr>
										<?php $cnt=$cnt+1; }?>
										<tfoot>
											<tr>
												<!-- <td class="text-end text-lg bg-black text-white fw-bold" ><br></td> -->
												<td class="text-end text-lg bg-black text-white fw-bold" colspan='6'>Total Due Amount :</td>
												<td class="text-end text-lg bg-black text-white fw-bold"><?php echo htmlentities($result->NewDue);?></td>
											</tr>
										</tfoot>
										<?php
									} ?>
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
	<div class="modal fade" id="exampleModal8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																				
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Invoice Product info</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="mbody8">
					<div class=" text-center">
						<h1 class="" id="invoiceids"></h1>
						<!-- <button onclick="InvoicePrint(this.id)" type="button" id="print" class="btn btn-warning"><i class="fas fa-print mr-2" style="margin-right: 10px;"></i> <span id="print"></span> Print</button>
						<button onclick="InvoicePrint(this.id)" type="button" id="download" class="btn btn-info"><i class="fas fa-download mr-2" style="margin-right: 10px;"></i> Download</button> -->
						<!-- <a href="customer_ledger.php" class="btn btn-primary mr-3"><i class="fas fa-print mr-2" style="margin-right: 10px;"></i>ledger list</a>   -->
					</div>
					<div class="card-body">
						<div class="col-12 rounded">
							<div class="col-12 d-flex flex-column justify-content-end">
								<table class="display table table-striped table-bordered border border-dark table-hover">
									<thead class="bg-style">
										<tr>
											<th>SN</th>
											<th>Name</th>
											<th>Batch</th>
											<th>Qty</th>
											<th>Price</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody id="invoice_details">
										<!-- show invoice information here using ajax-->
									</tbody>
								</table>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function invodetails(clicked_id) {
			var tbody = document.getElementById('invoice_details');
			var invoiceids = document.getElementById('invoiceids');
			const xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
						invoiceids.innerHTML="Invoice No : "+clicked_id;
						tbody.innerHTML = this.responseText;
						$('#exampleModal8').modal('show');
				}
			};
			xmlhttp.open('GET', `../query.php?invodetails=${clicked_id}`, true);
			xmlhttp.send();
		}	
		const InvoicePrint =(event) =>{
			const name =event.target.name
			const id =event.target.id
			window.open(`http://localhost:8080/rbkssl/invoice/invoice.php?invoiceid=${id}&ptype=${name}`, "_blank")
		}
	</script>
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

