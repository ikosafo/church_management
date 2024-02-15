<?php
include('../../../../config.php');

$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$datefrom = mysqli_real_escape_string($mysqli, $_POST['datefrom']);
$dateto = mysqli_real_escape_string($mysqli, $_POST['dateto']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$rand = date('hisdmy');
$branch = $_SESSION['branch'];


    $mysqli->query("INSERT INTO `meeting_config`
            (`title`,
             `datefrom`,
             `dateto`,
             `description`,
             `configid`,
             `branch`)
VALUES ('$title',
        '$datefrom',
        '$dateto',
        '$description',
        '$rand',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;

