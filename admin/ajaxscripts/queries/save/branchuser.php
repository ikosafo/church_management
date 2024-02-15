<?php
include('../../../../config.php');

$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$userbranch = mysqli_real_escape_string($mysqli, $_POST['userbranch']);
$password = md5('123456');

$getcount = $mysqli->query("select * from users_admin where `username` = '$username'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `users_admin`
            (`fullname`,
             `username`,
             `password`,
             `branch`)
VALUES ('$fullname',
        '$username',
        '$password',
        '$userbranch')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
