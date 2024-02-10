<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$subcategoryname = mysqli_real_escape_string($mysqli, $_POST['subcategoryname']);
$subcategorycode = mysqli_real_escape_string($mysqli, $_POST['subcategorycode']);
$parentcategory = mysqli_real_escape_string($mysqli, $_POST['parentcategory']);
$theid = mysqli_real_escape_string($mysqli, $_POST['theid']);
$getparentid = $mysqli->query("select * from categories where categoryname = '$parentcategory'");
$resparentid = $getparentid->fetch_assoc();
$parentid = $resparentid['catid'];


//Check whether a category already exists
$check = $mysqli->query("select * from subcategories where 
                         (subcategoryname = '$subcategoryname' or subcategorycode = '$subcategorycode')
                         and subcatid != '$theid'");
$getexist = mysqli_num_rows($check);

if ($getexist == "0") {

                    $saveconfig = $mysqli->query("UPDATE `subcategories`
                                        SET  `subcategoryname` = '$subcategoryname',
                                             `subcategorycode` = '$subcategorycode',
                                             `parentid` = '$parentid'
                                             WHERE `subcatid` = '$theid'");

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
                            'Product Subcategory',
                            'Edited Subategory successfully',
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
                            'Product Subcategory'
                            'Edit Subategory error (Name or code already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

                     echo 2;
         }           

                         


                   

