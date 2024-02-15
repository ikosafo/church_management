<?php
include('../../../../config.php');

$category_name = mysqli_real_escape_string($mysqli, $_POST['category_name']);
$category_code = mysqli_real_escape_string($mysqli, $_POST['category_code']);
$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$branch = $_SESSION['branch'];

    $mysqli->query("UPDATE `asset_category`
SET
`category_name` = '$category_name',
`category_code` = '$category_code'

WHERE `id` = '$id_index'") or die(mysqli_error($mysqli));
    echo 1;


