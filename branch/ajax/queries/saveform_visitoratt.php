<?php
include('../../../../config.php');

$visitor_name = mysqli_real_escape_string($mysqli, $_POST['visitor_name']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$branch = $_SESSION['branch'];
$datereported = date('Y-m-d H:i:s');
$chkattendance = $mysqli->query("select * from service_config where branch = '$branch' and
                                     datefrom <= '$datereported' AND dateto >= '$datereported'");
$resattendance = $chkattendance->fetch_assoc();
$configid = $resattendance['configid'];

    $mysqli->query("INSERT INTO `attendance`
            (`datereported`,
             `branch`,
             `telephone`,
             `visitor`,
             `status`,
             `configid`)
VALUES ('$datereported',
        '$branch',
        '$telephone',
        '$visitor_name',
        '1',
        '$configid')") or die(mysqli_error($mysqli));
    echo 1;

