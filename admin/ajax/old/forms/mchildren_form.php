<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">


        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="page_text">Page Text</label>
                <textarea class="form-control summernote" id="page_text"
                          placeholder="Enter Page Text"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label>Page Image</label>
            <input type="file" class="form-control" id="page_image">
            <input type="hidden" id="selected"/>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savewmchildren">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->

<script>
    $(".summernote").summernote({
        placeholder: 'Enter Page text here',
        tabsize: 2,
        height: 100
    });

    $('#page_image').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_mchildren_image.php',
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

    $("#savewmchildren").click(function () {
        var page_text = $("#page_text").val();
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (page_text == "") {
            error += 'Please enter page text\n';
            $("#page_text").focus();
        }
        if (selected == "") {
            error += 'Please upload image\n';
            $("#page_text").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_mchildren.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    page_text: page_text,
                    imageid:imageid
                },
                success: function (text) {
                    //alert(text);
                    $('#page_image').uploadifive('upload');
                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/mchildren_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#wmchildrenform_div').html(text);
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
                        url: "ajax/tables/mchildren_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#wmchildrentable_div').html(text);
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