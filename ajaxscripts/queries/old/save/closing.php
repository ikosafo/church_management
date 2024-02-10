<?php
include('../../../config.php');
include("../../../functions.php");

//$username = $_SESSION['username'];
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$totalprice = mysqli_real_escape_string($mysqli, $_POST['totalprice']);
$totalexpense = mysqli_real_escape_string($mysqli, $_POST['totalexpense']);

            $saveclosing = $mysqli->query("INSERT INTO `closingperiod`
            (`closingbalance`,
             `totalexpense`,
             `timeclosed`,
             `username`)
            VALUES ('$totalprice',
                '$totalexpense',
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
            'Signed Out',
            'Closed for the day',
            '$username',
            '$mac_address',
            '$ip_add',
            'Successful')") or die(mysqli_error($mysqli));                       

            echo 1; 


                   
            error_reporting(0);
            $key = "mgMdqyJ6ynoZD1loelcBNkbEN";
            $to = "0205737464";
            $msg = "Closed today at '.$datetime.'. Total sales made: '.$totalprice.'. Total expenses made:'.$totalexpense.'";
            $sender_id = "AKS";

            $msg = urlencode($msg);
            $url = "https://apps.mnotify.net/smsapi?key=$key&to=$to&msg=$msg&sender_id=$sender_id";