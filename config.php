<?php

date_default_timezone_set('UTC');
$datetime = date("Y-m-d H:i:s");
$mysqli = new mysqli('localhost:3308', 'root', 'root', 'church_management');

if ($mysqli->connect_errno) {
    echo "cannot connect MYSQLI error no{$mysqli->connect_errno}:{$mysqli->connect_errno}";
    exit();
}


//Get Logo
function getLogo()
{
    global $mysqli;
    $getlogo = $mysqli->query("SELECT * FROM system_config LIMIT 1");

    if (!$getlogo) {
        // Handle query execution error
        // You can log the error or return a default logo here
        return 'default_logo.png';
    }

    $reslogo = $getlogo->fetch_assoc();

    if (!$reslogo) {
        // Handle case where no logo is found
        // You can log a message or return a default logo here
        return 'default_logo.png';
    }

    return $reslogo['logo'];
}


//Get Company Name
function getChurchName()
{
    global $mysqli;
    $getcomname = $mysqli->query("select * from system_config LIMIT 1");
    $rescomname = $getcomname->fetch_assoc();
    return $rescomname['churchname'];
}

//Get Company Tagline
function getCompanyTagline()
{
    global $mysqli;
    $getcomname = $mysqli->query("select * from system_config LIMIT 1");
    $rescomname = $getcomname->fetch_assoc();
    return $rescomname['tagline'];
}

//Get Company Address
function getCompanyAddress()
{
    global $mysqli;
    $getcomname = $mysqli->query("select * from system_config LIMIT 1");
    $rescomname = $getcomname->fetch_assoc();
    return $rescomname['address'];
}

//Get Company Telephone
function getCompanyTelephone()
{
    global $mysqli;
    $getcomname = $mysqli->query("select * from system_config LIMIT 1");
    $rescomname = $getcomname->fetch_assoc();
    return $rescomname['telephone'];
}


//Get whatsapp number
function getCompanyWhatsapp()
{
    global $mysqli;
    $getcomname = $mysqli->query("select * from system_config LIMIT 1");
    $rescomname = $getcomname->fetch_assoc();
    return $rescomname['whatsapp'];
}

//Get email address
function getCompanyEmail()
{
    global $mysqli;
    $getcomname = $mysqli->query("select * from system_config LIMIT 1");
    $rescomname = $getcomname->fetch_assoc();
    return $rescomname['emailaddress'];
}

session_start();
