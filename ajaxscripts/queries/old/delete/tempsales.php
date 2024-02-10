<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$theid = mysqli_real_escape_string($mysqli, $_POST['i_index']);

//Delete sales
$check = $mysqli->query("DELETE FROM `tempsales` WHERE `tsid` = '$theid'");

echo 1; 



