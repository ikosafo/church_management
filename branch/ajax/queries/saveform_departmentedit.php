<?php
include('../../../../config.php');

$department_name = mysqli_real_escape_string($mysqli, $_POST['department_name']);
$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from department where `department_name` = '$department_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("UPDATE `department`
SET `department_name` = '$department_name' WHERE `id` = '$id_index'") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


