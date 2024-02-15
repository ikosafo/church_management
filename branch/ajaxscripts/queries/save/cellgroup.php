<?php
include('../../../../config.php');

$cellname = mysqli_real_escape_string($mysqli, $_POST['cellgroupname']);
$branch = $_SESSION['branch'];
$getcount = $mysqli->query("select * from cell where `cell_name` = '$cellname' and branch = '$branch'");
$count = mysqli_num_rows($getcount);

if ($count == "0") {
    $mysqli->query("INSERT INTO `cell`
            (`cell_name`,
             `branch`)
VALUES ('$cellname',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
} else {
    echo 2;
}
