<?php
include('../../../../config.php');

$visid = mysqli_real_escape_string($mysqli, $_POST['i_index']);
$branch = $_SESSION['branch'];

$mysqli->query("DELETE FROM `visitor`
WHERE `id` = '$visid'") or die(mysqli_error($mysqli));
echo 1;
