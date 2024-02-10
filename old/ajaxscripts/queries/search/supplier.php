<?php
include('../../../config.php');
include('../../../functions.php');

$supplier = $_POST['supplier'];

$getproducts = $mysqli->query("select * from products where supplier = '$supplier' AND STATUS IS NULL ORDER BY productname");

?>

<section id="datatable">


    <div class="row">
        <div class="col-12">
            <div class="card" style="height:400px;overflow-y:scroll;">
                <table class="table table-hover table-sm mt-2" id="table-data">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th width="20%">Product Name</th>
                            <th width="20%">Quantity</th>
                            <th width="15%">Expiry Date</th>
                            <th width="20%">Pricing</th>
                            <th width="20%">Variation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($resproducts = $getproducts->fetch_assoc()) {

                        ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td>
                                    <?php echo getProductName($resproducts['prodid']); ?>
                                </td>
                                <td>
                                    Sale: <?php echo $resproducts['quantity']; ?><br />
                                    Threshold: <?php echo $resproducts['stockthreshold']; ?>
                                </td>
                                <td><?php echo $resproducts['expirydate'] ?></td>
                                <td>
                                    Supplier: <?php echo $resproducts['supplier']; ?> <br />
                                    Cost Price: <?php echo $resproducts['costprice']; ?> <br />
                                    Selling Price: <?php echo $resproducts['sellingprice']; ?> <br />
                                </td>
                                <td>
                                    Variations: <?php echo $resproducts['variations'] ?>
                                </td>

                            </tr>

                        <?php $count++;
                        } ?>


                    </tbody>
                </table>

            </div>
        </div>
    </div>

</section>