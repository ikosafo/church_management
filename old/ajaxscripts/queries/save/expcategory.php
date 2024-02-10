<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$categoryname = mysqli_real_escape_string($mysqli, $_POST['categoryname']);
$categorycode = mysqli_real_escape_string($mysqli, $_POST['categorycode']);

//Check whether a category already exists
$check = $mysqli->query("select * from expcategories where 
                         categoryname = '$categoryname' or categorycode = '$categorycode' AND status IS NULL");
$getexist = mysqli_num_rows($check);

if ($getexist == "0") {

                    $saveconfig = $mysqli->query("INSERT INTO `expcategories`
                            (
                            `categoryname`,
                            `categorycode`,
                            `datetime`,
                            `useraction`
                            )
                            VALUES 
                            ('$categoryname',
                            '$categorycode',
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
                            'Expense Category',
                            'Added $categoryname as Expense Category successfully',
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
                            'Expense Category',
                            'Add Expense Category error (Name or code already exists)',
                            '$username',
                            '$mac_address',
                            '$ip_add',
                            'Failed')") or die(mysqli_error($mysqli));

                     echo 2;
         }           

                         


                   

