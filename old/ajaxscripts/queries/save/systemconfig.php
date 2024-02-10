<?php
include('../../../config.php');
include("../../../functions.php");

$companyname = mysqli_real_escape_string($mysqli, $_POST['companyname']);
$tagline = mysqli_real_escape_string($mysqli, $_POST['tagline']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$whatsapp = mysqli_real_escape_string($mysqli, $_POST['whatsapp']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['emailaddress']);
$currency = mysqli_real_escape_string($mysqli, $_POST['currency']);
$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = md5(mysqli_real_escape_string($mysqli, $_POST['password']));
$terms = mysqli_real_escape_string($mysqli, $_POST['terms']);
$sysconid = mysqli_real_escape_string($mysqli, $_POST['sysconid']);


$saveconfig = $mysqli->query("INSERT INTO `system_config`
                            (
                            `companyname`,
                            `tagline`,
                            `address`,
                            `telephone`,
                            `whatsapp`,
                            `emailaddress`,
                            `currency`,
                            `username`,
                            `password`,
                            `sysconid`
                            )
                            VALUES 
                            ('$companyname',
                            '$tagline',
                            '$address',
                            '$telephone',
                            '$whatsapp',
                            '$emailaddress',
                            '$currency',
                            '$username',
                            '$password',
                            '$sysconid'
                            )");


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
                            'System Config',
                            'System configured successfully',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Successful')") or die(mysqli_error($mysqli));

echo 1;
