<?php include('../../../config.php'); ?>
<p class="card-text font-small mb-2">
    Add category
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="fullname">Full Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="fullname" autocomplete="off" class="form-control" placeholder="Enter Full Name" />
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="username">Username</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="username" autocomplete="off" class="form-control" placeholder="Enter Username" />
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="userbranch">Branch</label>
                </div>
                <div class="col-sm-9">
                    <select id="userbranch" class="form-select">
                        <option value="">Select User Branch</option>
                        <?php $getbranch = $mysqli->query("select * from branch order by name");
                        while ($resbranch = $getbranch->fetch_assoc()) { ?>
                            <option value="<?php echo $resbranch['id'] ?>"><?php echo $resbranch['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="branchuserbtn" class="btn btn-primary me-1">Submit</button>
        </div>
    </div>
</form>



<script>
    $("#userbranch").select2({
        placeholder: "Select User",
        allowClear: true
    });

    // Add action on form submit
    $("#branchuserbtn").click(function() {

        var fullname = $("#fullname").val();
        var username = $("#username").val();
        var userbranch = $("#userbranch").val();

        var error = '';
        if (fullname == "") {
            error += 'Please enter full name \n';
            $("#fullname").focus();
        }
        if (username == "") {
            error += 'Please enter username \n';
            $("#username").focus();
        }
        if (userbranch == "") {
            error += 'Please select branch \n';
            $("#userbranch").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/branchuser.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    fullname,
                    username,
                    userbranch
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addbranchusers.php",
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
                            url: "ajaxscripts/tables/branchusers.php",
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
                        $("#error_loc").notify("User already exists", {
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