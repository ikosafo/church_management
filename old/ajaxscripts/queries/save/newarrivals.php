<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$productid = mysqli_real_escape_string($mysqli, $_POST['product']);
$quantity = mysqli_real_escape_string($mysqli, $_POST['quantity']);
$supplier = mysqli_real_escape_string($mysqli, $_POST['supplier']);
$expirydate = mysqli_real_escape_string($mysqli, $_POST['expirydate']);
$costprice = mysqli_real_escape_string($mysqli, $_POST['costprice']);
$sellingprice = mysqli_real_escape_string($mysqli, $_POST['sellingprice']);
$productname = getProductName($productid);
$datetime = date('Y-m-d H:i:s');

$saveconfig = $mysqli->query("INSERT INTO `newarrivals`
                                (
                                `prodid`,
                                `productname`,
                                `quantity`,
                                `supplier`,
                                `expirydate`,
                                `costprice`,
                                `sellingprice`,
                                `datetime`,
                                `username`)
                                VALUES (
                                '$productid',
                                '$productname',
                                '$quantity',
                                '$supplier',
                                '$expirydate',
                                '$costprice',
                                '$sellingprice',
                                '$datetime',
                                '$username')");

//update products

$getdetails = $mysqli->query("select * from `products` where prodid = '$productid'");
$resdetails = $getdetails->fetch_assoc();
$quantityold = $resdetails['quantity'];
$updatequantity = $quantityold + $quantity;

if ($quantityold == "0") {
    $saveconfig = $mysqli->query("UPDATE `products`
                            SET 
                            `quantity` = '$updatequantity',
                            `costprice` = '$costprice',
                            `expirydate` = '$expirydate',
                            `supplier` = '$supplierid',
                            `sellingprice` = '$sellingprice'
                            
                            WHERE `prodid` = '$productid'");
} else {
    $saveconfig = $mysqli->query("UPDATE `products`
                            SET 
                            `quantity` = '$updatequantity',
                            `costprice` = '$costprice',
                            `sellingprice` = '$sellingprice',
                            `newarrivalexpiry` = '$expirydate'
                            
                            WHERE `prodid` = '$productid'");
}


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
                        'New arrivals',
                        'Added product $productname as new arrival successfully',
                        '$username',
                        '$mac_address',
                        '$ip_add',
                        'Successful')") or die(mysqli_error($mysqli));

echo 1;
