
<?php 
function cssStyle($lastLinkName,$currenFileName) {
	if ($lastLinkName == $currenFileName){
		return 'style="margin: 5px 10px 5px 50px; background: #c9c8c3; color: #000000; border-radius: 10px;"';
	}
	else return 'style="margin-left: 50px;" class="hover_class"';
  }
  $FullUrl= $_SERVER['REQUEST_URI'];
  $HostName= $_SERVER['HTTP_HOST'];
  $Urls =explode("/",$FullUrl);
  $FolderName = $Urls[2];
  $FileName = $Urls[3];
  $QueryName =explode("?",$FileName);
  $BaseUrl= "/".$Urls[1];
  
?>
<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		<li class="ts-label">Category</li>
		<li ><a href=<?php echo $BaseUrl."/dashboard.php"; ?>><i class="typcn typcn-home-outline mr-2"></i> Dashboard</a></li>

		<?php 
		if($_SESSION['user']['position']== 'Admin' || $_SESSION['user']['position']== 'Sales' || $_SESSION['user']['position']== 'Cashier') { 
		
		?>
		<li class="<?php echo $FolderName=='customer' ? "open":'close' ?>"><a href="#"><i class="typcn typcn-group mr-2"></i> Customer</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'add_customer.php')?> ><a href=<?php echo $BaseUrl."/customer/add_customer.php";?> >Add Customer</a></li>
				<li <?php echo cssStyle($FileName, 'customer_list.php')?> ><a href=<?php echo $BaseUrl."/customer/customer_list.php";?>>Customer List</a></li>
				<li <?php echo cssStyle($FileName, 'customer_ledger.php')?> ><a href=<?php echo $BaseUrl."/customer/customer_ledger.php";?>>Customer Ledger</a></li>
				<li <?php echo cssStyle($FileName, 'add_ref.php')?> ><a href=<?php echo $BaseUrl."/customer/add_ref.php";?>>Add Reference</a></li>
				<li <?php echo cssStyle($FileName, 'ref_list.php')?> ><a href=<?php echo $BaseUrl."/customer/ref_list.php";?>>Reference list</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='company' ? "open":'close' ?>"><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'company_add.php')?> ><a href=<?php echo $BaseUrl."/company/company_add.php";?> >Add Company</a></li>
				<li <?php echo cssStyle($FileName, 'company_list.php')?> ><a href=<?php echo $BaseUrl."/company/company_list.php";?>>Company List</a></li>
				<li <?php echo cssStyle($FileName, 'purchase_list.php')?> ><a href=<?php echo $BaseUrl."/company/purchase_list.php";?>>Company Ledger</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='emi' ? "open":'close' ?>"><a href="#"><i class="typcn typcn-group-outline mr-2"></i> EMI</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'emisells.php')?>><a href=<?php echo $BaseUrl."/emi/emisells.php";?>>EMI Sells</a></li>
				<li <?php echo cssStyle($FileName, 'emisellslist.php')?>><a href=<?php echo $BaseUrl."/emi/emisellslist.php";?>>EMI Sells List</a></li>
				<li <?php echo cssStyle($FileName, 'todaysemi.php')?>><a href=<?php echo $BaseUrl."/emi/todaysemi.php";?>>Todays EMI List</a></li>
				<li <?php echo cssStyle($FileName, 'emiduelist.php')?>><a href=<?php echo $BaseUrl."/emi/emiduelist.php";?>>Due EMI List</a></li>
				<li <?php echo cssStyle($QueryName[0], 'emidetails.php')?>><a href=<?php echo $BaseUrl."/emi/emidetails.php";?>>EMI Details</a></li>
				<li <?php echo cssStyle($FileName, 'emicalculation.php')?>><a href=<?php echo $BaseUrl."/emi/emicalculation.php";?>>EMI Calculation</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='products' ? "open":'close' ?>"><a href="#"><i class="fas fa-pills"></i> Products</a> 
			<ul>
				<li <?php echo cssStyle($FileName, 'products_category_list.php')?>><a href="<?php echo $BaseUrl."/products/products_category_list.php";?>">Categroy List</a></li>
				<li <?php echo cssStyle($FileName, 'products_unit_list.php')?>><a href="<?php echo $BaseUrl."/products/products_unit_list.php";?>">Unit List</a></li>
				<li <?php echo cssStyle($FileName, 'products_add.php')?>><a href="<?php echo $BaseUrl."/products/products_add.php";?>">Add Products</a></li>
				<li <?php echo cssStyle($FileName, 'products_list.php')?>><a href="<?php echo $BaseUrl."/products/products_list.php";?>">Products List</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='purchase' ? "open":'close' ?>" ><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'add_purchase.php')?>><a href="<?php echo $BaseUrl."/purchase/add_purchase.php";?>" >Add Purchase</a></li>
				<li <?php echo cssStyle($FileName, 'purchase_list.php')?>><a href="<?php echo $BaseUrl."/purchase/purchase_list.php";?>" >Purchase invoice List</a></li>
				<li <?php echo cssStyle($FileName, 'purchaseitem_list.php')?>><a href="<?php echo $BaseUrl."/purchase/purchaseitem_list.php";?>" >Purchase item List</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='invoice' ? "open":'close' ?>"><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Add Invoice</a></li>
				<li <?php echo cssStyle($FileName, 'pos_invoice.php')?>><a href="<?php echo $BaseUrl."/invoice/pos_invoice.php";?>">POS Invoice</a></li>
				<li <?php echo cssStyle($FileName, 'invoicelist.php')?>><a href="<?php echo $BaseUrl."/invoice/invoicelist.php";?>">Invoice List</a></li>
			</ul>
		</li>
		<!-- <li class="<?php echo $FolderName=='return' ? "open":'close' ?>"><a href="#"><i class="fas fa-retweet mr-2"></i> Return</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Add Return</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Invoice Return List</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Company Return List</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Wastage Return List</a></li>
			</ul>
		</li> -->
		<li class="<?php echo $FolderName=='stock' ? "open":'close' ?>"><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'stocklist.php')?>><a href="<?php echo $BaseUrl."/stock/stocklist.php";?>">Stock Report</a></li>
				<li <?php echo cssStyle($FileName, 'stockavailable.php')?>><a href="<?php echo $BaseUrl."/stock/stockavailable.php";?>">Available Stock</a></li>
				<li <?php echo cssStyle($FileName, 'stockout.php')?>><a href="<?php echo $BaseUrl."/stock/stockout.php";?>">Stock out list</a></li>
				<li <?php echo cssStyle($FileName, 'stockexpired.php')?>><a href="<?php echo $BaseUrl."/stock/stockexpired.php";?>">Stock Expired</a></li>
			</ul>
		</li>
		<!-- <li class="<?php echo $FolderName=='bank' ? "open":'close' ?>"><a href="#"><i class="fas fa-landmark mr-2"></i> Bank</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Add Bank</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Bank List</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='accounts' ? "open":'close' ?>"><a href="#"><i class="fas fa-money-check-alt mr-2"></i> Accounts</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Company Payment</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Voucher List</a></li>
			</ul>
		</li> -->
		<li class="<?php echo $FolderName=='report' ? "open":'close' ?>"><a href="#"><i class="fas fa-book-open mr-2"></i> Report</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'report.php')?>><a href="<?php echo $BaseUrl."/report/report.php";?>">Sales Report</a></li>				
				<li <?php echo cssStyle($FileName, 'reportpurchase.php')?>><a href="<?php echo $BaseUrl."/report/reportpurchase.php";?>">Purchease Report</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Purchease Report(Category)</a></li>
			</ul>
		</li>
		<!-- <li class="<?php echo $FolderName=='hr' ? "open":'close' ?>"><a href="#"><i class="far fa-address-card mr-2"></i> Human Ressource</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Employee</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Attendance</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Payroll</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Expense</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href="<?php echo $BaseUrl."/msg.php";?>">Loan</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='tax' ? "open":'close' ?>"><a href="#"><i class="fas fa-hryvnia mr-3"></i> Tax</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Add Income Tax</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Income Tax List</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='service' ? "open":'close' ?>"><a href="#"><i class="fab fa-servicestack mr-3"></i> Service</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Add Service</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Service List</a></li>
			</ul>
		</li>
		<li class="<?php echo $FolderName=='search' ? "open":'close' ?>"><a href="#"><i class="fas fa-search mr-3"></i> Search</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Medicine Search</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Invoice Search</a></li>
				<li <?php echo cssStyle($FileName, 'msg.php')?>><a href=<?php echo $BaseUrl."/msg.php";?>>Purchease Search</a></li>
			</ul>
		</li> -->
		<li class="<?php echo $FolderName=='as' ? "open":'close' ?>"><a href="#"><i class="fas fa-plus mr-2"></i>Application Setting</a>
			<ul>
				<?php  if($_SESSION['user']['userType']=='All_manage') { ?>
					<li <?php echo cssStyle($FileName, 'add_user.php')?>><a href="<?php echo $BaseUrl."/as/add_user.php";?>">Add User</a></li>
					<li <?php echo cssStyle($FileName, 'add_role.php')?>><a href="<?php echo $BaseUrl."/as/add_role.php";?>">Add Role</a></li>
				<?php  }?>
				<li <?php echo cssStyle($FileName, 'user_list.php')?>><a href="<?php echo $BaseUrl."/as/user_list.php";?>">User List</a></li>
				<li <?php echo cssStyle($FileName, 'set-rule.php')?>><a href="<?php echo $BaseUrl."/as/set-rule.php";?>">Set Rule</a></li>
			</ul>
		</li>
		<?php  }?>
		<?php
			if($_SESSION['user']['position']=='Admin') { 
		?>
		<li class="<?php echo $FolderName=='admin' ? "open":'close' ?>"><a href="#"><i class="fas fa-plus mr-2"></i>Admin Panel</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'add_user.php')?>><a href="<?php echo $BaseUrl."/admin/add_user.php";?>">Add User</a></li>
				<li <?php echo cssStyle($FileName, 'add_role.php')?>><a href="<?php echo $BaseUrl."/admin/add_branch.php";?>">Add Branch</a></li>
				<li <?php echo cssStyle($FileName, 'set-rule.php')?>><a href="<?php echo $BaseUrl."/admin/set-role.php";?>">Set Rule</a></li>
				<li <?php echo cssStyle($FileName, 'set-rule.php')?>><a href="<?php echo $BaseUrl."/admin/branch_list.php";?>">Branch List</a></li>
			</ul>
		</li>
		<?php 
		} ?>
		<?php
			if($_SESSION['user']['position']=='Admin') { 
		?>
			<li ><a href=<?php echo $BaseUrl."/sr1c4e3a5o0q5c7k6l1.php"; ?>><i class="typcn typcn-home-outline mr-2"></i> SR_Sales</a></li>
		<?php 
		} ?>

		<?php
			if($_SESSION['user']['position']=='SAP') { 
		?>
		<li class="<?php echo $FolderName=='sap1c4e1d9ce3l4dqx1c1c' ? "open":'close' ?>"><a href="#"><i class="fas fa-plus mr-2"></i>Super Admin Panel</a>
			<ul>
				<li <?php echo cssStyle($FileName, 'add_user.php')?>><a href="<?php echo $BaseUrl."/sap1c4e1d9ce3l4dqx1c1c/add_user.php";?>">Add User</a></li>
				<li <?php echo cssStyle($FileName, 'user_list.php')?>><a href="<?php echo $BaseUrl."/sap1c4e1d9ce3l4dqx1c1c/add_shop.php";?>">Add Shop</a></li>
				<li <?php echo cssStyle($FileName, 'add_role.php')?>><a href="<?php echo $BaseUrl."/sap1c4e1d9ce3l4dqx1c1c/add_branch.php";?>">Add Branch</a></li>
				<li <?php echo cssStyle($FileName, 'set-rule.php')?>><a href="<?php echo $BaseUrl."/sap1c4e1d9ce3l4dqx1c1c/set-role.php";?>">Set Rule</a></li>
				<li <?php echo cssStyle($FileName, 'set-rule.php')?>><a href="<?php echo $BaseUrl."/sap1c4e1d9ce3l4dqx1c1c/shop_list.php";?>">Shop List</a></li>
			</ul>
		</li>
		<?php }?>


		
		<li margin-bottom: 200px;"><a href='<?php echo count($Urls) > 3? "../logout.php": "./logout.php"?>'><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
	</ul>
</nav>