<?php
include ('../../../config.php');
include ('../../../functions.php');

$firstdate = $_POST['firstdate'];
$seconddate = $_POST['seconddate'];

$getexpense = $mysqli->query("select * from expenses where `expdate` 
                            BETWEEN '$firstdate' AND '$seconddate'
                            ORDER BY expid DESC ");

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
            window.location.href="/expensestatistics"
        }
    </script>

    <div id="printthis">
        <div style="text-align:center" class="text-center printdetails">
            <p class="mb-25"><h3><?php echo getCompanyName(); ?></h3></p>
            <p class="mb-25"><?php echo getCompanyTagline(); ?></p>
            <p class="mb-25"><?php echo getCompanyAddress(); ?></p>
            <p class="mb-0">Tel: <?php echo getCompanyTelephone(); ?></p>
            <hr/>
            Expenses between <?php echo $firstdate; ?> and <?php echo $seconddate; ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-sm mt-2">
                <thead>
                    <tr>
                        <th width="10%">No.</th>
                        <th width="15%">Date</th>
                        <th width="15%">Amount</th>
                        <th width="15%">Payment Mode</th>
                        <th width="15%">Receipient</th>
                        <th width="15%">Approved By</th>
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
                            $getsum = $mysqli->query("select sum(amount) as totprice from expenses 
                            where `datetime` 
                            BETWEEN '$firstdate' AND '$seconddate'");
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
                                $getsum = $mysqli->query("select sum(amount) as totprice from expenses 
                                where `datetime` 
                                BETWEEN '$firstdate' AND '$seconddate'");
                                $ressum = $getsum->fetch_assoc();
                                $totalprice = $ressum['totprice'];
                                $format = number_format($totalprice,2);
                                echo "<b>GHS ".$format.'</b>';
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
        <form style="display:hidden" name="hiddenForm" id="hiddenForm" method="post" 
            action="exportexpenses.php">
            <input type="hidden" id="hiddenExportText" name="hiddenExportText">
        </form>
      
        <div class="row mt-1">
            <div class="col-sm-2">
                <button type="button" id="paybtn" onclick="printContent('printthis')" class="btn btn-block btn-primary">Print Details</button>
            </div>
            <div class="col-sm-3">
                <button type="button" id="paybtn" 
                onclick = "excel_export();"
                class="btn btn-block btn-secondary">Export to Excel</button>
            </div>
            <div class="col-sm-7"></div>
        </div>
         </div>
      </div>

      <script>
            function excel_export(){
                var content = document.getElementById('printthis').innerHTML;
                $('#hiddenExportText').val(content);
                document.getElementById("hiddenForm").submit();	
            }
      </script>



 