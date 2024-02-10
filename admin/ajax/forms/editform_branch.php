<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$i_index = $_POST['i_index'];

$query = $mysqli->query("select * from branch where id = '$i_index'");
$result = $query->fetch_assoc();
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="branch_name">Branch Name</label>
                <input type="text" class="form-control" id="branch_name"
                       placeholder="Enter Branch Name" value="<?php echo $result['name']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="branch_location">Branch Location</label>
                <input type="text" class="form-control" id="branch_location"
                       placeholder="Enter Branch Location" value="<?php echo $result['location']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="branch_location">Branch Code</label>
                <input type="text" class="form-control" id="branch_code"
                       placeholder="Enter Branch Code" value="<?php echo $result['code']; ?>">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editbranch">Edit</button>
                <button type="button" class="btn btn-secondary" id="cancelbranch">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#editbranch').click(function () {
        var branch_name = $('#branch_name').val();
        var branch_location = $('#branch_location').val();
        var branch_code = $('#branch_code').val();
        var id_index = '<?php echo $i_index ?>';

        var error = '';
        if (branch_name == "") {
            error += 'Please enter branch name \n';
            $("#branch_name").focus();
        }
        if (branch_location == "") {
            error += 'Please enter branch location \n';
            $("#branch_location").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_branchedit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    branch_name: branch_name,
                    branch_location: branch_location,
                    branch_code: branch_code,
                    id_index: id_index
                },
                success: function (text) {
                    //alert(text);

                    if (text == 1) {
                        $("#success_loc").notify("Branch updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/branch_form.php",
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
                            url: "ajax/tables/branch_table.php",
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
                        $("#error_loc").notify("Branch already exists", {position: "top center"});
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
            url: "ajax/forms/branch_form.php",
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