<?php
include('../../../../config.php');

$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$docid = mysqli_real_escape_string($mysqli, $_POST['docid']);
$branch = $_SESSION['branch'];
$today = date('Y-m-d H:i:s');

$mysqli->query("INSERT INTO `document`
            (
             `document_title`,
             `document_description`,
             `document_id`,
             `period_uploaded`,
             `branch`)
VALUES (
        '$title',
        '$description',
        '$docid',
        '$today',
        '$branch')") or die(mysqli_error($mysqli));
echo 1;

