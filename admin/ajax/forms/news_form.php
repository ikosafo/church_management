<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="news_title">News/Article Title</label>
                <input type="text" class="form-control" id="news_title"
                       placeholder="Enter News Title">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label>News/Article Image</label>
                <input type="file" class="form-control" id="news_image">
                <input type="hidden" id="selected"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="8"
                          placeholder="Enter Description"></textarea>
            </div>
        </div>
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savenews">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->


<script>
    $('#news_image').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_news_image.php',
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


    $("#savenews").click(function () {
        var news_title = $("#news_title").val();
        var selected = $("#selected").val();
        var description = $("#description").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (news_title == "") {
            error += 'Please enter title \n';
            $("#news_title").focus();
        }
        if (description == "") {
            error += 'Please enter description \n';
            $("#description").focus();
        }
        if (selected == "") {
            error += 'Please upload image\n';
            $("#news_text").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_news.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    news_title: news_title,
                    imageid:imageid,
                    description:description
                },
                success: function (text) {
                    //alert(text);
                    $('#news_image').uploadifive('upload');
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