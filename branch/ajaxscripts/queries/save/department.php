<?php
include('../../../../config.php');

$departmentname = mysqli_real_escape_string($mysqli, $_POST['departmentname']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from department where `department_name` = '$departmentname' and 
branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0") {
    $mysqli->query("INSERT INTO `department`
            (`department_name`,
             `branch`)
VALUES ('$departmentname',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
