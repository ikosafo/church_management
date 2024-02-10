<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$variationname = variationName($theid);

//Delete category
$check = $mysqli->query("DELETE FROM `variations` WHERE `varid` = '$theid'");

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
        'Product Variation',
        'Deleted $variationname as variation name successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));                       

        echo 1; 



