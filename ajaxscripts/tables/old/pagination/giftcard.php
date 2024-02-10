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
   $searchQuery = " and (giftnumber like '%".$searchValue."%' or 
   giftvalue like '%".$searchValue."%' or
   customerid like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from giftcard where status IS NULL ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from giftcard WHERE status IS NULL AND 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from giftcard WHERE status IS NULL AND 1 ".$searchQuery." order by giftid limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "giftcardnumber"=>$row['giftnumber'],
      "giftcardvalue"=>$row['giftvalue'],
      "customername"=>getCustomerName($row['customerid']),
      "action"=>getGiftcard($row['giftid'])
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
