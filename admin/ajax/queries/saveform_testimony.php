<?php
include('../../../../config.php');

$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$branch = mysqli_real_escape_string($mysqli, $_POST['branch']);
$testimony = mysqli_real_escape_string($mysqli, $_POST['testimony']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_testimony`
        (`branch`,
        `fullname`,
        `title`,
        `testimony`)
        VALUES (
        '$branch',
        '$full_name',
        '$title',
        '$testimony')") or die(mysqli_error($mysqli));

echo 1;
