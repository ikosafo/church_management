<?php
include('../../../../config.php');

$sms_key = mysqli_real_escape_string($mysqli, $_POST['sms_key']);
$i_index = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$mysqli->query("UPDATE mnotify SET mnotify_key = '$sms_key' WHERE id = '$i_index'") or die(mysqli_error($mysqli));
echo 1;


