<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$i_index = $_POST['i_index'];

$query = $mysqli->query("select * from service where id = '$i_index'");
$result = $query->fetch_assoc();
?>
<!--begin::Form-->

<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="service_name">Service Name</label>
                <input type="text" class="form-control" id="service_name"
                       placeholder="Enter Service Name" value="<?php echo $result['service_name']; ?>">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editservice">Edit</button>
                <button type="button" class="btn btn-secondary" id="cancelservice">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#editservice').click(function () {
        var service_name = $('#service_name').val();
        var id_index = '<?php echo $i_index ?>';

        var error = '';
        if (service_name == "") {
            error += 'Please enter service name \n';
            $("#service_name").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_serviceedit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    service_name: service_name,
                    id_index: id_index
                },
                success: function (text) {
                    //alert(text);

                    if (text == 1) {
                        $("#success_loc").notify("Service updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/services_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#servicesform_div').html(text);
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
                            url: "ajax/tables/services_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#servicestable_div').html(text);
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
                        $("#error_loc").notify("Service already exists", {position: "top center"});
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
    });

    
    $('#cancelservice').click(function () {
        $.ajax({
            url: "ajax/forms/services_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#servicesform_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },
        });
    });
    
</script>