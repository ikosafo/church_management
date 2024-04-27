<?php
include('../../../../config.php');

// Assuming session_start() is called somewhere before accessing $_SESSION
$branch = $_SESSION['branch'];
$memtelephone = $_SESSION['telephone'];

$spousename = mysqli_real_escape_string($mysqli, $_POST['spousename']);
$spousephone = mysqli_real_escape_string($mysqli, $_POST['spousephone']);
$fathersname = mysqli_real_escape_string($mysqli, $_POST['fathersname']);
$fathersphone = mysqli_real_escape_string($mysqli, $_POST['fathersphone']);
$mothersname = mysqli_real_escape_string($mysqli, $_POST['mothersname']);
$mothersphone = mysqli_real_escape_string($mysqli, $_POST['mothersphone']);
$childrennumber = mysqli_real_escape_string($mysqli, $_POST['childrennumber']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$nextofkin = mysqli_real_escape_string($mysqli, $_POST['nextofkin']);
$nextofkinphone = mysqli_real_escape_string($mysqli, $_POST['nextofkinphone']);

unset($_SESSION['telephone']);

$updateQuery = $mysqli->query("UPDATE `members`
SET 
  `spousename` = '$spousename',
  `spousephone` = '$spousephone',
  `fathersname` = '$fathersname',
  `fathersphone` = '$fathersphone',
  `mothersname` = '$mothersname',
  `mothersphone` = '$mothersphone',
  `childrennumber` = '$childrennumber',
  `nextofkin` = '$nextofkin',
  `nextofkinphone` = '$nextofkinphone'

WHERE `telephone` = '$memtelephone'");
