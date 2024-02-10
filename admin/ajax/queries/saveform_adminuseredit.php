<?php
include('../../../../config.php');

$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$i_index = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$getcount = $mysqli->query("select * from users_adminmain where `username` = '$username'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("UPDATE `users_adminmain`
SET
  `fullname` = '$full_name',
  `username` = '$username'

WHERE `id` = '$i_index'") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


