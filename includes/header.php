<?php 

	// $userId= $_SESSION['alogin'];
	// $sql = "SELECT user_info.Name, user_info.Photo, admin.UserName,admin.Position, admin.ActiveStatus FROM user_info
	// INNER JOIN admin ON admin.UserId = user_info.UserId WHERE admin.UserId=:userid";
	// $query = $dbh -> prepare($sql);
	// $query->bindParam(':userid',$userId,PDO::PARAM_STR);
	// $query->execute();
	// $result=$query->fetch(PDO::FETCH_OBJ);	

	$FullUrl= $_SERVER['REQUEST_URI'];
	$HostName= $_SERVER['HTTP_HOST'];
	$Urls =explode("/",$FullUrl);
	$FolderName = $Urls[2];
	$FileName = $value[2];
	$QueryName =explode("?",$FileName);
	$BaseUrl= "/".$Urls[1];

?>
<style>
	.active-status{
		background-color: green;
	}

</style>



<div class="brand d-flex justify-content-between">
	<div class="d-flex">
		<img class="brand-logo" src=<?php echo count($Urls) > 3? "../img/rbksslllogo.jpg": "./img/rbksslllogo.jpg"?> alt="logo">
		<div class=" d-none flex-column d-md-flex d-lg-flex d-xl-flex d-xxl-flex justify-content-center">
			<a  href=<?php echo $BaseUrl."/dashboard.php"; ?> style=" font-size:large;" class="title" ><?php echo $_SESSION['user']['shopName'] ?> </a>  
			<span class=""style="color: #ccbb6e;"><?php echo $_SESSION['user']['branchName'] ?></span>
		</div>
		<div class="d-flex flex-column d-inline-block d-md-none d-lg-none d-xl-none d-xxl-none justify-content-center">
			<a  href=<?php echo $BaseUrl."/dashboard.php"; ?> style=" font-size:small;" class="title " ><?php echo $_SESSION['user']['shopName'] ?></a>  
			<span class=""style="color: #ccbb6e;"><?php echo $_SESSION['user']['branchName'] ?></span>
		</div>
		
	</div>
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<!-- <a href="#"><img src="./UserPhoto/<?php echo $result->Photo ?>" class="ts-avatar hidden-side" alt=""> <?php echo $_SESSION['user']['Name']?> <i class="fa fa-angle-down hidden-side"></i></a> -->
				<a type="button" class=" position-relative">
					
				<img src= <?php echo count($Urls) > 3? "../UserPhoto/".$_SESSION['user']['userPhoto'] : "./UserPhoto/".$_SESSION['user']['userPhoto']?>
				 class="ts-avatar hidden-side" alt=""> <?php echo $_SESSION['user']['Name']?> <i class="fa fa-angle-down hidden-side"></i>
					<!-- <span style="margin-left: -82px; margin-top:14px; padding:6px" class="position-absolute active-status border border-light rounded-circle">
						<span class="visually-hidden">ali</span>
					</span> -->
				</a>
				<ul>
					<li><a href='<?php echo count($Urls) > 3? "../change-password.php": "./change-password.php"?>'><i class="fas fa-user me-2"></i> Profile</a></li>
					<li><a href='<?php echo count($Urls) > 3? "../change-password.php": "./change-password.php"?>'><i class="fas fa-user-edit me-2"></i> Edit Profile</a></li>
					<li><a href='<?php echo count($Urls) > 3? "../change-password.php": "./change-password.php"?>'><i class="fas fa-history me-2"></i>Sells History</a></li>
					<li><a href='<?php echo count($Urls) > 3? "../change-password.php": "./change-password.php"?>'><i class="fas fa-users-cog me-2"></i>Change Password</a></li>
					<li><a href='<?php echo count($Urls) > 3? "../logout.php": "./logout.php"?>'><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
				</ul>
			</li>
		</ul>

	</div>


