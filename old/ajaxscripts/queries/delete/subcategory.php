<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$subcategory = subcategoryName($theid);

//Delete category
$check = $mysqli->query("UPDATE `subcategories` SET `status` = '0' WHERE `subcatid` = '$theid'");

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
        'Product Subcategory',
        'Deleted $subcategory as product subategory successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));                       

        echo 1; 



