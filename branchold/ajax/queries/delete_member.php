<?php
include('../../../../config.php');
$member_index = $_POST['member_index'];

$mysqli->query("INSERT INTO `deleted` SELECT * FROM `member` WHERE memberid = '$member_index'");
$mysqli->query("delete from `member` where memberid = '$member_index'") or die(mysqli_error($mysqli));

echo 1;
?>