<?php
include('../../../../config.php');

$branchname = mysqli_real_escape_string($mysqli, $_POST['branchname']);
$branchlocation = mysqli_real_escape_string($mysqli, $_POST['branchlocation']);
$branchcode = mysqli_real_escape_string($mysqli, $_POST['branchcode']);
$branchid = mysqli_real_escape_string($mysqli, $_POST['branchid']);

$getcount = $mysqli->query("select * from branch where 
(`name` = '$branchname' and `location` = '$branchlocation' and `code` = '$branchcode')");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("UPDATE `branch`
    SET
    `name` = '$branchname',
    `location` = '$branchlocation',
    `code` = '$branchcode'
    WHERE `id` = '$branchid'")
        or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
