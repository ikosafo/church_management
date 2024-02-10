<?php
include("../../../config.php");
include("../../../functions.php");

$username = $_POST['username'];
$pass = $_POST['password'];
$usertype = $_POST['usertype'];
$password = md5($pass);
$today = date("Y-m-d H:i:s");

if ($usertype == 'Main Admin') {
    // Attempt authentication with users_adminmain table
    $res = $mysqli->query("SELECT * FROM users_adminmain WHERE `username` = '$username' AND `password` = '$password'");
    $getdetails = $res->fetch_assoc();
    $rowcount = mysqli_num_rows($res);

    // If no record found in users_adminmain, attempt authentication with system_config table
    if ($rowcount == 0) {
        $res = $mysqli->query("SELECT * FROM system_config WHERE `username` = '$username' AND `password` = '$password'");
        $getdetails = $res->fetch_assoc();
        $rowcount = mysqli_num_rows($res);
    }

    // Check if authentication was successful
    if ($rowcount > 0) {
        // Authentication successful, proceed with login
        // You can set session variables or perform other actions here
        @$fullname = $getdetails['fullname'];
        if ($fullname == '') {
            $fullname = 'Admin';
        }
        $_SESSION['fullname'] = $fullname;
        $_SESSION['username'] = $username;
        echo 2;
    } else {
        // Authentication failed
        echo 3;
        session_destroy();
    }
} else {

    $res = $mysqli->query("SELECT * FROM users_admin WHERE `username` = '$username'
                                       AND `password` = '$password'");
    $getdetails = $res->fetch_assoc();
    $rowcount = mysqli_num_rows($res);
    @$fullname = $getdetails['fullname'];
    @$branch = $getdetails['branch'];
    @$usertype = $getdetails['usertype'];
    $_SESSION['fullname'] = $fullname;
    $_SESSION['username'] = $username;
    $_SESSION['branch'] = $branch;
    $_SESSION['usertype'] = $usertype;

    if ($rowcount == "0") {
        echo 4;
        session_destroy();
    } else {
        echo 1;
    }
}
