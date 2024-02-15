<?php
include('../../../../config.php');

$branchname = mysqli_real_escape_string($mysqli, $_POST['branchname']);
$branchlocation = mysqli_real_escape_string($mysqli, $_POST['branchlocation']);
$branchcode = mysqli_real_escape_string($mysqli, $_POST['branchcode']);

$getcount = $mysqli->query("select * from branch where (`name` = '$branchname' or `code` = '$branchcode')");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `branch`
            (`name`,
             `location`,
             `code`)
VALUES ('$branchname',
        '$branchlocation',
        '$branchcode')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
