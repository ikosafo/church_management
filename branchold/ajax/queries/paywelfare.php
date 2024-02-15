<?php
include ('../../../../config.php');

$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$branch = mysqli_real_escape_string($mysqli, $_POST['branch']);
$amount = mysqli_real_escape_string($mysqli, $_POST['amount']);
$paymentfor = mysqli_real_escape_string($mysqli, $_POST['paymentfor']);
$datepaid = mysqli_real_escape_string($mysqli, $_POST['datepaid']);
$period = date('Y-m-d H:i:s');


$mysqli->query("INSERT INTO `f_welfare`
            (`memberid`,
             `year_month`,
             `date_paid`,
             `amount`,
             `period`,
             `branch`)
VALUES ('$memberid',
        '$paymentfor',
        '$datepaid',
        '$amount',
        '$period',
        '$branch')");

echo 1;