<?php
include('../../../../config.php');

$event_title = mysqli_real_escape_string($mysqli, $_POST['event_title']);
$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_eventsgallery`
            (`title`,
             `eventid`,
             `periodupdated`
             )
VALUES ('$event_title',
        '$imageid',
        '$datetime'
        )") or die(mysqli_error($mysqli));

echo 1;
