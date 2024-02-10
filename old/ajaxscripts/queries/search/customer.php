<?php
include('../../../config.php');
include('../../../functions.php');

$firstdate = $_POST['firstdate'];
$seconddate = $_POST['seconddate'];
$customer = $_POST['customer'];

$getsales = $mysqli->query("select * from sales where `datetime`
                            BETWEEN '$firstdate' AND '$seconddate'
                            AND customer = '$customer'
                            ORDER BY salesid DESC");

?>

<style>
    .printdetails {
        display: none;
    }

    @media print {
        .printdetails {
            display: block;
        }
    }
</style>

<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        window.location.href = "/customerstatistics"
    }
</script>

<div id="printthis">
    <div style="text-align:center" class="text-center printdetails">
        <p class="mb-25">
        <h3><?php echo getCompanyName(); ?></h3>
        </p>
        <p class="mb-25"><?php echo getCompanyTagline(); ?></p>
        <p class="mb-25"><?php echo getCompanyAddress(); ?></p>
        <p class="mb-0">Tel: <?php echo getCompanyTelephone(); ?></p>
        <hr />
        Sales Details between <?php echo $firstdate; ?> and <?php echo $seconddate; ?>
        for <?php echo getCustomerName($customer); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm mt-2">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="35%">Details</th>
                    <th width="10%">Total<br /> Price</th>
                    <th width="10%">Amount<br /> Paid</th>
                    <th width="10%">Change<br /> Given</th>
                    <th width="10%">Payment<br /> Method</th>
                    <th width="10%">Transaction <br /> Period</th>
                    <th width="10%">Transaction <br /> User</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;
                while ($ressales = $getsales->fetch_assoc()) {

                ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php
                            $newsaleid = $ressales['newsaleid'];
                            $gettemp = $mysqli->query("select * from tempsales where genid = '$newsaleid'");
                            ?>

                            <table class="table table-borderless">
                                <?php while ($restemp = $gettemp->fetch_assoc()) { ?>
                                    <tr>
                                        <td width="40%">
                                            <?php
                                            $prodid = $restemp['prodid'];
                                            echo getProductName($prodid); ?>
                                        </td>
                                        <td width="20%">
                                            <?php echo $quantity =  $restemp['quantity']; ?>
                                        </td>
                                        <td width="40%">
                                            <?php echo "GHS " . $restemp['price'] ?>
                                        </td>

                                    </tr>
                                <?php }
                                ?>
                            </table>

                        </td>
                        <td><?php echo $ressales['totalprice']; ?></td>
                        <td><?php echo $ressales['amountpaid']; ?></td>
                        <td><?php echo $ressales['change']; ?></td>
                        <td><?php echo $ressales['paymentmethod']; ?></td>
                        <td><?php echo $ressales['datetime']; ?></td>
                        <td><?php echo getLogname($ressales['username']); ?></td>

                    </tr>
                <?php
                    $count++;
                }
                ?>
                <tr>
                    <td colspan="2"></td>
                    <td><b>
                            <?php
                            //get the total
                            $getsum = $mysqli->query("select sum(totalprice) as totprice from sales 
                            where `datetime` 
                            BETWEEN '$firstdate' AND '$seconddate' 
                            AND customer = '$customer'");
                            $ressum = $getsum->fetch_assoc();
                            $totalprice = $ressum['totprice'];
                            $format = number_format($totalprice, 2);
                            echo "<b>GHS " . $format . '</b>';
                            ?></b></td>
                    <td>
                        <?php
                        //get the total
                        $getsum = $mysqli->query("select sum(`amountpaid`) as totprice from sales 
                                    where `datetime` 
                                    BETWEEN '$firstdate' AND '$seconddate'
                                    AND customer = '$customer'");
                        $ressum = $getsum->fetch_assoc();
                        $totalprice = $ressum['totprice'];
                        $format = number_format($totalprice, 2);
                        echo "<b>GHS " . $format . '</b>';
                        ?>
                    </td>
                    <td>
                        <?php
                        //get the total
                        $getsum = $mysqli->query("select sum(`change`) as totprice from sales 
                                    where `datetime` 
                                    BETWEEN '$firstdate' AND '$seconddate'
                                    AND customer = '$customer'");
                        $ressum = $getsum->fetch_assoc();
                        $totalprice = $ressum['totprice'];
                        $format = number_format($totalprice, 2);
                        echo "<b>GHS " . $format . '</b>';
                        ?>
                    </td>
                    <td colspan="3"></td>
                </tr>

            </tbody>
        </table>
    </div>


    <div class="col-lg-12 col-12">
        <div class="card card-statistics">

            <div class="card-body statistics-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-12 mb-2 mb-md-0">
                        <div class="d-flex flex-row">
                            <div class="my-auto">
                                <h2 class="fw-bolder mb-0">
                                    <?php
                                    //get the total
                                    $getsum = $mysqli->query("select sum(totalprice) as totprice from sales 
                                where `datetime` 
                                BETWEEN '$firstdate' AND '$seconddate'
                                AND customer = '$customer'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice, 2);
                                    echo "<b>GHS " . $format . '</b>';
                                    ?>
                                </h2>
                                <p class="card-text font-small-3 mb-0">Total Price</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-12 mb-2 mb-md-0">
                        <div class="d-flex flex-row">
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">
                                    <?php
                                    //get the total
                                    $getsum = $mysqli->query("select sum(amountpaid) as totprice from sales 
                                    where `datetime` 
                                    BETWEEN '$firstdate' AND '$seconddate'
                                    AND customer = '$customer'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice, 2);
                                    echo "<b>GHS " . $format . '</b>';
                                    ?>
                                </h4>
                                <p class="card-text font-small-3 mb-0">Total Amount Paid</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-12 mb-2 mb-md-0">
                        <div class="d-flex flex-row">
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">
                                    <?php
                                    //get the total
                                    $getsum = $mysqli->query("select sum(`change`) as totprice from sales 
                                    where `datetime` 
                                    BETWEEN '$firstdate' AND '$seconddate'
                                    AND customer = '$customer'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice, 2);
                                    echo "<b>GHS " . $format . '</b>';
                                    ?>
                                </h4>
                                <p class="card-text font-small-3 mb-0">Total Change Given</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<div class="row mt-1">
    <div class="col-sm-2">
        <button type="button" id="paybtn" onclick="printContent('printthis')" class="btn btn-block btn-primary">Print Details</button>
    </div>
    <div class="col-sm-3">
        <button type="button" id="paybtn" class="btn btn-block btn-secondary">Export to Excel</button>
    </div>
    <div class="col-sm-7"></div>
</div>
</div>
</div>


<!-- <script>
    $("#customer").select2({
        placeholder: "Select Customer",
        allowClear: true
    });
</script> -->