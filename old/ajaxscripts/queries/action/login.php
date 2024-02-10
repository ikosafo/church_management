<?php
include("../../../config.php");
include("../../../functions.php");

$username = $_POST['username'];
$pass = $_POST['password'];
$password = md5($pass);

$res = $mysqli->query("SELECT * FROM system_config WHERE `username` = '$username' 
                                       AND `password` = '$password'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);

$resstaff = $mysqli->query("SELECT * FROM staff WHERE `username` = '$username' 
                                       AND `password` = '$password'");
$getstaff = $resstaff->fetch_assoc();
$rowcountstaff = mysqli_num_rows($resstaff);


if ($rowcount == "0" && $rowcountstaff == "0") {

        $mysqli->query("INSERT INTO `logs`
            (
            `logdate`,
            `section`,
            `message`,
            `user`,
            `macaddress`,
            `ipaddress`,
            `action`)
            VALUES (
            '$datetime',
            'login',
            'Log in error (Wrong username or password)',
            '$username',
            '$mac_address',
            '$ip_add',
            'Failed')") or die(mysqli_error($mysqli));

         echo 2;

    } 
     
    else {

            $mysqli->query("INSERT INTO `logs`
            (
            `logdate`,
            `section`,
            `message`,
            `user`,
            `macaddress`,
            `ipaddress`,
            `action`)
            VALUES (
            '$datetime',
            'Login',
            '$username logged in Successfully',
            '$username',
            '$mac_address',
            '$ip_add',
            'Successful')") or die(mysqli_error($mysqli));

            $_SESSION['username'] = $username;

    echo 1;

}


?>