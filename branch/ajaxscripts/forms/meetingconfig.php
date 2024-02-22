<style>
    body {
        overflow-x: hidden !important;
    }
</style>
<p class="card-text font-small mb-2">
    Add New Meeting
</p>
<hr />
<form class="form form-horizontal">

    <div class="row">
        <div class="mb-1 col-md-6">
            <label for="meetingname" class="form-label">Meeting Name/Title</label>
            <input type="text" class="form-control" id="meetingname" placeholder="Enter Meeting Name/Title">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="datefrom">Date From</label>
            <input type="number" id="datefrom" class="form-control" placeholder="Date From" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="dateto">Date To</label>
            <input type="text" id="dateto" class="form-control" placeholder="Date To" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="description">Description </label>
            <textarea id="description" class="form-control" style="width: 100%" placeholder="Enter description"></textarea>
        </div>
    </div>


    <div class="row">

        <div class="mb-1 col-md-6">
            <button type="button" id="meetingconfigbtn" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>

</form>



<script>
    $("#datefrom").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onClose: function(selectedDates, dateStr, instance) {
            instance.close();
        }
    });

    $("#dateto").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onClose: function(selectedDates, dateStr, instance) {
            instance.close();
        }
    });




    // Add action on form submit
    $("#meetingconfigbtn").click(function() {

        var meetingname = $("#meetingname").val();
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var description = $("#description").val();

        var error = '';
        if (meetingname == "") {
            error += 'Please enter meeting name \n';
            $("#meetingname").focus();
        }
        if (datefrom == "") {
            error += 'Please select date started \n';
            $("#datefrom").focus();
        }
        if (dateto == "") {
            error += 'Please select date completed \n';
            $("#dateto").focus();
        }

        if (datefrom != "" && dateto != "" && datefrom > dateto) {
            error += 'Please specify a correct date range \n';
            $("#dateto").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/meetingconfig.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    meetingname,
                    datefrom,
                    dateto,
                    description
                },
                success: function(text) {
                    //alert(text);
                    $.ajax({
                        url: "ajaxscripts/forms/meetingconfig.php",
                        beforeSend: function() {
                            $.blockUI({
                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                            });
                        },
                        success: function(text) {
                            $('#pageform_div').html(text);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function() {
                            $.unblockUI();
                        },

                    });

                    $.ajax({
                        url: "ajaxscripts/tables/meetingsconfig.php",
                        beforeSend: function() {
                            $.blockUI({
                                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                            });
                        },
                        success: function(text) {
                            $('#pagetable_div').html(text);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function() {
                            $.unblockUI();
                        },

                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $("#error_loc").notify(error, {
                position: "right"
            });
        }
        return false;

    });
</script>