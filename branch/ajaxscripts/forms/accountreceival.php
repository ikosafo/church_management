<?php include('../../../config.php');
$random = rand(1, 10000) . date("Ymd");
?>
<!--begin::Form-->

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
            <div class="mb-1 col-lg-12 col-md-12">
                <label class="form-label" for="datereceived">Date Received</label>
                <input type="text" class="form-control" id="datereceived" placeholder="Select Date" value="<?php echo date('Y-m-d') ?>" autocomplete="off">
            </div>
        </div>

        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label" for="receival_name">Offering</label>
                <input type="text" class="form-control" id="offering" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="tithe">Tithe</label>
                <input type="text" class="form-control" id="tithe" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>

        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label" for="youth">Youth</label>
                <input type="text" class="form-control" id="youth" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="children">Children Service</label>
                <input type="text" class="form-control" id="children" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>

        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label" for="pledge">Pledge</label>
                <input type="text" class="form-control" id="pledge" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="seed">Special Seed</label>
                <input type="text" class="form-control" id="seed" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>

        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label" for="welfare">Welfare</label>
                <input type="text" class="form-control" id="welfare" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="firstfruit">First Fruits</label>
                <input type="text" class="form-control" id="firstfruit" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>

        <div class="row">
            <div class="mb-1 col-md-6">
                <label class="form-label" for="contributions">Contributions</label>
                <input type="text" class="form-control" id="contributions" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="mb-1 col-md-6">
                <label class="form-label" for="partners">Partners</label>
                <input type="text" class="form-control" id="partners" placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-6">
            <button type="button" id="savereceival" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>


</form>
<!--end::Form-->


<script>
    $('#datereceived').flatpickr();

    $('#savereceival').click(function() {

        var datereceived = $('#datereceived').val();
        var offering = $('#offering').val();
        var tithe = $('#tithe').val();
        var youth = $('#youth').val();
        var children = $('#children').val();
        var pledge = $('#pledge').val();
        var seed = $('#seed').val();
        var welfare = $('#welfare').val();
        var firstfruit = $('#firstfruit').val();
        var contributions = $('#contributions').val();
        var partners = $('#partners').val();

        var error = '';
        if (datereceived == "") {
            error += 'Please select date received \n';
            $("#datereceived").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/receival.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    datereceived: datereceived,
                    offering: offering,
                    tithe: tithe,
                    youth: youth,
                    children: children,
                    pledge: pledge,
                    seed: seed,
                    welfare: welfare,
                    firstfruit: firstfruit,
                    contributions: contributions,
                    partners: partners
                },
                success: function(text) {
                    //alert(text);

                    $("#success_loc").notify("Updated", "success");

                    $.ajax({
                        url: "ajaxscripts/forms/accountreceival.php",
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
                        url: "ajaxscripts/tables/accountreceival.php",
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
                    $.unblockUI();
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