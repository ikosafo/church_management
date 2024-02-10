<?php
include('../../config.php');

$memberid = $_POST['id_index'];
$branch = $_POST['branch'];
$paymenttype = 'Tithe';
//$user_id = $_SESSION['user_id'];

$app = $mysqli->query("select * from `member` where memberid = '$memberid'");
$result = $app->fetch_assoc();
?>

<script>
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>


<section class="page-content container-fluid">
    <div class="form-group row">
        <div class="col-md-5">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Payment of Tithe for <?php echo $result['surname'] . ' ' .$result['firstname'] . ' ' .$result['othername'] ?>
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="paymentfor">Payment For</label>
                            <input type="text" class="form-control" id="paymentfor"
                                   placeholder="Select Tithe Payment For">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount"
                                   placeholder="Enter amount" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label for="payment_mode">Select Payment Mode</label>
                            <div class="kt-form__control">
                                <select class="form-control bootstrap-select" id="payment_mode">
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Mobile Money">Mobile Money</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="datepaid">Date Paid</label>
                            <input type="text" class="form-control" id="datepaid"
                                   placeholder="Select Date Paid" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="button" class="btn btn-primary" id="savepaymentbtn">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <div class="col-md-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Summary Data
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->

                <div id="paymenttable_div"></div>
                <!--end::Form-->
            </div>
        </div>

    </div>
</section>

<!-- SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END SIDEBAR QUICK PANNEL WRAPPER -->

<!-- END CONTENT WRAPPER -->
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->

<script>

    $.ajax({
        type:"post",
        url: "ajax/tables/mempayment_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        data:{
            memberid:'<?php echo $memberid ?>',
            paymenttype:'<?php echo $paymenttype ?>',
            branch:'<?php echo $branch ?>'
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

    $('#datepaid').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $('#paymentfor').datepicker({
        format: 'yyyy-mm',
        autoclose: true,
        orientation: "bottom",
        startView: "months",
        minViewMode: "months"
    });

    $("#payment_mode").selectpicker();

    $("#savepaymentbtn").click(function () {
        var paymentfor = $("#paymentfor").val();
        var amount = $("#amount").val();
        var datepaid = $("#datepaid").val();
        var payment_mode = $("#payment_mode").val();

        var error = '';
        if (paymentfor == "") {
            error += 'Please select payment for \n';
            $("#paymentfor").focus();
        }
        if (amount == "") {
            error += 'Please enter amount \n';
            $("#amount").focus();
        }
        if (datepaid == "") {
            error += 'Please select date paid \n';
            $("#datepaid").focus();
        }
        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/paytithe.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    memberid: '<?php echo $memberid ?>',
                    branch: '<?php echo $branch ?>',
                    amount:amount,
                    paymentfor:paymentfor,
                    payment_mode:payment_mode,
                    datepaid:datepaid
                },
                success: function (text) {
                    //alert(text);
                    $.notify("Payment Made", "success", {position: "top center"});
                    $("#mem-table").DataTable().ajax.reload(null, false );
                    $.ajax({
                        type:"post",
                        url: "ajax/tables/mempayment_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        data:{
                            memberid:'<?php echo $memberid ?>',
                            paymenttype:'<?php echo $paymenttype ?>',
                            branch:'<?php echo $branch ?>'
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
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;
    });
</script>