<?php
## Database configuration
include('../../../config.php');
include('../../../functions.php');
$username = $_SESSION['username'];

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
    $searchQuery = " and (email like '%" . $searchValue . "%' or 
    fullname like '%" . $searchValue . "%' or 
    msg_subject like '%" . $searchValue . "%' or 
    message like '%" . $searchValue . "%' or 
    periodsent like '%" . $searchValue . "%' or 
    phone like '%" . $searchValue . "%') ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from client_messages");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from client_messages WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from client_messages WHERE 1 " . $searchQuery . " order by periodsent limit " . $row . "," . $rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "fullname" => $row['fullname'],
        "email" => $row['email'],
        "phone" => $row['phone'],
        "msg_subject" => $row['msg_subject'],
        "message" => $row['message'] . '<br/><small>(' . time_elapsed_string($row['periodsent']) . ')</small>',
        "periodsent" => $row['periodsent']
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
