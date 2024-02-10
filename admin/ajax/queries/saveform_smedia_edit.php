<?php
include('../../../../config.php');

$fb_link = mysqli_real_escape_string($mysqli, $_POST['fb_link']);
$tw_link = mysqli_real_escape_string($mysqli, $_POST['tw_link']);
$yt_link = mysqli_real_escape_string($mysqli, $_POST['yt_link']);
$id = mysqli_real_escape_string($mysqli, $_POST['id']);


    $mysqli->query("UPDATE `website_smedia`
                        SET
                          `facebook` = '$fb_link',
                          `twitter` = '$tw_link',
                          `youtube` = '$yt_link'

                        WHERE `id` = '$id'
                    ") or die(mysqli_error($mysqli));


                echo 1;






