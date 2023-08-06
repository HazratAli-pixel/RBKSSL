<?php 
session_start();
//error_reporting(0);
session_regenerate_id(true);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
	header("Location: index.php"); //
	}
	else{?>
<table border="1">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Mobile No</th>
											
										</tr>
									</thead>

<?php 
$filename="Medicine list";
$sql = "SELECT * from  medicine_list ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				

	echo '  
	<tr>  
	<td>'.$cnt.'</td> 
	<td>'.$complainNumber= $result->medicine_name.'</td> 
	<td>'.	$MobileNumber= $result->item_code.'</td> 		
	<td>'.	$MobileNumber= $result->unit.'</td> 		
	<td>'.	$MobileNumber= $result->menufacturer.'</td> 		
	</tr>  
	';
	$cnt++;
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-report.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
	}
?>
</table>
<?php } ?>