<?php include ('../../../../config.php');
//$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name"
                       placeholder="Enter Full Name">
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
                <label for="branch">Select Branch</label>
                <select id="branch" style="width: 100%">
                    <option value="">Select Branch</option>
                    <?php $getbranch = $mysqli->query("select * from branch order by name");
                       while ($resbranch = $getbranch->fetch_assoc()) { ?>
                           <option value="<?php echo $resbranch['id'] ?>"><?php echo $resbranch['name'] ?></option>
                      <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="title">Testimony</label>
                <textarea class="form-control" rows="10" id="testimony"
                       placeholder="Enter Testimony"></textarea>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="savetestimony">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $("#branch").select2({placeholder:'Select Branch'});

    $('#savetestimony').click(function () {
        var full_name = $('#full_name').val();
        var title = $('#title').val();
        var branch = $('#branch').val();
        var testimony = $('#testimony').val();

        var error = '';
        if (full_name == "") {
            error += 'Please enter full name \n';
            $("#full_name").focus();
        }
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (testimony == "") {
            error += 'Please enter testimony \n';
            $("#testimony").focus();
        }
        if (branch == "") {
            error += 'Please select branch \n';
            $("#branch").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_testimony.php",
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
                    title: title,
                    branch: branch,
                    testimony:testimony
                },
                success: function (text) {
                    //alert(text);
                    
                        $("#success_loc").notify("Testimony Added","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/testimonies_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#testimoniesform_div').html(text);
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
                            url: "ajax/tables/testimonies_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#testimoniestable_div').html(text);
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