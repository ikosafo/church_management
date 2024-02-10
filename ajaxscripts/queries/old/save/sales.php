<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$amountpaid = mysqli_real_escape_string($mysqli, $_POST['amountpaid']);
$totalprice = mysqli_real_escape_string($mysqli, $_POST['totalprice']);
$change = mysqli_real_escape_string($mysqli, $_POST['change']);
$newsaleid = mysqli_real_escape_string($mysqli, $_POST['newsaleid']);
$customer = mysqli_real_escape_string($mysqli, $_POST['customer']);
$paymentmethod = mysqli_real_escape_string($mysqli, $_POST['paymentmethod']);
$customertel = mysqli_real_escape_string($mysqli, $_POST['customertel']);


$getquantity = $mysqli->query("select * from tempsales where genid = '$newsaleid'");
while ($resquantity = $getquantity->fetch_assoc()) {
    $quantity = $resquantity['quantity'];
    $prodid = $resquantity['prodid'];

    $getproduct = $mysqli->query("select * from products where prodid = '$prodid'");
    $resproduct = $getproduct->fetch_assoc();
    $prodquantity = $resproduct['quantity'];
    $newquantity = $prodquantity - $quantity;

    if ($newquantity < 0) {
        echo 2;
    } else {
        $updatequantity = $mysqli->query("update products set quantity = '$newquantity' 
        where prodid = '$prodid'");
        echo 1;
    }
}

$checkforsaleid = $mysqli->query("select * from `sales` where newsaleid = '$newsaleid'");
if (mysqli_num_rows($checkforsaleid) == "1") {
    echo 5;
} else {

    $saveconfig = $mysqli->query("INSERT INTO `sales`
    (`amountpaid`,
    `totalprice`,
    `change`,
    `newsaleid`,
    `customer`,
    `paymentmethod`,
    `telephone`,
    `username`,
    `datetime`)
        VALUES (
    '$amountpaid',
    '$totalprice',
    '$change',
    '$newsaleid',
    '$customer',
    '$paymentmethod',
    '$customertel',
    '$username',
    '$datetime')");

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
        'Sale',
        '$username sold $totalprice of items successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));
    echo 4;
}
