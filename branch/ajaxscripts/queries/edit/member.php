<?php
include('../../../../config.php');

// Assuming session_start() is called somewhere before accessing $_SESSION
$branch = $_SESSION['branch'];

$fullname = mysqli_real_escape_string($mysqli, $_POST['fullname']);
$maidenname = mysqli_real_escape_string($mysqli, $_POST['maidenname']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$dob = mysqli_real_escape_string($mysqli, $_POST['dob']);
$age = mysqli_real_escape_string($mysqli, $_POST['age']);
$birthplace = mysqli_real_escape_string($mysqli, $_POST['birthplace']);
$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);
$gpsaddress = mysqli_real_escape_string($mysqli, $_POST['gpsaddress']);
$location = mysqli_real_escape_string($mysqli, $_POST['location']);
$hometown = mysqli_real_escape_string($mysqli, $_POST['hometown']);
$nationality = mysqli_real_escape_string($mysqli, $_POST['nationality']);
$communicant = mysqli_real_escape_string($mysqli, $_POST['communicant']);
$baptismdate = mysqli_real_escape_string($mysqli, $_POST['baptismdate']);
$confirmationdate = mysqli_real_escape_string($mysqli, $_POST['confirmationdate']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['emailaddress']);
$placeofwork = mysqli_real_escape_string($mysqli, $_POST['placeofwork']);
$society = mysqli_real_escape_string($mysqli, $_POST['society']);
$occupation = mysqli_real_escape_string($mysqli, $_POST['occupation']);
$random = mysqli_real_escape_string($mysqli, $_POST['random']);
$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);


$mysqli->query("UPDATE `members` SET `fullname` = '$fullname', `maidenname` = '$maidenname', telephone = '$telephone', dob = '$dob', age = '$age', birthplace = '$birthplace', gender = '$gender', gpsaddress = '$gpsaddress', `location` = '$location', hometown = '$hometown', nationality = '$nationality', communicant = '$communicant', baptismdate = '$baptismdate', confirmationdate = '$confirmationdate', emailaddress = '$emailaddress', placeofwork = '$placeofwork', society = '$society', occupation = '$occupation', random = '$random', branch = '$branch' WHERE id = '$memberid'");

echo 1;
