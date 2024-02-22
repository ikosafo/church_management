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
    $searchQuery = " and (fullname like '%" . $searchValue . "%' or 
   telephone like '%" . $searchValue . "%' or
   location like '%" . $searchValue . "%' or 
   age like '%" . $searchValue . "%' or
   occupation like '%" . $searchValue . "%' or
   emailaddress like '%" . $searchValue . "%') ";
}

$branch = $_GET['branch'];
$financialtype = $_GET['financialtype'];

## Total number of records without filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from `members` WHERE `branch` = '$branch'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from `members` WHERE `branch` = '$branch' AND 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from `members` WHERE `branch` = '$branch' AND 1 " . $searchQuery . " order by fullname limit " . $row . "," . $rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

if ($financialtype == 'Offering') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "fullname" => $row['fullname'],
            "telephone" => $row['telephone'],
            "age" => $row['age'],
            "gender" => $row['gender'],
            "location" => $row['location'],
            "occupation" => $row['occupation'],
            "action" => getfinoffering($row['id'])
        );
    }
} else if ($financialtype == 'Tithe') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "fullname" => $row['fullname'],
            "telephone" => $row['telephone'],
            "age" => $row['age'],
            "gender" => $row['gender'],
            "location" => $row['location'],
            "occupation" => $row['occupation'],
            "action" => getfintithe($row['id'])
        );
    }
} else if ($financialtype == 'Welfare') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "fullname" => $row['fullname'],
            "telephone" => $row['telephone'],
            "age" => $row['age'],
            "gender" => $row['gender'],
            "location" => $row['location'],
            "occupation" => $row['occupation'],
            "action" => getfinwelfare($row['id'])
        );
    }
} else if ($financialtype == 'First Fruit') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "fullname" => $row['fullname'],
            "telephone" => $row['telephone'],
            "age" => $row['age'],
            "gender" => $row['gender'],
            "location" => $row['location'],
            "occupation" => $row['occupation'],
            "action" => getfinff($row['id'])
        );
    }
} else if ($financialtype == 'Contributions') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "fullname" => $row['fullname'],
            "telephone" => $row['telephone'],
            "age" => $row['age'],
            "gender" => $row['gender'],
            "location" => $row['location'],
            "occupation" => $row['occupation'],
            "action" => getfincontributions($row['id'])
        );
    }
} else if ($financialtype == 'Partners') {
    while ($row = mysqli_fetch_assoc($empRecords)) {
        $data[] = array(
            "fullname" => $row['fullname'],
            "telephone" => $row['telephone'],
            "age" => $row['age'],
            "gender" => $row['gender'],
            "location" => $row['location'],
            "occupation" => $row['occupation'],
            "action" => getfinmpartner($row['id'])
        );
    }
}


## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
