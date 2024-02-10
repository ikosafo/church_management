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
$random = mysqli_real_escape_string($mysqli, $_POST['random']);
$theid = mysqli_real_escape_string($mysqli, $_POST['theid']);



    $editstaff = $mysqli->query("UPDATE `staff`
    SET 
      `fullname` = '$fullname',
      `gender` = '$gender',
      `birthdate` = '$dateofbirth',
      `telephone` = '$phonenumber',
      `emailaddress` = '$emailaddress',
      `residence` = '$residence',
      `address` = '$address',
      `educationallevel` = '$educationallevel',
      `idtype` = '$idtype',
      `idnumber` = '$idnumber',
      `hometown` = '$hometown',
      `staffid` = '$staffid',
      `nationality` = '$nationality',
      `position` = '$position',
      `religion` = '$religion'

    WHERE `stid` = '$theid'");

        

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
                'Update User details for $fullname successfully',
                '$username',
                '$mac_address',
                '$ip_add',
                'Successful')") or die(mysqli_error($mysqli));                       
                
                        echo 1; 

                

