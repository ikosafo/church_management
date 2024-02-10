<?php
include('../../config.php');
$category = $_POST['category'];

$sql = "select * from `subcategories` where `parentid`= '$category' AND status IS NULL";
$res = $mysqli->query($sql);

if(mysqli_num_rows($res) > 0) {
    echo "<option value=''></option>";
    while($row = mysqli_fetch_object($res)) {
        echo "<option value='".$row->subcatid."'>".$row->subcategoryname."</option>";
    }
}
