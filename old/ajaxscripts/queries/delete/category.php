<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$categoryname = categoryName($theid);

        //Delete category
        $check = $mysqli->query("UPDATE `categories` SET `status` = '0' WHERE `catid` = '$theid'");

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
        'Product Category',
        'Deleted $categoryname as product category successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));                       

        echo 1; 



