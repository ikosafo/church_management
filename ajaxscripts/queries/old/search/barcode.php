<?php include ('../../../config.php'); 
include ('../../../functions.php'); 

$barcode = $_POST['barcode'];
$newsaleid = $_POST['newsaleid'];

$getdetails = $mysqli->query("select * from products where barcode = '$barcode'");
$resdetails = $getdetails->fetch_assoc();
$productid = $resdetails['prodid'];
$sellingprice = $resdetails['sellingpricewhole'];

 //Check whether barcode exists
if (mysqli_num_rows($getdetails) == '1') {

          
        //Check whether item is in tempsales table
        $chktemp = $mysqli->query("select * from `tempsales` where barcode = '$barcode' and genid = '$newsaleid'");
        if (mysqli_num_rows($chktemp) == '0') {
          
                  //Insert into temp sales
                  $insertsale = $mysqli->query("INSERT INTO `tempsales`
                  ( `barcode`,
                    `quantity`,
                    `price`,
                    `genid`,
                    `datetime`,
                    `prodid`)
                  VALUES (
                    '$barcode',
                    '1',
                    '$sellingprice',
                    '$newsaleid',
                    '$datetime',
                    '$productid')");
                  
                  echo 1;
        }
        else {
        echo 2;
        }


}
