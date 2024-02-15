<?php
include('../../../../config.php');

$smskey = mysqli_real_escape_string($mysqli, $_POST['apikey']);

$getcount = $mysqli->query("select * from `mnotify` where branch = 'Admin'");
$count = mysqli_num_rows($getcount);

if ($count == "0") {
    $mysqli->query("INSERT INTO `mnotify`
            (`mnotify_key`,
             `branch`)
VALUES ('$smskey',
        'Admin')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
