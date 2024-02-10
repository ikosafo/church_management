<?php
include("../../../../config.php");

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$pass = mysqli_real_escape_string($mysqli, $_POST['password']);
$password = md5($pass);

$res = $mysqli->query("SELECT * FROM users_adminmain WHERE `username` = '$username' 
                                       AND `password` = '$password'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);

$today = date("Y-m-d H:i:s");
$fullname = $getdetails['fullname'];
$_SESSION['fullname'] = $fullname;
$_SESSION['username'] = $username;


if ($rowcount == "0") {
    echo 2;
    session_destroy();
} else {
    echo 1;

}

?>