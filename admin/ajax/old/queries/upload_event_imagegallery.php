<?php
include('../../../../config.php');

$randno = $_POST['randno'];
$today = date('Y-m-d H:i:s');
$target_path = "../../../uploads/eventsgallery/";
$rand = rand(1,100000);
$allowed =  array('gif','png' ,'jpg', 'jpeg');
$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);

$filename =  $_FILES['Filedata']['name'];
$newfile = 'uploads/eventsgallery/'.date('Ymd').$rand.".".$ext;
$target_path = "../../../uploads/eventsgallery/".date('Ymd').$rand.".".$ext;
$filetype =  $_FILES['Filedata']['type'];
$filesize =  $_FILES['Filedata']['size'];


if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path)) {
    echo $success =  "The file ".  basename( $_FILES['Filedata']['name']). " has been uploaded";
}
else
{
    echo $error = "There was an error uploading the file, please try again!";
}

/* $chk = $mysqli->query("select * from website_image_eventsgallery where imageid = '$randno'");
$count = mysqli_num_rows($chk); */

$insertfile  = $mysqli->query("INSERT INTO `website_image_eventsgallery`
(`image_name`,
 `image_location`,
 `image_size`,
 `image_type`,
 `dateuploaded`,
 `imageid`)
VALUES (
    '$filename',
    '$newfile',
    '$filesize',
    '$filetype',
    '$today',
    '$randno')") or die ();
echo 1;
?>

