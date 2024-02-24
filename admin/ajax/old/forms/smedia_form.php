<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="fb_link">FaceBook</label>
                <textarea class="form-control" id="fb_link"
                          rows="8"
                          placeholder="Enter Facebook Link"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="yt_link">YouTube</label>
                <textarea class="form-control" id="yt_link"
                          rows="8"
                          placeholder="Enter YouTube Link"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="tw_link">Twitter</label>
                <textarea class="form-control" id="tw_link"
                          rows="8"
                          placeholder="Enter Twitter Link"></textarea>
            </div>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savesmedia">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->

<script>
       $("#savesmedia").click(function () {
        var fb_link = $("#fb_link").val();
        var yt_link = $("#yt_link").val();
        var tw_link = $("#tw_link").val();

        var error = '';
        if (fb_link == "") {
            error += 'Please enter facebook link \n';
            $("#fb_link").focus();
        }
        if (yt_link == "") {
            error += 'Please enter youtube link \n';
            $("#yt_link").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_smedia.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    fb_link: fb_link,
                    tw_link:tw_link,
                    yt_link:yt_link
                },
                success: function (text) {
                    if (text == 1) {
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/smedia_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#smediaform_div').html(text);
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
                            url: "ajax/tables/smedia_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#smediatable_div').html(text);
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
                        $.notify("Links already exist", {position: "top center"});
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