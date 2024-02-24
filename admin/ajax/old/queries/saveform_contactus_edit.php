<?php
include('../../../../config.php');

$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$mail = mysqli_real_escape_string($mysqli, $_POST['mail']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$alttelephone = mysqli_real_escape_string($mysqli, $_POST['alttelephone']);
$id = mysqli_real_escape_string($mysqli, $_POST['id']);


    $mysqli->query("UPDATE `website_contactus`
                        SET
                          `address` = '$address',
                          `telephone` = '$telephone',
                          `alttelephone` = '$alttelephone',
                          `mail` = '$mail'

                        WHERE `id` = '$id'
                    ") or die(mysqli_error($mysqli));


                echo 1;






