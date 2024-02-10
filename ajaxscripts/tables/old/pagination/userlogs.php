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
   $searchQuery = " and (message like '%" . $searchValue . "%' or 
   user like '%" . $searchValue . "%' or 
   action like '%" . $searchValue . "%' or 
   section like '%" . $searchValue . "%' or 
   macaddress like '%" . $searchValue . "%' or 
   ipaddress like '%" . $searchValue . "%' or 
   logid like'%" . $searchValue . "%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from logs where user = '$username'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli, "select count(*) as allcount from logs WHERE user = '$username' AND 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from logs WHERE user = '$username' AND 1 " . $searchQuery . " order by logdate DESC limit " . $row . "," . $rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array(
      /*   "fullname"=>getLogname($row['user']), */
      "logdate" => $row['logdate'],
      "section" => $row['section'],
      "activity" => $row['message'],
      "status" => $row['action'],
      "status" => $row['action'],
      "macaddress" => $row['macaddress'],
      "ipaddress" => $row['ipaddress']
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
