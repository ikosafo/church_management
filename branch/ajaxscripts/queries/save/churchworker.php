<?php
include('../../../../config.php');

$select_member = mysqli_real_escape_string($mysqli, $_POST['select_member']);
$position = mysqli_real_escape_string($mysqli, $_POST['position']);
$role = mysqli_real_escape_string($mysqli, $_POST['role']);

$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from `branchworker` where `memberid` = '$select_member' and 
branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `branchworker`
        (`memberid`,
        `role`,
        `position`,
        `branch`)
        VALUES (
        '$select_member',
        '$role',
        '$position',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
