<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['emailaddress']);
$phonenumber = mysqli_real_escape_string($mysqli, $_POST['phonenumber']);
$dateofbirth = mysqli_real_escape_string($mysqli, $_POST['dateofbirth']);
$nationality = mysqli_real_escape_string($mysqli, $_POST['nationality']);
$staffid = mysqli_real_escape_string($mysqli, $_POST['staffid']);
$position = mysqli_real_escape_string($mysqli, $_POST['position']);
$educationallevel = mysqli_real_escape_string($mysqli, $_POST['educationallevel']);
$residence = mysqli_real_escape_string($mysqli, $_POST['residence']);
$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$hometown = mysqli_real_escape_string($mysqli, $_POST['hometown']);
$religion = mysqli_real_escape_string($mysqli, $_POST['religion']);
$idtype = mysqli_real_escape_string($mysqli, $_POST['idtype']);
$idnumber = mysqli_real_escape_string($mysqli, $_POST['idnumber']);
$user_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$random = mysqli_real_escape_string($mysqli, $_POST['random']);
$password = mysqli_real_escape_string($mysqli, $_POST['userpassword']);
$userpassword = md5($password);

//Check whether a staff already exists
$check = $mysqli->query("select * from staff where username = '$user_username'");
$getexist = mysqli_num_rows($check);

if ($getexist == "0") {

        $saveconfig = $mysqli->query("INSERT INTO `staff`
                        (`fullname`,
                        `gender`,
                        `birthdate`,
                        `telephone`,
                        `emailaddress`,
                        `residence`,
                        `address`,
                        `educationallevel`,
                        `idtype`,
                        `idnumber`,
                        `hometown`,
                        `generatedid`,
                        `staffid`,
                        `nationality`,
                        `position`,
                        `religion`,
                        `username`,
                        `password`)
                        VALUES (
                        '$fullname',
                        '$gender',
                        '$dateofbirth',
                        '$phonenumber',
                        '$emailaddress',
                        '$residence',
                        '$address',
                        '$educationallevel',
                        '$idtype',
                        '$idnumber',
                        '$hometown',
                        '$random',
                        '$staffid',
                        '$nationality',
                        '$position',
                        '$religion',
                        '$user_username',
                        '$userpassword')");

                        $mysqli->query("INSERT INTO `logs`
                        (
                        `logdate`,
                        `section`,
                        `message`,
                        `user`,
                        `macaddress`,
                        `ipaddress`,
                        `action`)
                        VALUES (
                        '$datetime',
                        'User',
                        'Added user $fullname as staff successfully',
                        '$username',
                        '$mac_address',
                        '$ip_add',
                        'Successful')") or die(mysqli_error($mysqli));                       
                        
                        echo 1; 

                }

         else  {
                            $mysqli->query("INSERT INTO `logs`
                            (
                            `logdate`,
                            `section`,
                            `message`,
                            `user`,
                            `macaddress`,
                            `ipaddress`,
                            `action`)
                            VALUES (
                            '$datetime',
                            'User',
                            'Add User error (Username already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

                     echo 2;
         }           

                         


                   

