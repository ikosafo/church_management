<?php
include('../../../../config.php');

$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$denomination = mysqli_real_escape_string($mysqli, $_POST['denomination']);
$residence = mysqli_real_escape_string($mysqli, $_POST['residence']);
$hearing_about = mysqli_real_escape_string($mysqli, $_POST['hearing_about']);
$description = mysqli_real_escape_string($mysqli, $_POST['description']);
$branch = $_SESSION['branch'];
$period = date("Y-m-d H:i:s");

$ct = mysqli_num_rows($mysqli->query("select * from `visitor` where telephone = '$telephone'
                                            AND branch = '$branch'"));
if ($ct == "0") {
    $mysqli->query("INSERT INTO `visitor`
            (`full_name`,
             `telephone`,
             `residence`,
             `denomination`,
             `hearing_about`,
             `description`,
             `period`,
             `branch`)
VALUES ('$full_name',
        '$telephone',
        '$residence',
        '$denomination',
        '$hearing_about',
        '$description',
        '$period',
        '$branch')")
    or die(mysqli_error($mysqli));
    echo 1;
}
else {
    echo 2;
}


?>