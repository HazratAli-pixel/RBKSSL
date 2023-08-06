<?php 
session_start();
error_reporting(0);
include('../includes/config.php');

if(isset($_GET['customReport'])){
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

    
    $Data = "<table id='zctb' class='display table bg-light table-bordered table-hover' >
        <thead class='bg-style'>
            <tr>
                <th>#</th>
                <th>P Name</th>
                <th class='text-center'>P ID</th>
                <th class='text-center'>B ID</th>
                <th class='text-center'>Invoce No</th>
                <th class='text-center'>Qty</th>
                <th class='text-center'>Price</th>
                <th class='text-center'>T Price</th>
                <th class='text-center'>Date</th>
                <th class='text-center'>Seller</th>
            </tr>
        </thead>
        <tbody>";
        
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        $TotalSeals= 0;
        if($query->rowCount() > 0)
        {
        foreach($results as $result){
           $Data.="<tr id='row-$cnt'>
           <td class='text-center'>$cnt</td>
           <td >
               <p id='name-$result->ID' class='form-control'>$result->Pname</p>
           </td>
           <td class='text-center'>
               <p id='Batch-$result->BatchNumber' class='form-control'> $result->PID</p>
           </td>
           <td class='text-end'>
               <p id='InQty-$result->BatchNumber' class='form-control'> $result->BID</p>
           </td>
           <td class='text-end'>
               <p id='OutQty-$result->BatchNumber' class='form-control'> $result->InvoiceId</p>
           </td>
           <td class='text-end'>
               <p id='RestQty-$result->BatchNumber' class='form-control'> $result->Qty</p>
           </td>
           <td class='text-end'>
                <p id='Mprice-$result->BatchNumber' class='form-control'> $result->Price</p>
           </td>
           <td class='text-end'>
                <p id='MRP-$result->BatchNumber' class='form-control'> $result->totalPrice</p>
           </td>
           <td class='text-end'>
               <p id='RestQty-$result->BatchNumber' class='form-control'> $result->Date</p>
           </td>
           <td class='text-center'>
               <p id='MRP-$result->BatchNumber' class='form-control'> $result->Uname</p>
           </td>
       </tr>";
            $cnt=$cnt+1; 
            $TotalSeals = $TotalSeals+$result->totalPrice;
            }} 
        $Data.="</tbody>
            </table>
            <div>
                <br/>
                <h2>Total Sell Amount in month:</h2>
                <h1>$TotalSeals</h1>
            </div>";
    echo $Data;
    // echo 'respons Back';
}
?>