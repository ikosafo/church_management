<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$suppliername = getSupplierName($theid);

//Delete user
$check = $mysqli->query("UPDATE `supplier` SET `status` = '0' WHERE `supid` = '$theid'");

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
        'Supplier',
        'Deleted supplier $suppliername successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));                       

        echo 1; 



