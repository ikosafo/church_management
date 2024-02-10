<?php
require_once('../../../../config.php');

$branch = $_SESSION['branch'];
$title = mysqli_real_escape_string($mysqli,$_POST['title']);
$message = mysqli_real_escape_string($mysqli,$_POST['message']);
$group = mysqli_real_escape_string($mysqli,$_POST['group']);

function sendSMS($message, $phone)
{
    include('../../../../dbcon.php');
    $branch = $_SESSION['branch'];
    $getkey = $mysqli->query("select * from `mnotify` where branch = '$branch' LIMIT 1");
    $reskey = $getkey->fetch_assoc();

    $keyval = $reskey['mnotify_key'];
    $sender = $_POST['title'];
    $key = $keyval;
    $url = "http://bulk.mnotify.net/smsapi?key=" . $key . "&to=" . $phone . "&msg=" . urlencode($message) . "&sender_id=" . $sender;
    $response = file_get_contents($url);
}

$date = date('Y-m-d H:i:s');

if ($group == "Members") {
    $res= $mysqli->query("SELECT * FROM `member` where status = '' OR status IS NULL  AND branch = '$branch'");
}
else if ($group == "Visitors") {
    $res= $mysqli->query("SELECT * FROM `visitor` where branch = '$branch'");
}
else if ($group == "New Converts") {
    $res= $mysqli->query("SELECT * FROM `convert` where branch = '$branch'");
}


while ($record = $res->fetch_assoc()) {
    $number = $record['telephone'];
    $num = substr("$number", 1);
    $phone = '+233' . $num;

    sendSMS($message, $phone);
    echo 1;
}

$query = $mysqli->query("INSERT INTO `sms`
            (`group`,
             `message`,
             `datesent`,
             `title`,
             `branch`)
VALUES ('$group',
        '$message',
        '$date',
        '$title',
        '$branch')")

or die(mysqli_error($mysqli));

echo 2;


?>


