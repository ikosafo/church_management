<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="event_title">Event Title/Name</label>
                <input type="text" class="form-control" id="event_title"
                       placeholder="Enter Event Title">
            </div>
        </div>
      
       
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label>Event Images</label>
                <input type="file" class="form-control" id="event_images">
                <input type="hidden" id="selected"/>
            </div>
        </div>
        
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savegallery">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->


<script>

    $('#event_images').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload images',
        'fileType': 'image/*',
        'multi': true,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_event_imagegallery.php',
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


    $("#savegallery").click(function () {
        var event_title = $("#event_title").val();
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (event_title == "") {
            error += 'Please enter title \n';
            $("#event_title").focus();
        }
        if (selected == "") {
            error += 'Please upload image\n';
            $("#event_text").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_eventgallery.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    event_title: event_title,
                    imageid:imageid
                },
                success: function (text) {
                    //alert(text);
                    $('#event_images').uploadifive('upload');
                    location.reload();
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