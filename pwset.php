<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['pwset'])==0 ){	
		header('location:searchresult.php');
}else {
	if(isset($_POST['save']))
	{
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		if($pass1 === $pass2){
			echo "<script> alert('Successfully you change the password')</script>";
			$password=md5($pass1);
			$userid =$_SESSION['forgetuserid'];
			$sql = "UPDATE admin set Password=:password WHERE UserId=:userid";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':password', $password, PDO::PARAM_STR);
			$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
			$query-> execute();
			unset($_SESSION['forgetuserid']);
			unset($_SESSION['pwset']);
			unset($_SESSION['lastInsertId']);
			header('location:index.php');
		}
		else{
			echo "<script> alert('Pasword not matched')</script>";
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
	#showpass{
		display: none;
	}
</style>

</head>

<body>
	
	<div  class="login-page bk-img" style="background-image: url(img/pms.jpg);">
		<div style="background-color: rgba(182, 192, 209,0.7);">
			<div class="container">
				<div class="row">
					<?php 
					$userid =$_SESSION['forgetuserid'];
					$sql ="SELECT admin.UserName,admin.Position,admin.ActiveStatus as sts,user_info.Name, user_info.Photo, user_info.Phone1,user_info.Email1 
					FROM admin left JOIN user_info ON user_info.UserId=admin.UserId WHERE  admin.UserId=:userid";
					$query= $dbh -> prepare($sql);
					$query-> bindParam(':userid', $userid, PDO::PARAM_STR);
					$query-> execute();
					$result=$query->fetch(PDO::FETCH_OBJ);
					$number=$result->Phone1;
					$first3= substr($number,0,4);
					$last3= substr($number,8);
					$fullPhoneNumber = $first3."*****".$last3;
					?>
					<div class="col-12" style="height: 100vh;" >
						<div id="" class="card col-lg-4 col-md-8 col-sm-10">
							<div class="card-header">
								<h4 class="text-center text-bold  text-black ">Pharmacy Management Software</h4>
							</div>	
							<div class="card-body p-2 m-0 " style="background-color: rgba(162, 202, 245,.8);">									
									<form action="" method="POST">
										<div id="optBox" class=" ">
											<div class="px-3 ">
												<p class="m-0"><strong>Congratulation...</strong>Set Your Password now</p>
											</div>
											<div class="px-3 py-3">
												<label class="fw-bolder" for="optbox">Password</label>
												<input class="form-control" type="password" name="pass1" id="optinputbox" value="" placeholder="New password">
												<label class="fw-bolder pt-3" for="optbox">Confrim Password</label>
												<input class="form-control" type="password" name="pass2" id="optinputbox" value="" placeholder="Confrim new password">
											</div>
											<div class="px-3 py-3 text-end">
												<button id="" class="btn btn-info px-4 py-1 text-center" name="save" type="submit">save</button>
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

</body>
</html>
<?php } ?>
