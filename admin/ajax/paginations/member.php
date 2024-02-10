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
(CONCAT(firstname,' ',surname) LIKE '%" . $searchValue . "%'
OR CONCAT(firstname,' ',surname,' ',othername) LIKE '%" . $searchValue . "%'
OR CONCAT(surname,' ',firstname,' ',othername) LIKE '%" . $searchValue . "%'
OR CONCAT(firstname,' ',othername,' ',surname) LIKE '%" . $searchValue . "%'
OR CONCAT(surname,' ',othername,' ',firstname) LIKE '%" . $searchValue . "%'
OR CONCAT(othername,' ',firstname, ' ',surname) LIKE '%" . $searchValue . "%'
OR CONCAT(othername,' ',surname,' ',firstname) LIKE '%" . $searchValue . "%'
OR surname LIKE '%" . $searchValue . "%'
OR firstname LIKE '%" . $searchValue . "%'
OR othername LIKE '%" . $searchValue . "%'
OR emailaddress LIKE '%" . $searchValue . "%'
OR gender LIKE '%" . $searchValue . "%'
OR telephone LIKE '%" . $searchValue . "%'
OR maritalstatus LIKE '%" . $searchValue . "%'
OR residence LIKE '%" . $searchValue . "%') ";
}

$branch = $_GET['branch'];
//$status = $_GET['status'];
//$email_address = $_GET['email'];

if ($branch == "All") {
    ## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount from `member`");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount from `member` WHERE id != ''
                                   AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * from `member` WHERE id != '' AND 1 ".$searchQuery." ORDER BY
                               surname,firstname,othername limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();
}

else {

## Total number of records without filtering
    $sel = mysqli_query($con,"select count(*) as allcount FROM `member` WHERE branch = '$branch'");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

## Total number of record with filtering
    $sel = mysqli_query($con,"select count(*) as allcount FROM `member` WHERE branch = '$branch' AND 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

## Fetch records
    $empQuery = "select * FROM `member` WHERE branch = '$branch'AND 1 ".$searchQuery." ORDER BY surname,firstname,othername limit ".$row.",".$rowperpage;
    $empRecords = mysqli_query($con, $empQuery);
    $data = array();
}


while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "branchid"=>getbranch($row['branch']),
        "fullname"=>$row['surname'].' '.$row['firstname'].' '.$row['othername'],
        "gender"=>$row['gender'],
        "telephone"=>$row['telephone'],
        "residence"=>$row['residence'],
        "maritalstatus"=>$row['maritalstatus'],
        "id"=>memberdetails($row['id'])
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