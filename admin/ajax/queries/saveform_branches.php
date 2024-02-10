<?php
include('../../../../config.php');

$pastor = mysqli_real_escape_string($mysqli, $_POST['pastor']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$branchid = mysqli_real_escape_string($mysqli, $_POST['branchid']);
$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_branches`
(`branchid`,
 `pastor`,
 `telephone`,
 `imageid`)
VALUES (
    '$branchid',
    '$pastor',
    '$telephone',
    '$imageid')") or die(mysqli_error($mysqli));

echo 1;
