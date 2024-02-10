<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$currentpassword = md5($_POST['currentpassword']);
$newpassword = md5($_POST['newpassword']);
$confirmpassword = $_POST['confirmpassword'];

$checkpassword = $mysqli->query("select * from staff where username = '$username'");
$respassword = $checkpassword->fetch_assoc();
$currpassword = $respassword['password'];

if ($currpassword == $currentpassword) {

        $editpassword = $mysqli->query("UPDATE `staff`
        SET `password` = '$newpassword'
        WHERE `username` = '$username'");

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
        'Reset Password',
        '$username updated password successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));  

        echo 1;
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
                'Reset Password',
                'Reset Password error',
                '$username',
                '$mac_address',
                '$ip_add',
                'Failed')") or die(mysqli_error($mysqli));  
        echo 2;
}
 


        
