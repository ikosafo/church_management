<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$companyname = mysqli_real_escape_string($mysqli, $_POST['companyname']);
$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['emailaddress']);
$phonenumber = mysqli_real_escape_string($mysqli, $_POST['phonenumber']);
$city = mysqli_real_escape_string($mysqli, $_POST['city']);
$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$accnumber = mysqli_real_escape_string($mysqli, $_POST['accnumber']);
$accbalance = mysqli_real_escape_string($mysqli, $_POST['accbalance']);
$adinfo = mysqli_real_escape_string($mysqli, $_POST['adinfo']);
$theid = mysqli_real_escape_string($mysqli, $_POST['theid']);


                                $saveconfig = $mysqli->query("UPDATE `supplier`
                                SET `companyname` = '$companyname',
                                 `fullname` = '$fullname',
                                 `emailaddress` = '$emailaddress',
                                 `phonenumber` = '$phonenumber',
                                 `city` = '$city',
                                 `address` = '$address',
                                 `accnumber` = '$accnumber',
                                 `accbalance` = '$accbalance',
                                 `adinfo` = '$adinfo' 

                                 WHERE `supid` = '$theid'") or die(mysqli_error($mysqli));   
                                
                                
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
                                'Supplier',
                                'Update Supplier details for $companyname successfully',
                                '$username',
                                '$mac_address',
                                '$ip_add',
                                'Successful')") or die(mysqli_error($mysqli));                       
                                
                                        echo 1; 
                


         
                    
                    
                   