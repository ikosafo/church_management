<?php
include('../../../../config.php');

$event_title = mysqli_real_escape_string($mysqli, $_POST['event_title']);
$venue = mysqli_real_escape_string($mysqli, $_POST['venue']);
$start_period = mysqli_real_escape_string($mysqli, $_POST['start_period']);
$end_period = mysqli_real_escape_string($mysqli, $_POST['end_period']);
$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_events`
            (`title`,
             `venue`,
             `startperiod`,
             `endperiod`,
             `eventid`,
             `periodupdated`,
             `description`
             )
VALUES ('$event_title',
        '$venue',
        '$start_period',
        '$end_period',
        '$imageid',
        '$datetime',
        '$description'
        )") or die(mysqli_error($mysqli));

echo 1;
