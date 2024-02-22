<?php
include('../../../../config.php');

$societyname = mysqli_real_escape_string($mysqli, $_POST['societyname']);
$societyid = mysqli_real_escape_string($mysqli, $_POST['societyid']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from `ministry` where `ministry_name` = '$societyname' and 
branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("UPDATE `ministry`
    SET 
      `ministry_name` = '$societyname'
    WHERE `id` = '$societyid'") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
