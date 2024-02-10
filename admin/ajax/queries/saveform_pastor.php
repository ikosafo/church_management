<?php
include('../../../../config.php');

$pastor_name = mysqli_real_escape_string($mysqli, $_POST['pastor_name']);
$pastor_branch = mysqli_real_escape_string($mysqli, $_POST['pastor_branch']);
$pastor_telephone = mysqli_real_escape_string($mysqli, $_POST['pastor_telephone']);
$pastor_email = mysqli_real_escape_string($mysqli, $_POST['pastor_email']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_pastors`
            (`pastor_name`,
             `pastor_branch`,
             `pastor_telephone`,
             `pastor_email`,
             `description`,
             `imageid`)
VALUES ('$pastor_name',
        '$pastor_branch',
        '$pastor_telephone',
        '$pastor_email',
        '$description',
        '$imageid')") or die(mysqli_error($mysqli));

echo 1;
