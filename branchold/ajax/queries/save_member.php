<?php
include('../../../../config.php');

$branch = $_SESSION['branch'];
$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$othertitle = mysqli_real_escape_string($mysqli, $_POST['othertitle']);
$surname = mysqli_real_escape_string($mysqli, $_POST['surname']);
$firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
$othername = mysqli_real_escape_string($mysqli, $_POST['othername']);
$emailaddress = mysqli_real_escape_string($mysqli, $_POST['email_address']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$alttelephone = mysqli_real_escape_string($mysqli, $_POST['alttelephone']);
$birthdate = mysqli_real_escape_string($mysqli, $_POST['birth_date']);
$nationality = mysqli_real_escape_string($mysqli, $_POST['nationality']);
$hometown = mysqli_real_escape_string($mysqli, $_POST['hometown']);
$residence = mysqli_real_escape_string($mysqli, $_POST['residence']);
$housenumber = mysqli_real_escape_string($mysqli, $_POST['house_number']);
$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);

$datetime = date("Y-m-d H:i:s");

$q_new = $mysqli->query("SELECT * FROM `member` WHERE `memberid` = '$memberid'");
$count_new = mysqli_num_rows($q_new);

if ($count_new == "0") {
    $mysqli->query("INSERT INTO `member`
            (`memberid`,
             `title`,
             `othertitle`,
             `surname`,
             `firstname`,
             `othername`,
             `emailaddress`,
             `telephone`,
             `alttelephone`,
             `birthdate`,
             `nationality`,
             `hometown`,
             `residence`,
             `housenumber`,
             `gender`,
             `branch`,
             `datetime`)
VALUES ('$memberid',
        '$title',
        '$othertitle',
        '$surname',
        '$firstname',
        '$othername',
        '$emailaddress',
        '$telephone',
        '$alttelephone',
        '$birthdate',
        '$nationality',
        '$hometown',
        '$residence',
        '$housenumber',
        '$gender',
        '$branch',
        '$datetime')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    $mysqli->query("UPDATE `member`

SET
  `title` = '$title',
  `othertitle` = '$othertitle',
  `surname` = '$surname',
  `firstname` = '$firstname',
  `othername` = '$othername',
  `emailaddress` = '$emailaddress',
  `telephone` = '$telephone',
  `alttelephone` = '$alttelephone',
  `birthdate` = '$birthdate',
  `nationality` = '$nationality',
  `hometown` = '$hometown',
  `residence` = '$residence',
  `housenumber` = '$housenumber',
  `gender` = '$gender'

WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));
    echo 2;
}
?>