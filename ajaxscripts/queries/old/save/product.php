<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$productname = mysqli_real_escape_string($mysqli, $_POST['productname']);
$quantity = mysqli_real_escape_string($mysqli, $_POST['quantity']);
$stockthreshold = mysqli_real_escape_string($mysqli, $_POST['stockthreshold']);
$supplier = mysqli_real_escape_string($mysqli, $_POST['supplier']);
$expirydate = mysqli_real_escape_string($mysqli, $_POST['expirydate']);
$variations = mysqli_real_escape_string($mysqli, $_POST['variations']);
$costprice = mysqli_real_escape_string($mysqli, $_POST['costprice']);
$sellingprice = mysqli_real_escape_string($mysqli, $_POST['sellingprice']);
$saletype = mysqli_real_escape_string($mysqli, $_POST['saletype']);
$datetime = date('Y-m-d H:i:s');


//Check whether a product already exists
if ($productname != "") {
    $check = $mysqli->query("select * from products where productname = '$productname' AND salestatus = '$saletype'");
    $getexist = mysqli_num_rows($check);

    if ($getexist == "0") {
        $saveconfig = $mysqli->query("INSERT INTO `products`
        (`productname`,
         `quantity`,
         `stockthreshold`,
         `supplier`,
         `expirydate`,
         `variations`,
         `costprice`,
         `sellingprice`,
         `username`,
         `datetime`,
         `salestatus`)
VALUES (
    '$productname',
    '$quantity',
    '$stockthreshold',
    '$supplier',
    '$expirydate',
    '$variations',
    '$costprice',
    '$sellingprice',
    '$username',
    '$datetime',
    '$saletype')");

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
        'Product',
        'Added product $productname as product successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));

        echo 1;
    } else {
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
                            'Product',
                            'Add Product error (Product already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

        echo 2;
    }
} else {
    $saveconfig = $mysqli->query("INSERT INTO `products`
    (`productname`,
     `quantity`,
     `stockthreshold`,
     `supplier`,
     `expirydate`,
     `variations`,
     `costprice`,
     `sellingprice`,
     `username`,
     `datetime`,
     `salestatus`)
VALUES (
'$productname',
'$quantity',
'$stockthreshold',
'$supplier',
'$expirydate',
'$variations',
'$costprice',
'$sellingprice',
'$username',
'$datetime',
'$saletype')");

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
    'Product',
    'Added product $productname as product successfully',
    '$username',
    '$mac_address',
    '$ip_add',
    'Successful')") or die(mysqli_error($mysqli));

    echo 1;
}
