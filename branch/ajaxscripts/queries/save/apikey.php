<?php
include('../../../../config.php');

$apikey = mysqli_real_escape_string($mysqli, $_POST['apikey']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from `mnotify` where branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `mnotify`
            (`mnotify_key`,
             `branch`)
VALUES ('$apikey',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
