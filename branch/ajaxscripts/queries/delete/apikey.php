<?php
include('../../../../config.php');

$keyid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$branch = $_SESSION['branch'];

$mysqli->query("DELETE FROM `mnotify`
WHERE `id` = '$keyid'") or die(mysqli_error($mysqli));
echo 1;
