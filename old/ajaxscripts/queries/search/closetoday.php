<?php
include ('../../../config.php');
include ('../../../functions.php');

$datetoday = date("Y-m-d");
$getsales = $mysqli->query("select * FROM `sales` WHERE `datetime` LIKE '$datetoday%' ORDER BY salesid DESC");
$getexpense = $mysqli->query("select * FROM `expenses` WHERE `datetime` LIKE '$datetoday%' ORDER BY expid DESC ");

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
            window.location.href="/login"
        }
</script>


    <div id="printthis">
        <div style="text-align:center" class="text-center printdetails">
            <p class="mb-25"><h3><?php echo getCompanyName(); ?></h3></p>
            <p class="mb-25"><?php echo getCompanyTagline(); ?></p>
            <p class="mb-25"><?php echo getCompanyAddress(); ?></p>
            <p class="mb-0">Tel: <?php echo getCompanyTelephone(); ?></p>
            <hr/>
            Sales Details for <?php echo $datetoday; ?> 
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-sm mt-2">
                <thead>
                    <tr>
                    <th width="5%">No.</th>
                    <th width="35%">Details</th>
                    <th width="10%">Total<br/> Price</th>
                    <th width="10%">Amount<br/> Paid</th>
                    <th width="10%">Change<br/> Given</th>
                    <th width="10%">Payment<br/> Method</th>
                    <th width="10%">Transaction <br/> Period</th>
                    <th width="10%">Transaction <br/> User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $count = 1;
                    while ($ressales = $getsales->fetch_assoc()) {
                    
                        ?>
                        <tr>
                            <td>
                                <?php echo $count; ?>
                            </td>
                            <td>
                                <?php
                                $newsaleid = $ressales['newsaleid'];
                                $gettemp = $mysqli->query("select * from `tempsales` where genid = '$newsaleid'");
                                ?>

                                <table class="table table-borderless">
                                <?php while ($restemp = $gettemp->fetch_assoc()) { ?>
                                        <tr>
                                            <td width="30%">
                                                <?php
                                                $prodid = $restemp['prodid'];
                                                echo getProductName($prodid); ?>
                                            </td>
                                            <td width="10%">
                                                <?php echo $quantity =  $restemp['quantity']; ?>
                                            </td>
                                            <td width="30%">
                                                CQ: <?php echo getCurrentQuantity($prodid); ?>
                                            </td>
                                            <td width="30%">
                                                <?php echo "GHS ".$restemp['price'] ?>
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
                            <td colspan="2"></td><td><b> 
                                <?php
                            //get the total
                            $getsum = $mysqli->query("select sum(totalprice) as totprice from `sales` 
                            WHERE `datetime` LIKE '$datetoday%'");
                            $ressum = $getsum->fetch_assoc();
                            $totalprice = $ressum['totprice'];
                            $format = number_format($totalprice,2);
                            echo "<b>GHS ".$format.'</b>';
                            ?></b></td>
                            <td>
                                <?php
                                    //get the total
                                    $getsum = $mysqli->query("select sum(`amountpaid`) as totprice from `sales` 
                                    WHERE `datetime` LIKE '$datetoday%'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice,2);
                                    echo "<b>GHS ".$format.'</b>';
                                    ?>
                            </td>
                            <td>
                                <?php
                                    //get the total
                                    $getsum = $mysqli->query("select sum(`change`) as totprice from `sales` 
                                    WHERE `datetime` LIKE '$datetoday%'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice,2);
                                    echo "<b>GHS ".$format.'</b>';
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
                                $getsum = $mysqli->query("select sum(totalprice) as totprice from `sales` 
                                WHERE `datetime` LIKE '$datetoday%'");
                                $ressum = $getsum->fetch_assoc();
                                $totalprice = $ressum['totprice'];
                                $formattolprice = number_format($totalprice,2);
                                echo "<b>GHS ".$formattolprice.'</b>';
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
                                    $getsum = $mysqli->query("select sum(amountpaid) as totprice from `sales` 
                                    WHERE `datetime` LIKE '$datetoday%'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice,2);
                                    echo "<b>GHS ".$format.'</b>';
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
                                    $getsum = $mysqli->query("select sum(`change`) as totprice from `sales` 
                                    WHERE `datetime` LIKE '$datetoday%'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $format = number_format($totalprice,2);
                                    echo "<b>GHS ".$format.'</b>';
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

        <hr/>
            Expense Details for <?php echo $datetoday; ?> 
        <div class="table-responsive">
            <table class="table table-hover table-sm mt-2">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Date</th>
                        <th width="10%">Amount</th>
                        <th width="15%">Payment Mode</th>
                        <th width="15%">Receipient</th>
                        <th width="15%">Approved By</th>
                        <th width="15%">Reason</th>
                        <th width="15%">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $count = 1;
                    while ($resexpense = $getexpense->fetch_assoc()) {
                    
                        ?>
                        <tr>
                            <td>
                                <?php echo $count; ?>
                            </td>
                            <td><?php echo $resexpense['expdate']; ?></td>
                            <td><?php echo $resexpense['amount']; ?></td>
                            <td><?php echo $resexpense['paymentmode']; ?></td>
                            <td><?php echo $resexpense['receipient']; ?></td>
                            <td><?php echo $resexpense['approvedby']; ?></td>
                            <td><?php echo $resexpense['reason']; ?></td>
                            <td><?php echo $resexpense['description']; ?></td>      
                        </tr>
                    <?php 
                    $count++;
                    } 
                        ?>
                        <tr>
                            <td colspan="2"></td><td><b> 
                                <?php
                            //get the total
                            $getsum = $mysqli->query("select sum(amount) as totprice from `expenses` 
                            WHERE `datetime` LIKE '$datetoday%'");
                            $ressum = $getsum->fetch_assoc();
                            $totalprice = $ressum['totprice'];
                            $format = number_format($totalprice,2);
                            echo "<b>GHS ".$format.'</b>';
                            ?></b></td>
                           
                            <td colspan="4"></td>
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
                                    $getsum = $mysqli->query("select sum(amount) as totprice from `expenses` 
                                    WHERE `datetime` LIKE '$datetoday%'");
                                    $ressum = $getsum->fetch_assoc();
                                    $totalprice = $ressum['totprice'];
                                    $formatexpense = number_format($totalprice,2);
                                    echo "<b>GHS ".$formatexpense.'</b>';
                                    ?>
                                    </h2>
                                    <p class="card-text font-small-3 mb-0">Total Amount</p>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

    </div>
      
    <div class="row mt-1">
         <form style="display:hidden" name="hiddenForm" id="hiddenForm" method="post" 
            action="exportcloseday.php">
            <input type="hidden" id="hiddenExportText" name="hiddenExportText">
        </form>
        <div class="col-sm-4">
            <button type="button" id="closebtn" onclick="printContent('printthis')" 
            class="btn btn-block btn-primary">Print Details and Close for day</button>
        </div>
        
        <div class="col-sm-4">
            <button type="button" id="exportbtn" 
            onclick = "excel_export();"
            class="btn btn-block btn-secondary">Export to Excel</button>
        </div>
        <div class="col-sm-4"></div>
    </div>
       

    <script>
        function excel_export(){
            var content = document.getElementById('printthis').innerHTML;
            $('#hiddenExportText').val(content);
            document.getElementById("hiddenForm").submit();	
        }

            // Add action on form submit
             $("#closebtn").click(function(){
    
            var totalprice = '<?php echo $formattolprice; ?>';
            var totalexpense = '<?php echo $formatexpense; ?>';

 
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/closing.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    totalprice: totalprice,
                    totalexpense: totalexpense,
                    username: '<?php echo $_SESSION["username"]; ?>'
                },
                success: function (text) {
                    //alert(text);
                   window.location.href= "/login";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
    });

</script>





 