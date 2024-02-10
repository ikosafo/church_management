<?php
include ('../../../../config.php');

$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$branch = mysqli_real_escape_string($mysqli, $_POST['branch']);
$amount = mysqli_real_escape_string($mysqli, $_POST['amount']);
$purpose = mysqli_real_escape_string($mysqli, $_POST['purpose']);
$datepaid = mysqli_real_escape_string($mysqli, $_POST['datepaid']);
$period = date('Y-m-d H:i:s');


$mysqli->query("INSERT INTO `f_offerings`
            (`memberid`,
             `purpose`,
             `date_paid`,
             `amount`,
             `period`,
             `branch`)
VALUES ('$memberid',
        '$purpose',
        '$datepaid',
        '$amount',
        '$period',
        '$branch')");

echo 1;