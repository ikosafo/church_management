<?php
include('../../../../config.php');
$id=$_POST['i_index'];
$mysqli->query("delete from acc_payments where pid = '$id'") or die(mysqli_error($mysqli));
echo 1;
?>