<?php

$host = "localhost:3308";
$user = "root";
$password = "root";
$dbname = "cvsi";

/*$host = "localhost:3306";
$user = "alliedgh_root";
$password = "Server@2019$";
$dbname = "alliedgh_registration";*/


$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
