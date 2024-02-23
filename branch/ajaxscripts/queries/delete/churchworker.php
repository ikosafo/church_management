<?php
include('../../../../config.php');

$conid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$branch = $_SESSION['branch'];

$mysqli->query("DELETE FROM `branchworker`
WHERE `id` = '$conid'") or die(mysqli_error($mysqli));
echo 1;
