<?php
include('../../../../config.php');

$address = mysqli_real_escape_string($mysqli, $_POST['address']);
$mail = mysqli_real_escape_string($mysqli, $_POST['mail']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$alttelephone = mysqli_real_escape_string($mysqli, $_POST['alttelephone']);

$getnum = $mysqli->query("select * from `website_contactus`");
$num = mysqli_num_rows($getnum);

if ($num == '0') {
    $mysqli->query("INSERT INTO `website_contactus`
            (`telephone`,
             `alttelephone`,
             `address`,
             `mail`
             )
VALUES ('$telephone',
        '$alttelephone',
        '$address',
        '$mail'
        )") or die(mysqli_error($mysqli));

    echo 1;
}

else {
    echo 2;
}





