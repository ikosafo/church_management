<p class="card-text font-small mb-2">
    Add branch
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="cellgroupname">Cell Group Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="cellgroupname" autocomplete="off" class="form-control" placeholder="Enter Cell Group Name" />
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="cellgroupbtn" class="btn btn-primary me-1">Submit</button>
        </div>
    </div>
</form>



<script>
    // Add action on form submit
    $("#cellgroupbtn").click(function() {

        var cellgroupname = $("#cellgroupname").val();

        var error = '';
        if (cellgroupname == "") {
            error += 'Please enter cell group name \n';
            $("#cellgroupname").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/cellgroup.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    cellgroupname
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addcellgroup.php",
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
                            url: "ajaxscripts/tables/cellgroups.php",
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
                        $("#error_loc").notify("Cell Group already exists", {
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
</script>