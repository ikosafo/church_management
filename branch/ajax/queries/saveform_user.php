<?php
include('../../../../config.php');

$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$user_type = mysqli_real_escape_string($mysqli, $_POST['user_type']);
$branch = $_SESSION['branch'];
$password = md5('123456');

$getcount = $mysqli->query("select * from users_admin where `username` = '$username'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `users_admin`
            (`fullname`,
             `username`,
             `password`,
             `usertype`,
             `branch`)
VALUES ('$full_name',
        '$username',
        '$password',
        '$user_type',
        '$branch'
        )") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


