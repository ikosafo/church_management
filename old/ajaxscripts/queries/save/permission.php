<?php 
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$user = mysqli_real_escape_string($mysqli, $_POST['user']);


foreach ($_POST['permission'] as $permission)
{

    //Check whether permission already exists

    $getperm = $mysqli->query("select * from `userpermission` where userid = '$user' AND permission = '$permission'");

    if (mysqli_num_rows($getperm) == '0') {
            $mysqli->query("INSERT INTO `userpermission`
            (`userid`,
            `permission`,
            `datetime`)
            VALUES ('$user',
            '$permission',
            '$datetime')")
        or die(mysqli_error($mysqli));
        echo 1;
    }
    else {
        echo 2;
    }

  

}