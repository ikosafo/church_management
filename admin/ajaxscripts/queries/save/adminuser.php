<?php
include('../../../../config.php');

$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = md5('123456');

$getcount = $mysqli->query("select * from users_adminmain where `username` = '$username'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `users_adminmain`
            (`fullname`,
             `username`,
             `password`)
VALUES ('$fullname',
        '$username',
        '$password')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
