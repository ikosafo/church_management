<?php include('../../../config.php');
$branch = $_SESSION['branch'];
?>
<style>
    body {
        overflow-x: hidden !important;
    }
</style>
<p class="card-text font-small mb-2">
    Send Bulk Messages to Members
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="group">Group</label>
            <select class="form-control" id="group">
                <option value="">Select Group</option>
                <option value="Members">Members</option>
                <option value="Visitors">Visitors</option>
                <option value="New Converts">New Converts</option>
            </select>
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label" for="title">Title</label>
            <input type="text" id="title" class="form-control" placeholder="Enter Title" />
        </div>
        <div class="mb-1 col-md-12">
            <label for="messages" class="form-label">Messages</label>
            <textarea class="form-control" id="messages" placeholder="Enter Message here" rows="12"></textarea>
        </div>

    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <button type="button" id="smsbtn" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>

</form>



<script>
    $("#group").select2({
        placeholder: "Select Group",
        allowClear: true
    });

    // Add action on form submit
    $("#churchworkerbtn").click(function() {

        var select_member = $("#select_member").val();
        var position = $("#position").val();
        var role = $("#role").val();

        var error = '';
        if (select_member == "") {
            error += 'Please select member \n';
            $("#select_member").focus();
        }
        if (position == "") {
            error += 'Please enter position \n';
            $("#position").focus();
        }
        if (role == "") {
            error += 'Please enter role \n';
            $("#role").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/churchworker.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    select_member,
                    position,
                    role
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addchurchworker.php",
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
                            url: "ajaxscripts/tables/churchworkers.php",
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
                    } else {
                        $("#error_loc").notify("Church Worker already exists", {
                            position: "right"
                        });
                    }

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


    $('#smsbtn').click(function() {
        var title = $('#title').val();
        var message = $('#messages').val();
        var group = $('#group').val();

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (title != "" && title.length > 11) {
            error += 'Maximum characters exceeded \n';
            $("#title").focus();
        }
        if (message == "") {
            error += 'Please enter message \n';
            $("#messages").focus();
        }
        if (group == "") {
            error += 'Please select group \n';
            $("#group").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/sms.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    title: title,
                    message: message,
                    group: group
                },
                success: function(text) {
                    //alert(text);
                    $("#success_loc").notify("SMS Sent", "success");
                    $.ajax({
                        url: "ajaxscripts/forms/addsms.php",
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

                    //Load table
                    $.ajax({
                        url: "ajaxscripts/tables/sms.php",
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
                    KTApp.unblockPage();
                },
            });

        } else {
            $.notify(error, {
                position: "top center"
            });
        }
        return false;
    });
</script>