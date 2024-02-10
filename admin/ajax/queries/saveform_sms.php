<?php
require_once('../../../../config.php');

$branch = 'Admin';
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
    $res= $mysqli->query("SELECT * FROM `member` where status = '' OR status IS NULL");
}
else if ($group == "Visitors") {
    $res= $mysqli->query("SELECT * FROM `visitor`");
}
else if ($group == "New Converts") {
    $res= $mysqli->query("SELECT * FROM `convert`");
}
else if ($group == "Admin Church Worker") {
    $res= $mysqli->query("SELECT * FROM `worker` w JOIN `member` m ON w.memberid = m.id");
}
else if ($group == "Branch Church Worker") {
    $res= $mysqli->query("SELECT * FROM `branchworker` w JOIN `member` m ON w.memberid = m.id");
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
        'Admin')")

or die(mysqli_error($mysqli));

echo 2;


?>


