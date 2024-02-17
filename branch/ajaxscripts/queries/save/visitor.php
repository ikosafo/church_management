<?php
include('../../../../config.php');

$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$residence = mysqli_real_escape_string($mysqli, $_POST['residence']);
$curdenom = mysqli_real_escape_string($mysqli, $_POST['curdenom']);
$hearingabout = mysqli_real_escape_string($mysqli, $_POST['hearingabout']);
$invitationdesc = mysqli_real_escape_string($mysqli, $_POST['invitationdesc']);
$branch = $_SESSION['branch'];

$mysqli->query("INSERT INTO `visitor`
(`full_name`,
 `telephone`,
 `residence`,
 `denomination`,
 `hearing_about`,
 `description`,
 `branch`)
VALUES (
'$fullname',
'$telephone',
'$residence',
'$curdenom',
'$hearingabout',
'$invitationdesc',
'$branch')") or die(mysqli_error($mysqli));
echo 1;
