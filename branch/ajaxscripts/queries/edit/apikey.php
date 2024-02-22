<?php
include('../../../../config.php');

$apikey = mysqli_real_escape_string($mysqli, $_POST['apikey']);
$keyid = mysqli_real_escape_string($mysqli, $_POST['keyid']);
$branch = $_SESSION['branch'];

$mysqli->query("UPDATE `mnotify`
SET 
  `mnotify_key` = '$apikey'
WHERE `branch` = '$branch'") or die(mysqli_error($mysqli));
echo 1;
