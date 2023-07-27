<?php 
function cssStyle($lastLinkName,$currenFileName) {
	if ($lastLinkName == $currenFileName){
		return $css_style ='style="margin: 5px 10px 5px 50px; background: #c9c8c3; color: #000000; border-radius: 10px;"';
	}
	else return $css_style='style="margin-left: 50px;" class="hover_class"';
  }
	$url= $_SERVER['REQUEST_URI'];
	$hosts= $_SERVER['[HTTP_HOST] '];
	$value =explode("/",$url);
	$tesst = $value[2];
	$tesst3 = $value[3];
	$value2 =explode("?",$tesst3);
	$links= $hosts."/".$value[1];
	$css_style = "margin-right: 10px; background: red; color: brown  ; border-radius: 15px;"
  
?>
<nav class="ts-sidebar">
		<ul class="ts-sidebar-menu">
				<li class="ts-label">Category</li>
				<li ><a href=<?php echo $links."/dashboard.php"; ?>><i class="typcn typcn-home-outline mr-2"></i> Dashboard</a></li>

				<?php if(isset($_SESSION['Admin'])) { 
                    //    $Img_Rule = $_SESSION['Img_Rule'];
                    //    if ($Img_Rule ==1){
                ?>
				<li class="<?php echo $value[2]=='customer' ? "open":'close' ?>"
				><a href="#"><i class="typcn typcn-group mr-2"></i> Customer</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'add_customer.php')?> ><a href=<?php echo $links."/customer/add_customer.php";?> >Add Customer</a></li>
						<li <?php echo cssStyle($tesst3, 'customer_list.php')?> ><a href=<?php echo $links."/customer/customer_list.php";?>>Customer List</a></li>
						<li <?php echo cssStyle($tesst3, 'customer_ledger.php')?> ><a href=<?php echo $links."/customer/customer_ledger.php";?>>Customer Ledger</a></li>
						<li <?php echo cssStyle($tesst3, 'add_ref.php')?> ><a href=<?php echo $links."/customer/add_ref.php";?>>Add Reference</a></li>
						<li <?php echo cssStyle($tesst3, 'ref_list.php')?> ><a href=<?php echo $links."/customer/ref_list.php";?>>Reference list</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='company' ? "open":'close' ?>"
				><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?> ><a href=<?php echo $links."/company/company_add.php";?> >Add Company</a></li>
						<li <?php echo cssStyle($tesst3, 'company_list.php')?> ><a href=<?php echo $links."/company/company_list.php";?>>Company List</a></li>
						<li <?php echo cssStyle($tesst3, 'purchase_list.php')?> ><a href=<?php echo $links."/company/purchase_list.php";?>>Company Ledger</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='emi' ? "open":'close' ?>"><a href="#"><i class="typcn typcn-group-outline mr-2"></i> EMI</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'emisells.php')?>><a href=<?php echo $links."/emi/emisells.php";?>>EMI Sells</a></li>
						<li <?php echo cssStyle($tesst3, 'emisellslist.php')?>><a href=<?php echo $links."/emi/emisellslist.php";?>>EMI Sells List</a></li>
						<li <?php echo cssStyle($tesst3, 'todaysemi.php')?>><a href=<?php echo $links."/emi/todaysemi.php";?>>Todays EMI List</a></li>
						<li <?php echo cssStyle($tesst3, 'emiduelist.php')?>><a href=<?php echo $links."/emi/emiduelist.php";?>>Due EMI List</a></li>
						<li <?php echo cssStyle($value2[0], 'emidetails.php')?>><a href=<?php echo $links."/emi/emidetails.php";?>>EMI Details</a></li>
						<li <?php echo cssStyle($tesst3, 'emicalculation.php')?>><a href=<?php echo $links."/emi/emicalculation.php";?>>EMI Calculation</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='products' ? "open":'close' ?>"><a href="#"><i class="fas fa-pills"></i> Products</a> 
					<ul>
						<li <?php echo cssStyle($tesst3, 'products_category_list.php')?>><a href="<?php echo $links."/products/products_category_list.php";?>">Categroy List</a></li>
						<li <?php echo cssStyle($tesst3, 'products_unit_list.php')?>><a href="<?php echo $links."/products/products_unit_list.php";?>">Unit List</a></li>
						<li <?php echo cssStyle($tesst3, 'products_add.php')?>><a href="<?php echo $links."/products/products_add.php";?>">Add Products</a></li>
						<li <?php echo cssStyle($tesst3, 'products_list.php')?>><a href="<?php echo $links."/products/products_list.php";?>">Products List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='purchase' ? "open":'close' ?>" ><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'add_purchase.php')?>><a href="<?php echo $links."/purchase/add_purchase.php";?>" >Add Purchase</a></li>
						<li <?php echo cssStyle($tesst3, 'purchase_list.php')?>><a href="<?php echo $links."/purchase/purchase_list.php";?>" >Purchase invoice List</a></li>
						<li <?php echo cssStyle($tesst3, 'purchaseitem_list.php')?>><a href="<?php echo $links."/purchase/purchaseitem_list.php";?>" >Purchase item List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='invoice' ? "open":'close' ?>"><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Add Invoice</a></li>
						<li <?php echo cssStyle($tesst3, 'pos_invoice.php')?>><a href="<?php echo $links."/invoice/pos_invoice.php";?>">POS Invoice</a></li>
						<li <?php echo cssStyle($tesst3, 'invoicelist.php')?>><a href="<?php echo $links."/invoice/invoicelist.php";?>">Invoice List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='return' ? "open":'close' ?>"><a href="#"><i class="fas fa-retweet mr-2"></i> Return</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Add Return</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Invoice Return List</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Company Return List</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Wastage Return List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='stock' ? "open":'close' ?>"><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'stocklist.php')?>><a href="<?php echo $links."/stock/stocklist.php";?>">Stock Report</a></li>
						<li <?php echo cssStyle($tesst3, 'stockavailable.php')?>><a href="<?php echo $links."/stock/stockavailable.php";?>">Available Stock</a></li>
						<li <?php echo cssStyle($tesst3, 'stockout.php')?>><a href="<?php echo $links."/stock/stockout.php";?>">Stock out list</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='bank' ? "open":'close' ?>"><a href="#"><i class="fas fa-landmark mr-2"></i> Bank</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Add Bank</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Bank List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='accounts' ? "open":'close' ?>"><a href="#"><i class="fas fa-money-check-alt mr-2"></i> Accounts</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Company Payment</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Voucher List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='report' ? "open":'close' ?>"><a href="#"><i class="fas fa-book-open mr-2"></i> Report</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Add Closing</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Closing List</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Sales Report</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Sales Report(User)</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Sales Report(Product)</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Sales Report(Category)</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Purchease Report</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Purchease Report(Category)</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='hr' ? "open":'close' ?>"><a href="#"><i class="far fa-address-card mr-2"></i> Human Ressource</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Employee</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Attendance</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Payroll</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Expense</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href="<?php echo $links."/msg.php";?>">Loan</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='tax' ? "open":'close' ?>"><a href="#"><i class="fas fa-hryvnia mr-3"></i> Tax</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Add Income Tax</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Income Tax List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='service' ? "open":'close' ?>"><a href="#"><i class="fab fa-servicestack mr-3"></i> Service</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Add Service</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Service List</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='search' ? "open":'close' ?>"><a href="#"><i class="fas fa-search mr-3"></i> Search</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Medicine Search</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Invoice Search</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>><a href=<?php echo $links."/msg.php";?>>Purchease Search</a></li>
					</ul>
				</li>
				<li class="<?php echo $value[2]=='as' ? "open":'close' ?>"><a href="#"><i class="fas fa-plus mr-2"></i>Application Setting</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'add_user.php')?>><a href="<?php echo $links."/as/add_user.php";?>">Add User</a></li>
						<li <?php echo cssStyle($tesst3, 'user_list.php')?>><a href="<?php echo $links."/as/user_list.php";?>">User List</a></li>
						<li <?php echo cssStyle($tesst3, 'add_role.php')?>><a href="<?php echo $links."/as/add_role.php";?>">Add Role</a></li>
						<li <?php echo cssStyle($tesst3, 'set-rule.php')?>><a href="<?php echo $links."/as/set-rule.php";?>">Set Rule</a></li>
						<!-- <li <?php echo cssStyle($tesst3, 'msg.php')?>"><a href=<?php echo $links."/msg.php";?>>Add User Rule</a></li>
						<li <?php echo cssStyle($tesst3, 'msg.php')?>"><a href=<?php echo $links."/msg.php";?>>Rule List</a></li> -->
					</ul>
				</li>

				<?php }?>



				<?php if(isset($_SESSION['Pharmacist'])) {
                ?>
				<li><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="company_add.php">Add Company</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="company_list.php">Company List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="purchase_list.php">Company Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-pills"></i> Medicine</a> 
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_category_list.php">Categroy List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_unit_list.php">Unit List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_type_list.php">Type List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="#">Leaf Setting</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_add.php">Add Medicine</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_list.php">Medicine List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="add_purchase.php">Add Purchase</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="purchase_list.php">Purchase invoice List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="purchaseitem_list.php">Purchase item List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Add Invoice</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="pos_invoice.php">POS Invoice</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="invoicelist.php">Invoice List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stocklist.php">Stock Report</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Stoct Report (Batch)</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stockavailable.php">Available Stock</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stockout.php">Stock out list</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stockexpired.php">Experied list</a></li>
					</ul>
				</li>
				<?php }?>

				<!-- Cashier part start herer -->
				<?php if(isset($_SESSION['Cashier'])) {
                ?>
				<li><a href="#"><i class="typcn typcn-group mr-2"></i> Customer</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="add_customer.php">Add Customer</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="customer_list.php">Customer List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="customer_ledger.php">Customer Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="company_add.php">Add Company</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="company_list.php">Company List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="purchase_list.php">Company Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-pills"></i> Medicine</a> 
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_category_list.php">Categroy List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_unit_list.php">Unit List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_type_list.php">Type List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="#">Leaf Setting</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_add.php">Add Medicine</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="./medicine_list.php">Medicine List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="add_purchase.php">Add Purchase</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="purchase_list.php">Purchase invoice List</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="purchaseitem_list.php">Purchase item List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Add Invoice</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="pos_invoice.php">POS Invoice</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="invoicelist.php">Invoice List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stocklist.php">Stock Report</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Stoct Report (Batch)</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stockavailable.php">Available Stock</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stockout.php">Stock out list</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="stockexpired.php">Experied list</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="far fa-address-card mr-2"></i> Human Ressource</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Employee</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Attendance</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Payroll</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Expense</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Loan</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hryvnia mr-3"></i> Tax</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Add Income Tax</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Income Tax List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-servicestack mr-3"></i> Service</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Add Service</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Service List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-search mr-3"></i> Search</a>
					<ul>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Medicine Search</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Invoice Search</a></li>
						<li <?php echo cssStyle($tesst3, 'company_add.php')?>><a href="msg.php">Purchease Search</a></li>
					</ul>
				</li>
				<?php }?>



				<!-- <li margin-bottom: 200px;"><a href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li> -->
				<li margin-bottom: 200px;"><a href='<?php echo count($value) > 3? "../logout.php": "./logout.php"?>'><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
		</ul>
</nav>