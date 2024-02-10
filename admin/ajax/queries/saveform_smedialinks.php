<?php
include('../../../../config.php');

$fb_link = mysqli_real_escape_string($mysqli, $_POST['fb_link']);
$tw_link = mysqli_real_escape_string($mysqli, $_POST['tw_link']);
$yt_link = mysqli_real_escape_string($mysqli, $_POST['yt_link']);

$getnum = $mysqli->query("select * from `website_smedialinks`");
$num = mysqli_num_rows($getnum);

if ($num == '0') {
    $mysqli->query("INSERT INTO `website_smedialinks`
            (`facebook`,
             `twitter`,
             `youtube`)
VALUES ('$fb_link',
        '$tw_link',
        '$yt_link')") or die(mysqli_error($mysqli));

    echo 1;
}

else {
    echo 2;
}





