<?php
include('../../../../config.php');

$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$user_branch = mysqli_real_escape_string($mysqli, $_POST['user_branch']);
$i_index = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$password = md5('123456');

$getbranchid = $mysqli->query("select * from branch where `name` = '$user_branch'");
$resid = $getbranchid->fetch_assoc();
$branch = $resid['id'];

$getcount = $mysqli->query("select * from users_admin where `username` = '$username'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("UPDATE `users_admin`
SET
  `fullname` = '$full_name',
  `username` = '$username',
  `password` = '$password'

WHERE `id` = '$i_index'") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


