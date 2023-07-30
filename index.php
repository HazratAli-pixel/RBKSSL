<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(strlen($_SESSION['alogin'])!=0 ){
			header('location:dashboard.php');
	}
	// if(strlen($_SESSION['alogin'])!=0 && strlen($_SESSION['current_link'])==0){
	// 		header('location:dashboard.php');
	// }
	// elseif(strlen($_SESSION['alogin'])!=0 && strlen($_SESSION['current_link'])!=0){
	// 		header("location:".$_SESSION['current_link']);
	// }
	else {
			if(isset($_POST['login']))
			{
				$userid = $phone1=$_POST['username'];
				$password=md5($_POST['password']);
				$position = $_POST['position'];
				$sql ="SELECT users.ID, users.userType,users.SrPermission as SRP, users.businessType, users.position, users.UserId, users.Name,users.Phone1, users.Email1, users.Photo as userPhoto, users.shopId, users.Status as userStatus, branchs.id as branchId,branchs.branchName, branchs.phone as branchPhone, branchs.status as branchsStatus, branchs.phone as branchsPhone,  branchs.address as branchsAddress, shops.name as shopName, shops.address, shops.owner,shops.photo as shopPhoto, shops.startTime as shopStartTime, shops.endTime as shopEndTime, shops.status as shopStatus FROM users JOIN branchs ON branchs.id = users.branchId JOIN shops ON shops.id = users.shopId WHERE (users.Phone1=:phone1 and users.password=:password and users.position=:position) || (users.UserId=:userid and users.password=:password and users.position=:position)";
				$query= $dbh -> prepare($sql);
				$query-> bindParam(':phone1', $phone1, PDO::PARAM_STR);
				$query-> bindParam(':password', $password, PDO::PARAM_STR);
				$query-> bindParam(':position', $position, PDO::PARAM_STR);
				$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
				$query-> bindParam(':password', $password, PDO::PARAM_STR);
				$query-> bindParam(':position', $position, PDO::PARAM_STR);
				$query-> execute();
				$results=$query->fetch(PDO::FETCH_OBJ);
				if($query->rowCount() > 0)
				{
					$_SESSION[$position]=$position;
					$_SESSION['user']= array('Name'=>$results->Name,'userId'=>$results->UserId, 'position'=>$results->position,'shopName'=>$results->shopName, 'userPhone'=>$results->Phone1,'userType'=>$results->userType, 'businessType'=>$results->businessType, 'shopId'=>$results->shopId, 'branchName'=>$results->branchName,'branchId'=>$results->branchId, 'shopOwner'=>$results->owner, 'contractStart'=>$results->startTime, 'contractEnd'=>$results->shopEndTime, 'userPhoto'=>$results->userPhoto, 'userStatus'=>$results->userStatus, 'shopStatus'=>$results->shopStatus, 'SRP'=>$results->SRP,'branchsPhone'=>$results->branchsPhone,'branchsAddress'=>$results->branchsAddress);
					$_SESSION['alogin']=$results->UserId;
					$_SESSION['position'] = $position;

					header('location:dashboard.php');
				}
				else {
					echo "<script> alert ('Invalid Details')</script>";
				}
			}
			if(isset($_POST['search'])){
				$userid =$_POST['userid'];
				$sql ="SELECT admin.UserName,admin.Position,admin.ActiveStatus as sts, user_info.Phone1,user_info.phone11 FROM admin left JOIN user_info ON user_info.UserId=admin.UserId WHERE admin.UserId=:userid";
				$query= $dbh -> prepare($sql);
				$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
				$query-> execute();
				$result=$query->fetch(PDO::FETCH_OBJ);
				if($query->rowCount() > 0){
					$_SESSION['forgetuserid']=$userid;
					header('location:searchresult.php');
				}else{
					echo "<script> alert ('No Result founds')</script>";
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
	<meta name="author" content="hazrat Ali">
	<title>PMS</title>
	<link rel="shortcut icon" href="./assets/pic/pmslogo.png" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
	.card{
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
		box-shadow: 0px 15px 20px 0px rgb(95, 52, 41,1);
	}
	#ForgetPassModel{
		display: none;
	}
	#showpass, #userresult{
		display: none;
	}
</style>

</head>

<body>
	
	<div  class="login-page bk-img" style="background-image: url(img/rbkssll.jpg);">
		<div style="background-color: rgba(182, 192, 209,0.7);">
		<div class="container " >
			<div class="row">
				<div class="col-12" style="height: 100vh;" >
					<div id="LoginModel"  class="card col-lg-4 col-md-8 col-sm-10">
						<div class="card-header">
							<h4 class="text-center text-bold  text-black ">Digital Shop Limited</h4>
						</div>	
						<div class="card-body">
							<form method="POST">
								<div class="form-floating mb-3">
									<input type="text" name="username" class="form-control" id="floatingInput" required>
									<label for="floatingInput" >User ID / User Email</label>
									
								</div>
								<div>
									<p id="userresult" class="mb-2 ms-1" style="margin-top:-12px"></p>
								</div>
								<div class="form-floating mb-3">
									<input type="password"  name="password" class="form-control" id="floatingPassword" required>
									<label for="floatingPassword" >Password</label>
								</div>
									<select name="position" class="form-control mb" required>
										<option selected disabled>Your Positon......</option>
										<option>Admin</option>
										<option>Sales</option>
										<option>Cashier</option>
									</select>
								<div class="d-flex justify-content-between align-items-center" >
									<button class="btn btn-info text-black" id="login" name="login" type="submit">LOGIN</button>	
									<p id="ForgetPassBtn" class="btn btn-outline-dark" >Forget password</p>	
								</div>
							</form>
						</div>
					</div>
					<!-- this is forget password section -->
					<div id="ForgetPassModel" class="card col-lg-4 col-md-8 col-sm-10">
						<div class="card-header">
							<h4 class="text-center text-bold  text-black ">Find Your Account</h4>
						</div>	
						<form method="POST">
							<div class="card-body">
								<div class="py-2">
									<p class="pb-2">Please enter your user id to search for your account.</p>
								</div>
								<div class="form-floating mb-3">
									<input type="text" name="userid" class="form-control" id="useridlbl" required>
									<label for="useridlbl" >User ID</label>
								</div>							
							</div>
							<div class="card-footer py-3">
								<div class="d-flex justify-content-between align-items-center" >
									<button id="LoginBtn" class="btn btn-outline-dark" type="button">Login</button>
									<div>
										<a href="index.php" class="btn btn-outline-dark ">cancel</a>
										<button name="search" type="submit" class="btn btn-info">Search</button>
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
	
	<script> 
		$(document).ready(() =>{
			$("#ForgetPassBtn").click(() =>{
				$("#LoginModel").hide();
				$("#ForgetPassModel").show();
				
			});
			$("#LoginBtn").click(() =>{
				$("#LoginModel").show();
				$("#ForgetPassModel").hide();
				
			});
			$("#floatingInput").blur(() =>{
				var InputValue = $("#floatingInput").val();
				if (InputValue.length == 0) {
					$("#userresult").text("You can't keep it empty!");
					$("#userresult").css("color", "red");
					$("#userresult").show();
					$("#login").attr("disabled",true);
				} 
				else
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							var result = Number(this.responseText);
							if(result ==0){
								$("#userresult").text("User Name/ID not found!");
								$("#userresult").css("color", "red");
								$("#userresult").show();
								$("#login").attr("disabled",true);
								
							}
							else{
								$("#userresult").hide();
								$("#login").attr("disabled","enabled");
								$("#login").attr("disabled",false);
							}
						}
					}
					xmlhttp.open("GET", "query.php?userid="+InputValue, true);
					xmlhttp.send();
				}
			});
		});
	</script> 

</body>
</html>
<?php } ?>

