<?php include ('../../../../config.php');
//$random = rand(1,10000).date("Ymd");

$i_index = $_POST['i_index'];
$query = $mysqli->query("select * from mnotify where id = '$i_index'");
$result = $query->fetch_assoc();
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="sms_key">SMS Key</label>
                <input type="text" class="form-control" id="sms_key"
                       placeholder="Enter SMS Key" value="<?php echo $result['mnotify_key'] ?>">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editsmskey">Edit</button>
                <button type="button" class="btn btn-secondary" id="cancelkey">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#editsmskey').click(function () {
        var sms_key = $('#sms_key').val();
        var i_index = '<?php echo $i_index ?>';


        var error = '';
        if (sms_key == "") {
            error += 'Please enter SMS Key \n';
            $("#sms_key").focus();
        }
        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_smskeyedit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    sms_key: sms_key,
                    i_index: i_index
                },
                success: function (text) {
                    //alert(text);
                    if (text == 1) {
                        $("#success_loc").notify("Key Updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/smskey_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#smskeyform_div').html(text);
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
                            url: "ajax/tables/smskey_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#smskeytable_div').html(text);
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
                        $("#error_loc").notify("Key already exists", {position: "top center"});
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


    $('#cancelkey').click(function () {
        $.ajax({
            url: "ajax/forms/smskey_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#smskeyform_div').html(text);
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