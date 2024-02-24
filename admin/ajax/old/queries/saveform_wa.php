<?php
include('../../../../config.php');

$day = mysqli_real_escape_string($mysqli, $_POST['day']);
$time = mysqli_real_escape_string($mysqli, $_POST['time']);
$program = mysqli_real_escape_string($mysqli, $_POST['program']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_weeklyactivities`
            (
            `day`,
            `time`,
            `program`
            )
VALUES ('$day',
        '$time',
        '$program'
        )") or die(mysqli_error($mysqli));

echo 1;
