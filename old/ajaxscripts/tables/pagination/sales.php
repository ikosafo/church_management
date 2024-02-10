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
   $searchQuery = " and (amountpaid like '%".$searchValue."%' or 
   totalprice like '%".$searchValue."%' or
   `change` like '%".$searchValue."%' or
   paymentmethod like '%".$searchValue."%' or
   username like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from sales");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($mysqli,"select count(*) as allcount from sales where 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from sales where 1 ".$searchQuery." order by datetime DESC limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($mysqli, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "paymentmethod"=>$row['paymentmethod'],
      "details"=>getSalesDetails($row['newsaleid']),
      "totalprice"=>$row['totalprice'],
      "amountpaid"=>$row['amountpaid'],
      "change"=>$row['change'],
      "datetime"=>$row['datetime'],
      "action"=>getSales($row['salesid'])
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
