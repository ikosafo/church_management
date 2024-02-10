<?php include('../../../../config.php');
$branch = $_POST['select_branch'];

$getyearmonth = $mysqli->query("SELECT DATE_FORMAT(datepaid, '%Y-%m') as datequery
FROM acc_payments where branch = '$branch'
GROUP BY
DATE_FORMAT(datepaid, '%Y-%m') ORDER BY DATE_FORMAT(datepaid, '%Y-%m') DESC")
?>
<style>
    .dataTables_filter {
        display: none;
    }

    .scrollbar-auto {
        scrollbar-width: thin;
        height: 550px;
        overflow-y: scroll;
    }
</style>


<div class="kt-section">
    <h5 class="kt-portlet__head-title">
        ACCOUNT DETAILS
    </h5>

    <div class="kt-section__content responsive scrollbar-auto">
        <div class="table-responsive">
            <table class="table" style="width: 100% !important;">
                <tbody>
                <?php
                while ($fetch = $getyearmonth->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php $dateyear = $fetch['datequery'];
                            echo '<span style="text-decoration:underline;text-transform: uppercase;
                               font-weight: 600;font-size: 15px">'.date('Y - F',strtotime($dateyear)).'</span>';
                            $getdetails = $mysqli->query("select * from acc_payments where
                                                         branch = '$branch' AND SUBSTRING(datepaid, 1, 7) = '$dateyear'
                                                         order by datepaid DESC");?>

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($resdetails = $getdetails->fetch_assoc()){ ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $branchid = $resdetails['branch'];
                                            $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                                            $resbranch = $getbranch->fetch_assoc();
                                            echo $resbranch['name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php $daterec = $resdetails['datepaid'];
                                            echo $new_date = date('jS(D)', strtotime($daterec));
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $resdetails['paymenttype'] ?>
                                        </td>
                                        <td>
                                            <?php echo $resdetails['purpose']; ?>
                                        </td>
                                        <td>
                                            <?php $amount = $resdetails['amount'];
                                            echo number_format($amount,2)
                                            ?>
                                        </td>

                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td COLSPAN="4" style="font-weight: 500">
                                        TOTAL
                                    </td>
                                    <td style="font-weight: 500">
                                        <?php
                                        $getamount = $mysqli->query("select sum(amount) as sumamount from acc_payments where
                                                         branch = '$branch' AND SUBSTRING(datepaid, 1, 7) = '$dateyear'");
                                        $resamount = $getamount->fetch_assoc();
                                        $totalamt = $resamount['sumamount'];
                                        echo number_format($totalamt,2);
                                        ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <?php ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
