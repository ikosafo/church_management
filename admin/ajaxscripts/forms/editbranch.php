<?php
include('../../../config.php');
$branchid = $_POST['i_index'];
$getdetails = $mysqli->query("select * from `branch` where id = '$branchid'");
$resdetails = $getdetails->fetch_assoc();
?>
<p class="card-text font-small mb-2">
    Edit Branch
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="branchname">Branch Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="branchname" autocomplete="off" class="form-control" placeholder="Enter Branch Name" value="<?php echo $resdetails['name'] ?>" />
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="branchlocation">Branch Location</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="branchlocation" autocomplete="off" class="form-control" placeholder="Enter Branch Location" value="<?php echo $resdetails['location'] ?>" />
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="branchcode">Branch Code</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="branchcode" autocomplete="off" class="form-control" placeholder="Enter Branch Code" value="<?php echo $resdetails['code'] ?>" />
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="editbranchbtn" class="btn btn-warning me-1">Update</button>
            <button type="button" id="cancelbranchbtn" class="btn btn-primary me-1">Cancel</button>
        </div>
    </div>
</form>



<script>
    $("#cancelbranchbtn").click(function() {
        location.reload();
    });



    // Add action on form submit
    $("#editbranchbtn").click(function() {

        var branchname = $("#branchname").val();
        var branchlocation = $("#branchlocation").val();
        var branchcode = $("#branchcode").val();

        var error = '';
        if (branchname == "") {
            error += 'Please enter branch name \n';
            $("#branchname").focus();
        }
        if (branchlocation == "") {
            error += 'Please enter branch location \n';
            $("#branchlocation").focus();
        }
        if (branchcode == "") {
            error += 'Please enter branch code \n';
            $("#branchcode").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/branch.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    branchname: branchname,
                    branchlocation: branchlocation,
                    branchcode: branchcode,
                    branchid: '<?php echo $branchid; ?>'
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addbranch.php",
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
                            url: "ajaxscripts/tables/branches.php",
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
                        $("#error_loc").notify("Name or Code already exists", {
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