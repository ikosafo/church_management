<?php include('../../../config.php');
$random = rand(1, 10000) . date("Ymd");
?>
<!--begin::Form-->

<style>
    html,
    body {
        overflow-x: hidden;
    }
</style>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>

<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="mb-1 col-lg-6 col-md-6">
                <label class="form-label" for="datereceived">Date Received</label>
                <input type="text" class="form-control" id="datereceived" placeholder="Select Date" value="<?php echo date('Y-m-d') ?>" autocomplete="off">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" onkeypress="return isNumberKey(event)" placeholder="Enter Amount" value="0.00">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="type">Type</label>
                <select id="type" style="width: 100%">
                    <option></option>
                    <option value="To Bank">To Bank</option>
                    <option value="Expense">Expense</option>
                </select>
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="purpose">Purpose/Description</label>
                <textarea class="form-control" id="purpose" placeholder="Enter Purpose"></textarea>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-6">
            <button type="button" id="savepayment" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>


</form>
<!--end::Form-->


<script>
    $('#datereceived').flatpickr();

    $("#type").select2({
        placeholder: "Select Type",
        allowClear: true
    });

    $('#savepayment').click(function() {
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
                url: "ajaxscripts/queries/save/payment.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    datepaid: datepaid,
                    amount: amount,
                    type: type,
                    purpose: purpose
                },
                success: function(text) {
                    //alert(text);
                    $("#success_loc").notify("Updated", "success");

                    $.ajax({
                        url: "ajaxscripts/forms/accountpayment.php",
                        beforeSend: function() {
                            $.blockUI({
                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                            });
                        },
                        success: function(text) {
                            $('#pageform_div').html(text);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function() {
                            $.unblockUI();
                        },

                    });

                    $.ajax({
                        url: "ajaxscripts/tables/accountpayment.php",
                        beforeSend: function() {
                            $.blockUI({
                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                            });
                        },
                        success: function(text) {
                            $('#pagetable_div').html(text);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function() {
                            $.unblockUI();
                        },

                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    KTApp.unblockPage();
                },
            });
        } else {
            $("#error_loc").notify(error, {
                position: "top center"
            });
        }
        return false;
    });
</script>