<?php include ('../../../../config.php');
$docid = date('ymdhis') . rand(1, 10000);
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title"
                       placeholder="Enter Title">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label>Document</label>
                <input type="file" class="form-control" id="document_file">
                <input type="hidden" id="selected"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description"
                       placeholder="Enter Title"></textarea>
            </div>
        </div>


        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="savedocument">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>
    $('#document_file').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload Document',
        'fileType': 'image/*',
        'multi': true,
        'width': 180,
        'formData': {'randno': '<?php echo $docid?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_document.php',
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
    
    
    $('#savedocument').click(function () {
        var title = $('#title').val();
        var description = $('#description').val();
        var selected = $("#selected").val();
        var docid = '<?php echo $docid ?>';

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (description == "") {
            error += 'Please enter description \n';
            $("#description").focus();
        }
        if (selected == "") {
            error += 'Please upload document \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_document.php",
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
                    description: description,
                    docid:docid
                },
                success: function (text) {
                    $('#document_file').uploadifive('upload');
                    //alert(text);
                    $.ajax({
                        url: "ajax/forms/document_form.php",
                        success: function (text) {
                            $('#documentform_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                    });

                    $.ajax({
                        url: "ajax/tables/document_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#documenttable_div').html(text);
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