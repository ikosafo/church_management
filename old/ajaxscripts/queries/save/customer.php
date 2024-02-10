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


                                $saveconfig = $mysqli->query("INSERT INTO `customer`
                                (
                                `fullname`,
                                `emailaddress`,
                                `phonenumber`,
                                `gender`,
                                `companyname`,
                                `nationality`,
                                `residence`,
                                `address`,
                                `adinfo`)
                                VALUES (
                                '$fullname',
                                '$emailaddress',
                                '$phonenumber',
                                '$gender',
                                '$companyname',
                                '$nationality',
                                '$residence',
                                '$address',
                                '$adinfo')") or die(mysqli_error($mysqli));   
                                
                                
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
                                'Customer $fullname was added successfully',
                                '$username',
                                '$mac_address',
                                '$ip_add',
                                'Successful')") or die(mysqli_error($mysqli));

                                        echo 1; 


         
                    
                    
                   