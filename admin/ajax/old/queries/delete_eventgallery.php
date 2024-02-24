<?php
include('../../../../config.php');
$id=$_POST['i_index'];

$query = $mysqli->query("select * from website_image_eventsgallery where id = '$id'");
$res = $query->fetch_assoc();
$filename =  $res['image_location'];
$imageid = $res['imageid'];

$getmainevent = $mysqli->query("select * from website_eventsgallery where eventid = '$imageid'");
$getcount = mysqli_num_rows($getmainevent);
if ($getcount == '1') {
    $mysqli->query("delete from website_eventsgallery where eventid = '$imageid'") or die(mysqli_error($mysqli)); 
}

$use = substr($filename,strpos($filename,"/")+1);
unlink("../../../uploads/".$use);

$mysqli->query("delete from website_image_eventsgallery where id = '$id'") or die(mysqli_error($mysqli));
$mysqli->query("delete from website_eventsgallery where id = '$id'") or die(mysqli_error($mysqli));

echo 1;