<?php include ('../../../../config.php');
$branch = $_SESSION['branch'];
//$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <label class="col-lg-12 col-sm-12">Select Service</label>

            <div class=" col-lg-12 col-sm-12">
                <select class="form-control" id="select_service">
                    <option value="">Select Service</option>
                    <?php
                    $getservice = $mysqli->query("select * from `service` where branch = '$branch' ORDER BY service_name");
                    while ($resservice = $getservice->fetch_assoc()){ ?>
                        <option value="<?php echo $resservice['id'] ?>"><?php echo $resservice['service_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="datefrom">Date From</label>
                <input type="text" class="form-control" id="datefrom"
                       placeholder="Select Start Period">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="dateto">Date To</label>
                <input type="text" class="form-control" id="dateto"
                       placeholder="Select End Period">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="dateto">Description</label>
                <textarea id="description" class="form-control" placeholder="Enter Description"></textarea>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="saveconfigatt">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $("#select_service").select2({placeholder:"Select service"});

    $('#datefrom').datetimepicker().on('change', function(){
        $('.datetimepicker').hide();
    });

    $('#dateto').datetimepicker().on('change', function(){
        $('.datetimepicker').hide();
    });

    $("#saveconfigatt").click(function(){
        var serviceid = $("#select_service").val();
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var description = $("#description").val();
        //alert(serviceid);

        var error = '';
        if (serviceid == "") {
            error += 'Please select service \n';
        }
        if (datefrom == "") {
            error += 'Please select period started \n';
        }
        if (dateto == "") {
            error += 'Please select period ended \n';
        }
        if (datefrom > dateto) {
            error += 'Please select correct date range \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_configatt.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    serviceid: serviceid,
                    datefrom: datefrom,
                    dateto: dateto,
                    description: description
                },
                success: function (text) {
                    //alert(text);
                    if (text == 1) {
                        $("#success_loc").notify("Configuration added","success");

                        $.ajax({
                            url: "ajax/forms/configatt_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#configattform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });

                        $.ajax({
                            url: "ajax/tables/configatt_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#configatttable_div').html(text);
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
                        $("#error_loc").notify("Date already exists", {position: "top center"});
                    }

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

    })


</script>