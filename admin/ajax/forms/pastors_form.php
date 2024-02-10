<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="pastor_name">Name of Pastor</label>
                <input type="text" class="form-control" id="pastor_name"
                       placeholder="Enter Name of Pastor">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="pastor_branch">Branch</label>
                <input type="text" class="form-control" id="pastor_branch"
                       placeholder="Enter Branch">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="pastor_telephone">Telephone</label>
                <input type="text" class="form-control" id="pastor_telephone"
                       placeholder="Enter Telephone">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="pastor_email">Email Address</label>
                <input type="text" class="form-control" id="pastor_email"
                       placeholder="Enter Email Address">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label>Pastor's Image</label>
                <input type="file" class="form-control" id="pastor_image">
                <input type="hidden" id="selected"/>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="4"
                          placeholder="Enter Description"></textarea>
            </div>
        </div>
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savepastor">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->

<script>
    $('#pastor_image').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_pastors_image.php',
        'onUploadComplete': function (file, data) {
            console.log(data);
        },
        'onSelect': function (file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
        },
        'onCancel': function (file) {
            // Update selected so we know they have no file selected
            $("#selected").val('');
        }
    });

    $("#savepastor").click(function () {
        var pastor_name = $("#pastor_name").val();
        var pastor_branch = $("#pastor_branch").val();
        var pastor_telephone = $("#pastor_telephone").val();
        var pastor_email = $("#pastor_email").val();
        var description = $("#description").val();
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (pastor_name == "") {
            error += 'Please enter name of pastor\n';
            $("#pastor_name").focus();
        }
        if (pastor_branch == "") {
            error += 'Please enter branch\n';
            $("#pastor_branch").focus();
        }
        if (pastor_telephone == "") {
            error += 'Please enter telephone\n';
            $("#pastor_telephone").focus();
        }
        if (selected == "") {
            error += 'Please upload image\n';
            $("#selected").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_pastor.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    pastor_name: pastor_name,
                    pastor_branch: pastor_branch,
                    pastor_telephone: pastor_telephone,
                    pastor_email: pastor_email,
                    description: description,
                    imageid:imageid
                },
                success: function (text) {
                    //alert(text);
                    $('#pastor_image').uploadifive('upload');
                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/pastors_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#pastorsform_div').html(text);
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
                        url: "ajax/tables/pastors_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#pastorstable_div').html(text);
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
            $.notify(error, {position: "top center"});
        }
        return false;
    });

</script>