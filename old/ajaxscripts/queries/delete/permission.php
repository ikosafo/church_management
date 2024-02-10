<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

$check = $mysqli->query("select * from `userpermission` WHERE `permid` = '$theid'");
$rescheck = $check->fetch_assoc();
$permissionname = $rescheck['permission'];
$user = getStaffName($rescheck['userid']);

    //Delete permission
    $del = $mysqli->query("DELETE FROM `userpermission` WHERE `permid` = '$theid'");

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
        'Permission',
        'Deleted $permissionname as permission for $user successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));                       

        echo 1; 



