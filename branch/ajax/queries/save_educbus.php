<?php
include('../../../../config.php');

$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$educlevel = mysqli_real_escape_string($mysqli, $_POST['educlevel']);
$institution_attended = mysqli_real_escape_string($mysqli, $_POST['institution_attended']);
$qualification = mysqli_real_escape_string($mysqli, $_POST['qualification']);
$occupation = mysqli_real_escape_string($mysqli, $_POST['occupation']);
$workplace = mysqli_real_escape_string($mysqli, $_POST['workplace']);
$job_position = mysqli_real_escape_string($mysqli, $_POST['job_position']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("UPDATE `member`

SET
 `educationallevel` = '$educlevel',
  `institutionattended` = '$institution_attended',
  `qualification` = '$qualification',
  `occupation` = '$occupation',
  `workplace` = '$workplace',
  `jobposition` = '$job_position'

WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));

echo 1;

?>