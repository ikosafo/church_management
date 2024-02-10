<?php
include("../../../../config.php");

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$pass = mysqli_real_escape_string($mysqli, $_POST['password']);
$password = md5($pass);

$res = $mysqli->query("SELECT * FROM users_admin WHERE `username` = '$username'
                                       AND `password` = '$password'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);

$today = date("Y-m-d H:i:s");
$fullname = $getdetails['fullname'];
$branch = $getdetails['branch'];
$usertype = $getdetails['usertype'];
$_SESSION['fullname'] = $fullname;
$_SESSION['username'] = $username;
$_SESSION['branch'] = $branch;
$_SESSION['usertype'] = $usertype;

if ($rowcount == "0") {
    echo 2;
    session_destroy();
} else {
    echo 1;

}

?>