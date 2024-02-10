<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$subcategoryname = mysqli_real_escape_string($mysqli, $_POST['subcategoryname']);
$subcategorycode = mysqli_real_escape_string($mysqli, $_POST['subcategorycode']);
$parentcategory = mysqli_real_escape_string($mysqli, $_POST['parentcategory']);

//Check whether a subcategory already exists
$check = $mysqli->query("select * from subcategories where 
                         (subcategoryname = '$subcategoryname' or subcategorycode = '$subcategorycode')");
$getexist = mysqli_num_rows($check);

if ($getexist == "0") {

                    $saveconfig = $mysqli->query("INSERT INTO `subcategories`
                            (
                            `subcategoryname`,
                            `subcategorycode`,
                            `parentid`,
                            `datetime`,
                            `useraction`
                            )
                            VALUES 
                            ('$subcategoryname',
                            '$subcategorycode',
                            '$parentcategory',
                            '$datetime',
                            '$username'
                            )");

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
                            'Added $subcategoryname as subcategory successfully',
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
                            'Product Subcategory',
                            'Add subcategory error (Name or code already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

                     echo 2;
         }           

                         


                   

