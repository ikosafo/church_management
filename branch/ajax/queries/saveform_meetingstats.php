<?php
include('../../../../config.php');

$serviceid = mysqli_real_escape_string($mysqli, $_POST['serviceid']);
$men = mysqli_real_escape_string($mysqli, $_POST['men']);
$women = mysqli_real_escape_string($mysqli, $_POST['women']);
$ladies = mysqli_real_escape_string($mysqli, $_POST['ladies']);
$guys = mysqli_real_escape_string($mysqli, $_POST['guys']);
$children = mysqli_real_escape_string($mysqli, $_POST['children']);
$offering = mysqli_real_escape_string($mysqli, $_POST['offering']);
$total = $men + $women + $ladies + $guys + $children;
$rand = date('hisdmy');
$branch = $_SESSION['branch'];
$dateperiod = date('Y-m-d H:i:s');

$getservice = $mysqli->query("select * from meeting_config where id = '$serviceid'");
$resservice = $getservice->fetch_assoc();
$service = $resservice['title'];
$datestarted = $resservice['datefrom'];
$dateended = $resservice['dateto'];


$mysqli->query("INSERT INTO `meeting`
            (`meetingname`,
             `men`,
             `women`,
             `ladies`,
             `guys`,
             `children`,
             `total`,
             `offering`,
             `branch`,
             `period`,
             `periodstarted`,
             `periodclosed`)
VALUES ('$service',
        '$men',
        '$women',
        '$ladies',
        '$guys',
        '$children',
        '$total',
        '$offering',
        '$branch',
        '$dateperiod',
        '$datestarted',
        '$dateended'
        )") or die(mysqli_error($mysqli));
echo 1;

