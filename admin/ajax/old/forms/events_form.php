<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="event_title">Event Title</label>
                <input type="text" class="form-control" id="event_title"
                       placeholder="Enter Event Title">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="venue">Venue</label>
                <input type="text" class="form-control" id="venue"
                          placeholder="Enter Venue">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label>Event Image</label>
                <input type="file" class="form-control" id="event_image">
                <input type="hidden" id="selected"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="start_period">Start Period</label>
                <input type="text" class="form-control" id="start_period"
                       placeholder="Select Start Period">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="end_period">End Period</label>
                <input type="text" class="form-control" id="end_period"
                       placeholder="Select End Period">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="start_period">Description</label>
                <textarea class="form-control" id="description" rows="4"
                       placeholder="Enter Description"></textarea>
            </div>
        </div>
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="saveslider">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->


<script>
    $('#start_period').datetimepicker().on('change', function(){
        $('.datetimepicker').hide();
    });

    $('#end_period').datetimepicker().on('change', function(){
        $('.datetimepicker').hide();
    });

    $('#event_image').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_event_image.php',
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
        var event_title = $("#event_title").val();
        var venue = $("#venue").val();
        var selected = $("#selected").val();
        var start_period = $("#start_period").val();
        var end_period = $("#end_period").val();
        var description = $("#description").val();
        var imageid = '<?php echo $random; ?>';

        var error = '';
        if (event_title == "") {
            error += 'Please enter title \n';
            $("#event_title").focus();
        }
        if (venue == "") {
            error += 'Please enter venue \n';
            $("#venue").focus();
        }
        if (description == "") {
            error += 'Please enter description \n';
            $("#description").focus();
        }
        if (selected == "") {
            error += 'Please upload image\n';
            $("#event_text").focus();
        }
        if (start_period == "") {
            error += 'Please enter start period \n';
            $("#start_period").focus();
        }
        if (end_period == "") {
            error += 'Please enter end period \n';
            $("#end_period").focus();
        }
        if (start_period != "" && end_period != "" && (start_period > end_period)) {
            error += 'Please select correct date range \n';
            $("#end_period").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_events.php",
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
                    venue: venue,
                    start_period: start_period,
                    end_period: end_period,
                    imageid:imageid,
                    description:description
                },
                success: function (text) {
                    //alert(text);
                    $('#event_image').uploadifive('upload');
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