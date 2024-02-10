<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['emailaddress']);
$phonenumber = mysqli_real_escape_string($mysqli, $_POST['phonenumber']);
$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
$companyname = mysqli_real_escape_string($mysqli, $_POST['companyname']);
$nationality = mysqli_real_escape_string($mysqli, $_POST['nationality']);
$residence = mysqli_real_escape_string($mysqli, $_POST['residence']);
$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$adinfo = mysqli_real_escape_string($mysqli, $_POST['adinfo']);
$theid = mysqli_real_escape_string($mysqli, $_POST['theid']);



              $editstaff = $mysqli->query("UPDATE `customer`
              SET 
                `fullname` = '$fullname',
                `emailaddress` = '$emailaddress',
                `phonenumber` = '$phonenumber',
                `gender` = '$gender',
                `companyname` = '$companyname',
                `nationality` = '$nationality',
                `residence` = '$residence',
                `address` = '$address',
                `adinfo` = '$adinfo'
              WHERE `cusid` = '$theid'");

        

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
                'Customer',
                'Update Customer details for $fullname successfully',
                '$username',
                '$mac_address',
                '$ip_add',
                'Successful')") or die(mysqli_error($mysqli));                       
                
                        echo 1; 

                

