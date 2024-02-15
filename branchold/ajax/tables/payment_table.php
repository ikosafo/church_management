<?php include('../../../../config.php');
$branch = $_SESSION['branch'];

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
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($resdetails = $getdetails->fetch_assoc()){ ?>
                                    <tr>
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

                                        <td>
                                            <button type="button"
                                                    data-type="confirm"
                                                    class="btn btn-sm btn-danger js-sweetalert delete_payment"
                                                    i_index="<?php echo $resdetails['pid'] ?>" title="Delete">
                                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                <tr>
                                    <td style="font-weight: 500">
                                        TOTAL
                                    </td>
                                    <td></td>
                                    <td></td>
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

<script>

    $(document).off('click', '.delete_payment').on('click', '.delete_payment', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Payment!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_payment.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/payment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        KTApp.unblockPage();
                                    },
                                });
                            },

                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });

</script>