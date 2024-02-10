<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="group">Group</label>
                <select class="form-control" id="group">
                    <option value="">Select Group</option>
                    <option value="Members">Members</option>
                    <option value="Visitors">Visitors</option>
                    <option value="New Converts">New Converts</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title"
                       placeholder="Enter Title">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="messages">Messages</label>
                <textarea class="form-control" id="messages"
                       placeholder="Enter Message here" rows="12"></textarea>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="savesms">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $("#group").select2();

    $('#savesms').click(function () {
        var title = $('#title').val();
        var message = $('#messages').val();
        var group = $('#group').val();

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (title != "" && title.length > 11) {
            error += 'Maximum characters exceeded \n';
            $("#title").focus();
        }
        if (message == "") {
            error += 'Please enter message \n';
            $("#messages").focus();
        }
        if (group == "") {
            error += 'Please select group \n';
            $("#group").focus();
        }
        

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_sms.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    title: title,
                    message: message,
                    group:group
                },
                success: function (text) {
                        //alert(text);
                        $("#success_loc").notify("SMS Sent","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/sms_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#smsform_div').html(text);
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
                            url: "ajax/tables/sms_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#smstable_div').html(text);
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