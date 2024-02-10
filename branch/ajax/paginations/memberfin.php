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
$financialtype = $_GET['financialtype'];
//$status = $_GET['status'];
//$email_address = $_GET['email'];


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

if ($financialtype == 'Offering') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "member"=>getmemberdetails($row['memberid']),
            "residence"=>$row['residence'],
            "occupation"=>$row['occupation'],
            "maritalstatus"=>$row['maritalstatus'],
            "department"=>getdepartment($row['department']),
            "action"=>getfinoffering($row['memberid'])
        );
    }
}
else if ($financialtype == 'Tithe') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "member"=>getmemberdetails($row['memberid']),
            "residence"=>$row['residence'],
            "occupation"=>$row['occupation'],
            "maritalstatus"=>$row['maritalstatus'],
            "department"=>getdepartment($row['department']),
            "action"=>getfintithe($row['memberid'])
        );
    }
}
else if ($financialtype == 'Welfare') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "member"=>getmemberdetails($row['memberid']),
            "residence"=>$row['residence'],
            "occupation"=>$row['occupation'],
            "maritalstatus"=>$row['maritalstatus'],
            "department"=>getdepartment($row['department']),
            "action"=>getfinwelfare($row['memberid'])
        );
    }
}
else if ($financialtype == 'First Fruit') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "member"=>getmemberdetails($row['memberid']),
            "residence"=>$row['residence'],
            "occupation"=>$row['occupation'],
            "maritalstatus"=>$row['maritalstatus'],
            "department"=>getdepartment($row['department']),
            "action"=>getfinff($row['memberid'])
        );
    }
}
else if ($financialtype == 'Contributions') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "member"=>getmemberdetails($row['memberid']),
            "residence"=>$row['residence'],
            "occupation"=>$row['occupation'],
            "maritalstatus"=>$row['maritalstatus'],
            "department"=>getdepartment($row['department']),
            "action"=>getfincontributions($row['memberid'])
        );
    }
}
else if ($financialtype == 'Ministry Partners') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "member"=>getmemberdetails($row['memberid']),
            "residence"=>$row['residence'],
            "occupation"=>$row['occupation'],
            "maritalstatus"=>$row['maritalstatus'],
            "department"=>getdepartment($row['department']),
            "action"=>getfinmpartner($row['memberid'])
        );
    }
}



## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecordwithFilter,
    "iTotalDisplayRecords" => $totalRecords,
    "aaData" => $data
);

echo json_encode($response);