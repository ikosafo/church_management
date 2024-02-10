<?php
## Database configuration
include ('../../../config.php');
include ('../../../functions.php');
$username = $_SESSION['username'];

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($mysqli,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (receipient like '%".$searchValue."%' or 
   message like '%".$searchValue."%' or 
   datetime like '%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from messages where user = '$username'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from messages WHERE user = '$username' AND 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from messages WHERE user = '$username' AND 1 ".$searchQuery." order by datetime limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "receipient"=>$row['receipient'],
      "message"=>$row['message'],
      "datetime"=>$row['datetime'].'<br/>.'.time_elapsed_string($row['datetime'])
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
