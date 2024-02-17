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

$_SESSION['telephone'] = $telephone;

$checkExist = $mysqli->query("SELECT * FROM members WHERE emailaddress = '$emailaddress' OR telephone = '$telephone'");
if (mysqli_num_rows($checkExist) > 0) {
    echo 2;
} else {
    $mysqli->query("INSERT INTO members (fullname, maidenname, telephone, dob, age, birthplace, gender, gpsaddress, `location`, hometown, nationality, communicant, baptismdate, confirmationdate, emailaddress, placeofwork, society, occupation, random, branch) 
    VALUES ('$fullname', '$maidenname', '$telephone', '$dob', '$age', '$birthplace', '$gender', '$gpsaddress', '$location', '$hometown', '$nationality', '$communicant', '$baptismdate', '$confirmationdate', '$emailaddress', '$placeofwork', '$society', '$occupation', '$random','$branch')");
    echo 1;
}

/* // Check if email address or telephone already exists in the table
$checkQuery = "SELECT * FROM members WHERE emailaddress = '$emailaddress' OR telephone = '$telephone'";
$checkResult = $mysqli->query($checkQuery);
if ($checkResult->num_rows > 0) {
    echo 2; // Error: Email address or telephone number already exists
} else {
    // Insert data into members table
    $insertQuery = "";
    if ($mysqli->query($insertQuery)) {
        echo 1; // Success
    } else {
        echo 0; // Error
    }
    echo 1; // Success
}
 */