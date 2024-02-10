<?php
include('../../../config.php');

$randno = $_POST['randno'];
$today = date('Y-m-d H:i:s');
$target_path = "../../../uploads/";
$rand = rand(1,100000);
$allowed =  array('gif','png' ,'jpg', 'jpeg');
$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);

$filename =  $_FILES['Filedata']['name'];
$newfile = 'uploads/'.date('Ymd').$rand.".".$ext;
$target_path = "../../../uploads/".date('Ymd').$rand.".".$ext;
$filetype =  $_FILES['Filedata']['type'];
$filesize =  $_FILES['Filedata']['size'];


if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path)) {

    $savelogo = $mysqli->query("UPDATE `system_config` SET `logo` = '$newfile' WHERE `sysconid` = '$randno'");
  
    echo $success =  "The file ".  basename( $_FILES['Filedata']['name']). " has been uploaded";
}
else
{
    echo $error = "There was an error uploading the file, please try again!";
}




