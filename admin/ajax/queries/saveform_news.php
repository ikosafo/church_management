<?php
include('../../../../config.php');

$news_title = mysqli_real_escape_string($mysqli, $_POST['news_title']);
$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_news`
            (`title`,
             `newsid`,
             `periodupdated`,
             `description`)
VALUES ('$news_title',
        '$imageid',
        '$datetime',
        '$description')") or die(mysqli_error($mysqli));

echo 1;
