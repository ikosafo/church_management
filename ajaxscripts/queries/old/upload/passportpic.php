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
    
    //$savelogo = $mysqli->query("UPDATE `staff` SET `passportpic` = '$newfile' WHERE `generatedid` = '$randno'");

    // Check whether image exists
    $chk = $mysqli->query("select * from `staff_images` where `random` = '$randno'");
    
    if (mysqli_num_rows($chk) == '0') {
        $savelogo = $mysqli->query("INSERT INTO `staff_images`
        (`imageloc`,
        `random`,
        `imagetype`)
        VALUES (
        '$newfile',
        '$randno',
        '$filetype')");
   
    }
    else {
        $updatelogo = $mysqli->query("UPDATE `staff_images` set `imageloc` = '$newfile' where `random` = '$randno'");

    }
   
                  
    echo $success =  "The file ".  basename( $_FILES['Filedata']['name']). " has been uploaded";
}
else
{
    echo $error = "There was an error uploading the file, please try again!";
}




