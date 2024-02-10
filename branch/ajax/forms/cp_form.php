<?php include ('../../../../config.php');
//$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="currentpassword">Current Password</label>
                <input type="password" class="form-control" id="currentpassword"
                       placeholder="Enter Current Password">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="newpassword">New Password</label>
                <input type="password" class="form-control" id="newpassword"
                       placeholder="Enter New Password">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="confirmpassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmpassword"
                       placeholder="Confirm New Password">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="changepassword">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>
    $('#changepassword').click(function () {
        var currentpassword = $('#currentpassword').val();
        var newpassword = $('#newpassword').val();
        var confirmpassword = $('#confirmpassword').val();

        var error = '';
        if (currentpassword == "") {
            error += 'Please enter current password \n';
            $("#currentpassword").focus();
        }
        if (newpassword == "") {
            error += 'Please enter new password \n';
            $("#newpassword").focus();
        }
        if (newpassword != "" && newpassword.length < 6) {
            error += 'Please enter not less than 6 characters \n';
            $("#user_type").focus();
        }
        if (confirmpassword == "") {
            error += 'Please confirm password \n';
            $("#confirmpassword").focus();
        }
        if (confirmpassword != "" && newpassword!=confirmpassword) {
            error += 'Please enter same password \n';
            $("#user_type").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_changepassword.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    currentpassword: currentpassword,
                    newpassword: newpassword
                },
                success: function (text) {
                       alert(text);

                     if (text == 1) {
                         $("#success_loc").notify("Password Changed","success");
                         $.ajax({
                             type: "POST",
                             url: "ajax/forms/cp_form.php",
                             beforeSend: function () {
                                 KTApp.blockPage({
                                     overlayColor: "#000000",
                                     type: "v2",
                                     state: "success",
                                     message: "Please wait..."
                                 })
                             },
                             success: function (text) {
                                 $('#cpform_div').html(text);
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
                         $.notify("Password not found", {position: "top center"});
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


</script>