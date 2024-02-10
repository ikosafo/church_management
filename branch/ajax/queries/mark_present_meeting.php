<?php
include('../../../../config.php');

$member_index = mysqli_real_escape_string($mysqli, $_POST['member_index']);
$configid = mysqli_real_escape_string($mysqli, $_POST['configid']);
$branch = $_SESSION['branch'];
$datereported = date('Y-m-d H:i:s');

$getcount = $mysqli->query("select * from `attendancemeeting` where `memberid` = '$member_index'
                            and branch = '$branch' and configid = '$configid'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `attendancemeeting`
            (`memberid`,
             `datereported`,
             `branch`,
             `status`,
             `configid`)
VALUES ('$member_index',
    '$datereported',
    '$branch',
    '1',
    '$configid')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    $mysqli->query("UPDATE `attendancemeeting`
SET
  `memberid` = '$member_index',
  `datereported` = '$datereported',
  `branch` = '$branch',
  `status` = '1'

WHERE `configid` = '$configid' and `branch` = '$branch' and `memberid` = '$member_index'") or die(mysqli_error($mysqli));
    echo 2;
}


