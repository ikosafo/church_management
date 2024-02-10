<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="title">Meeting Name/Title</label>
                <input type="text" class="form-control" id="title"
                       placeholder="Enter Meeting Name/Title">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="datefrom">Date From</label>
                <input type="text" class="form-control" id="datefrom"
                       placeholder="Select Start Period">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="dateto">Date To</label>
                <input type="text" class="form-control" id="dateto"
                       placeholder="Select End Period">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="dateto">Description</label>
                <textarea id="description" class="form-control" placeholder="Enter Description"></textarea>
            </div>
        </div>


        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="savemeeting">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#datefrom').datetimepicker().on('change', function(){
        $('.datetimepicker').hide();
    });

    $('#dateto').datetimepicker().on('change', function(){
        $('.datetimepicker').hide();
    });

    $('#savemeeting').click(function () {
        var title = $('#title').val();
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var description = $("#description").val();

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (datefrom == "") {
            error += 'Please select period started \n';
        }
        if (dateto == "") {
            error += 'Please select period ended \n';
        }
        if (datefrom > dateto) {
            error += 'Please select correct date range \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_meetings.php",
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
                    datefrom: datefrom,
                    dateto: dateto,
                    description: description
                },
                success: function (text) {
                    //alert(text);
                    $("#success_loc").notify("Meeting updated","success");
                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/meetings_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#meetingsform_div').html(text);
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
                        url: "ajax/tables/meetings_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#meetingstable_div').html(text);
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