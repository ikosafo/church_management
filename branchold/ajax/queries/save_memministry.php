<?php
include('../../../../config.php');

$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$mem_department = mysqli_real_escape_string($mysqli, $_POST['mem_department']);
$mem_ministry = mysqli_real_escape_string($mysqli, $_POST['mem_ministry']);
$mem_cell = mysqli_real_escape_string($mysqli, $_POST['mem_cell']);
$datetime = date("Y-m-d H:i:s");

$getdeptid = $mysqli->query("select * from department where department_name = '$mem_department'");
$resdeptid = $getdeptid->fetch_assoc();
$deptid = $resdeptid['id'];
if ($deptid == "") {
  $deptid = 'None';
}

$getminid = $mysqli->query("select * from ministry where ministry_name = '$mem_ministry'");
$resminid = $getminid->fetch_assoc();
$minid = $resminid['id'];
if ($minid == "") {
  $minid = 'None';
}

$getcellid = $mysqli->query("select * from cell where cell_name = '$mem_cell'");
$rescellid = $getcellid->fetch_assoc();
$cellid = $rescellid['id'];
if ($cellid == "") {
  $cellid = 'None';
}

$mysqli->query("UPDATE `member`

SET
  `department` = '$deptid',
  `ministry` = '$minid',
  `cell` = '$cellid'

WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));

echo 1;
?>