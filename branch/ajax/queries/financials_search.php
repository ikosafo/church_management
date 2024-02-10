<?php include('../../../../config.php');

$branch = $_SESSION['branch'];
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$fin_type = $_POST['fin_type'];


?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<hr/>

<div class="kt-section">

    <div class="kt-section__content responsive">

        <div class="row">
            <div class="col-md-4">
                START PERIOD:
                <small><?php echo $datefrom ?></small>
            </div>
            <div class="col-md-4">
                END PERIOD:
                <small><?php echo $dateto ?></small>
            </div>
            <div class="col-md-4">
                TYPE:
                <small><?php echo $fin_type?></small>
            </div>
        </div>


            <?php
        if ($fin_type == "Special Offerings/Seeds") {
            $gettable = $mysqli->query("select * from f_offerings where branch = '$branch' and date_paid BETWEEN '$datefrom'
                                   AND '$dateto' ORDER by id DESC");
            ?>
            <div class="table-responsive">
                <div class="kt-portlet__body">
                    <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Date Paid</th>
                            <th>Entry Period</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($restable = $gettable->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $restable['amount']; ?></td>
                                <td><?php echo $restable['purpose']; ?></td>
                                <td><?php echo $restable['date_paid']; ?></td>
                                <td><?php echo $restable['period']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                            <tr>
                                <td>
                                    <span style="font-weight: 600;font-size: large">
                                        <?php
                                        $gettotal = $mysqli->query("select sum(amount) as sumoffering from f_offerings where branch = '$branch' and date_paid
                                        BETWEEN '$datefrom' AND '$dateto' ORDER by id DESC");
                                        $restotal = $gettotal->fetch_assoc();
                                        echo number_format($restotal['sumoffering'],2);
                                        ?>
                                    </span>
                                </td>
                                <td colspan="3">
                                    TOTAL
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                    </table>
                </div>
            </div>
        <?php }

        else  if ($fin_type == "Tithe") {
            $gettable = $mysqli->query("select * from f_tithe where branch = '$branch' and date_paid BETWEEN '$datefrom'
                                   AND '$dateto' ORDER by id DESC");
            ?>
            <div class="table-responsive">
                <div class="kt-portlet__body">
                    <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Payment For</th>
                            <th>Payment Mode</th>
                            <th>Date Paid</th>
                            <th>Entry Period</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($restable = $gettable->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $restable['amount']; ?></td>
                                <td><?php echo $restable['year_month']; ?></td>
                                <td><?php echo $restable['payment_mode']; ?></td>
                                <td><?php echo $restable['date_paid']; ?></td>
                                <td><?php echo $restable['period']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                            <tr>
                                <td>
                                        <span style="font-weight: 600;font-size: large">
                                            <?php
                                            $gettotal = $mysqli->query("select sum(amount) as sumtithe from f_tithe where branch = '$branch' and date_paid
                                            BETWEEN '$datefrom' AND '$dateto' ORDER by id DESC");
                                            $restotal = $gettotal->fetch_assoc();
                                            echo number_format($restotal['sumtithe'],2);
                                            ?>
                                        </span>
                                </td>
                                <td colspan="3">
                                    TOTAL
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                    </table>
                </div>
            </div>
        <?php }

        else  if ($fin_type == "Welfare") {
            $gettable = $mysqli->query("select * from f_welfare where branch = '$branch' and date_paid BETWEEN '$datefrom'
                                   AND '$dateto' ORDER by id DESC");
            ?>
            <div class="table-responsive">
                <div class="kt-portlet__body">
                    <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Payment For</th>
                            <th>Date Paid</th>
                            <th>Entry Period</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($restable = $gettable->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $restable['amount']; ?></td>
                                <td><?php echo $restable['year_month']; ?></td>
                                <td><?php echo $restable['date_paid']; ?></td>
                                <td><?php echo $restable['period']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>
                                        <span style="font-weight: 600;font-size: large">
                                            <?php
                                            $gettotal = $mysqli->query("select sum(amount) as sumwelfare from f_welfare where
                                                        branch = '$branch' and date_paid
                                            BETWEEN '$datefrom' AND '$dateto' ORDER by id DESC");
                                            $restotal = $gettotal->fetch_assoc();
                                            echo number_format($restotal['sumwelfare'],2);
                                            ?>
                                        </span>
                            </td>
                            <td colspan="3">
                                TOTAL
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                    </table>
                </div>
            </div>
        <?php }

        else  if ($fin_type == "First Fruit") {
            $gettable = $mysqli->query("select * from f_firstfruit where branch = '$branch' and date_paid BETWEEN '$datefrom'
                                   AND '$dateto' ORDER by id DESC");
            ?>
            <div class="table-responsive">
                <div class="kt-portlet__body">
                    <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Payment For</th>
                            <th>Date Paid</th>
                            <th>Entry Period</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($restable = $gettable->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $restable['amount']; ?></td>
                                <td><?php echo $restable['year']; ?></td>
                                <td><?php echo $restable['date_paid']; ?></td>
                                <td><?php echo $restable['period']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>
                                        <span style="font-weight: 600;font-size: large">
                                            <?php
                                            $gettotal = $mysqli->query("select sum(amount) as sumfistfruit from f_firstfruit where
                                                        branch = '$branch' and date_paid
                                            BETWEEN '$datefrom' AND '$dateto' ORDER by id DESC");
                                            $restotal = $gettotal->fetch_assoc();
                                            echo number_format($restotal['sumfistfruit'],2);
                                            ?>
                                        </span>
                            </td>
                            <td colspan="3">
                                TOTAL
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                    </table>
                </div>
            </div>
        <?php }

        else  if ($fin_type == "Contributions") {
            $gettable = $mysqli->query("select * from f_contributions where branch = '$branch' and date_paid BETWEEN '$datefrom'
                                   AND '$dateto' ORDER by id DESC");
            ?>
            <div class="table-responsive">
                <div class="kt-portlet__body">
                    <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Date Paid</th>
                            <th>Entry Period</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($restable = $gettable->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $restable['amount']; ?></td>
                                <td><?php echo $restable['purpose']; ?></td>
                                <td><?php echo $restable['date_paid']; ?></td>
                                <td><?php echo $restable['period']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                            <tr>
                                <td>
                                            <span style="font-weight: 600;font-size: large">
                                                <?php
                                                $gettotal = $mysqli->query("select sum(amount) as sumcontribution from f_contributions where
                                                            branch = '$branch' and date_paid
                                                BETWEEN '$datefrom' AND '$dateto' ORDER by id DESC");
                                                $restotal = $gettotal->fetch_assoc();
                                                echo number_format($restotal['sumcontribution'],2);
                                                ?>
                                            </span>
                                </td>
                                <td colspan="3">
                                    TOTAL
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                    </table>
                </div>
            </div>
        <?php }

        else  if ($fin_type == "Ministry Partners") {
            $gettable = $mysqli->query("select * from f_mpcontributions where branch = '$branch' and date_paid BETWEEN '$datefrom'
                                   AND '$dateto' ORDER by id DESC");
            ?>
            <div class="table-responsive">
                <div class="kt-portlet__body">
                    <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Date Paid</th>
                            <th>Entry Period</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($restable = $gettable->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $restable['amount']; ?></td>
                                <td><?php echo $restable['purpose']; ?></td>
                                <td><?php echo $restable['date_paid']; ?></td>
                                <td><?php echo $restable['period']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                            <tr>
                                <td>
                                                <span style="font-weight: 600;font-size: large">
                                                    <?php
                                                    $gettotal = $mysqli->query("select sum(amount) as sumcontribution from f_mpcontributions where
                                                                branch = '$branch' and date_paid
                                                    BETWEEN '$datefrom' AND '$dateto' ORDER by id DESC");
                                                    $restotal = $gettotal->fetch_assoc();
                                                    echo number_format($restotal['sumcontribution'],2);
                                                    ?>
                                                </span>
                                </td>
                                <td colspan="3">
                                    TOTAL
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                    </table>
                </div>
            </div>
        <?php }
        ?>

    </div>
</div>



<script>
    oTable = $('#data-table').DataTable({
        "bLengthChange": false,"order": []
    });

    $('#data_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

</script>