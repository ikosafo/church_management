<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="datepaid">Date Paid</label>
                <input type="text" class="form-control" id="datepaid"
                       placeholder="Select Date" value="<?php echo date('Y-m-d') ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" onkeypress="return isNumberKey(event)"
                       placeholder="Enter Amount" value="0.00">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="type">Type</label>
                <select id="type" style="width: 100%">
                    <option value="">Select</option>
                    <option value="To Bank">To Bank</option>
                    <option value="Expense">Expense</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="purpose">Purpose/Description</label>
                <textarea class="form-control" id="purpose"
                       placeholder="Enter Purpose"></textarea>
            </div>
        </div>


        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="savepayment">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->

<script>
    $('#datepaid').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $('#type').select2();

    $('#savepayment').click(function () {
        var datepaid = $('#datepaid').val();
        var amount = $('#amount').val();
        var type = $('#type').val();
        var purpose = $('#purpose').val();

        var error = '';
        if (datepaid == "") {
            error += 'Please select date paid \n';
            $("#datepaid").focus();
        }
        if (amount == "") {
            error += 'Please enter amount \n';
            $("#amount").focus();
        }
        if (type == "") {
            error += 'Please select type \n';
            $("#type").focus();
        }
        if (purpose == "") {
            error += 'Please enter purpose or description  \n';
            $("#purpose").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_payment.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    datepaid: datepaid,
                    amount: amount,
                    type: type,
                    purpose: purpose
                },
                success: function (text) {
                    //alert(text);
                    $("#success_loc").notify("Updated","success");
                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/payment_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#paymentform_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            KTApp.unblockPage();
                        },
                    });
                    $.ajax({
                        type: "POST",
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
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        }
        else {
            $("#error_loc").notify(error, {position: "top center"});
        }
        return false;
    });
</script>