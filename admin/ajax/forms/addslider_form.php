<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->


<form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">NAME</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
    </div>
    <div class="form-group">
        <label for="email">EMAIL</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
    </div>
    <input id="uploadImage" type="file" name="image" /> <!--accept="image/*" -->
    <div id="preview"><img src="../../../../files.jpg" style="width: 20%;margin-top: 10px"/></div><br>
    <input class="btn btn-success" type="submit" value="Upload">
</form>
<div id="err"></div>

<!--<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group">
            <label>Slider Image</label>
            <input type="file" class="form-control" id="slider_image">
            <input type="hidden" id="selected"/>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="saveslider">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>-->
<!--end::Form-->

<script>
    $(document).ready(function (e) {
        $("#form").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "ajax/forms/ajaxupload.php",
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
        }));
    });
</script>


<!--<script>

    $('#slider_image').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php /*echo $random*/?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_slider_image.php',
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


    $("#saveslider").click(function () {
        var selected = $("#selected").val();
        var imageid = '<?php /*echo $random; */?>';

        var error = '';
        if (selected == "") {
            error += 'Please upload image\n';
            $("#slider_text").focus();
        }

        if (error == "") {

            $('#slider_image').uploadifive('upload');
            location.reload();

                }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;

    });

</script>-->