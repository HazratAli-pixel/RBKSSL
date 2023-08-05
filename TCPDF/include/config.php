<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
// define('DB_NAME','dshop');
define('DB_NAME','pharmacy_management_system');
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
$con=mysqli_connect("localhost", "root", "", "pharmacy_management_system");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}
?>