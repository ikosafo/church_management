<?php
## Database configuration
include ('../../../config.php');
include ('../../../functions.php');

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
   $searchQuery = " and (fullname like '%".$searchValue."%' or 
   gender like '%".$searchValue."%' or
   birthdate like '%".$searchValue."%' or 
   telephone like '%".$searchValue."%' or
   emailaddress like '%".$searchValue."%' or
   residence like '%".$searchValue."%' or
   address like '%".$searchValue."%' or
   educationallevel like '%".$searchValue."%' or
   staffid like '%".$searchValue."%' or
   nationality like '%".$searchValue."%' or
   position like '%".$searchValue."%' or
   stid like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from staff where status IS NULL ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from staff WHERE status IS NULL AND 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from staff WHERE status IS NULL AND 1 ".$searchQuery." order by fullname limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "fullname"=>$row['fullname'],
      "emailaddress"=>$row['emailaddress'],
      "phonenumber"=>$row['telephone'],
      "gender"=>$row['gender'],
      "nationality"=>$row['nationality'],
      "staffid"=>$row['staffid'],
      "action"=>getUser($row['stid'])
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
