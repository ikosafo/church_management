<?php
include('../../../../config.php');

$category_name = mysqli_real_escape_string($mysqli, $_POST['category_name']);
$category_code = mysqli_real_escape_string($mysqli, $_POST['category_code']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("SELECT * FROM asset_category WHERE (`category_name` = '$category_name' OR
`category_code` = '$category_code') AND
branch = '$branch'");
$count = mysqli_num_rows($getcount);

if ($count == "0"){
    $mysqli->query("INSERT INTO `asset_category`
            (
            `category_name`,
            `category_code`,
             `branch`
             )
VALUES (
        '$category_name',
        '$category_code',
        '$branch'
        )") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


