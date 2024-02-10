<?php
include('../../../../config.php');

$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$marital_status = mysqli_real_escape_string($mysqli, $_POST['marital_status']);
$spouse = mysqli_real_escape_string($mysqli, $_POST['spouse']);
$father_alive = mysqli_real_escape_string($mysqli, $_POST['father_alive']);
$father = mysqli_real_escape_string($mysqli, $_POST['father']);
$mother_alive = mysqli_real_escape_string($mysqli, $_POST['mother_alive']);
$mother = mysqli_real_escape_string($mysqli, $_POST['mother']);
$have_children = mysqli_real_escape_string($mysqli, $_POST['have_children']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("UPDATE `member`

SET

 `maritalstatus` = '$marital_status',
 `spousename` = '$spouse',
  `fatheralive` = '$father_alive',
  `fathername` = '$father',
  `motheralive` = '$mother_alive',
  `mothername` = '$mother',
  `havechildren` = '$have_children'

WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));

echo 1;
?>