<?php
## Database configuration
include('../../../config.php');
include('../../../functions.php');

$datetime = date("Y-m-d");
$expirydate = @$_GET['expirydate'];
$quantity = @$_GET['quantity'];
$supplier = @$_GET['supplier'];

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($mysqli, $_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " and (productname like '%" . $searchValue . "%' or 
   expirydate like '%" . $searchValue . "%' or
   quantity like '%" . $searchValue . "%' or
   variations like '%" . $searchValue . "%' or
   sellingprice like '%" . $searchValue . "%' or
   username like '%" . $searchValue . "%') ";
}


// Search for Expiry date
if ($expirydate != "") {

    if ($expirydate == "Expired") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where 
                                         expirydate != '0000-00-00' AND expirydate < '$datetime' 
                                        AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE 
                                        expirydate != '0000-00-00' AND 
                                        expirydate < '$datetime' AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE expirydate != '0000-00-00' AND expirydate < '$datetime' 
                AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else if ($expirydate == "Not Expired") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where 
                                    expirydate != '0000-00-00' AND expirydate > '$datetime' 
                                    AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE 
                                    expirydate != '0000-00-00' AND expirydate > '$datetime'  
                                    AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE expirydate != '0000-00-00' AND expirydate > '$datetime' 
             AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else if ($expirydate == "Expired in one week") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where 
                                            expirydate != '0000-00-00' AND 
                                            expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -7 DAY) 
                                            AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE 
                                            expirydate != '0000-00-00' AND 
                                            expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -7 DAY) 
                                             AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE expirydate != '0000-00-00' AND 
                         expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -7 DAY)
                         AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else if ($expirydate == "Expired in one month") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where 
                                    expirydate != '0000-00-00' AND 
                                    expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -31 DAY) 
                                    AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE 
                                    expirydate != '0000-00-00' AND 
                                    expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -31 DAY) 
                                     AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE expirydate != '0000-00-00' AND 
                 expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -31 DAY)
                 AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else {
        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where 
        expirydate != '0000-00-00' AND 
        expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -366 DAY) 
        AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE 
        expirydate != '0000-00-00' AND 
        expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -366 DAY) 
        AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE expirydate != '0000-00-00' AND 
        expirydate BETWEEN CURDATE() AND DATE_SUB(CURDATE(),INTERVAL -366 DAY)
        AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    }
}

//Search for Quantity
else if ($quantity != "") {

    if ($quantity == "None for sale") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where 
                                         `quantity` ='0' AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE 
                                        `quantity` ='0' AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE `quantity` ='0' AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else if ($quantity == "Less than threshold") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where `quantity` < `stockthreshold` 
                                        AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE `quantity` < `stockthreshold` 
                                        AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE `quantity` < `stockthreshold` AND 
                        status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else if ($quantity == "More than threshold") {

        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where `quantity` > `stockthreshold` 
            AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE `quantity` > `stockthreshold`
                    AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE `quantity` > `stockthreshold` AND 
            status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    } else {
        ## Total number of records without filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products where `quantity` > 0
        AND status IS NULL");
        $records = mysqli_fetch_assoc($sel);
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE `quantity` > 0 
                AND status IS NULL AND 1 " . $searchQuery);
        $records = mysqli_fetch_assoc($sel);
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $empQuery = "select * from products WHERE `quantity` > 0 AND 
        status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
        $empRecords = mysqli_query($mysqli, $empQuery);
        $data = array();
    }
}

//Search for Supplier
if ($supplier != "") {

    ## Total number of records without filtering
    $sel = mysqli_query($mysqli, "select count(*) as allcount from products where supplier = '$supplier' 
                                            AND status IS NULL");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of record with filtering
    $sel = mysqli_query($mysqli, "select count(*) as allcount from products WHERE supplier = '$supplier' 
                                                AND status IS NULL AND 1 " . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from products WHERE supplier = '$supplier' AND status IS NULL AND 1 " . $searchQuery . " order by productname limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($mysqli, $empQuery);
    $data = array();
}



while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "product" => getProdName($row['prodid']),
        "quantity" => getQuantity($row['prodid']),
        "expirydate" => getExpiryDate($row['expirydate']),
        "sellingprice" => $row['sellingprice'],
        "variations" => $row['variations']
    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
