<?php
## Database configuration
include('../../../config.php');
include('../../../functions.php');

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
    $searchQuery = " and (expdate like '%" . $searchValue . "%' or 
   amount like '%" . $searchValue . "%' or
   paymentmode like '%" . $searchValue . "%' or
   receipient like '%" . $searchValue . "%' or
   reason like '%" . $searchValue . "%' or
   approvedby like '%" . $searchValue . "%') ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from expenses where status IS NULL and DATE(datetime) = CURDATE()");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from expenses WHERE status IS NULL and DATE(datetime) = CURDATE() AND 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from expenses WHERE status IS NULL and DATE(datetime) = CURDATE() AND 1 " . $searchQuery . " order by expdate DESC limit " . $row . "," . $rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "amount" => $row['amount'],
        "paymentmode" => $row['paymentmode'],
        "receipient" => $row['receipient'],
        "reason" => $row['reason']
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
