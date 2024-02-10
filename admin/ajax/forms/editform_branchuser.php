<?php include ('../../../../config.php');
//$random = rand(1,10000).date("Ymd");
$i_index = $_POST['i_index'];

$query = $mysqli->query("select * from users_admin where id = '$i_index'");
$result = $query->fetch_assoc();
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name"
                       placeholder="Enter Full Name" value="<?php echo $result['fullname'] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username"
                       placeholder="Enter Username" value="<?php echo $result['username'] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="user_branch">Select User Branch</label>
                <select id="user_branch" style="width: 100%">
                    <option value="">Select User Branch</option>
                    <?php
                    $user_branch = $result['branch'];
                    $queryed = $mysqli->query("select * from branch ORDER BY name");
                    while ($resulted = $queryed->fetch_assoc()) { ?>
                        <option <?php if (@$user_branch == @$resulted['id']) echo "Selected" ?>><?php echo $resulted['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editbranchuser">Edit</button>
                <button type="button" class="btn btn-secondary" id="cancelbranch">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $("#user_branch").select2({placeholder:'Select Branch'});

    $('#editbranchuser').click(function () {
        var full_name = $('#full_name').val();
        var username = $('#username').val();
        var user_branch = $('#user_branch').val();
        var i_index = '<?php echo $i_index ?>';

        var error = '';
        if (full_name == "") {
            error += 'Please enter full name \n';
            $("#full_name").focus();
        }
        if (username == "") {
            error += 'Please enter username \n';
            $("#username").focus();
        }
        if (user_branch == "") {
            error += 'Please select branch \n';
            $("#user_branch").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_branchuseredit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    full_name: full_name,
                    username: username,
                    user_branch: user_branch,
                    i_index: i_index
                },
                success: function (text) {
                    //alert(text);
                    if (text == 1) {
                        $("#success_loc").notify("Branch updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/branchuser_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#branchform_div').html(text);
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
                            url: "ajax/tables/branchuser_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#branchtable_div').html(text);
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
                        $("#error_loc").notify("Username already exists", {position: "top center"});
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


    $('#cancelbranch').click(function () {

        $.ajax({
            url: "ajax/forms/branchuser_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#branchform_div').html(text);
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