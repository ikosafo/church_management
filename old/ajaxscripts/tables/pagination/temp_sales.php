<?php
## Database configuration
include('../../../config.php');
include('../../../functions.php');

$prodsearch = $_GET['prodsearch'];

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

## Total number of records without filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from 
products where status IS NULL AND productname LIKE '%$prodsearch%' LIMIT 10");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli, "SELECT COUNT(*) AS allcount FROM products 
                              WHERE status IS NULL 
                              AND productname LIKE '%$prodsearch%' 
                              AND 1 " . $searchQuery . " 
                              LIMIT 10");

$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from products WHERE status IS NULL AND productname LIKE '%$prodsearch%' LIMIT 10";
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "product" => getProdName($row['prodid']),
        "quantity" => getQuantity($row['prodid']),
        "expirydate" => getExpiryDate($row['expirydate']),
        "sellingprice" => $row['sellingprice'],
        "variations" => $row['variations'],
        "action" => getTempSales($row['prodid'])
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
