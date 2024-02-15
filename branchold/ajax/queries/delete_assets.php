<?php
include('../../../../config.php');
$id=$_POST['i_index'];
$mysqli->query("delete from asset_registry where id = '$id'") or die(mysqli_error($mysqli));
echo 1;
?>