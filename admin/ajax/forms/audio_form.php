<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group">
            <label>Audio Sermon</label>
            <input type="file" class="form-control" id="audio_sermon">
            <input type="hidden" id="selected"/>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="saveaudio">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->


<script>
    $('#audio_sermon').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload Audio',
        'fileType': 'audio/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_audio_sermon.php',
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


    $("#saveaudio").click(function () {
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (selected == "") {
            error += 'Please upload audio \n';
            $("#audio_text").focus();
        }

        if (error == "") {
            $('#audio_sermon').uploadifive('upload');
            $.ajax({
                type: "POST",
                url: "ajax/forms/audio_form.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                success: function (text) {
                    $('#audioform_div').html(text);
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
                url: "ajax/tables/audio_table.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                success: function (text) {
                    $('#audiotable_div').html(text);
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