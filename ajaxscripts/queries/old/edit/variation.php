<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$attributename = mysqli_real_escape_string($mysqli, $_POST['attributename']);
$attributecode = mysqli_real_escape_string($mysqli, $_POST['attributecode']);
$theid = mysqli_real_escape_string($mysqli, $_POST['theid']);

//Check whether an attribute already exists
$check = $mysqli->query("select * from variations where 
                         (attributename = '$attributename' or attributecode = '$attributecode')
                         and varid != '$theid'");
$getexist = mysqli_num_rows($check);

if ($getexist == "0") {

                    $saveconfig = $mysqli->query("UPDATE `variations`
                                        SET  `attributename` = '$attributename',
                                             `attributecode` = '$attributecode'
                                             WHERE `varid` = '$theid'");

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
                            'Product Variation',
                            'Edited Variation for $attributename successfully',
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
                            'Product Variation',
                            'Edit Variation error (Name or code already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

                     echo 2;
         }           

                         


                   

