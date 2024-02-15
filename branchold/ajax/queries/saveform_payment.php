<?php
include('../../../../config.php');

$datepaid = mysqli_real_escape_string($mysqli, $_POST['datepaid']);
$amount = mysqli_real_escape_string($mysqli, $_POST['amount']);
$paymenttype = mysqli_real_escape_string($mysqli, $_POST['type']);
$purpose = mysqli_real_escape_string($mysqli, $_POST['purpose']);
$branch = $_SESSION['branch'];
$periodpaid = date('Y-m-d H:i:s');


$mysqli->query("INSERT INTO `acc_payments`
            (`amount`,
             `paymenttype`,
             `purpose`,
             `periodpaid`,
             `datepaid`,
             `branch`)
VALUES ('$amount',
        '$paymenttype',
        '$purpose',
        '$periodpaid',
        '$datepaid',
        '$branch')") or die(mysqli_error($mysqli));
echo 1;