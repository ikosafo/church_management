<?php
include('../../../../config.php');

$ministry_name = mysqli_real_escape_string($mysqli, $_POST['ministry_name']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from ministry where `ministry_name` = '$ministry_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `ministry`
            (`ministry_name`,
             `branch`)
VALUES ('$ministry_name',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}


