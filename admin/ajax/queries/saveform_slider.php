<?php
include('../../../../config.php');

$imageid = mysqli_real_escape_string($mysqli, $_POST['imageid']);
$datetime = date("Y-m-d H:i:s");

$mysqli->query("INSERT INTO `slider`
            (`imageid`)
VALUES ('$imageid')") or die(mysqli_error($mysqli));

echo 1;
