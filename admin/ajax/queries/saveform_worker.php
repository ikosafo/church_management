<?php
include('../../../../config.php');
$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$position = mysqli_real_escape_string($mysqli, $_POST['position']);
$role = mysqli_real_escape_string($mysqli, $_POST['role']);

$getcount = $mysqli->query("select * from `worker` where `memberid` = '$memberid'");
$count = mysqli_num_rows($getcount);

if ($count == "0"){
    $mysqli->query("INSERT INTO `worker`
            (`memberid`,
             `role`,
             `position`)
VALUES ('$memberid',
        '$role',
        '$position')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


