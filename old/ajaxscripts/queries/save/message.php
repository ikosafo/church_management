<?php
include('../../../config.php');
include("../../../functions.php");

$username = $_SESSION['username'];
$receipient = mysqli_real_escape_string($mysqli, $_POST['receipient']);
$message = mysqli_real_escape_string($mysqli, $_POST['message']);

            $saveconfig = $mysqli->query("INSERT INTO `messages`
                                        (`receipient`,
                                        `message`,
                                        `datetime`,
                                        `user`)
                                        VALUES (
                                        '$receipient',
                                        '$message',
                                        '$datetime',
                                        '$username')");

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
                                        'Messages',
                                        'Message sent successfully by $username to $receipient',
                                        '$username',
                                        '$mac_address',
                                        '$ip_add',
                                        'Successful')") or die(mysqli_error($mysqli));                       

                                        echo 1; 


