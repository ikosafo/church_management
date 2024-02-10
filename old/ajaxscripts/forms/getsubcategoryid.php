<?php
include('../../config.php');
$categoryname = $_POST['category'];
$getcategoryid = $mysqli->query("select * from categories where categoryname = '$categoryname'");
$rescategoryid = $getcategoryid->fetch_assoc();
$category = $rescategoryid['catid'];

$sql = "select * from `subcategories` where `parentid`= '$category' AND status IS NULL";
$res = $mysqli->query($sql);

if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->subcatid."'>".$row->subcategoryname."</option>";
    }
}
