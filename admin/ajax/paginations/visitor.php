<?php

include ('../../includes/db.php');
include ('../../includes/phpfunctions.php');

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and

full_name LIKE '%" . $searchValue . "%'
OR telephone LIKE '%" . $searchValue . "%'
OR residence LIKE '%" . $searchValue . "%'
OR denomination LIKE '%" . $searchValue . "%'
OR hearing_about LIKE '%" . $searchValue . "%'
OR description LIKE '%" . $searchValue . "%'";
}

$branch = $_GET['branch'];
//$status = $_GET['status'];
//$email_address = $_GET['email'];

if ($branch == "All") {
    ## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount from `visitor`");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount from `visitor` WHERE id != ''
                                   AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * from `visitor` WHERE id != '' AND 1 ".$searchQuery." ORDER BY
                               full_name limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();
}

else {

## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount FROM `visitor` WHERE branch = '$branch'");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount FROM `visitor` WHERE branch = '$branch' AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * FROM `visitor` WHERE branch = '$branch'AND 1 ".$searchQuery." ORDER BY full_name limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();
}


while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "branchid"=>getbranch($row['branch']),
        "fullname"=>$row['full_name'],
        "telephone"=>$row['telephone'],
        "residence"=>$row['residence'],
        "denomination"=>$row['denomination'],
        "hearingabout"=>$row['hearing_about'],
        "description"=>$row['description']
    );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecordwithFilter,
    "iTotalDisplayRecords" => $totalRecords,
    "aaData" => $data
);

echo json_encode($response);