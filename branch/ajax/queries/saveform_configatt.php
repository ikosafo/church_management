<?php
include('../../../../config.php');

$serviceid = mysqli_real_escape_string($mysqli, $_POST['serviceid']);
$datefrom = mysqli_real_escape_string($mysqli, $_POST['datefrom']);
$dateto = mysqli_real_escape_string($mysqli, $_POST['dateto']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$rand = date('hisdmy');
$branch = $_SESSION['branch'];

$getcount = $mysqli->query("select * from service_config where branch = '$branch' and dateto BETWEEN '$datefrom' AND '$dateto'");
$count = mysqli_num_rows($getcount);

if ($count == "0"){
    $mysqli->query("INSERT INTO `service_config`
            (`serviceid`,
             `datefrom`,
             `dateto`,
             `description`,
             `configid`,
             `branch`)
VALUES ('$serviceid',
        '$datefrom',
        '$dateto',
        '$description',
        '$rand',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
}
else {
    echo 2;
}

