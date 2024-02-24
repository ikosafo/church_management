<?php
include('../../../../config.php');

$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$link = mysqli_real_escape_string($mysqli, $_POST['link']);
$branch = mysqli_real_escape_string($mysqli, $_POST['branch']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$date_ministered = mysqli_real_escape_string($mysqli, $_POST['date_ministered']);
$datetime = date("Y-m-d H:i:s");


$getcount = $mysqli->query("select * from website_youtubelink where link = '$link'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `website_youtubelink`
            (`title`,
             `link`,
             `branch`,
             `dateministered`,
             `description`,
             `dateuploaded`)
VALUES ('$title',
        '$link',
        '$branch',
        '$date_ministered',
        '$description',
        '$datetime')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


