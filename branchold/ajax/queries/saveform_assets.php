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
$branch = $_SESSION['branch'];
$today = date('Y-m-d H:i:s');

$mysqli->query("INSERT INTO `asset_registry`
            (`categoryid`,
             `itemname`,
             `location`,
             `excellent`,
             `good`,
             `fair`,
             `bad`,
             `worse`,
             `period`,
             `branch`)
VALUES ('$category',
        '$item_name',
        '$location',
        '$excellent',
        '$good',
        '$fair',
        '$bad',
        '$worse',
        '$today',
        '$branch')") or die(mysqli_error($mysqli));
echo 1;

