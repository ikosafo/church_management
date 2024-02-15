<?php
include('../../../../config.php');

$sms_key = mysqli_real_escape_string($mysqli, $_POST['sms_key']);
$branch =$_SESSION['branch'];

$getcount = $mysqli->query("select * from mnotify where branch = '$branch'");
$count = mysqli_num_rows($getcount);

if ($count == "0"){
    $mysqli->query("INSERT INTO `mnotify`
            (`mnotify_key`,
             `branch`)
VALUES ('$sms_key',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


