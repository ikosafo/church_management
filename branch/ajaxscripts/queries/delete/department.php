<?php
include('../../../../config.php');

$deptid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$branch = $_SESSION['branch'];

$mysqli->query("DELETE FROM `department`
WHERE `id` = '$deptid'") or die(mysqli_error($mysqli));
echo 1;
