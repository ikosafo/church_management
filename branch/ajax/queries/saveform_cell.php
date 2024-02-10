<?php
include('../../../../config.php');

$cell_name = mysqli_real_escape_string($mysqli, $_POST['cell_name']);
$branch = $_SESSION['branch'];
$getcount = $mysqli->query("select * from cell where `cell_name` = '$cell_name' and branch = '$branch'");
$count = mysqli_num_rows($getcount);

if ($count == "0"){
    $mysqli->query("INSERT INTO `cell`
            (`cell_name`,
             `branch`)
VALUES ('$cell_name',
        '$branch')") or die(mysqli_error($mysqli));
    echo 1;
}

else {
    echo 2;
}



