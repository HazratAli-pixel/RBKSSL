<?php
session_start();
error_reporting(0);
// Include the main TCPDF library (search for installation path).
require_once('../TCPDF/tcpdf.php');
require_once('../constant.php');
// require_once('./includes/config.php');



// DB credentials.
    try
    {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }

    $domain = "localhost/url/";
    $con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
    }
	
	$customReport = $_GET['customReport'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $SID = $_GET['SID'];
    $PID = $_GET['PID'];
    if(strlen($SID) ==0 && strlen($PID) != 0 ){
        $sql = "SELECT sellingproduct.InvoiceId, sellingproduct.ProductId as PID, sellingproduct.BatchId as BID, sellingproduct.Qty,sellingproduct.NetPrice as Price, sellingproduct.Price as totalPrice, sellingproduct.Date, sellingproduct.shopId, sellingproduct.branchId, medicine_list.medicine_name as Pname, users.UserId as UID, users.Name as Uname FROM sellingproduct JOIN medicine_list ON sellingproduct.ProductId = medicine_list.item_code JOIN users ON users.UserId = sellingproduct.SellerId WHERE sellingproduct.shopId =:shopId  AND sellingproduct.Date BETWEEN :sellStartDate  AND :sellEndDate AND sellingproduct.ProductId Like :PID";
        $query = $dbh -> prepare($sql);
        $query->execute([':shopId' => $_SESSION['user']['shopId'],':sellStartDate' => $startDate, ':sellEndDate' => $endDate, ':PID' => $PID]);
    }
    if(strlen($SID) !=0 && strlen($PID) == 0 ){
        $sql = "SELECT sellingproduct.InvoiceId, sellingproduct.ProductId as PID, sellingproduct.BatchId as BID, sellingproduct.Qty,sellingproduct.NetPrice as Price, sellingproduct.Price as totalPrice, sellingproduct.Date, sellingproduct.shopId, sellingproduct.branchId, medicine_list.medicine_name as Pname, users.UserId as UID, users.Name as Uname FROM sellingproduct JOIN medicine_list ON sellingproduct.ProductId = medicine_list.item_code JOIN users ON users.UserId = sellingproduct.SellerId WHERE sellingproduct.shopId =:shopId  AND sellingproduct.Date BETWEEN :sellStartDate  AND :sellEndDate AND sellingproduct.SellerId Like :SID";
        $query = $dbh -> prepare($sql);
        $query->execute([':shopId' => $_SESSION['user']['shopId'],':sellStartDate' => $startDate, ':sellEndDate' => $endDate, ':SID' => $SID]);
    }
    if(strlen($SID) !=0 && strlen($PID) != 0 ){
        $sql = "SELECT sellingproduct.InvoiceId, sellingproduct.ProductId as PID, sellingproduct.BatchId as BID, sellingproduct.Qty,sellingproduct.NetPrice as Price, sellingproduct.Price as totalPrice, sellingproduct.Date, sellingproduct.shopId, sellingproduct.branchId, medicine_list.medicine_name as Pname, users.UserId as UID, users.Name as Uname FROM sellingproduct JOIN medicine_list ON sellingproduct.ProductId = medicine_list.item_code JOIN users ON users.UserId = sellingproduct.SellerId WHERE sellingproduct.shopId =:shopId  AND sellingproduct.Date BETWEEN :sellStartDate  AND :sellEndDate AND sellingproduct.ProductId Like :PID AND sellingproduct.SellerId Like :SID";
        $query = $dbh -> prepare($sql);
        $query->execute([':shopId' => $_SESSION['user']['shopId'],':sellStartDate' => $startDate, ':sellEndDate' => $endDate, ':PID' => $PID, ':SID' => $SID]);
    }
    if(strlen($SID) ==0 && strlen($PID) == 0 ){
        $sql = "SELECT sellingproduct.InvoiceId, sellingproduct.ProductId as PID, sellingproduct.BatchId as BID, sellingproduct.Qty,sellingproduct.NetPrice as Price, sellingproduct.Price as totalPrice, sellingproduct.Date, sellingproduct.shopId, sellingproduct.branchId, medicine_list.medicine_name as Pname, users.UserId as UID, users.Name as Uname FROM sellingproduct JOIN medicine_list ON sellingproduct.ProductId = medicine_list.item_code JOIN users ON users.UserId = sellingproduct.SellerId WHERE sellingproduct.shopId =:shopId  AND sellingproduct.Date BETWEEN :sellStartDate  AND :sellEndDate";
        $query = $dbh -> prepare($sql);
        $query->execute([':shopId' => $_SESSION['user']['shopId'],':sellStartDate' => $startDate, ':sellEndDate' => $endDate]);
    }
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$cnt=1;


	


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf = new TCPDF('P', 'mm', array(150, 250), true, 'UTF-8', false);
// set document information
$pdf->SetCreator("Hazrat Ali");
$pdf->SetAuthor('Hazrat Ali');
$pdf->SetTitle('File name');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData("dshop.jpeg", 20, $_SESSION['user']['shopName'], $_SESSION['user']['branchName'].", ".$_SESSION['user']['branchsAddress']."\n"."Phone: ".$_SESSION['user']['branchPhone']);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 12));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage();

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
// SELECT sellingproduct.InvoiceId, sellingproduct.ProductId as PID, sellingproduct.BatchId as BID, sellingproduct.Qty,sellingproduct.NetPrice as Price, sellingproduct.Price as totalPrice, sellingproduct.Date, sellingproduct.shopId, sellingproduct.branchId, medicine_list.medicine_name as Pname, users.UserId as UID, users.Name as Uname 

date_default_timezone_set('Asia/Dhaka');
// $DateTime = date('Y-m-d h:i:s');
$DateTime = date('H:i:s');
$SL='';
$cnt=1;
$ProductLists='';
$ProductID='';
$batchNo='';
$InvoiceNo='';
$ProductQty='';
$ProductPrice='';
$TotalPrice='';
$Date='';
$SellerName='';
if($query->rowCount() > 0){
	foreach($results as $result){
		$Data.='
		<tr>
			<td colspan="1" align="center">'."$cnt".'</td>
			<td colspan="2">'."$result->Pname".'</td>
			<td colspan="2" align="center">'."$result->PID".'</td>
			<td colspan="1" align="right">'."$result->BID".'</td>
			<td colspan="1" align="right">'."$result->Qty".'</td>
			<td colspan="1" align="right">'."$result->Price".'</td>
			<td colspan="2" align="right">'."$result->Date".'</td>
			<td colspan="2" align="right">'."$result->Uname".'</td>
		</tr>';
		$cnt=$cnt+1;
	}
}


$html = '
<table border="1" cellspacing="none" cellpadding="4">
	<tr>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="1" align="center" >SL No</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" >Name</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="center">P.ID</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="1" align="right">B. NO</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="1" align="right">Qty</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="1" align="right">T.Price</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="right">Date</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="right">Seller</th>
	</tr>'.$Data.'
</table>';





// $pdf->writeHTML($invoiceDetails, true, false, true, false, '');
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->writeHTMLCell(0, 0, '0', '255', $FooterPart, '0', 0, 0, false, 'C', false);


// reset pointer to the last page
$pdf->lastPage();

if($_GET['ptype']=='D'){
	$pdf->Output("Sales Report".".pdf", 'D');
}
else $pdf->Output("Sales Report_".".pdf", 'I');

