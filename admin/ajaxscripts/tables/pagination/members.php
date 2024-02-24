<?php
## Database configuration
include('../../../../config.php');
include('../../../../functions.php');
$branch = $_GET['branch'];

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
   gender like '%" . $searchValue . "%' or 
   age like '%" . $searchValue . "%' or
   location like '%" . $searchValue . "%' or
   maidenname like '%" . $searchValue . "%' or
   dob like '%" . $searchValue . "%' or
   gpsaddress like '%" . $searchValue . "%' or
   hometown like '%" . $searchValue . "%' or
   nationality like '%" . $searchValue . "%' or
   emailaddress like '%" . $searchValue . "%' or
   placeofwork like '%" . $searchValue . "%' or
   occupation like '%" . $searchValue . "%' or
   spousename like '%" . $searchValue . "%' or
   spousephone like '%" . $searchValue . "%' or
   fathersname like '%" . $searchValue . "%' or
   fathersphone like '%" . $searchValue . "%' or
   mothersname like '%" . $searchValue . "%' or
   mothersphone like '%" . $searchValue . "%' or
   communicant like '%" . $searchValue . "%') ";
}

if ($branch == "All") {
    ## Total number of records without filtering
    $sel = mysqli_query($mysqli, "select count(*) as allcount from `members`");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of record with filtering
    $sel = mysqli_query($mysqli, "select count(*) as allcount from `members` WHERE id != ''
                                    AND 1 " . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from `members` WHERE id != '' AND 1 " . $searchQuery . " ORDER BY
                                fullname limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($mysqli, $empQuery);
    $data = array();
} else {
    ## Total number of records without filtering
    $sel = mysqli_query($mysqli, "select count(*) as allcount from members WHERE branch = '$branch'");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    ## Total number of record with filtering
    $sel = mysqli_query($mysqli, "select count(*) as allcount from members WHERE branch = '$branch' AND  1 " . $searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from members WHERE branch = '$branch' AND 1 " . $searchQuery . " order by fullname limit " . $row . "," . $rowperpage;
    $empRecords = mysqli_query($mysqli, $empQuery);
    $data = array();
}



while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
        "fullname" => $row['fullname'],
        "telephone" => $row['telephone'],
        "gender" => $row['gender'],
        "age" => $row['age'],
        "location" => $row['location'],
        "communicant" => $row['communicant'],
        "action" => getMemberDetailsAdmin($row['id'])
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
