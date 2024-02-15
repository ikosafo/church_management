<?php
include('../../../../config.php');

$category = mysqli_real_escape_string($mysqli, $_POST['category']);
$item_name = mysqli_real_escape_string($mysqli, $_POST['item_name']);
$location = mysqli_real_escape_string($mysqli, $_POST['location']);
$excellent = mysqli_real_escape_string($mysqli, $_POST['excellent']);
$good = mysqli_real_escape_string($mysqli, $_POST['good']);
$fair = mysqli_real_escape_string($mysqli, $_POST['fair']);
$bad = mysqli_real_escape_string($mysqli, $_POST['bad']);
$worse = mysqli_real_escape_string($mysqli, $_POST['worse']);
$id = mysqli_real_escape_string($mysqli, $_POST['id']);
$branch = $_SESSION['branch'];
$today = date('Y-m-d H:i:s');

$getid = $mysqli->query("select * from asset_category where category_name = '$category'");
$resid = $getid->fetch_assoc();
$theid = $resid['id'];

$mysqli->query("UPDATE `asset_registry`
SET
  `categoryid` = '$theid',
  `itemname` = '$item_name',
  `location` = '$location',
  `excellent` = '$excellent',
  `good` = '$good',
  `fair` = '$fair',
  `bad` = '$bad',
  `worse` = '$worse',
  `branch` = '$branch'

WHERE `id` = '$id'") or die(mysqli_error($mysqli));
echo 1;

