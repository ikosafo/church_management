<?php
include('../../../../config.php');

$service_name = mysqli_real_escape_string($mysqli, $_POST['service_name']);
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from service where `service_name` = '$service_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);


if ($count == "0"){
    $mysqli->query("INSERT INTO `service`
            (`service_name`,
             `branch`)
VALUES ('$service_name',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}

