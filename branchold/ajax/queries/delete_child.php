<?php
include('../../../../config.php');
$ch_id=$_POST['i_index'];

$mysqli->query("delete from children where id='$ch_id'")
or die(mysqli_error($mysqli));


?>