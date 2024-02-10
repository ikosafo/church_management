<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">


        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title"
                       placeholder="Enter Title">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link"
                       placeholder="Enter Youtube Link">
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
                <label for="date_ministered">Date Ministered</label>
                <input type="text" class="form-control" id="date_ministered"
                       placeholder="Select Date">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3"
                       placeholder="Enter Description"></textarea>
            </div>
        </div>


    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savesermon">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->

<script>

    $("#branch").select2({placeholder:'Select Branch'});

    $('#date_ministered').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    });

    $("#savesermon").click(function () {
        var title = $("#title").val();
        var link = $("#link").val();
        var branch = $("#branch").val();
        var date_ministered = $("#date_ministered").val();
        var description = $("#description").val();

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (link == "") {
            error += 'Please enter link \n';
            $("#link").focus();
        }
        if (branch == "") {
            error += 'Please select branch \n';
            $("#branch").focus();
        }
        if (description == "") {
            error += 'Please enter description \n';
            $("#description").focus();
        }
        if (date_ministered == "") {
            error += 'Please select date \n';
            $("#date_ministered").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_rsermon.php",
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
                    link: link,
                    description: description,
                    branch:branch,
                    date_ministered:date_ministered
                },
                success: function (text) {
                    //alert(text);
                    if (text == 1) {
                        $.ajax({
                            url: "ajax/forms/rsermon_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#rsermonform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });
                        $.ajax({
                            url: "ajax/tables/rsermon_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#rsermontable_div').html(text);
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
                        $.notify("Link already exists", {position: "top center"});
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
            $.notify(error, {position: "top center"});
        }
        return false;
    });


</script>