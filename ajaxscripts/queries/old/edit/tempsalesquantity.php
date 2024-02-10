<?php
include('../../../config.php');

$id_index = $_POST['id_index'];
$quantity = $_POST['quantity'];
$newsaleid = $_POST['newsaleid'];

$getproduct = $mysqli->query("select * from tempsales where genid = '$newsaleid' and tsid = '$id_index'");
$resproduct = $getproduct->fetch_assoc();
$prodid = $resproduct['prodid'];

$getprice = $mysqli->query("select * from products where prodid = '$prodid'");
$resprice = $getprice->fetch_assoc();
$price = $resprice['sellingprice'];
$quantitydb = $resprice['quantity'];

$newprice = $quantity * $price;

if ($quantity > $quantitydb) {
    echo 2;
} else {
    $updatequantity = $mysqli->query("update tempsales 
                                    set quantity = '$quantity',
                                    price = '$newprice'
                                    where (genid = '$newsaleid' and tsid = '$id_index')");

    echo 1;
}
