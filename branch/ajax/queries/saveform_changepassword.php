<?php
include('../../../../config.php');

$currentpassword = mysqli_real_escape_string($mysqli, $_POST['currentpassword']);
$newpassword = mysqli_real_escape_string($mysqli, $_POST['newpassword']);
$cpass = md5($currentpassword);
$npass = md5($newpassword);
$username = $_SESSION['username'];
$branch = $_SESSION['branch'];

$getdetails = $mysqli->query("select * from `users_admin` where username = '$username'");
$resdetails = $getdetails->fetch_assoc();
$passdb = $resdetails['password'];

if ($cpass == $passdb) {
    $mysqli->query("UPDATE `users_admin`
SET
  `password` = '$npass'
WHERE `username` = '$username'") or die(mysqli_error($mysqli));
    echo 1;

}
else {
    echo 2;
}






