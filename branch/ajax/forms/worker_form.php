<?php include ('../../../../config.php');
$branch = $_SESSION['branch'];
//$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <label class="col-lg-12 col-sm-12">Select Member</label>

            <div class=" col-lg-12 col-sm-12">
                <select class="form-control" id="select_member">
                    <option value="">Select Member</option>
                    <?php
                    $getmember = $mysqli->query("select * from `member` where branch = '$branch' ORDER BY surname,firstname,othername");
                    while ($resmember = $getmember->fetch_assoc()){ ?>
                        <option value="<?php echo $resmember['id'] ?>">
                            <?php echo $resmember['surname'].' '.$resmember['firstname'].' '.$resmember['othername']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div id="member_details"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position"
                       placeholder="Enter Position">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="role">Role</label>
                <textarea class="form-control" id="role"
                          placeholder="Enter Role"></textarea>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="saveworker">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $("#select_member").select2({placeholder:"Select Member"});

    $("#select_member").change(function () {
        var select_member = $("#select_member").val();
        //alert(select_member);

        $.ajax({
            type: "POST",
            url: "ajax/forms/getmember_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            data: {
                select_member: select_member
            },
            success: function (text) {
                $('#member_details').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },
        });

    });

    $("#saveworker").click(function(){
        var memberid = $("#select_member").val();
        var position = $("#position").val();
        var role = $("#role").val();
        //alert(memberid);

        var error = '';
        if (memberid == "") {
            error += 'Please select member \n';
        }
        if (position == "" && role == "") {
            error += 'Please enter position or role \n';
            $("#position").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_worker.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    memberid: memberid,
                    position: position,
                    role: role
                },
                success: function (text) {
                    //alert(text);
                    if (text == 1) {
                        $("#success_loc").notify("Worker added","success");

                        $.ajax({
                            url: "ajax/forms/worker_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#workerform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });

                        $.ajax({
                            url: "ajax/tables/worker_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#workertable_div').html(text);
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
                        $("#error_loc").notify("Worker already exists", {position: "top center"});
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