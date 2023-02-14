<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','ckamscom_hazratali');
define('DB_PASS','&zc9kEEs1o%5');
define('DB_NAME','ckamscom_pms');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>

<?php
$domain = "localhost/url/";
$con=mysqli_connect("localhost", "ckamscom_hazratali", "&zc9kEEs1o%5", "ckamscom_pms");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}
?>