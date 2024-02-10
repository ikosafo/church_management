<?php
include('../../../../config.php');
$id=$_POST['i_index'];
$usertype = $_SESSION['usertype'];

if ($usertype == "Normal") {
    echo 2;
}
else {
    $mysqli->query("delete from users_admin where id = '$id'") or die(mysqli_error($mysqli));
    echo 1;
}

?>