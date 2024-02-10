<?php
include('../../../../config.php');
$id=$_POST['i_index'];

$query = $mysqli->query("select * from document where id = '$id'");
$res = $query->fetch_assoc();
$document_id = $res['document_id'];

/*$getquery = $mysqli->query("select * from document_files where document_id = '$document_id'");
$resquery = $getquery->fetch_assoc();
$filename =  $resquery['document_location'];

$use = substr($filename,strpos($filename,"/")+1);
unlink("../../ms/uploads/".$use);*/

$mysqli->query("delete from document where
                     document_id = '$document_id'") or die(mysqli_error($mysqli));

$mysqli->query("delete from document_files where
                     document_id = '$document_id'") or die(mysqli_error($mysqli));

echo 1;
?>
