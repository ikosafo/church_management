<?php

$apiKey = '9HRmoMg7EQ3sz9kJ26HQqZOvI';
$phoneNumber = '+233205737464';
$message = 'This is a test message';
$senderID = 'Pharm';

$url = "https://api.mnotify.com/api/sms/quick?key=$apiKey";
$data = [
    'to' => $phoneNumber,
    'msg' => $message,
    'sender_id' => $senderID
];

$ch = curl_init();
$headers = array(
    "Content-Type: application/x-www-form-urlencoded"
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);

if ($response !== false) {
    echo "Message sent: $response";
} else {
    echo "Failed to send message";
}

curl_close($ch);
