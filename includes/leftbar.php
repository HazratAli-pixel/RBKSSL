
<nav class="ts-sidebar">
		<ul class="ts-sidebar-menu">
				<li class="ts-label">Category</li>
				<li><a href="dashboard.php"><i class="typcn typcn-home-outline mr-2"></i> Dashboard</a></li>

				<?php if(isset($_SESSION['Admin'])) { 
                    //    $Img_Rule = $_SESSION['Img_Rule'];
                    //    if ($Img_Rule ==1){
                ?>
				<li><a href="#"><i class="typcn typcn-group mr-2"></i> Customer</a>
					<ul>
						<li style="margin-left: 50px;"><a href="add_customer.php">Add Customer</a></li>
						<li style="margin-left: 50px;"><a href="customer_list.php">Customer List</a></li>
						<li style="margin-left: 50px;"><a href="customer_ledger.php">Customer Ledger</a></li>
						<li style="margin-left: 50px;"><a href="add_ref.php">Add Reference</a></li>
						<li style="margin-left: 50px;"><a href="ref_list.php">Ref list</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
					<ul>
						<li style="margin-left: 50px;"><a href="company_add.php">Add Company</a></li>
						<li style="margin-left: 50px;"><a href="company_list.php">Company List</a></li>
						<li style="margin-left: 50px;"><a href="purchase_list.php">Company Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-group-outline mr-2"></i> EMI</a>
					<ul>
						<li style="margin-left: 50px;"><a href="emisells.php">EMI Sells</a></li>
						<li style="margin-left: 50px;"><a href="emisellslist.php">EMI Sells List</a></li>
						<li style="margin-left: 50px;"><a href="emicalculation.php">EMI Calculation</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-pills"></i> Products</a> 
					<ul>
						<li style="margin-left: 50px;"><a href="./products_category_list.php">Categroy List</a></li>
						<li style="margin-left: 50px;"><a href="./products_unit_list.php">Unit List</a></li>
						<li style="margin-left: 50px;"><a href="./products_type_list.php">Type List</a></li>
						<li style="margin-left: 50px;"><a href="#">Leaf Setting</a></li>
						<li style="margin-left: 50px;"><a href="./products_add.php">Add Products</a></li>
						<li style="margin-left: 50px;"><a href="./products_list.php">Products List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
					<ul>
						<li style="margin-left: 50px;"><a href="add_purchase.php">Add Purchase</a></li>
						<li style="margin-left: 50px;"><a href="purchase_list.php">Purchase invoice List</a></li>
						<li style="margin-left: 50px;"><a href="purchaseitem_list.php">Purchase item List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Invoice</a></li>
						<li style="margin-left: 50px;"><a href="pos_invoice.php">POS Invoice</a></li>
						<li style="margin-left: 50px;"><a href="invoicelist.php">Invoice List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-retweet mr-2"></i> Return</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Return</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Invoice Return List</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Company Return List</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Wastage Return List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
					<ul>
						<li style="margin-left: 50px;"><a href="stocklist.php">Stock Report</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Stoct Report (Batch)</a></li>
						<li style="margin-left: 50px;"><a href="stockavailable.php">Available Stock</a></li>
						<li style="margin-left: 50px;"><a href="stockout.php">Stock out list</a></li>
						<li style="margin-left: 50px;"><a href="stockexpired.php">Experied list</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-landmark mr-2"></i> Bank</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Bank</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Bank List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-money-check-alt mr-2"></i> Accounts</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Company Payment</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Voucher List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-book-open mr-2"></i> Report</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Closing</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Closing List</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Sales Report</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Sales Report(User)</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Sales Report(Product)</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Sales Report(Category)</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Purchease Report</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Purchease Report(Category)</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="far fa-address-card mr-2"></i> Human Ressource</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Employee</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Attendance</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Payroll</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Expense</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Loan</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hryvnia mr-3"></i> Tax</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Income Tax</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Income Tax List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-servicestack mr-3"></i> Service</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Service</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Service List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-search mr-3"></i> Search</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Medicine Search</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Invoice Search</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Purchease Search</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-plus mr-2"></i>Application Setting</a>
					<ul>
						<li style="margin-left: 50px;"><a href="user_info.php">User Information</a></li>
						<li style="margin-left: 50px;"><a href="add_user.php">Add User</a></li>
						<li style="margin-left: 50px;"><a href="user_list.php">User List</a></li>
						<li style="margin-left: 50px;"><a href="add_role.php">Add Role</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Add User Rule</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Rule List</a></li>
					</ul>
				</li>

				<?php }?>



				<?php if(isset($_SESSION['Pharmacist'])) {
                ?>
				<li><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
					<ul>
						<li style="margin-left: 50px;"><a href="company_add.php">Add Company</a></li>
						<li style="margin-left: 50px;"><a href="company_list.php">Company List</a></li>
						<li style="margin-left: 50px;"><a href="purchase_list.php">Company Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-pills"></i> Medicine</a> 
					<ul>
						<li style="margin-left: 50px;"><a href="./medicine_category_list.php">Categroy List</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_unit_list.php">Unit List</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_type_list.php">Type List</a></li>
						<li style="margin-left: 50px;"><a href="#">Leaf Setting</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_add.php">Add Medicine</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_list.php">Medicine List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
					<ul>
						<li style="margin-left: 50px;"><a href="add_purchase.php">Add Purchase</a></li>
						<li style="margin-left: 50px;"><a href="purchase_list.php">Purchase invoice List</a></li>
						<li style="margin-left: 50px;"><a href="purchaseitem_list.php">Purchase item List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Invoice</a></li>
						<li style="margin-left: 50px;"><a href="pos_invoice.php">POS Invoice</a></li>
						<li style="margin-left: 50px;"><a href="invoicelist.php">Invoice List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
					<ul>
						<li style="margin-left: 50px;"><a href="stocklist.php">Stock Report</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Stoct Report (Batch)</a></li>
						<li style="margin-left: 50px;"><a href="stockavailable.php">Available Stock</a></li>
						<li style="margin-left: 50px;"><a href="stockout.php">Stock out list</a></li>
						<li style="margin-left: 50px;"><a href="stockexpired.php">Experied list</a></li>
					</ul>
				</li>
				<?php }?>

				<!-- Cashier part start herer -->
				<?php if(isset($_SESSION['Cashier'])) {
                ?>
				<li><a href="#"><i class="typcn typcn-group mr-2"></i> Customer</a>
					<ul>
						<li style="margin-left: 50px;"><a href="add_customer.php">Add Customer</a></li>
						<li style="margin-left: 50px;"><a href="customer_list.php">Customer List</a></li>
						<li style="margin-left: 50px;"><a href="customer_ledger.php">Customer Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-group-outline mr-2"></i> Company</a>
					<ul>
						<li style="margin-left: 50px;"><a href="company_add.php">Add Company</a></li>
						<li style="margin-left: 50px;"><a href="company_list.php">Company List</a></li>
						<li style="margin-left: 50px;"><a href="purchase_list.php">Company Ledger</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-pills"></i> Medicine</a> 
					<ul>
						<li style="margin-left: 50px;"><a href="./medicine_category_list.php">Categroy List</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_unit_list.php">Unit List</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_type_list.php">Type List</a></li>
						<li style="margin-left: 50px;"><a href="#">Leaf Setting</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_add.php">Add Medicine</a></li>
						<li style="margin-left: 50px;"><a href="./medicine_list.php">Medicine List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="typcn typcn-shopping-cart mr-2"></i> Purchase</a>
					<ul>
						<li style="margin-left: 50px;"><a href="add_purchase.php">Add Purchase</a></li>
						<li style="margin-left: 50px;"><a href="purchase_list.php">Purchase invoice List</a></li>
						<li style="margin-left: 50px;"><a href="purchaseitem_list.php">Purchase item List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hand-holding-usd mr-2"></i> Invoice</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Invoice</a></li>
						<li style="margin-left: 50px;"><a href="pos_invoice.php">POS Invoice</a></li>
						<li style="margin-left: 50px;"><a href="invoicelist.php">Invoice List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-linode mr-3"></i> Stock</a>
					<ul>
						<li style="margin-left: 50px;"><a href="stocklist.php">Stock Report</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Stoct Report (Batch)</a></li>
						<li style="margin-left: 50px;"><a href="stockavailable.php">Available Stock</a></li>
						<li style="margin-left: 50px;"><a href="stockout.php">Stock out list</a></li>
						<li style="margin-left: 50px;"><a href="stockexpired.php">Experied list</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="far fa-address-card mr-2"></i> Human Ressource</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Employee</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Attendance</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Payroll</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Expense</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Loan</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-hryvnia mr-3"></i> Tax</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Income Tax</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Income Tax List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fab fa-servicestack mr-3"></i> Service</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Add Service</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Service List</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fas fa-search mr-3"></i> Search</a>
					<ul>
						<li style="margin-left: 50px;"><a href="msg.php">Medicine Search</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Invoice Search</a></li>
						<li style="margin-left: 50px;"><a href="msg.php">Purchease Search</a></li>
					</ul>
				</li>
				<?php }?>



				<li style="margin-bottom: 200px;"><a href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
		</ul>
</nav>