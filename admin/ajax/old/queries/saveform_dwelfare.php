<?php
include('../../../../config.php');

$page_text = mysqli_real_escape_string($mysqli, $_POST['page_text']);
$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `website_dwelfare`
            (`page_text`,
             `imageid`)
VALUES ('$page_text',
        '$imageid')") or die(mysqli_error($mysqli));

echo 1;
