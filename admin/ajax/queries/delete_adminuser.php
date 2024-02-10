<?php
include('../../../../config.php');
$id=$_POST['i_index'];

$mysqli->query("delete from users_adminmain where id = '$id'") or die(mysqli_error($mysqli));

echo 1;
?>