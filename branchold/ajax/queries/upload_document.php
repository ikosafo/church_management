<?php
include('../../../../config.php');
$randno = $_POST['randno'];
$today = date('Y-m-d H:i:s');

$target_path = "../../../uploads/documents/";
$rand = rand(1,100000);
$allowed =  array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'txt', 'rtf', 'html',
    'zip', 'mp3', 'wma', 'mpg', 'flv', 'avi', 'jpg', 'jpeg', 'png','gif','pdf');
$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);

$filename =  $_FILES['Filedata']['name'];
$newfile = 'uploads/documents/'.date('Ymd').$rand.".".$ext;
$target_path = "../../../uploads/documents/".date('Ymd').$rand.".".$ext;

$filetype =  $_FILES['Filedata']['type'];
$filesize =  $_FILES['Filedata']['size'];

if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path)) {
    echo $success =  "The file ".  basename( $_FILES['Filedata']['name']). " has been uploaded";
}
else
{
    echo $error = "There was an error uploading the file, please try again!";

}




$chk = $mysqli->query("select * from member_images where memberid = '$randno'");
$count = mysqli_num_rows($chk);

if ($count == "0"){
    $insertfile  = $mysqli->query("INSERT INTO `member_images`
            (`memberid`,
             `image_name`,
             `image_location`,
             `image_size`,
             `image_type`,
             `datetime`)
VALUES ('$randno',
        '$filename',
        '$newfile',
        '$filesize',
        '$filetype',
        '$today')") or die ();
    echo 100;
}

else {
    $query = $mysqli->query("select * from member_images where memberid = '$randno'");
    $res = $query->fetch_assoc();
    $filename2 =  $res['image_location'];
    $use = substr($filename2,strpos($filename2,"/")+1);
    unlink("../../uploads/".$use);

    $updatefile  = $mysqli->query("UPDATE `member_images`
SET

  `image_name` = '$filename',
  `image_location` = '$newfile',
  `image_size` = '$filesize',
  `image_type` = '$filetype'

WHERE `memberid` = '$randno'") or die ();
    echo 101;

}

$insertfile  = $mysqli->query("INSERT INTO `document_files`
            (`document_name`,
             `document_location`,
             `document_size`,
             `document_type`,
             `document_id`,
             `period_uploaded`)
VALUES ('$filename',
    '$newfile',
    '$filesize',
    '$filetype',
    '$randno',
    '$today')") or die ();


/*$insertfile  = $mysqli->query("INSERT INTO `member_images`
            (`memberid`,
             `image_name`,
             `image_location`,
             `image_size`,
             `image_type`,
             `datetime`)
VALUES ('$randno',
        '$filename',
        '$newfile',
        '$filesize',
        '$filetype',
        '$today')") or die ();*/
?>


