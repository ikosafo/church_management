<?php
include('../../../../config.php');

$branch_name = mysqli_real_escape_string($mysqli, $_POST['branch_name']);
$branch_location = mysqli_real_escape_string($mysqli, $_POST['branch_location']);
$branch_code = mysqli_real_escape_string($mysqli, $_POST['branch_code']);
$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);

$getcount = $mysqli->query("select * from branch where `name` = '$branch_name'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){

    $mysqli->query("UPDATE `branch`
SET
  `name` = '$branch_name',
  `location` = '$branch_location',
  `code` = '$branch_code'
WHERE `id` = '$id_index'") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


