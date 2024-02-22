<?php
include('../../../../config.php');

$departmentname = mysqli_real_escape_string($mysqli, $_POST['departmentname']);
$deptid = mysqli_real_escape_string($mysqli, $_POST['deptid']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from department where `department_name` = '$departmentname' and 
branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("UPDATE `department`
    SET 
      `department_name` = '$departmentname'
    WHERE `id` = '$deptid'") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
