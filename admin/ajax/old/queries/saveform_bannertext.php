<?php
include('../../../../config.php');

$bannertext = mysqli_real_escape_string($mysqli, $_POST['bannertext']);

$getcount = $mysqli->query("select * from website_bannertext where `bannertext` = '$bannertext'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `website_bannertext`
            (`bannertext`)
VALUES ('$bannertext')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


