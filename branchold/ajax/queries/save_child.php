<?php
include('../../../../config.php');

$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$child_name = mysqli_real_escape_string($mysqli, $_POST['child_name']);

$mysqli->query("INSERT INTO `children`
            (`memberid`,
             `childname`)
VALUES ('$memberid',
        '$child_name')") or die(mysqli_error($mysqli));

echo 1;

?>