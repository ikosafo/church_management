<?php
include('../../../../config.php');

$memid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$branch = $_SESSION['branch'];

$mysqli->query("DELETE FROM `members`
WHERE `id` = '$memid'") or die(mysqli_error($mysqli));
echo 1;
