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
$theindex = mysqli_real_escape_string($mysqli, $_POST['theid']);


$editstaff = $mysqli->query("UPDATE `products`
    SET 
  `productname` = '$productname',
  `quantity` = '$quantity',
  `stockthreshold` = '$stockthreshold',
  `supplier` = '$supplier',
  `expirydate` = '$expirydate',
  `variations` = '$variations',
  `costprice` = '$costprice',
  `sellingprice` = '$sellingprice'

  WHERE `prodid` = '$theindex'");



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
              'Update Product details by $username successfully',
              '$username',
              '$mac_address',
              '$ip_add',
              'Successful')") or die(mysqli_error($mysqli));

echo 1;
