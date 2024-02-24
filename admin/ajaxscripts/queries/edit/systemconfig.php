<?php
include('../../../../config.php');
include("../../../../functions.php");

$churchname = mysqli_real_escape_string($mysqli, $_POST['churchname']);
$tagline = mysqli_real_escape_string($mysqli, $_POST['tagline']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);


$saveconfig = $mysqli->query("UPDATE `system_config`
                            SET
                            `churchname` = '$churchname',
                            `tagline` = '$tagline',
                            `telephone` = '$telephone'
                           ");


/* $mysqli->query("INSERT INTO `logs`
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
                            'Successful')") or die(mysqli_error($mysqli)); */

echo 1;
