<?php include('../../../config.php');
include('../../../functions.php');

$productid = $_POST['productid'];
$newsaleid = $_POST['newsaleid'];

$getdetails = $mysqli->query("select * from products where prodid = '$productid'");
$resdetails = $getdetails->fetch_assoc();
$sellingprice = $resdetails['sellingprice'];
$quantitydb = $resdetails['quantity'];


//Check whether item is there
$chktemp = $mysqli->query("select * from `tempsales` where prodid = '$productid' and genid = '$newsaleid'");
if (mysqli_num_rows($chktemp) == '0') {

  //Insert into temp sales
  $insertsale = $mysqli->query("INSERT INTO `tempsales`
          ( `quantity`,
            `quantitydb`,
            `price`,
            `genid`,
            `datetime`,
            `prodid`)
          VALUES (
            '1',
          '$quantitydb',
          '$sellingprice',
          '$newsaleid',
          '$datetime',
          '$productid')");

  echo 1;
} else {
  echo 2;
}
