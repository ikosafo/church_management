<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$giftcardnumber = mysqli_real_escape_string($mysqli, $_POST['giftcardnumber']);
$giftcardvalue = mysqli_real_escape_string($mysqli, $_POST['giftcardvalue']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$customerid = mysqli_real_escape_string($mysqli, $_POST['customername']);


                $saveconfig = $mysqli->query("INSERT INTO `giftcard`
                (
                `giftnumber`,
                `giftvalue`,
                `description`,
                `datetime`,
                `customerid`)
                 VALUES (
                '$giftcardnumber',
                '$giftcardvalue',
                '$description',
                '$datetime',
                '$customerid ')") or die(mysqli_error($mysqli));   
                
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
                'Gift Card',
                'Added $giftcardnumber as number and $giftcardvalue as value for gift card successfully',
                '$username',
                '$mac_address',
                '$ip_add',
                'Successful')") or die(mysqli_error($mysqli));

                                        echo 1; 


         
                    
                    
                   