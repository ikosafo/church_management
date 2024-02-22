<?php
include('../../../../config.php');

$societyid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$branch = $_SESSION['branch'];

$mysqli->query("DELETE FROM `ministry`
WHERE `id` = '$societyid'") or die(mysqli_error($mysqli));
echo 1;
