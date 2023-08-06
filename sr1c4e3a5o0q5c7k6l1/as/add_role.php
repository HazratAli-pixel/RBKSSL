
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
	if(isset($_REQUEST['del']))
	{
		$did=intval($_GET['del']);
		$sql = "delete from user_info WHERE  Status=:did";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':did',$did, PDO::PARAM_STR);
		$query -> execute();
		$msg="Record deleted Successfully";
        header("refresh:1;user_list.php");
	}
	else if(isset($_GET['close'])){    
		$cmpid=$_GET['close'];
		$sts=0;
		$sql ="update user_info set Status=:status where ID=:cusId";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':status',$sts, PDO::PARAM_STR);
		$query-> bindParam(':cusId',$cmpid, PDO::PARAM_STR);
		$query -> execute();
		echo "<script>window.location.href='user_list.php'</script>";
		}
	else if(isset($_GET['active'])){    
		$cmpid=$_GET['active'];
		$sts=1;
		$sql ="update user_info set Status=:status where ID=:cusId";
		$query = $dbh->prepare($sql);
		$query-> bindParam(':status',$sts, PDO::PARAM_STR);
		$query-> bindParam(':cusId',$cmpid, PDO::PARAM_STR);
		$query -> execute();
		echo "<script>window.location.href='user_list.php'</script>";
		}

 ?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="pharmacy management System">
	<meta name="author" content="Md. Hazrat Ali">
	<meta name="theme-color" content="#3e454c">
	
	<title>PMS-Add role</title>
    <link rel="shortcut icon" href="../assets/pic/pmslogo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	
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
                    <div class="col-sm-12">
                        <div class="card card-bd lobidrag">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center"> 
                                    Create role name 
                                </div>
                            </div>
                            <form action="" method="post" accept-charset="utf-8">
                                <input type="hidden" name="app_csrf" value="7d12a19a97750cf415625c8bff2a2343" />                    
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">Role Name <i class="text-danger">*</i></label>
                                        <div class="col-sm-6">
                                            <input type="text" tabindex="2" class="form-control" name="role_id" id="type" placeholder="Role Name" required />
                                        </div>
                                    </div>
				                    <table class="table table-bordered">
                                        <h2 class="">Dashboard</h2>
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-center">Menu Name</th>
                                                <th class="text-center">Create(<label for="checkAllcreate0"><input type="checkbox" onclick="checkallcreate(0)" id="checkAllcreate0"  name="" > All)</label> </th>
                                                <th class="text-center">Read (<label for="checkAllread0"><input type="checkbox" onclick="checkallread(0)" id="checkAllread0"  name="" > All)</label></th>
                                                <th class="text-center">Update  (<label for="checkAlledit0"><input type="checkbox" onclick="checkalledit(0)" id="checkAlledit0"  name="" > All)</label></th>
                                                <th class="text-center">Delete (<label for="checkAlldelete0"><input type="checkbox" onclick="checkalldelete(0)" id="checkAlldelete0"  name="" > All)</label></th>
                                            </tr>
                                        </thead>                                     
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    Income Expense Statement                                    
                                                    <input type="hidden" name="fk_module_id[0][0][]"  value="1" id="id_1">
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center text-green">
                                                        <label for="create00" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="create[0][0][]" value="1"  id="create00" class="create0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>  
                                                    </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="read00" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="read[0][0][]" value="1"  id="read00" class="read0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="update00" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="update[0][0][]" value="1"  id="update00" class="edit0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="delete00" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="delete[0][0][]" value="1"  id="delete00" class="delete0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>                    
                                        <tbody>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                Best Sales Of The Month
                                                <input type="hidden" name="fk_module_id[0][1][]"  value="2" id="id_2">
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center text-green">
                                                        <label for="create01" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="create[0][1][]" value="1"  id="create01" class="create0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>  
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="read01" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="read[0][1][]" value="1"  id="read01" class="read0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="update01" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="update[0][1][]" value="1"  id="update01" class="edit0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="delete01" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="delete[0][1][]" value="1"  id="delete01" class="delete0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    Monthly Progress Report                                   
                                                    <input type="hidden" name="fk_module_id[0][2][]"  value="3" id="id_3">
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center text-green">
                                                        <label for="create02" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="create[0][2][]" value="1"  id="create02" class="create0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>  
                                                    </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="read02" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="read[0][2][]" value="1"  id="read02" class="read0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="update02" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="update[0][2][]" value="1"  id="update02" class="edit0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="checkbox-success checked text-center">
                                                        <label for="delete02" class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="delete[0][2][]" value="1"  id="delete02" class="delete0 custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                            <tbody>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        Today&#39;s Report                                    
                                        <input type="hidden" name="fk_module_id[0][3][]"  value="4" id="id_4">
                                    </td>
                                    <td class="text-center">
                                        <div class="checkbox-success checked text-center text-green">
                                            <label for="create03" class="custom-control custom-checkbox">
                                            <input type="checkbox" name="create[0][3][]" value="1"  id="create03" class="create0 custom-control-input">
                                            <span class="custom-control-indicator"></span>  
                                        </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="checkbox-success checked text-center">
                                            <label for="read03" class="custom-control custom-checkbox">
                                            <input type="checkbox" name="read[0][3][]" value="1"  id="read03" class="read0 custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="checkbox-success checked text-center">
                                            <label for="update03" class="custom-control custom-checkbox">
                                            <input type="checkbox" name="update[0][3][]" value="1"  id="update03" class="edit0 custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="checkbox-success checked text-center">
                                            <label for="delete03" class="custom-control custom-checkbox">
                                            <input type="checkbox" name="delete[0][3][]" value="1"  id="delete03" class="delete0 custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                        </table>
                        <table class="table table-bordered">
                        <h2 class="">Customer</h2>
                        <thead>
                            <tr>
                                <th class="text-center">Sl</th>
                                <th class="text-center">Menu Name</th>
                                <th class="text-center">Create(<label for="checkAllcreate1"><input type="checkbox" onclick="checkallcreate(1)" id="checkAllcreate1"  name="" > All)</label> </th>
                                <th class="text-center">Read (<label for="checkAllread1"><input type="checkbox" onclick="checkallread(1)" id="checkAllread1"  name="" > All)</label></th>
                                <th class="text-center">Update  (<label for="checkAlledit1"><input type="checkbox" onclick="checkalledit(1)" id="checkAlledit1"  name="" > All)</label></th>
                                <th class="text-center">Delete (<label for="checkAlldelete1"><input type="checkbox" onclick="checkalldelete(1)" id="checkAlldelete1"  name="" > All)</label></th>
                            </tr>
                        </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Customer                                    <input type="hidden" name="fk_module_id[1][0][]"  value="5" id="id_5">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create10" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[1][0][]" value="1"  id="create10" class="create1 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read10" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[1][0][]" value="1"  id="read10" class="read1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update10" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[1][0][]" value="1"  id="update10" class="edit1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete10" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[1][0][]" value="1"  id="delete10" class="delete1 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Customer List                                    <input type="hidden" name="fk_module_id[1][1][]"  value="6" id="id_6">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create11" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[1][1][]" value="1"  id="create11" class="create1 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read11" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[1][1][]" value="1"  id="read11" class="read1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update11" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[1][1][]" value="1"  id="update11" class="edit1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete11" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[1][1][]" value="1"  id="delete11" class="delete1 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Credit Customer                                    <input type="hidden" name="fk_module_id[1][2][]"  value="7" id="id_7">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create12" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[1][2][]" value="1"  id="create12" class="create1 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read12" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[1][2][]" value="1"  id="read12" class="read1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update12" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[1][2][]" value="1"  id="update12" class="edit1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete12" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[1][2][]" value="1"  id="delete12" class="delete1 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Paid Customer                                    <input type="hidden" name="fk_module_id[1][3][]"  value="8" id="id_8">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create13" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[1][3][]" value="1"  id="create13" class="create1 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read13" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[1][3][]" value="1"  id="read13" class="read1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update13" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[1][3][]" value="1"  id="update13" class="edit1 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete13" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[1][3][]" value="1"  id="delete13" class="delete1 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Manufacturer</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate2"><input type="checkbox" onclick="checkallcreate(2)" id="checkAllcreate2"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread2"><input type="checkbox" onclick="checkallread(2)" id="checkAllread2"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit2"><input type="checkbox" onclick="checkalledit(2)" id="checkAlledit2"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete2"><input type="checkbox" onclick="checkalldelete(2)" id="checkAlldelete2"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Manufacturer                                    <input type="hidden" name="fk_module_id[2][0][]"  value="9" id="id_9">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create20" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[2][0][]" value="1"  id="create20" class="create2 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read20" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[2][0][]" value="1"  id="read20" class="read2 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update20" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[2][0][]" value="1"  id="update20" class="edit2 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete20" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[2][0][]" value="1"  id="delete20" class="delete2 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Manufacturer List                                    <input type="hidden" name="fk_module_id[2][1][]"  value="10" id="id_10">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create21" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[2][1][]" value="1"  id="create21" class="create2 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read21" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[2][1][]" value="1"  id="read21" class="read2 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update21" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[2][1][]" value="1"  id="update21" class="edit2 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete21" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[2][1][]" value="1"  id="delete21" class="delete2 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Medicine</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate3"><input type="checkbox" onclick="checkallcreate(3)" id="checkAllcreate3"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread3"><input type="checkbox" onclick="checkallread(3)" id="checkAllread3"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit3"><input type="checkbox" onclick="checkalledit(3)" id="checkAlledit3"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete3"><input type="checkbox" onclick="checkalldelete(3)" id="checkAlldelete3"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Category                                    <input type="hidden" name="fk_module_id[3][0][]"  value="11" id="id_11">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create30" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][0][]" value="1"  id="create30" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read30" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][0][]" value="1"  id="read30" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update30" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][0][]" value="1"  id="update30" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete30" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][0][]" value="1"  id="delete30" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Category List                                    <input type="hidden" name="fk_module_id[3][1][]"  value="12" id="id_12">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create31" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][1][]" value="1"  id="create31" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read31" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][1][]" value="1"  id="read31" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update31" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][1][]" value="1"  id="update31" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete31" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][1][]" value="1"  id="delete31" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Add Unit                                    <input type="hidden" name="fk_module_id[3][2][]"  value="13" id="id_13">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create32" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][2][]" value="1"  id="create32" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read32" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][2][]" value="1"  id="read32" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update32" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][2][]" value="1"  id="update32" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete32" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][2][]" value="1"  id="delete32" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Unit List                                    <input type="hidden" name="fk_module_id[3][3][]"  value="14" id="id_14">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create33" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][3][]" value="1"  id="create33" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read33" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][3][]" value="1"  id="read33" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update33" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][3][]" value="1"  id="update33" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete33" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][3][]" value="1"  id="delete33" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>5</td>
                                <td>
                                    Add Type                                    <input type="hidden" name="fk_module_id[3][4][]"  value="15" id="id_15">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create34" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][4][]" value="1"  id="create34" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read34" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][4][]" value="1"  id="read34" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update34" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][4][]" value="1"  id="update34" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete34" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][4][]" value="1"  id="delete34" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>6</td>
                                <td>
                                    Type List                                    <input type="hidden" name="fk_module_id[3][5][]"  value="16" id="id_16">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create35" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][5][]" value="1"  id="create35" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read35" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][5][]" value="1"  id="read35" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update35" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][5][]" value="1"  id="update35" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete35" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][5][]" value="1"  id="delete35" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>7</td>
                                <td>
                                    Add Medicine                                    <input type="hidden" name="fk_module_id[3][6][]"  value="17" id="id_17">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create36" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][6][]" value="1"  id="create36" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read36" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][6][]" value="1"  id="read36" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update36" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][6][]" value="1"  id="update36" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete36" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][6][]" value="1"  id="delete36" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>8</td>
                                <td>
                                    Medicine List                                    <input type="hidden" name="fk_module_id[3][7][]"  value="18" id="id_18">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create37" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[3][7][]" value="1"  id="create37" class="create3 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read37" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[3][7][]" value="1"  id="read37" class="read3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update37" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[3][7][]" value="1"  id="update37" class="edit3 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete37" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[3][7][]" value="1"  id="delete37" class="delete3 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Purchase</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate4"><input type="checkbox" onclick="checkallcreate(4)" id="checkAllcreate4"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread4"><input type="checkbox" onclick="checkallread(4)" id="checkAllread4"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit4"><input type="checkbox" onclick="checkalledit(4)" id="checkAlledit4"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete4"><input type="checkbox" onclick="checkalldelete(4)" id="checkAlldelete4"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Purchase                                    <input type="hidden" name="fk_module_id[4][0][]"  value="19" id="id_19">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create40" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[4][0][]" value="1"  id="create40" class="create4 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read40" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[4][0][]" value="1"  id="read40" class="read4 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update40" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[4][0][]" value="1"  id="update40" class="edit4 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete40" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[4][0][]" value="1"  id="delete40" class="delete4 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Purchase List                                    <input type="hidden" name="fk_module_id[4][1][]"  value="20" id="id_20">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create41" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[4][1][]" value="1"  id="create41" class="create4 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read41" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[4][1][]" value="1"  id="read41" class="read4 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update41" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[4][1][]" value="1"  id="update41" class="edit4 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete41" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[4][1][]" value="1"  id="delete41" class="delete4 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Invoice</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate5"><input type="checkbox" onclick="checkallcreate(5)" id="checkAllcreate5"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread5"><input type="checkbox" onclick="checkallread(5)" id="checkAllread5"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit5"><input type="checkbox" onclick="checkalledit(5)" id="checkAlledit5"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete5"><input type="checkbox" onclick="checkalldelete(5)" id="checkAlldelete5"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Invoice                                    <input type="hidden" name="fk_module_id[5][0][]"  value="21" id="id_21">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create50" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[5][0][]" value="1"  id="create50" class="create5 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read50" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[5][0][]" value="1"  id="read50" class="read5 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update50" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[5][0][]" value="1"  id="update50" class="edit5 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete50" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[5][0][]" value="1"  id="delete50" class="delete5 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    POS Invoice                                    <input type="hidden" name="fk_module_id[5][1][]"  value="22" id="id_22">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create51" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[5][1][]" value="1"  id="create51" class="create5 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read51" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[5][1][]" value="1"  id="read51" class="read5 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update51" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[5][1][]" value="1"  id="update51" class="edit5 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete51" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[5][1][]" value="1"  id="delete51" class="delete5 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Invoice List                                    <input type="hidden" name="fk_module_id[5][2][]"  value="23" id="id_23">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create52" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[5][2][]" value="1"  id="create52" class="create5 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read52" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[5][2][]" value="1"  id="read52" class="read5 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update52" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[5][2][]" value="1"  id="update52" class="edit5 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete52" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[5][2][]" value="1"  id="delete52" class="delete5 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Return</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate6"><input type="checkbox" onclick="checkallcreate(6)" id="checkAllcreate6"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread6"><input type="checkbox" onclick="checkallread(6)" id="checkAllread6"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit6"><input type="checkbox" onclick="checkalledit(6)" id="checkAlledit6"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete6"><input type="checkbox" onclick="checkalldelete(6)" id="checkAlldelete6"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Return                                    <input type="hidden" name="fk_module_id[6][0][]"  value="24" id="id_24">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create60" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[6][0][]" value="1"  id="create60" class="create6 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read60" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[6][0][]" value="1"  id="read60" class="read6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update60" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[6][0][]" value="1"  id="update60" class="edit6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete60" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[6][0][]" value="1"  id="delete60" class="delete6 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Invoice Return List                                    <input type="hidden" name="fk_module_id[6][1][]"  value="25" id="id_25">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create61" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[6][1][]" value="1"  id="create61" class="create6 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read61" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[6][1][]" value="1"  id="read61" class="read6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update61" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[6][1][]" value="1"  id="update61" class="edit6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete61" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[6][1][]" value="1"  id="delete61" class="delete6 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Manufacturer Return List                                    <input type="hidden" name="fk_module_id[6][2][]"  value="26" id="id_26">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create62" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[6][2][]" value="1"  id="create62" class="create6 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read62" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[6][2][]" value="1"  id="read62" class="read6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update62" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[6][2][]" value="1"  id="update62" class="edit6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete62" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[6][2][]" value="1"  id="delete62" class="delete6 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Wastage Return List                                    <input type="hidden" name="fk_module_id[6][3][]"  value="112" id="id_112">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create63" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[6][3][]" value="1"  id="create63" class="create6 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read63" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[6][3][]" value="1"  id="read63" class="read6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update63" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[6][3][]" value="1"  id="update63" class="edit6 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete63" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[6][3][]" value="1"  id="delete63" class="delete6 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Stock</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate7"><input type="checkbox" onclick="checkallcreate(7)" id="checkAllcreate7"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread7"><input type="checkbox" onclick="checkallread(7)" id="checkAllread7"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit7"><input type="checkbox" onclick="checkalledit(7)" id="checkAlledit7"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete7"><input type="checkbox" onclick="checkalldelete(7)" id="checkAlldelete7"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Stock Report                                    <input type="hidden" name="fk_module_id[7][0][]"  value="27" id="id_27">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create70" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[7][0][]" value="1"  id="create70" class="create7 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read70" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[7][0][]" value="1"  id="read70" class="read7 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update70" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[7][0][]" value="1"  id="update70" class="edit7 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete70" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[7][0][]" value="1"  id="delete70" class="delete7 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Stock Report(Batch Wise)                                    <input type="hidden" name="fk_module_id[7][1][]"  value="28" id="id_28">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create71" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[7][1][]" value="1"  id="create71" class="create7 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read71" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[7][1][]" value="1"  id="read71" class="read7 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update71" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[7][1][]" value="1"  id="update71" class="edit7 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete71" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[7][1][]" value="1"  id="delete71" class="delete7 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Available Stock                                    <input type="hidden" name="fk_module_id[7][2][]"  value="103" id="id_103">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create72" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[7][2][]" value="1"  id="create72" class="create7 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read72" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[7][2][]" value="1"  id="read72" class="read7 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update72" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[7][2][]" value="1"  id="update72" class="edit7 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete72" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[7][2][]" value="1"  id="delete72" class="delete7 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Bank</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate8"><input type="checkbox" onclick="checkallcreate(8)" id="checkAllcreate8"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread8"><input type="checkbox" onclick="checkallread(8)" id="checkAllread8"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit8"><input type="checkbox" onclick="checkalledit(8)" id="checkAlledit8"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete8"><input type="checkbox" onclick="checkalldelete(8)" id="checkAlldelete8"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Bank                                    <input type="hidden" name="fk_module_id[8][0][]"  value="29" id="id_29">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create80" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[8][0][]" value="1"  id="create80" class="create8 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read80" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[8][0][]" value="1"  id="read80" class="read8 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update80" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[8][0][]" value="1"  id="update80" class="edit8 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete80" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[8][0][]" value="1"  id="delete80" class="delete8 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Bank List                                    <input type="hidden" name="fk_module_id[8][1][]"  value="30" id="id_30">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create81" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[8][1][]" value="1"  id="create81" class="create8 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read81" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[8][1][]" value="1"  id="read81" class="read8 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update81" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[8][1][]" value="1"  id="update81" class="edit8 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete81" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[8][1][]" value="1"  id="delete81" class="delete8 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Accounts</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate9"><input type="checkbox" onclick="checkallcreate(9)" id="checkAllcreate9"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread9"><input type="checkbox" onclick="checkallread(9)" id="checkAllread9"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit9"><input type="checkbox" onclick="checkalledit(9)" id="checkAlledit9"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete9"><input type="checkbox" onclick="checkalldelete(9)" id="checkAlldelete9"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Chart Of Accounts                                    <input type="hidden" name="fk_module_id[9][0][]"  value="31" id="id_31">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create90" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][0][]" value="1"  id="create90" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read90" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][0][]" value="1"  id="read90" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update90" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][0][]" value="1"  id="update90" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete90" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][0][]" value="1"  id="delete90" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Opening Balance                                    <input type="hidden" name="fk_module_id[9][1][]"  value="32" id="id_32">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create91" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][1][]" value="1"  id="create91" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read91" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][1][]" value="1"  id="read91" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update91" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][1][]" value="1"  id="update91" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete91" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][1][]" value="1"  id="delete91" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Manufacturer Payment                                    <input type="hidden" name="fk_module_id[9][2][]"  value="33" id="id_33">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create92" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][2][]" value="1"  id="create92" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read92" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][2][]" value="1"  id="read92" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update92" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][2][]" value="1"  id="update92" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete92" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][2][]" value="1"  id="delete92" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Customer Receive                                    <input type="hidden" name="fk_module_id[9][3][]"  value="34" id="id_34">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create93" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][3][]" value="1"  id="create93" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read93" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][3][]" value="1"  id="read93" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update93" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][3][]" value="1"  id="update93" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete93" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][3][]" value="1"  id="delete93" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>5</td>
                                <td>
                                    Cash Adjustment                                    <input type="hidden" name="fk_module_id[9][4][]"  value="35" id="id_35">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create94" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][4][]" value="1"  id="create94" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read94" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][4][]" value="1"  id="read94" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update94" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][4][]" value="1"  id="update94" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete94" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][4][]" value="1"  id="delete94" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>6</td>
                                <td>
                                    Debit Voucher                                    <input type="hidden" name="fk_module_id[9][5][]"  value="36" id="id_36">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create95" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][5][]" value="1"  id="create95" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read95" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][5][]" value="1"  id="read95" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update95" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][5][]" value="1"  id="update95" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete95" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][5][]" value="1"  id="delete95" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>7</td>
                                <td>
                                    Credit Voucher                                    <input type="hidden" name="fk_module_id[9][6][]"  value="37" id="id_37">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create96" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][6][]" value="1"  id="create96" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read96" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][6][]" value="1"  id="read96" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update96" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][6][]" value="1"  id="update96" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete96" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][6][]" value="1"  id="delete96" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>8</td>
                                <td>
                                    Contra Voucher                                    <input type="hidden" name="fk_module_id[9][7][]"  value="38" id="id_38">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create97" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][7][]" value="1"  id="create97" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read97" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][7][]" value="1"  id="read97" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update97" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][7][]" value="1"  id="update97" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete97" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][7][]" value="1"  id="delete97" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>9</td>
                                <td>
                                    Journal Voucher                                    <input type="hidden" name="fk_module_id[9][8][]"  value="39" id="id_39">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create98" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][8][]" value="1"  id="create98" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read98" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][8][]" value="1"  id="read98" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update98" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][8][]" value="1"  id="update98" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete98" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][8][]" value="1"  id="delete98" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>10</td>
                                <td>
                                    Voucher List                                    <input type="hidden" name="fk_module_id[9][9][]"  value="40" id="id_40">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create99" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][9][]" value="1"  id="create99" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read99" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][9][]" value="1"  id="read99" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update99" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][9][]" value="1"  id="update99" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete99" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][9][]" value="1"  id="delete99" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>11</td>
                                <td>
                                    Report                                    <input type="hidden" name="fk_module_id[9][10][]"  value="41" id="id_41">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create910" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][10][]" value="1"  id="create910" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read910" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][10][]" value="1"  id="read910" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update910" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][10][]" value="1"  id="update910" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete910" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][10][]" value="1"  id="delete910" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>12</td>
                                <td>
                                    Cash Book                                    <input type="hidden" name="fk_module_id[9][11][]"  value="42" id="id_42">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create911" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][11][]" value="1"  id="create911" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read911" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][11][]" value="1"  id="read911" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update911" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][11][]" value="1"  id="update911" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete911" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][11][]" value="1"  id="delete911" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>13</td>
                                <td>
                                    Bank Book                                    <input type="hidden" name="fk_module_id[9][12][]"  value="43" id="id_43">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create912" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][12][]" value="1"  id="create912" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read912" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][12][]" value="1"  id="read912" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update912" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][12][]" value="1"  id="update912" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete912" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][12][]" value="1"  id="delete912" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>14</td>
                                <td>
                                    General Ledger                                    <input type="hidden" name="fk_module_id[9][13][]"  value="44" id="id_44">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create913" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][13][]" value="1"  id="create913" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read913" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][13][]" value="1"  id="read913" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update913" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][13][]" value="1"  id="update913" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete913" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][13][]" value="1"  id="delete913" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>15</td>
                                <td>
                                    Trial Balance                                    <input type="hidden" name="fk_module_id[9][14][]"  value="46" id="id_46">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create914" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][14][]" value="1"  id="create914" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read914" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][14][]" value="1"  id="read914" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update914" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][14][]" value="1"  id="update914" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete914" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][14][]" value="1"  id="delete914" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>16</td>
                                <td>
                                    Profit Loss                                    <input type="hidden" name="fk_module_id[9][15][]"  value="47" id="id_47">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create915" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][15][]" value="1"  id="create915" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read915" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][15][]" value="1"  id="read915" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update915" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][15][]" value="1"  id="update915" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete915" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][15][]" value="1"  id="delete915" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>17</td>
                                <td>
                                    Cash Flow                                    <input type="hidden" name="fk_module_id[9][16][]"  value="48" id="id_48">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create916" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][16][]" value="1"  id="create916" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read916" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][16][]" value="1"  id="read916" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update916" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][16][]" value="1"  id="update916" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete916" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][16][]" value="1"  id="delete916" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>18</td>
                                <td>
                                    COA Print                                    <input type="hidden" name="fk_module_id[9][17][]"  value="49" id="id_49">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create917" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][17][]" value="1"  id="create917" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read917" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][17][]" value="1"  id="read917" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update917" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][17][]" value="1"  id="update917" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete917" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][17][]" value="1"  id="delete917" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>19</td>
                                <td>
                                    Balance Sheet                                    <input type="hidden" name="fk_module_id[9][18][]"  value="50" id="id_50">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create918" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[9][18][]" value="1"  id="create918" class="create9 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read918" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[9][18][]" value="1"  id="read918" class="read9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update918" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[9][18][]" value="1"  id="update918" class="edit9 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete918" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[9][18][]" value="1"  id="delete918" class="delete9 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Human Resource</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate10"><input type="checkbox" onclick="checkallcreate(10)" id="checkAllcreate10"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread10"><input type="checkbox" onclick="checkallread(10)" id="checkAllread10"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit10"><input type="checkbox" onclick="checkalledit(10)" id="checkAlledit10"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete10"><input type="checkbox" onclick="checkalldelete(10)" id="checkAlldelete10"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Employee                                    <input type="hidden" name="fk_module_id[10][0][]"  value="59" id="id_59">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create100" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][0][]" value="1"  id="create100" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read100" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][0][]" value="1"  id="read100" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update100" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][0][]" value="1"  id="update100" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete100" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][0][]" value="1"  id="delete100" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Add Designation                                    <input type="hidden" name="fk_module_id[10][1][]"  value="60" id="id_60">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create101" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][1][]" value="1"  id="create101" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read101" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][1][]" value="1"  id="read101" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update101" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][1][]" value="1"  id="update101" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete101" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][1][]" value="1"  id="delete101" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Designation List                                    <input type="hidden" name="fk_module_id[10][2][]"  value="61" id="id_61">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create102" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][2][]" value="1"  id="create102" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read102" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][2][]" value="1"  id="read102" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update102" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][2][]" value="1"  id="update102" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete102" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][2][]" value="1"  id="delete102" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Add Employee                                    <input type="hidden" name="fk_module_id[10][3][]"  value="62" id="id_62">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create103" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][3][]" value="1"  id="create103" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read103" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][3][]" value="1"  id="read103" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update103" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][3][]" value="1"  id="update103" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete103" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][3][]" value="1"  id="delete103" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>5</td>
                                <td>
                                    Employee List                                    <input type="hidden" name="fk_module_id[10][4][]"  value="63" id="id_63">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create104" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][4][]" value="1"  id="create104" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read104" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][4][]" value="1"  id="read104" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update104" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][4][]" value="1"  id="update104" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete104" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][4][]" value="1"  id="delete104" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>6</td>
                                <td>
                                    Attendance                                    <input type="hidden" name="fk_module_id[10][5][]"  value="64" id="id_64">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create105" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][5][]" value="1"  id="create105" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read105" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][5][]" value="1"  id="read105" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update105" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][5][]" value="1"  id="update105" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete105" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][5][]" value="1"  id="delete105" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>7</td>
                                <td>
                                    Add Attendance                                    <input type="hidden" name="fk_module_id[10][6][]"  value="65" id="id_65">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create106" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][6][]" value="1"  id="create106" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read106" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][6][]" value="1"  id="read106" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update106" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][6][]" value="1"  id="update106" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete106" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][6][]" value="1"  id="delete106" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>8</td>
                                <td>
                                    Attendance List                                    <input type="hidden" name="fk_module_id[10][7][]"  value="66" id="id_66">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create107" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][7][]" value="1"  id="create107" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read107" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][7][]" value="1"  id="read107" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update107" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][7][]" value="1"  id="update107" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete107" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][7][]" value="1"  id="delete107" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>9</td>
                                <td>
                                    Date Wise Attendance Report                                    <input type="hidden" name="fk_module_id[10][8][]"  value="67" id="id_67">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create108" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][8][]" value="1"  id="create108" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read108" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][8][]" value="1"  id="read108" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update108" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][8][]" value="1"  id="update108" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete108" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][8][]" value="1"  id="delete108" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>10</td>
                                <td>
                                    Payroll                                    <input type="hidden" name="fk_module_id[10][9][]"  value="68" id="id_68">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create109" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][9][]" value="1"  id="create109" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read109" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][9][]" value="1"  id="read109" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update109" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][9][]" value="1"  id="update109" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete109" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][9][]" value="1"  id="delete109" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>11</td>
                                <td>
                                    Add Benefits                                    <input type="hidden" name="fk_module_id[10][10][]"  value="69" id="id_69">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1010" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][10][]" value="1"  id="create1010" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1010" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][10][]" value="1"  id="read1010" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1010" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][10][]" value="1"  id="update1010" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1010" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][10][]" value="1"  id="delete1010" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>12</td>
                                <td>
                                    Benefit List                                    <input type="hidden" name="fk_module_id[10][11][]"  value="70" id="id_70">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1011" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][11][]" value="1"  id="create1011" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1011" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][11][]" value="1"  id="read1011" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1011" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][11][]" value="1"  id="update1011" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1011" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][11][]" value="1"  id="delete1011" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>13</td>
                                <td>
                                    Add Salary Setup                                    <input type="hidden" name="fk_module_id[10][12][]"  value="71" id="id_71">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1012" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][12][]" value="1"  id="create1012" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1012" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][12][]" value="1"  id="read1012" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1012" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][12][]" value="1"  id="update1012" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1012" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][12][]" value="1"  id="delete1012" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>14</td>
                                <td>
                                    Salary Setup List                                    <input type="hidden" name="fk_module_id[10][13][]"  value="72" id="id_72">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1013" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][13][]" value="1"  id="create1013" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1013" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][13][]" value="1"  id="read1013" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1013" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][13][]" value="1"  id="update1013" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1013" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][13][]" value="1"  id="delete1013" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>15</td>
                                <td>
                                    Salary Generate                                    <input type="hidden" name="fk_module_id[10][14][]"  value="73" id="id_73">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1014" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][14][]" value="1"  id="create1014" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1014" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][14][]" value="1"  id="read1014" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1014" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][14][]" value="1"  id="update1014" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1014" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][14][]" value="1"  id="delete1014" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>16</td>
                                <td>
                                    Salary Sheet                                    <input type="hidden" name="fk_module_id[10][15][]"  value="74" id="id_74">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1015" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][15][]" value="1"  id="create1015" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1015" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][15][]" value="1"  id="read1015" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1015" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][15][]" value="1"  id="update1015" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1015" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][15][]" value="1"  id="delete1015" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>17</td>
                                <td>
                                    Salary Payment                                    <input type="hidden" name="fk_module_id[10][16][]"  value="75" id="id_75">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1016" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][16][]" value="1"  id="create1016" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1016" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][16][]" value="1"  id="read1016" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1016" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][16][]" value="1"  id="update1016" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1016" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][16][]" value="1"  id="delete1016" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>18</td>
                                <td>
                                    Expense                                    <input type="hidden" name="fk_module_id[10][17][]"  value="76" id="id_76">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1017" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][17][]" value="1"  id="create1017" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1017" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][17][]" value="1"  id="read1017" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1017" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][17][]" value="1"  id="update1017" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1017" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][17][]" value="1"  id="delete1017" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>19</td>
                                <td>
                                    Add Expense Item                                    <input type="hidden" name="fk_module_id[10][18][]"  value="77" id="id_77">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1018" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][18][]" value="1"  id="create1018" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1018" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][18][]" value="1"  id="read1018" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1018" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][18][]" value="1"  id="update1018" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1018" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][18][]" value="1"  id="delete1018" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>20</td>
                                <td>
                                    Expense Item List                                    <input type="hidden" name="fk_module_id[10][19][]"  value="78" id="id_78">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1019" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][19][]" value="1"  id="create1019" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1019" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][19][]" value="1"  id="read1019" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1019" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][19][]" value="1"  id="update1019" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1019" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][19][]" value="1"  id="delete1019" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>21</td>
                                <td>
                                    Add Expense                                    <input type="hidden" name="fk_module_id[10][20][]"  value="79" id="id_79">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1020" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][20][]" value="1"  id="create1020" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1020" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][20][]" value="1"  id="read1020" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1020" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][20][]" value="1"  id="update1020" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1020" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][20][]" value="1"  id="delete1020" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>22</td>
                                <td>
                                    Expense List                                    <input type="hidden" name="fk_module_id[10][21][]"  value="80" id="id_80">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1021" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][21][]" value="1"  id="create1021" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1021" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][21][]" value="1"  id="read1021" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1021" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][21][]" value="1"  id="update1021" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1021" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][21][]" value="1"  id="delete1021" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>23</td>
                                <td>
                                    Expense Statement                                    <input type="hidden" name="fk_module_id[10][22][]"  value="81" id="id_81">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1022" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][22][]" value="1"  id="create1022" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1022" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][22][]" value="1"  id="read1022" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1022" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][22][]" value="1"  id="update1022" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1022" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][22][]" value="1"  id="delete1022" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>24</td>
                                <td>
                                    Loan                                    <input type="hidden" name="fk_module_id[10][23][]"  value="82" id="id_82">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1023" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][23][]" value="1"  id="create1023" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1023" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][23][]" value="1"  id="read1023" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1023" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][23][]" value="1"  id="update1023" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1023" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][23][]" value="1"  id="delete1023" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>25</td>
                                <td>
                                    Add Person                                    <input type="hidden" name="fk_module_id[10][24][]"  value="83" id="id_83">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1024" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][24][]" value="1"  id="create1024" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1024" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][24][]" value="1"  id="read1024" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1024" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][24][]" value="1"  id="update1024" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1024" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][24][]" value="1"  id="delete1024" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>26</td>
                                <td>
                                    Person List                                    <input type="hidden" name="fk_module_id[10][25][]"  value="84" id="id_84">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1025" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][25][]" value="1"  id="create1025" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1025" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][25][]" value="1"  id="read1025" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1025" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][25][]" value="1"  id="update1025" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1025" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][25][]" value="1"  id="delete1025" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>27</td>
                                <td>
                                    Add Loan                                    <input type="hidden" name="fk_module_id[10][26][]"  value="85" id="id_85">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1026" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][26][]" value="1"  id="create1026" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1026" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][26][]" value="1"  id="read1026" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1026" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][26][]" value="1"  id="update1026" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1026" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][26][]" value="1"  id="delete1026" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>28</td>
                                <td>
                                    Add Payment                                    <input type="hidden" name="fk_module_id[10][27][]"  value="86" id="id_86">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1027" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][27][]" value="1"  id="create1027" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1027" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][27][]" value="1"  id="read1027" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1027" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][27][]" value="1"  id="update1027" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1027" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][27][]" value="1"  id="delete1027" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>29</td>
                                <td>
                                    Loan List                                    <input type="hidden" name="fk_module_id[10][28][]"  value="87" id="id_87">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1028" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][28][]" value="1"  id="create1028" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1028" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][28][]" value="1"  id="read1028" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1028" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][28][]" value="1"  id="update1028" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1028" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][28][]" value="1"  id="delete1028" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>30</td>
                                <td>
                                    Person Ledger                                    <input type="hidden" name="fk_module_id[10][29][]"  value="88" id="id_88">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1029" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[10][29][]" value="1"  id="create1029" class="create10 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1029" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[10][29][]" value="1"  id="read1029" class="read10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1029" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[10][29][]" value="1"  id="update1029" class="edit10 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1029" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[10][29][]" value="1"  id="delete1029" class="delete10 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Service</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate11"><input type="checkbox" onclick="checkallcreate(11)" id="checkAllcreate11"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread11"><input type="checkbox" onclick="checkallread(11)" id="checkAllread11"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit11"><input type="checkbox" onclick="checkalledit(11)" id="checkAlledit11"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete11"><input type="checkbox" onclick="checkalldelete(11)" id="checkAlldelete11"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Service                                    <input type="hidden" name="fk_module_id[11][0][]"  value="92" id="id_92">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create110" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[11][0][]" value="1"  id="create110" class="create11 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read110" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[11][0][]" value="1"  id="read110" class="read11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update110" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[11][0][]" value="1"  id="update110" class="edit11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete110" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[11][0][]" value="1"  id="delete110" class="delete11 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Service List                                    <input type="hidden" name="fk_module_id[11][1][]"  value="93" id="id_93">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create111" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[11][1][]" value="1"  id="create111" class="create11 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read111" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[11][1][]" value="1"  id="read111" class="read11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update111" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[11][1][]" value="1"  id="update111" class="edit11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete111" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[11][1][]" value="1"  id="delete111" class="delete11 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Add Invoice                                    <input type="hidden" name="fk_module_id[11][2][]"  value="94" id="id_94">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create112" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[11][2][]" value="1"  id="create112" class="create11 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read112" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[11][2][]" value="1"  id="read112" class="read11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update112" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[11][2][]" value="1"  id="update112" class="edit11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete112" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[11][2][]" value="1"  id="delete112" class="delete11 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Invoice List                                    <input type="hidden" name="fk_module_id[11][3][]"  value="95" id="id_95">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create113" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[11][3][]" value="1"  id="create113" class="create11 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read113" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[11][3][]" value="1"  id="read113" class="read11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update113" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[11][3][]" value="1"  id="update113" class="edit11 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete113" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[11][3][]" value="1"  id="delete113" class="delete11 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Report</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate12"><input type="checkbox" onclick="checkallcreate(12)" id="checkAllcreate12"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread12"><input type="checkbox" onclick="checkallread(12)" id="checkAllread12"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit12"><input type="checkbox" onclick="checkalledit(12)" id="checkAlledit12"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete12"><input type="checkbox" onclick="checkalldelete(12)" id="checkAlldelete12"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add Closing                                    <input type="hidden" name="fk_module_id[12][0][]"  value="51" id="id_51">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create120" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][0][]" value="1"  id="create120" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read120" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][0][]" value="1"  id="read120" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update120" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][0][]" value="1"  id="update120" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete120" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][0][]" value="1"  id="delete120" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Closing List                                    <input type="hidden" name="fk_module_id[12][1][]"  value="52" id="id_52">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create121" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][1][]" value="1"  id="create121" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read121" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][1][]" value="1"  id="read121" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update121" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][1][]" value="1"  id="update121" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete121" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][1][]" value="1"  id="delete121" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Sales Report                                    <input type="hidden" name="fk_module_id[12][2][]"  value="53" id="id_53">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create122" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][2][]" value="1"  id="create122" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read122" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][2][]" value="1"  id="read122" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update122" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][2][]" value="1"  id="update122" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete122" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][2][]" value="1"  id="delete122" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Sales Report (User)                                    <input type="hidden" name="fk_module_id[12][3][]"  value="54" id="id_54">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create123" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][3][]" value="1"  id="create123" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read123" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][3][]" value="1"  id="read123" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update123" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][3][]" value="1"  id="update123" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete123" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][3][]" value="1"  id="delete123" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>5</td>
                                <td>
                                    Sales Report (Product)                                    <input type="hidden" name="fk_module_id[12][4][]"  value="55" id="id_55">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create124" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][4][]" value="1"  id="create124" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read124" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][4][]" value="1"  id="read124" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update124" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][4][]" value="1"  id="update124" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete124" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][4][]" value="1"  id="delete124" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>6</td>
                                <td>
                                    Sales Report (Category)                                    <input type="hidden" name="fk_module_id[12][5][]"  value="56" id="id_56">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create125" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][5][]" value="1"  id="create125" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read125" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][5][]" value="1"  id="read125" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update125" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][5][]" value="1"  id="update125" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete125" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][5][]" value="1"  id="delete125" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>7</td>
                                <td>
                                    Purchase Report                                    <input type="hidden" name="fk_module_id[12][6][]"  value="57" id="id_57">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create126" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][6][]" value="1"  id="create126" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read126" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][6][]" value="1"  id="read126" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update126" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][6][]" value="1"  id="update126" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete126" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][6][]" value="1"  id="delete126" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>8</td>
                                <td>
                                    Purchase Report(Category)                                    <input type="hidden" name="fk_module_id[12][7][]"  value="58" id="id_58">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create127" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[12][7][]" value="1"  id="create127" class="create12 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read127" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[12][7][]" value="1"  id="read127" class="read12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update127" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[12][7][]" value="1"  id="update127" class="edit12 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete127" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[12][7][]" value="1"  id="delete127" class="delete12 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Tax</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate13"><input type="checkbox" onclick="checkallcreate(13)" id="checkAllcreate13"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread13"><input type="checkbox" onclick="checkallread(13)" id="checkAllread13"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit13"><input type="checkbox" onclick="checkalledit(13)" id="checkAlledit13"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete13"><input type="checkbox" onclick="checkalldelete(13)" id="checkAlldelete13"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Tax Settings                                    <input type="hidden" name="fk_module_id[13][0][]"  value="89" id="id_89">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create130" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[13][0][]" value="1"  id="create130" class="create13 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read130" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[13][0][]" value="1"  id="read130" class="read13 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update130" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[13][0][]" value="1"  id="update130" class="edit13 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete130" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[13][0][]" value="1"  id="delete130" class="delete13 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Add Income Tax                                    <input type="hidden" name="fk_module_id[13][1][]"  value="90" id="id_90">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create131" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[13][1][]" value="1"  id="create131" class="create13 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read131" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[13][1][]" value="1"  id="read131" class="read13 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update131" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[13][1][]" value="1"  id="update131" class="edit13 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete131" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[13][1][]" value="1"  id="delete131" class="delete13 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Income Tax List                                    <input type="hidden" name="fk_module_id[13][2][]"  value="91" id="id_91">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create132" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[13][2][]" value="1"  id="create132" class="create13 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read132" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[13][2][]" value="1"  id="read132" class="read13 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update132" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[13][2][]" value="1"  id="update132" class="edit13 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete132" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[13][2][]" value="1"  id="delete132" class="delete13 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Search</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate14"><input type="checkbox" onclick="checkallcreate(14)" id="checkAllcreate14"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread14"><input type="checkbox" onclick="checkallread(14)" id="checkAllread14"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit14"><input type="checkbox" onclick="checkalledit(14)" id="checkAlledit14"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete14"><input type="checkbox" onclick="checkalldelete(14)" id="checkAlldelete14"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Medicine Search                                    <input type="hidden" name="fk_module_id[14][0][]"  value="96" id="id_96">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create140" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[14][0][]" value="1"  id="create140" class="create14 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read140" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[14][0][]" value="1"  id="read140" class="read14 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update140" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[14][0][]" value="1"  id="update140" class="edit14 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete140" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[14][0][]" value="1"  id="delete140" class="delete14 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    Invoice Search                                    <input type="hidden" name="fk_module_id[14][1][]"  value="97" id="id_97">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create141" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[14][1][]" value="1"  id="create141" class="create14 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read141" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[14][1][]" value="1"  id="read141" class="read14 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update141" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[14][1][]" value="1"  id="update141" class="edit14 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete141" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[14][1][]" value="1"  id="delete141" class="delete14 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Purchase Search                                    <input type="hidden" name="fk_module_id[14][2][]"  value="98" id="id_98">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create142" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[14][2][]" value="1"  id="create142" class="create14 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read142" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[14][2][]" value="1"  id="read142" class="read14 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update142" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[14][2][]" value="1"  id="update142" class="edit14 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete142" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[14][2][]" value="1"  id="delete142" class="delete14 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <table class="table table-bordered">
                    <h2 class="">Application Setting</h2>
                    <thead>
                    <tr>
                        <th class="text-center">Sl</th>
                        <th class="text-center">Menu Name</th>
                        <th class="text-center">Create(<label for="checkAllcreate15"><input type="checkbox" onclick="checkallcreate(15)" id="checkAllcreate15"  name="" > All)</label> </th>
                        <th class="text-center">Read (<label for="checkAllread15"><input type="checkbox" onclick="checkallread(15)" id="checkAllread15"  name="" > All)</label></th>
                        <th class="text-center">Update  (<label for="checkAlledit15"><input type="checkbox" onclick="checkalledit(15)" id="checkAlledit15"  name="" > All)</label></th>
                        <th class="text-center">Delete (<label for="checkAlldelete15"><input type="checkbox" onclick="checkalldelete(15)" id="checkAlldelete15"  name="" > All)</label></th>
                    </tr>
                    </thead>
                                                                
                                                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    Add User                                    <input type="hidden" name="fk_module_id[15][0][]"  value="99" id="id_99">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create150" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][0][]" value="1"  id="create150" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read150" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][0][]" value="1"  id="read150" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update150" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][0][]" value="1"  id="update150" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete150" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][0][]" value="1"  id="delete150" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>2</td>
                                <td>
                                    User List                                    <input type="hidden" name="fk_module_id[15][1][]"  value="100" id="id_100">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create151" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][1][]" value="1"  id="create151" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read151" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][1][]" value="1"  id="read151" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update151" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][1][]" value="1"  id="update151" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete151" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][1][]" value="1"  id="delete151" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>3</td>
                                <td>
                                    Currency                                    <input type="hidden" name="fk_module_id[15][2][]"  value="101" id="id_101">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create152" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][2][]" value="1"  id="create152" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read152" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][2][]" value="1"  id="read152" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update152" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][2][]" value="1"  id="update152" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete152" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][2][]" value="1"  id="delete152" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>4</td>
                                <td>
                                    Setting                                    <input type="hidden" name="fk_module_id[15][3][]"  value="102" id="id_102">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create153" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][3][]" value="1"  id="create153" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read153" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][3][]" value="1"  id="read153" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update153" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][3][]" value="1"  id="update153" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete153" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][3][]" value="1"  id="delete153" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>5</td>
                                <td>
                                    Download Backup                                    <input type="hidden" name="fk_module_id[15][4][]"  value="104" id="id_104">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create154" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][4][]" value="1"  id="create154" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read154" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][4][]" value="1"  id="read154" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update154" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][4][]" value="1"  id="update154" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete154" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][4][]" value="1"  id="delete154" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>6</td>
                                <td>
                                    Restore Database                                    <input type="hidden" name="fk_module_id[15][5][]"  value="105" id="id_105">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create155" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][5][]" value="1"  id="create155" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read155" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][5][]" value="1"  id="read155" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update155" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][5][]" value="1"  id="update155" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete155" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][5][]" value="1"  id="delete155" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>7</td>
                                <td>
                                    Database Import                                    <input type="hidden" name="fk_module_id[15][6][]"  value="106" id="id_106">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create156" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][6][]" value="1"  id="create156" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read156" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][6][]" value="1"  id="read156" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update156" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][6][]" value="1"  id="update156" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete156" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][6][]" value="1"  id="delete156" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>8</td>
                                <td>
                                    Panel Setting                                    <input type="hidden" name="fk_module_id[15][7][]"  value="107" id="id_107">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create157" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][7][]" value="1"  id="create157" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read157" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][7][]" value="1"  id="read157" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update157" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][7][]" value="1"  id="update157" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete157" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][7][]" value="1"  id="delete157" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>9</td>
                                <td>
                                    Add Role                                    <input type="hidden" name="fk_module_id[15][8][]"  value="108" id="id_108">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create158" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][8][]" value="1"  id="create158" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read158" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][8][]" value="1"  id="read158" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update158" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][8][]" value="1"  id="update158" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete158" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][8][]" value="1"  id="delete158" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>10</td>
                                <td>
                                    Role List                                    <input type="hidden" name="fk_module_id[15][9][]"  value="109" id="id_109">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create159" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][9][]" value="1"  id="create159" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read159" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][9][]" value="1"  id="read159" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update159" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][9][]" value="1"  id="update159" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete159" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][9][]" value="1"  id="delete159" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>11</td>
                                <td>
                                    Assign Role                                    <input type="hidden" name="fk_module_id[15][10][]"  value="110" id="id_110">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1510" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][10][]" value="1"  id="create1510" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1510" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][10][]" value="1"  id="read1510" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1510" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][10][]" value="1"  id="update1510" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1510" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][10][]" value="1"  id="delete1510" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                    
                                                        <tbody>
                            <tr>
                                <td>12</td>
                                <td>
                                    Language                                    <input type="hidden" name="fk_module_id[15][11][]"  value="111" id="id_111">

                                </td>
                                <td class="text-center">
                                    
                                  
                                    <div class="checkbox-success checked text-center text-green">
                                         <label for="create1511" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="create[15][11][]" value="1"  id="create1511" class="create15 custom-control-input">
                                          <span class="custom-control-indicator"></span>  
                                       </label>
                         
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="read1511" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="read[15][11][]" value="1"  id="read1511" class="read15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                    
                                    <div class="checkbox-success checked text-center">
                                        <label for="update1511" class="custom-control custom-checkbox">
                                        <input type="checkbox" name="update[15][11][]" value="1"  id="update1511" class="edit15 custom-control-input">
                                         <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                                <td class="text-center">
                                   
                                    <div class="checkbox-success checked text-center">
                                        <label for="delete1511" class="custom-control custom-checkbox">
                                         <input type="checkbox" name="delete[15][11][]" value="1"  id="delete1511" class="delete15 custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        </label>
                                   
                            </div>
                                </td>
                            </tr>
                            </tbody>
                                                                                        </table>
                                <div class="form-group text-right">
                <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
            </div>
            </form>
            </div>
                   
                   </div>
               </div>                    

								</div>
							</div>
						</div>
					<!-- </div>
				</div>
			</div>
		</div>		
	</div> -->


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

    <script src="../js/selecetor2.js"></script>

</body>
</html>

<?php } ?>