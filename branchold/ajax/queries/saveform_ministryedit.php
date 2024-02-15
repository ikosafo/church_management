<?php
include('../../../../config.php');

$ministry_name = mysqli_real_escape_string($mysqli, $_POST['ministry_name']);
$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from ministry where `ministry_name` = '$ministry_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("UPDATE `ministry`
SET `ministry_name` = '$ministry_name' WHERE `id` = '$id_index'") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


