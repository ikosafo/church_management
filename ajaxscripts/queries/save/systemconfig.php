<?php
include('../../../config.php');
include("../../../functions.php");

$churchname = mysqli_real_escape_string($mysqli, $_POST['churchname']);
$tagline = mysqli_real_escape_string($mysqli, $_POST['tagline']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = md5(mysqli_real_escape_string($mysqli, $_POST['password']));
$sysconid = mysqli_real_escape_string($mysqli, $_POST['sysconid']);


$saveconfig = $mysqli->query("INSERT INTO `system_config`
                            (
                            `churchname`,
                            `tagline`,
                            `telephone`,
                            `username`,
                            `password`,
                            `sysconid`
                            )
                            VALUES 
                            ('$churchname',
                            '$tagline',
                            '$telephone',
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
