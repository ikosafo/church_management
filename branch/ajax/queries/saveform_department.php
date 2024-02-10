<?php
include('../../../../config.php');

$department_name = mysqli_real_escape_string($mysqli, $_POST['department_name']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from department where `department_name` = '$department_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `department`
            (`department_name`,
             `branch`)
VALUES ('$department_name',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


