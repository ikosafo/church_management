<?php
include('../../../../config.php');

$ministryname = mysqli_real_escape_string($mysqli, $_POST['ministryname']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from ministry where `ministry_name` = '$ministryname' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `ministry`
            (`ministry_name`,
             `branch`)
VALUES ('$ministryname',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
