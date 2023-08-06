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
		if(isset($_POST['submit']))
	  		{
			
			$c_name=$_POST['c_name'];
			$c_phone=$_POST['c_phone'];
			$c_address=$_POST['c_address'];
			$status=$_POST['radio_value'];

			$sql="INSERT INTO customertable (Name, Phone,Address,Status,shopId,branchId) 
			VALUES(:c_name,:c_phone,:c_address,:radio_value,:shopId,:branchId)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':c_name',$c_name,PDO::PARAM_STR);
			$query->bindParam(':c_phone',$c_phone,PDO::PARAM_STR);
			$query->bindParam(':c_address',$c_address,PDO::PARAM_STR);
			$query->bindParam(':radio_value',$status,PDO::PARAM_STR);
			$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
			$query->bindParam(':branchId',$_SESSION['user']['branchId'],PDO::PARAM_STR);

			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
	
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
			
		<title>D-shop | POS</title>
		<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
		<!-- Font awesome -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<!-- Sandstone Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
		
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="../css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="../css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="../css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="../css/style.css">
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		
		<style>
			.footer {
				/* position: fixed; */
				/* margin: 0 auto; */
				/* bottom: 0; */
				/* width: 100%; */
				background-color: white ;
				color: black;
				z-index: 5;
			}
			.dataTables_filter {
				display: none;
			}
			.bg-style{
				background-image: linear-gradient(to right, rgba(202, 166, 227,.3), rgba(133, 160, 199,.3), rgba(202, 166, 227,.3));
			}
		</style>

	</head>
	
	<body>
		<?php 
		include('../includes/header.php');
		?>
		
		<div class="ts-main-content">
			<?php include('../includes/leftbar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="w-100 m-0 px-1">
							<div class="card" style="margin-right: 2px;">
								<div class="card-header  d-flex justify-content-between align-items-center">
									<div class="fs-3">
										Sells table
									</div>
									<div>
										<a id="ClearCard" href="#"><button type="button" class="btn btn-info"><i style='color: red;' class='far fa-trash-alt me-2' aria-hidden='true'></i> Clear Card</button></a>		
									</div>
								</div>
								<div class="card-body" >
									<div class="row d-flex">
										<!-- button Part start here -->
										<!-- <div class="col-12 col-md-2 col-lg-1">
											<div id="button_list" class="d-flex flex-row justify-content-center flex-wrap flex-sm-row flex-md-column flex-lg-column flex-xl-column">
												<?php $sql = "SELECT * from  medicine_category order by  MedicineCategory ASC";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1; 
												if($query->rowCount() > 0)
												{
													foreach($results as $result)
													{
														if($result->MedicineCategoryStatus ==1 || $result->MedicineCategoryStatus ==0)
														{?>
															<div class="px-1">
																<button onClick="Category_function(this.id)" class="form-control btn btn-md btn-success" id="<?php echo $result->MedicineCategory?>" style="margin: 5px;"><?php echo $result->MedicineCategory?></button>
															</div>
														<?php 
														}
													}
												}?>
											</div>
										</div> -->
										<!-- button Part ends here -->

										<!-- Medicine list Part starts here -->
										<div class="col-12 col-md-10 col-lg-2">
											<div class="row px-2 d-flex flex-column flex-sm-row flex-md-row justify-content-between">
												<div class="col-md-12 ">
													<input class="form-control" onkeyup="myFunction()" id="myInput" type="search" placeholder="Search Products">
												</div>
											</div>
											<div class="row  p-2">
												<div class="col-12" style="overflow-x: hidden;overflow-y: scroll; height: 700px;">
													<table id="" class="display ali table table-striped table-bordered table-hover" cellspacing="0" width="100%">
														<thead>
															<tr class="bg-style">
																<!-- <th class = "text-center w-25">SL</th> -->
																<th class = "text-center">Products Name</th>
																<!-- <th class = "text-center w-50" >action </th> -->
															</tr>
														</thead>
														<tbody id="myTable">
															<?php $sql = "SELECT * from  medicine_list WHERE shopId=:shopId ORDER BY medicine_name ASC ";
															$query = $dbh -> prepare($sql);
															$query-> bindParam(':shopId', $_SESSION['user']['shopId'], PDO::PARAM_STR);
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
															$cnt=1;
															if($query->rowCount() > 0)
															{
																foreach($results as $result)
																{ 
																	if($result->status ==1)
																	{?>	
																		<tr style="user-select: none"  id="<?php echo htmlentities($result->item_code);?>" onClick="reply_click(this.id)" class="header">
																			<!-- <td hidden class="text-center"><?php echo htmlentities($cnt);?></td> -->
																			<td style="visibility: none;" hidden class="text-center"><?php echo htmlentities($result->category);?> - All</td>
																			<td class="text-center fw-bold" ><?php echo htmlentities($result->medicine_name);?>  
																				<input type="hidden" name= "MedicineName" value="<?php echo htmlentities($result->medicine_name);?>">
																			</td>
																			<!-- <td style="text-align: center; ">
																				<p  id="<?php echo htmlentities($result->item_code);?>" style="user-select: none" class="btn w-100 btn-primary" value="">add</p>
																				<input id="BtnNo" class="btn btn-sm btn-primary" type="hidden" value="<?php echo htmlentities($cnt);?>">
																			</td> -->
																		</tr>
																	<?php $cnt=$cnt+1; 
																	}
																}
															}?>	
														</tbody>
													</table>
												</div>


												<!-- <div class="row p-0 m-0">
													<div class="col-12 flex-wrap d-flex justify-content-between w-100" style="overflow-x: hidden;overflow-y: scroll; height: 700px;" >
														<?php
														// $sql = "SELECT * from  medicine_list ORDER BY medicine_name ASC ";
														// $query = $dbh -> prepare($sql);
														// $query->execute();
														// $results=$query->fetchAll(PDO::FETCH_OBJ);
														// $cnt=1;
														if($query->rowCount() > 0)
														{
															foreach($results as $result)
															{ 
																if($result->status ==1)
																{?>
																<div class="col-4 m-1">
																	<div class="card ">
																		<img src="pic/ali2.jpg" class="card-img-top" alt="...">
																		<div class="card-body">
																			<h5 class="card-title"><?php echo htmlentities($result->medicine_name);?></h5>
																		</div>
																	</div>
																	</div>
																	<div class="col-6 col-md-4 col-lg-3 p-1 ">
																		<div class="card">
																		<img src="./pic/ali2.jpg" class="h-100 card-img-top" alt="...">
																		<div class="card-body">
																			<p class="text-center fw-bold">
																				<?php 
																				// echo htmlentities($result->medicine_name);
																				?></p>
																		</div>
																		</div>
																	</div>
																<?php $cnt=$cnt+1; 
																}
															}
														}?>
													</div>
												</div> -->



											</div>
										</div>
										<!-- Medicine list Part ends here -->

										<!-- Calculation table start herer -->
										<div class="col-12 col-md-12 col-lg-10 mb-5">
											<div class="row">
												<div class="col-12 d-flex justify-content-between ">
													<div class="col-xl-3">
														<input class="form-control" id="AddItemById" type="search" placeholder="Bar Code / Item Code">
													</div>
													<div class="col-xl-5 ">
														<div class="input-group mb-3">
															<input onchange="DuePerson(this.value)" onkeyup="CustomerNameSearch(this.value)" name="companyname" value="Walking Customer" class="form-control" list="datalistOptionss" id="exampleDataListf" >
																<datalist id="datalistOptionss" required>
																	
																</datalist>
															<button class="btn btn-outline-primary " type="button" onclick="clean_filed()" id="cln_id">Clean</button>
															<button class="btn btn-outline-primary" type="button" id="add_person" data-toggle="modal" data-target="#exampleModal2">Add</button>
														</div>	
													</div>
												</div>
											</div>
											<div class="row">
												<table id="" class="col-12 display table  table-bordered table-hover w-100" cellspacing="0">
													<thead>
														<tr class='bg-style'>						
															<th style="text-align: center; width:20%">Name </th>
															<th style="text-align: center; width:10%" >Batch </th>
															<th style="text-align: center; width:10%" >Quantity </th>
															<th style="text-align: center; width:8%" >price </th>
															<th style="text-align: center; width:10%" >Total </th>
															<th style="text-align: center; width:12%" >Action</th> <p></p>
														</tr>
													</thead>
													<tbody id="DisplayData">
														<?php
														if(isset($_SESSION['items']))
														{
															foreach($_SESSION['items'] as $key => $value)
															{
																$Itotal = $value['SellQty']*$value['Price'];
																echo "<tr>						
																		<td class='text-center'> <p class='form-control'>$value[ProductName]</p>  </td>
																		<td class='text-center'> <p class='form-control'>$value[Batch]</p> </td>
																		<td class='text-center'>
																			<input type='number' class='form-control $value[SellQty] text-center' id='$value[ItemId]' onChange='changeQty(this.id,this.value)' value='$value[SellQty]' min='1' max='120'>
																		</td>
																		<td class='iprice text-center'>
																			<p class='form-control' readonly>$value[Price]</p>  
																			<input type='hidden'  id='$value[Price]'  min='1' max='120'>
																		</td>
																		<td class='itotal text-center'><p class='form-control' readonly>$Itotal</p> </td>
																		<td class='text-center'>
																			<p class='btn btn-outline-none tprice p-0 me-1' onClick='remove_item(this.id)' id='$value[ItemId]'><i style='color: red;' class='far fa-trash-alt p-0 m-0' aria-hidden='true'></i></p>
																			<p class='btn btn-outline-none p-0 m-0' onClick='show_item(this.id)' id='$value[ItemId]'><i style='color: red;' class='far fa-eye p-0 m-0' aria-hidden='true'></i></p>
																		</td>
																	</tr>";
															}
														}?>
													</tbody>
												</table>
											</div>
											<div class="row">
												<div class="col-6">
												</div>
												<div class="col-4">
													<div class="col-12 d-flex flex-column justify-content-end">
														<div class="row mb-2">
															<label  for="" class="fw-bold col-6 text-end">Inoice Discount %: </label>
															<div class="col-6">
																<input id="ivoicediscount" onblur="InvoiceDiscount()" type="text" class="form-control text-end" value="" placeholder="0.00">
															</div>
														</div>
														<div class="row mb-2">
															<label for="" class="fw-bold col-6 text-end">Total Discount : </label>
															<div class="col-6">
																<input id="totaldiscount" name="totaldiscount" type="text" disabled class="form-control text-end" value="" placeholder="0.00">
															</div>
														</div>
														<div class="row mb-2">
															<label for="" class="fw-bold col-6 text-end">Total Vat : </label>
															<div class="col-6">
																<input type="text" id="vat" disabled class="form-control text-end" name="" value="" placeholder="0.00">
															</div>
														</div>
														<div class="row mb-2">
															<label for="" class="fw-bold col-6 text-end">Grand Total : </label>
															<div class="col-6">
																<input name="grandtotal" id="Total" type="text" style="font-weight: bold; font-size:15px" disabled class="form-control text-end" name="mobile" value="" placeholder="0.00">
															</div>
														</div>
														<div class="row mb-2">
															<label for="" class="fw-bold col-6 text-end">Privious Due : </label>
															<div class="col-6">
																<input onchange="FullPayment()" type="text" name="previousdue" id="previousdue" class="form-control text-end"  value="" placeholder="0.00">
															</div>
														</div>
														<div class="row mb-2">
															<label for="" class="fw-bold col-6 text-end"> Total : </label>
															<div class="col-6">
																<input id="paidamount" type="text" disabled class="form-control text-end" name="" value="" placeholder="0.00">
															</div>
														</div>
													</div>
												</div>
												<div class="col-2">
												</div>
											</div>
										</div>
										<!-- Calculation table ends herer -->
									</div>  
									<!-- card body row ends here -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer  -->
		<div class="footer row fixed-bottom border border-info">
			<div class="col-12" >
					<div class="d-flex flex-wrap justify-content-center justify-content-lg-between justify-content-xl-between  p-2">
						<div class="mb-md-2">
							<label class="fs-5 fw-bold"  for="">Payable Amount</label>
							<input disabled onchange="PaidAmountttt()" id="paidamount2" name="paidamount" class="ms-2 fs-5 fw-bold outline-primary text-end" style="border-radius: 5px; width: 120px;" type="float" placeholder="0.00">
							<label class="fs-5 fw-bold ml-3" for="">Paid Amount</label>
							<input onchange="PaidAmount()" id="paidamount3" name="" class="ms-2 fs-5 fw-bold outline-primary text-end" style="border-radius: 5px; width: 120px;" type="float" placeholder="0.00">
							<label id="DuiLable" class="fs-5 fw-bold ms-2" for=""></label>
							<label id="duelbl" name="dueamount" class="fs-5 fw-bold ms-2" for=""></label>
						</div>
											
						<!-- <form action="" method="POST"> -->
							<div class="d-flex align-items-center">
								<div class="form-check form-switch pe-2">
									<input class="form-check-input" value="1" type="checkbox" name="switch" id="flexSwitchCheckDefault">
									<label class="form-check-label" for="flexSwitchCheckDefault">msg</label>
								</div>
								<p id="fullPaidbtn" onclick="FullPayment2()" class="me-2 btn btn-warning " >Full Paid</p>
								<!-- <a href="query2.php"><button class="me-2 btn btn-md btn-primary align-items-center" for="">Cash Payment</button></a> onclick="OrderConfirm()" -->
								<p onclick="OrderConfirm()" class="me-2 btn btn-primary" for="">Cash Payment</p>
								<label class="me-3 btn btn-info " for="">Bank Payment</label>
							</div>	
						<!-- </form>												 -->
					</div>

			</div>
		</div>
		<!-- footer part end -->

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">																
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title text-center" id="Modal_title"></h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body bg-style" id="mbody">

					</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div> -->
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

		<script>
			let emiinfo= document.getElementById("emi_info");
			function emi_display(clickedid){
				let a = event.target.value
				if(a==1){
					document.getElementById("flexSwitchCheckDefault2").value = "2";
					emiinfo.classList.remove("d-none")
				}
				else{
					document.getElementById("flexSwitchCheckDefault2").value = "1";
					emiinfo.classList.add("d-none")
				}				
			}
		</script>												

		<script>
			let Iprice = document.getElementsByClassName('iprice');
			let Iquantity = document.getElementsByClassName('qty');
			
			
			function subTotal(){
				let Itotal = document.getElementsByClassName('itotal');
				let gtotal = document.getElementById('Total');
				let paidamount2 = document.getElementById('paidamount2');
				var Gtotal=0;
				for (i=0; i<Itotal.length; i++){
					Gtotal= Gtotal+Number(Itotal[i].innerText);

				}
				gtotal.value=Gtotal;
				paidamount2.value=Gtotal;
			
			} 

			function InvoiceDiscount() {
				let getdis =document.getElementById('ivoicediscount').value;
				let totaldis = document.getElementById('totaldiscount');
				let gtotal = document.getElementById('Total');
				subTotal();
				if(getdis.length<=0){
					totaldis.value="0.00";
				}else{
				Totaldiscount =((Number(getdis)*Number(gtotal.value))/100);
				totaldis.value=Totaldiscount.toFixed(2);
				var amount =Number((gtotal.value)-Totaldiscount);
				gtotal.value=amount.toFixed(3);
				FullPayment();
				PaidAmount();
				}
			}
			function PaidAmount() {
				let payableamount = document.getElementById('paidamount2');
				let paidamount = document.getElementById('paidamount3');
				let Duelabel = document.getElementById('duelbl');
				let Due_Lable = document.getElementById('DuiLable');
				// let predue = Number(document.getElementById('previousdue').value);
				if(Number(paidamount.value)==Number(payableamount.value)){
					Due_Lable.innerHTML="Thank you For Full Paid";
					Duelabel.innerHTML='';
				}
				else{
					gtotal = Number((payableamount.value)-Number(paidamount.value)).toFixed(2);
					if(Number(gtotal)<=0){
						Due_Lable.innerHTML="Thanks, Change Amount :";
						Duelabel.innerHTML='';
					}
					else{
						Due_Lable.innerHTML="Due Amount :";
					}
					Duelabel.innerHTML=gtotal;
				
				}
			}
			function FullPayment2(){
				var gtotal = Number(document.getElementById('Total').value);
				var due_amount = Number(document.getElementById('previousdue').value);
				gtotal = gtotal + due_amount;
				let paidamount3 = document.getElementById('paidamount3');
				paidamount3.value=gtotal.toFixed(2);
				PaidAmount();

			}
			function FullPayment() {
				var gtotal = Number(document.getElementById('Total').value);
				var due_amount = Number(document.getElementById('previousdue').value);
				gtotal = gtotal + due_amount;
				let paidamount = document.getElementById('paidamount');
				let paidamount2 = document.getElementById('paidamount2');
				paidamount.value=gtotal.toFixed(2);
				paidamount2.value=gtotal.toFixed(2);
			}

			$(document).ready(() =>{
				$("#AddItemById").blur(() =>{
					var InputValue = $("#AddItemById").val();
					if (InputValue.length >= 1) {
						reply_click(InputValue);
					} 
				});
			});
			// FullPayment();
			subTotal();

			function CustomerNameSearch(inputValue){
				const xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
							// alert(this.responseText);
							$('#datalistOptionss').html(this.responseText);
					}
				};

				xmlhttp.open('GET', `../query4.php?CustomberName=${inputValue}`, true);
				xmlhttp.send();
			}
		</script>
		
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
<?php } ?>