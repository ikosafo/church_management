<?php
include('../../../../config.php');
$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$position = mysqli_real_escape_string($mysqli, $_POST['position']);
$role = mysqli_real_escape_string($mysqli, $_POST['role']);
$branch = $_SESSION['branch'];
$getcount = $mysqli->query("select * from `branchworker` where `memberid` = '$memberid'");
$count = mysqli_num_rows($getcount);

if ($count == "0"){
    $mysqli->query("INSERT INTO `branchworker`
            (`memberid`,
             `role`,
             `branch`,
             `position`)
VALUES ('$memberid',
        '$role',
        '$branch',
        '$position')") or die(mysqli_error($mysqli));
    echo 1;
}
else {
    echo 2;
}


