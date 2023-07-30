<?php
session_start();
error_reporting(0);
// Include the main TCPDF library (search for installation path).
require_once('../TCPDF/tcpdf.php');
// require_once('./includes/config.php');



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

    $domain = "localhost/url/";
    $con=mysqli_connect("localhost", "root", "", "pharmacy_management_system");
    if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
    }
	$invoieId = $_GET['invoiceid'];
	// $invoieId = 187;

	// $sql = "SELECT * from  customertable";
	$sql = "SELECT customertable.Name, customertable.Address, customertable.Phone, invoice.ID, invoice.SellerID, invoice.NetPayment, invoice.PreDue, invoice.discount,invoice.discount,invoice.Tax,invoice.Total_with_due,invoice.DueAmount, users.Name as UName, invoice.date, invoice.PaidAmount FROM `invoice` JOIN customertable ON invoice.CustomerID = customertable.ID JOIN users ON users.UserId = invoice.SellerID WHERE invoice.ID=:invoieId AND invoice.shopId=:shopId";
    $query = $dbh -> prepare($sql);
	$query->bindParam(':invoieId',$invoieId,PDO::PARAM_STR);
	$query->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
    $query->execute();
	$results=$query->fetch(PDO::FETCH_OBJ);

	$sql2 = "SELECT invoice.ID, invoice.shopId, invoice.branchId, invoice.CustomerID, sellingproduct.ProductId, sellingproduct.NetPrice, sellingproduct.Qty,sellingproduct.Price, medicine_list.medicine_name, medicine_list.strength, medicine_list.menufacturer FROM invoice JOIN sellingproduct ON invoice.ID= sellingproduct.InvoiceId JOIN medicine_list ON medicine_list.item_code = sellingproduct.ProductId WHERE invoice.ID=:invoieId AND invoice.shopId=:shopId";
    $query2 = $dbh -> prepare($sql2);
	$query2->bindParam(':invoieId',$invoieId,PDO::PARAM_STR);
	// $query->bindParam(':shopId',$invoieId,PDO::PARAM_STR);
	$query2->bindParam(':shopId',$_SESSION['user']['shopId'],PDO::PARAM_STR);
    $query2->execute();
    $ProductList=$query2->fetchAll(PDO::FETCH_OBJ);


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
$pdf->SetHeaderData("dshop.jpeg", 20, $_SESSION['user']['shopName'], $_SESSION['user']['branchName'].", ".$_SESSION['user']['branchsAddress']."\n"."Phone: ".$_SESSION['user']['branchsPhone']);

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


date_default_timezone_set('Asia/Dhaka');
// $DateTime = date('Y-m-d h:i:s');
$DateTime = date('H:i:s');
$SL='';
$cnt=1;
$ProductLists='';
$Quentity='';
$UnitPrice='';
$TotalPrice='';
$GrandTotal='';
if($query2->rowCount() > 0){
	foreach($ProductList as $product){
		$SL.="$cnt"."<br/>";
		$ProductLists.=$product->medicine_name.' ('.$product->strength.')'."<br/>";
		$Quentity.=$product->Qty."<br/>";
		$UnitPrice.=$product->NetPrice."<br/>";
		$TotalPrice.=$product->Price."<br/>";
		$cnt=$cnt+1;
		$GrandTotal=$GrandTotal+$product->Price;
	}
}



$invoiceDetails='
<table style="padding-top: 10px" border="none" >
	<tr>
		<td style="font-weight: bold;" colspan="2" >Sales Order</td>
		<td style="font-weight: bold;" colspan="10">:</td>
	</tr>
	<tr>
		<td style="font-weight: bold;" colspan="2"  >Name</td>
		<td colspan="4"  >: '."$results->Name".'</td>
		<td style="font-weight: bold;" colspan="2"  >Date</td>
		<td colspan="4"  >: '."$results->date".'</td>
	</tr>
	<tr>
		<td style="font-weight: bold;" colspan="2"  >Phone</td>
		<td colspan="4"  >: '."$results->Phone".'</td>
		<td style="font-weight: bold;" colspan="2"  >Time</td>
		<td colspan="4"  >: '."$DateTime".'</td>
	</tr>
	<tr>
		<td style="font-weight: bold;" colspan="2"  >Bill No</td>
		<td colspan="4"  >: '."$results->ID".'</td>
		<td style="font-weight: bold;" colspan="2"  >Sold By</td>
		<td colspan="4"  >: '."$results->UName ".'</td>
	</tr>
    <tr>
		<td style="font-weight: bold;" colspan="2" >Address</td>
		<td colspan="10" >: '."$results->Address".'</td>
	</tr>
</table>';



$html = '
<table border="1" cellspacing="none" cellpadding="4">
	<tr>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="1" align="center" >SL No</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="5" >Product Description</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="center">Quantity</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="right">Unit Price</th>
		<th bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="right">Total Price</th>
	</tr>
	<tr>
		<td colspan="1" align="center">'."$SL".'</td>
		<td colspan="5">'."$ProductLists".'</td>
		<td colspan="2" align="center">'."$Quentity".'</td>
		<td colspan="2" align="right">'."$UnitPrice".'</td>
		<td colspan="2" align="right">'."$TotalPrice".'</td>
	</tr>
	<tr>
		<td colspan="6" ></td>
		<td colspan="4" >Total Amount</td>
		<td bgcolor="#cccccc" style="font-weight: bold;" colspan="2" align="right">'.number_format($GrandTotal).'</td>
	</tr>

</table>';


$calculation='
<table border="none" style="padding-top: 10px"  >
	<tr>
		<td colspan="6" ></td>
		<td colspan="3" >Discount</td>
		<td align="center" >:</td>
		<td colspan="2" align="right">'.number_format("$results->discount").'</td>
	</tr>
	<tr>
        <td colspan="6" ></td>
		<td colspan="3" >Vat</td>
        <td align="center" >:</td>
		<td colspan="2" align="right">'.number_format("$results->Tax").'</td>
	</tr>
	<tr>
		<td colspan="6" ></td>
		<td colspan="3" >Total</td>
		<td align="center" >:</td>
		<td colspan="2" align="right">'.number_format("$results->NetPayment").'</td>
	</tr>
	<tr>
		<td colspan="6" ></td>
		<td colspan="3" >Priviou Dues</td>
		<td align="center" >:</td>
		<td colspan="2" align="right">'.number_format("$results->PreDue").'</td>
	</tr>
	<tr>
        <td colspan="6" ></td>
		<td colspan="3" >Total</td>
        <td align="center" >:</td>
		<td colspan="2" align="right">'.number_format("$results->Total_with_due").'</td>
	</tr>
	<tr>
        <td colspan="6" ></td>
		<td colspan="3" >Cash received</td>
        <td align="center" >:</td>
		<td colspan="2" align="right">'.number_format("$results->PaidAmount").'</td>
	</tr>
	<tr>
        <td colspan="6" ></td>
		<td colspan="3" >Due Amount</td>
        <td align="center" >:</td>
		<td colspan="2" color="red" style="font-weight: bold;"  align="right">'.number_format("$results->DueAmount").'</td>
	</tr>
</table>';

$Signature='
<table border="none" style="padding-top: 10px"  >
	<tr>
		<td colspan="5" ></td>
		<td colspan="2" ></td>
		<td colspan="5" ></td>
	</tr>
	<tr>
		<td colspan="5" ></td>
		<td colspan="2" ></td>
		<td colspan="5" ></td>
	</tr>
	<tr>
		<td colspan="5" ></td>
		<td colspan="2" ></td>
		<td colspan="5" ></td>
	</tr>
	<tr>
		<td colspan="5" ></td>
		<td colspan="2" ></td>
		<td colspan="5" ></td>
	</tr>
	<tr>
        <td colspan="5" ><hr/></td>
        <td colspan="2" ></td>
		<td colspan="5" ><hr/></td>
	</tr>
	<tr>
        <td colspan="5" align="center">Received With Good Condition by</td>
        <td colspan="2" ></td>
		<td colspan="5" align="center" >Authorised Signature and Company Stamp</td>
	</tr>

</table>';



$FooterPart = '
<span color="red" align="center">Warranty is not applicable on any Physically damaged items</span> <br />
<span color="green" align="center">Thank You for choosing Us</span> <br />
<span color="green" align="center">Digital shop software - 01306440448 or <a href="www.hazratinfo.com">hazratinfo</a></span>';



$pdf->writeHTML($invoiceDetails, true, false, true, false, '');
$pdf->writeHTML($html.$calculation, true, false, true, false, '');
$pdf->writeHTML($Signature, true, false, true, false, '');


// $pdf->writeHTMLCell(0, 0, '10', '185', $Signature, '0', 0, 0, false, 'C', false);
$pdf->writeHTMLCell(0, 0, '0', '255', $FooterPart, '0', 0, 0, false, 'C', false);
// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);


// reset pointer to the last page
$pdf->lastPage();

if($_GET['ptype']=='D'){
	$pdf->Output($results->Name.'_'.$results->Phone.'_'.$results->ID.".pdf", 'D');
}
else $pdf->Output($results->Name.'_'.$results->Phone.'_'.$results->ID.".pdf", 'I');



