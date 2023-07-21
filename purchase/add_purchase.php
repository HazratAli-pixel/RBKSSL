
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
		if(isset($_POST['submit']))
	  		{
			$M_ID = $_POST['manufacturer_id'];
			$invoice_no = $_POST['invoice_no'];
			$payment_type = $_POST['payment_type'];
			$date = $_POST['date'];
			$sub_total = $_POST['sub_total'];
			$vat = $_POST['vat'];
			$discount = $_POST['discount'];
			$grand_total_price = $_POST['grand_total_price'];
			$paid_amount = $_POST['paid_amount'];
			$due_amount = $_POST['due_amount'];
			$userid = $_SESSION['alogin'];
			
			$sql2="INSERT INTO companyinvoice (InvoiceId, CompanyId, Subtotal,Vat,Discount,G_total,Paid,DueAmount,Date,UserId) 
			VALUES(:invoice_no,:M_ID,:sub_total,:vat,:discount,:grand_total_price,:paid_amount,:due_amount,:date,:userid)";
			$query = $dbh->prepare($sql2);
			$query->bindParam(':invoice_no',$invoice_no,PDO::PARAM_STR);
			$query->bindParam(':M_ID',$M_ID,PDO::PARAM_STR);
			$query->bindParam(':sub_total',$sub_total,PDO::PARAM_STR);
			$query->bindParam(':vat',$vat,PDO::PARAM_STR);
			$query->bindParam(':discount',$discount,PDO::PARAM_STR);
			$query->bindParam(':grand_total_price',$grand_total_price,PDO::PARAM_STR);
			$query->bindParam(':paid_amount',$paid_amount,PDO::PARAM_STR);
			$query->bindParam(':due_amount',$due_amount,PDO::PARAM_STR);
			$query->bindParam(':date',$date,PDO::PARAM_STR);
			$query->bindParam(':userid',$userid,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();

			$product_id = $_POST['product_id'];
			$batch_id = $_POST['batch_id'];
			$expeire_date = $_POST['expeire_date'];
			$product_quantity = $_POST['product_quantity'];
			$product_rate = $_POST['product_rate'];
			$mrp = $_POST['mrp'];

			$i= count($_POST['batch_id']);
			$v= $_POST['batch_id'][0];
			$v= "sdafsadfsdaf";

			foreach($batch_id as $key => $value){
				$sql = "INSERT INTO purchaseslist (InvoiceId,ProductId,BatchId,Qty,Mprice,MRP) VALUES 
				('".$invoice_no."','".$product_id[$key]."','".$batch_id[$key]."','".$product_quantity[$key]."','".$product_rate[$key]."','".$mrp[$key]."')";
				$query = mysqli_query($con,$sql);
			}
			header("refresh:1;add_purchase.php");
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
	
	<title>PMS-Add Purchase info</title>
	<link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<style>
		/* datalist {
  			display: none;
		} */
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
							<div  class="card-header">
                                <div class="d-flex justify-content-between align-items-center h-100px">
		  							<div style="font-size: 20px; " class="bg-primary;">
										Add Purchase Information
									</div>
									<div >
                                        <a href="purchase_list.php" class="btn btn-warning mr-3"><i class="fa fa-info-circle me-3" aria-hidden="true"></i> Purchase List</a>                                              
                                        <!-- <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#exampleModal2"><i class="fas fa-plus mr-2" style="margin-right: 10px;"></i> Add Customer</button>                                               -->
									</div>
								</div>
                            </div>
							<div class="card-body">
								<form  id="purchase_form" action=""  method="post" >
									<div class="form-group row mb-2">
										<label for="manufacturer" class="col-md-2 text-end col-form-label">Manufacturer <i class="text-danger"> * </i>:</label>
										<div class="col-md-4">
										<?php 
														$cname="SELECT ID, name, Status from company";
														$cquery = $dbh -> prepare($cname);
														$cquery->bindParam(':barcode',$id,PDO::PARAM_STR);
														$cquery->execute();
														$results=$cquery->fetchAll(PDO::FETCH_OBJ);							   
														?>
											<div class="">
												<select name="manufacturer_id" class="form-control select2" id="manufacturer_id" tabindex="" >
														<option value="" selected="selected">Select Manufacturer</option>
														<?php
														foreach($results as $result)
																{
																	if($result->Status==1)
																	{?>	
																		<option id="" value="<?php echo htmlentities($result->ID);?>"><?php echo htmlentities($result->name);?></option>
																		<?php 
																	} 
																}?>
												</select>
                        					</div>
                    					</div>
                     						<label for="date" class="col-md-2 text-end col-form-label">Date <i class="text-danger"> * </i>:</label>
                    						<div class="col-md-4">
												<?php 
												date_default_timezone_set('Asia/Dhaka');
												$date = date('Y-m-d');
												?>
                        						<div class="">
													<input type="text" name="date" class="form-control p-2 datepicker" id="purdate" placeholder="" value="<?php echo $date?>" tabindex="2" >
												</div>
                       
                    						</div>
                					</div>
										<div class="form-group row mb-2">
											<label for="invoice_no" class="col-md-2 text-end col-form-label">Invoice No<i class="text-danger"> * </i>:</label>
											<div class="col-md-4">
												<div class=""> 
													<input type="text" class="form-control p-2 valid_number" name="invoice_no" id="invoice_no" placeholder="Invoice No" value="" tabindex="3">
												</div>
											</div>
											<label for="details" class="col-md-2 text-end col-form-label">Details:</label>
											<div class="col-md-4">
												<div class="">
													<input type="text" class="form-control p-2" name="details" id="details" placeholder="Details" value="" tabindex="4">
												</div>
											</div>
										</div>
										<div class="form-group row mb-2">
											<label for="payment_type" class="col-md-2 text-end col-form-label">Payment Type<i class="text-danger"> * </i>:</label>
											<div class="col-md-4">
												<div class="">	
													<select name="payment_type" id="payment_type" onchange="bank_payment(this.value)" class="form-control p-2 select2" tabindex="5" >
														<option value="1" selected="selected">Cash Payment</option>
														<option value="2">Bank Payment</option>
													</select>
												</div>
											</div>
											<label for="bank" class="col-md-2 text-end bank_div col-form-label">Bank:</label>
											<div class="col-md-4 bank_div" id="bank_div">
												<div class="">
												<?php 
														$cname="SELECT ID, name, Status from company";
														$cquery = $dbh -> prepare($cname);
														$cquery->bindParam(':barcode',$id,PDO::PARAM_STR);
														$cquery->execute();
														$results=$cquery->fetchAll(PDO::FETCH_OBJ);							   
														?>
													<select name="bank_id" class="form-control p-2 select2" id="bank_id">
														<option value="" selected="selected">Select Bank</option>
														<?php 
																foreach($results as $result)
																{
																	if($result->Status==1)
																	{?>	
																		<!-- <option id="" value="<?php echo htmlentities($result->ID);?>"><?php echo htmlentities($result->name);?></option> -->
																		<?php 
																	} 
																}?>
														<option value="12">DBBL</option>
														<option value="13">IBBL </option>
														<option value="14">Agrani Bank</option>
														<option value="15">Janata Bank</option>
														<option value="16">Rupali Bank</option>
														<option value="17">IFIC Bank</option>
														<option value="18">NRBC Bank</option>
														<option value="19">Jamnuna Bank</option>
													</select>
												</div>
											</div>
										</div>
                 						<div class="table-responsive pt-2">
                            				<table class="table table-bordered border-muted table-hover" id="purchaseTable">
                                				<thead class="border border-dark border-2">
													<tr class="">
														<th class="text-center"><nobr>Product name<i class="text-danger">*</i></nobr></th> 
														<th class="text-center"><nobr>Product Id<i class="text-danger"></i></nobr></th>
														<th class="text-center"><nobr>Quantity <i class="text-danger">*</i></nobr></th>
														<th class="text-center"><nobr>Manufacturer Price<i class="text-danger">*</i></nobr></th>
														<th class="text-center"><nobr>MRP <i class="text-danger">*</i></nobr></th>
														<th class="text-center"><nobr>Total Purchase Price</nobr></th>
														<th class="text-center"><nobr>Action</nobr></th>
                                        			</tr>
                                				</thead>
												<tbody id="addPurchaseItem">
													<tr id="row_1">
														<td class="span3 manufacturer">
															<!-- <input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_list_purchase(1);" placeholder="Medicine Name" id="product_name_1" tabindex="6" >
															<input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>
															<input type="hidden" class="sl" value="1"> -->
															<input name="companyname" value="" class="form-control" onblur="product_list_purchase2(1)" onkeyup="product_list_purchase(1);" list="datalistOptionss_1" id="exampleDataListf_1" >
															<input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId" value="">
															<datalist id="datalistOptionss_1" required></datalist>
														</td>
														<td>
															<input type="text" name="batch_id[]" id="batch_id_1" class="batch_class form-control text-end"  tabindex="7" placeholder="Product Id">
														</td>
													
														<td class="text-end">
															<input type="text" name="product_quantity[]" id="quantity_1" class="form-control text-end store_cal_1" onkeyup="purchase_calculation(1),checkqty(1);" onchange="purchase_calculation(1);" placeholder="0.00" value="" min="0" required="required">
															<input type="hidden" name="unit_qty[]" id="unit_qty_1">
														</td>
														<td class="test">
															<input type="text" name="product_rate[]" onkeyup="purchase_calculation(1),checkqty(1);" onchange="purchase_calculation(1);" id="product_rate_1" class="form-control product_rate_1 text-end valid_number" placeholder="0.00" value="" min="0" tabindex="11" required="required">
														</td>
														<td>
															<input type="text" class="form-control valid_number" name="mrp[]" id="mrp_1" required tabindex="12" >
														</td>

														<td class="text-end">
															<input class="form-control total_price text-end" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" >
														</td>
														<td>
															
														</td>
													</tr>
												</tbody>
												<tfoot>
													<tr>
														<td class="text-end" colspan="5"><b>Sub Total:</b></td>
														<td class="text-end">
															<input type="text" id="sub_total"  class="text-end form-control" name="sub_total" placeholder="0.00" readonly="" />
														</td>
														<td>
															<button id="add_invoice_item" type="button" class="btn btn-info" name="add-invoice-item" onClick="add_purchaseRow('addPurchaseItem')" tabindex="14"><i class="fa fa-plus"></i></button>
														</td>
													</tr>
													<tr>
														<td class="text-end" colspan="5"><b>Vat:</b></td>
														<td class="text-end">
															<input type="text" id="vat" onkeyup="purchase_vatcalculation()" class="text-end form-control valid_number" name="vat" placeholder="%" tabindex="15" />
														</td>
														<td>

														</td>
													</tr>
													<tr>
														<td class="text-end" colspan="5"><b>Discount:</b></td>
														<td class="text-end">
															<input type="text" id="discount" onkeyup="disoucnt_calculation()" class="text-end form-control valid_number" name="discount" placeholder="0.00" tabindex="16" />
														</td>
														<td>
															
														</td>
													</tr>
													<tr>
														
														<td class="text-end" colspan="5"><b>Grand Total:</b></td>
														<td class="text-end">
															<input type="text" id="grandTotal" class="text-end form-control" name="grand_total_price" value="0.00" readonly="readonly" />
														</td>
														<td>
													
														</td>
													</tr>
													<tr>
														<td class="text-end" colspan="5"><b>Paid Amount:</b></td>
														<td class="text-end">
															<input type="text" id="paid_amount" class="text-end form-control valid_number" name="paid_amount" onkeyup="paid_calculation()" placeholder="0.00" tabindex="18" />
														</td>
														<td>
													
														</td>
													</tr>
													<tr>
														<td class="text-end" colspan="5"><b>Due Amount:</b></td>
														<td class="text-end">
															<input type="text" id="due_amount" class="text-end form-control" name="due_amount" placeholder="0.00" readonly="readonly" />
														</td>
														<td>
													
														</td>
													</tr>
												</tfoot>
                            				</table>
                        				</div>
               
									<div class="form-group row">
										<div class="col-md-6 text-end">
										</div>
										<div class="col-md-6 text-end">
											<div class="">
												<input type="button" id="full_paid_purchase_tab" class="btn btn-warning" value="Full Paid" tabindex="17" onClick="full_paid_purchase()"/>
												<button type="submit" name="submit"  class="btn btn-success" tabindex="19" id="save_purchase">Save</button>
											</div>
										</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
	

<script>
window.onload = function() {
	bank_payment(1);
};
// $(function() {
// $( "#purdate").datepicker({
//   dateFormat: 'dd-mm-yy'
// });
// });
// const prices = document.querySelectorAll('product_rate_1');
// for (const price of prices){
// 	console.log(price.innerText);
// }


var count = 1;
function add_purchaseRow(click){
				// var id = click
				count = count + 1;
				output = '<tr id="row_'+count+'">';
				output += '<td class="span3 manufacturer">';
				output+='<input name="companyname" value="" class="form-control" onblur="product_list_purchase2('+count+');" onkeyup="product_list_purchase('+count+');" list="datalistOptionss_'+count+'" id="exampleDataListf_'+count+'">';
				output+='<input type="hidden" class="product_id_'+count+'" name="product_id[]" id="SchoolHiddenId" value="">';
				output+='<datalist id="datalistOptionss_'+count+'" required>';
				output+='</datalist>';
				output+='</td>';
				output+='<td> <input type="text" name="batch_id[]" id="batch_id_'+count+'" class="form-control batch_class text-end"  tabindex="7" placeholder="Product Id" /></td>';
				
				
				
				output += '<td class="text-end">   <input type="text" name="product_quantity[]" id="quantity_'+count+'" class="form-control text-end store_cal_'+count+'" onkeyup="purchase_calculation('+count+'),checkqty('+count+');" onchange="purchase_calculation('+count+');" placeholder="0.00" value="" min="0" required="required">';
				output+='<input type="hidden" name="unit_qty[]" id="unit_qty_'+count+'"></td>';
				output += '<td class="test">    <input type="text" name="product_rate[]" onkeyup="purchase_calculation('+count+'),checkqty('+count+');" onchange="purchase_calculation('+count+');" id="product_rate_'+count+'" class="form-control product_rate_'+count+' text-end valid_number" placeholder="0.00" value="" min="0" tabindex="11" required="required" ></td>';
				output += '<td>    <input type="text" class="form-control valid_number" name="mrp[]" id="mrp_'+count+'" required tabindex="12" ></td>';
				output += '<td class="text-end">    <input class="form-control total_price text-end" type="text" name="total_price[]" id="total_price_'+count+'" value="0.00" readonly="readonly" ></td>';
				output += '<td>    <button type="button" class="btn btn-danger" tabindex="13" id="'+count+'" onclick="deleteRow(this.id)"><i class="far fa-trash-alt"></i></button></td>';
				output += '</tr>';
				$('#'+click).append(output);
				
}

function product_list_purchase(clicked_id){
	const inputValue = document.getElementById('exampleDataListf_'+clicked_id).value;
	const manufacturer_id = document.getElementById('manufacturer_id').value;
	// alert(manufacturer_id);
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				// alert(this.responseText);
				$('#datalistOptionss_'+clicked_id).html(this.responseText);
		}
	};

	xmlhttp.open('GET', `query.php?medicineName=${inputValue}&manufacturer_id=${manufacturer_id}`, true);
	xmlhttp.send();
}

function product_list_purchase2(clicked_id){
	const inputValue = document.getElementById('exampleDataListf_'+clicked_id).value;
	const manufacturer_id = document.getElementById('manufacturer_id').value;
	// alert(manufacturer_id);
	const xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
				var newString = this.responseText.replace(/\s+/g,' ').trim();
				$('.product_id_'+clicked_id).val(newString);
				$('#batch_id_'+clicked_id).val(newString);
		}
	};

	xmlhttp.open('GET', `query.php?medicineName2=${inputValue}&manufacturer_id2=${manufacturer_id}`, true);
	xmlhttp.send();
}


function purchase_calculation(id){
	let productQty = document.getElementById('quantity_'+id);
	let productRate = document.getElementById('product_rate_'+id);
	let totalPerItem = document.getElementById('total_price_'+id);
	let sub_total = document.getElementById('sub_total');
	let grandTotal = document.getElementById('grandTotal');
	productQty = Number(productQty.value);
	productRate = Number(productRate.value);
	let total = productQty*productRate;
	totalPerItem.value = total.toFixed(2);

	let totalPrices = document.getElementsByClassName('total_price')
	let i =0;
	let sum =0;
	for(i; i<totalPrices.length;i++){
		sum += Number(totalPrices[i].value);
	}
	sub_total.value = sum;
	grandTotal.value = sum;
}

function purchase_vatcalculation(){
	let sub_total = document.getElementById('sub_total');
	let vat = document.getElementById('vat');
	let grandTotal = document.getElementById('grandTotal');
	grandTotal.value =Number(sub_total.value)+((Number(sub_total.value)*Number(vat.value))/100);
}
function disoucnt_calculation(){
	let sub_total = document.getElementById('sub_total');
	let vat = document.getElementById('vat');
	let grandTotal = document.getElementById('grandTotal');
	let discount = document.getElementById('discount');
	grandTotal.value = Number(sub_total.value)+((Number(sub_total.value)*Number(vat.value))/100)-Number(discount.value);
}
function paid_calculation(){
	let grandTotal = document.getElementById('grandTotal');
	let paid_amount = document.getElementById('paid_amount');
	let due_amount = document.getElementById('due_amount');
	due_amount.value = Number(grandTotal.value)-Number(paid_amount.value);
}
function full_paid_purchase(){
	let grandTotal = document.getElementById('grandTotal');
	let paid_amount = document.getElementById('paid_amount');
	let due_amount = document.getElementById('due_amount');
	paid_amount.value = Number(grandTotal.value)
	due_amount.value='0.00';
}



function deleteRow(click_id){
	$('#row_'+click_id+'').remove();
}
function bank_payment(value){
	if(value==2){
		$('.bank_div').show();
	}
	else{

		$('.bank_div').hide();
	}
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
		<script src="../js/query.js"></script>
    
</body>
</html>
<?php } ?>

