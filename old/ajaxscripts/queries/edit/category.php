<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$categoryname = mysqli_real_escape_string($mysqli, $_POST['categoryname']);
$categorycode = mysqli_real_escape_string($mysqli, $_POST['categorycode']);
$theid = mysqli_real_escape_string($mysqli, $_POST['theid']);

//Check whether a category already exists
$check = $mysqli->query("select * from categories where 
                         categoryname = '$categoryname' or categorycode = '$categorycode'");
$getexist = mysqli_num_rows($check);

if ($getexist == "0") {

                    $saveconfig = $mysqli->query("UPDATE `categories`
                                        SET  `categoryname` = '$categoryname',
                                             `categorycode` = '$categorycode'
                                             WHERE `catid` = '$theid'");

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
                            'Product Category',
                            'Edited Category for $categoryname successfully',
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
                            'Product Category',
                            'Edit Category error (Name or code already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

                     echo 2;
         }           

                         


                   

