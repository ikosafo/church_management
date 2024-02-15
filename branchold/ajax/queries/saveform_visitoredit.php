<?php
include('../../../../config.php');

$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$denomination = mysqli_real_escape_string($mysqli, $_POST['denomination']);
$residence = mysqli_real_escape_string($mysqli, $_POST['residence']);
$hearing_about = mysqli_real_escape_string($mysqli, $_POST['hearing_about']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$visitorid = mysqli_real_escape_string($mysqli, $_POST['visitorid']);
$branch = $_SESSION['branch'];
$period = date("Y-m-d H:i:s");

$mysqli->query("UPDATE `visitor` SET
      `full_name` = '$full_name',
      `telephone` = '$telephone',
      `residence` = '$residence',
      `denomination` = '$denomination',
      `hearing_about` = '$hearing_about',
      `description` = '$description',
      `branch` = '$branch'

WHERE `id` = '$visitorid'")
or die(mysqli_error($mysqli));
echo 1;

?>