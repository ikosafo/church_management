<?php
include('../../../../config.php');

$cell_name = mysqli_real_escape_string($mysqli, $_POST['cell_name']);
$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from cell where `cell_name` = '$cell_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("UPDATE `cell`
SET `cell_name` = '$cell_name' WHERE `id` = '$id_index'") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


