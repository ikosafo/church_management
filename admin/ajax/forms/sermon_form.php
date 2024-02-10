<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<style>
    input[type="file"] {
        z-index: -1;
        position: absolute;
        opacity: 0;
    }

    input:focus + label {
        outline: 2px solid;
    }
</style>


<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="sermon_type">Sermon Type</label>
                <select class="form-control" id="sermon_type">
                    <option value="">Select Type</option>
                    <option value="Video">Video</option>
                    <option value="Audio">Audio</option>
                    <option value="PDF">PDF</option>
                    <option value="Image">Image</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title"
                       placeholder="Enter Title">
            </div>
        </div>

        <input type="file" id="file-upload" multiple required />
        <label for="file-upload">Upload file</label>
        <div id="file-upload-filename"></div>

        <div class="upload-btn-wrapper">
            <button class="btn" onclick="myFunction()">Upload a file</button>
            <input type="file" name="myfile" id="myFile"/>
            <p id="demo"></p>
        </div>

        <div class="form-group">
            <label>Sermon</label>
            <!--<input type="file" class="form-control" id="sermon_sermon">
            <input type="hidden" id="selected"/>-->

            <div class="input-file-container">
                <input class="input-file" id="my-file" type="file">
                <label tabindex="0" for="my-file" class="input-file-trigger">UPLOAD FILE</label>
            </div>
            <p class="file-return"></p>
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


    $("#sermon_type").select2();

   $('#sermon_sermon').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload Audio',
        'fileType': 'sermon/!*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_sermon_sermon.php',
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


    $("#savesermon").click(function () {
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (selected == "") {
            error += 'Please upload sermon \n';
            $("#sermon_text").focus();
        }

        if (error == "") {
            $('#sermon_sermon').uploadifive('upload');
            $.ajax({
                type: "POST",
                url: "ajax/forms/sermon_form.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                success: function (text) {
                    $('#sermonform_div').html(text);
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
                url: "ajax/tables/sermon_table.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                success: function (text) {
                    $('#sermontable_div').html(text);
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



    $("#savesermon").click(function () {
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (selected == "") {
            error += 'Please upload sermon \n';
            $("#sermon_text").focus();
        }

        if (error == "") {
            $.ajax({
                url: "ajaxupload.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
                    //$("#preview").fadeOut();
                    $("#err").fadeOut();
                },
                success: function(data)
                {
                    if(data=='invalid')
                    {
                        // invalid file format.
                        $("#err").html("Invalid File !").fadeIn();
                    }
                    else
                    {
                        // view uploaded file.
                        $("#preview").html(data).fadeIn();
                        $("#form")[0].reset();
                    }
                },
                error: function(e)
                {
                    $("#err").html(e).fadeIn();
                }
            });
        }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;
    });

</script>