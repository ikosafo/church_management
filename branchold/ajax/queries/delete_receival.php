<?php
include('../../../../config.php');
$id=$_POST['i_index'];
$mysqli->query("delete from acc_receivals where rid = '$id'") or die(mysqli_error($mysqli));
echo 1;
?>