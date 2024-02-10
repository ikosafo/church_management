<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$getdetails = $mysqli->query("select * from expenses where expid = '$theid'");
$resdetails = $getdetails->fetch_assoc();
$amount = $resdetails['amount'];
$expdate = $resdetails['expdate'];
$receipient = $resdetails['receipient'];


    //Delete user
    $check = $mysqli->query("UPDATE `expenses` SET `status` = '0' WHERE `expid` = '$theid'");

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
        'Expenses',
        'Deleted Expense with amount of $amount, date $expdate and receipient $receipient, successfully',
        '$username',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));                       

        echo 1; 



