<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

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

<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="datereceived">Date Received</label>
                <input type="text" class="form-control" id="datereceived"
                       placeholder="Select Date" value="<?php echo date('Y-m-d') ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="receival_name">Offering</label>
                <input type="text" class="form-control" id="offering"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="tithe">Tithe</label>
                <input type="text" class="form-control" id="tithe"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="youth">Youth</label>
                <input type="text" class="form-control" id="youth"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="children">Children Service</label>
                <input type="text" class="form-control" id="children"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="pledge">Pledge</label>
                <input type="text" class="form-control" id="pledge"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="seed">Special Seed</label>
                <input type="text" class="form-control" id="seed"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="welfare">Welfare</label>
                <input type="text" class="form-control" id="welfare"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="firstfruit">First Fruits</label>
                <input type="text" class="form-control" id="firstfruit"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="contributions">Contributions</label>
                <input type="text" class="form-control" id="contributions"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="partners">Partners</label>
                <input type="text" class="form-control" id="partners"
                       placeholder="Enter Amount" value="0.00" onkeypress="return isNumberKey(event)">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="savereceival">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#datereceived').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $('#savereceival').click(function () {
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
                url: "ajax/queries/saveform_receival.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
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
                success: function (text) {
                    //alert(text);
                        $("#success_loc").notify("Updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/receival_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#receivalform_div').html(text);
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
                            url: "ajax/tables/receival_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#receivaltable_div').html(text);
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