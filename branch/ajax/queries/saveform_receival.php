<?php
include('../../../../config.php');

$datereceived = mysqli_real_escape_string($mysqli, $_POST['datereceived']);
$offering = mysqli_real_escape_string($mysqli, $_POST['offering']);
$tithe = mysqli_real_escape_string($mysqli, $_POST['tithe']);
$youth = mysqli_real_escape_string($mysqli, $_POST['youth']);
$children = mysqli_real_escape_string($mysqli, $_POST['children']);
$pledge = mysqli_real_escape_string($mysqli, $_POST['pledge']);
$seed = mysqli_real_escape_string($mysqli, $_POST['seed']);
$welfare = mysqli_real_escape_string($mysqli, $_POST['welfare']);
$firstfruit = mysqli_real_escape_string($mysqli, $_POST['firstfruit']);
$contributions = mysqli_real_escape_string($mysqli, $_POST['contributions']);
$partners = mysqli_real_escape_string($mysqli, $_POST['partners']);
$branch = $_SESSION['branch'];
$periodreceived = date('Y-m-d H:i:s');


$mysqli->query("INSERT INTO `acc_receivals`
            (`offering`,
             `tithe`,
             `youth`,
             `children`,
             `pledge`,
             `seed`,
             `welfare`,
             `firstfruit`,
             `contribution`,
             `partners`,
             `datereceived`,
             `periodreceived`,
             `branch`)
VALUES ('$offering',
        '$tithe',
        '$youth',
        '$children',
        '$pledge',
        '$seed',
        '$welfare',
        '$firstfruit',
        '$contributions',
        '$partners',
        '$datereceived',
        '$periodreceived',
        '$branch')") or die(mysqli_error($mysqli));
echo 1;