<?php
## Database configuration
include('../../../../config.php');
include('../../../../functions.php');
$branch = $_SESSION['branch'];

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
    $searchQuery = " and (full_name like '%" . $searchValue . "%' or 
   telephone like '%" . $searchValue . "%' or
   residence like '%" . $searchValue . "%' or 
   denomination like '%" . $searchValue . "%' or
   hearing_about like '%" . $searchValue . "%' or
   description like '%" . $searchValue . "%') ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from `visitor` WHERE `branch` = '$branch'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from `visitor` WHERE `branch` = '$branch' AND 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from `visitor` WHERE `branch` = '$branch' AND 1 " . $searchQuery . " order by full_name limit " . $row . "," . $rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "fullname" => $row['full_name'],
        "telephone" => $row['telephone'],
        "residence" => $row['residence'],
        "denomination" => $row['denomination'],
        "hearing_about" => $row['hearing_about'],
        "description" => $row['description'],
        "action" => getVisitorDetails($row['id'])
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
