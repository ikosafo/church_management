<?php include('../../../config.php');
$branch = $_SESSION['branch'];
?>
<style>
    body {
        overflow-x: hidden !important;
    }
</style>
<p class="card-text font-small mb-2">
    Add Church Worker
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="fullname">Full Name</label>
            <select class="form-control" id="select_member">
                <option value="">Select Member</option>
                <?php
                $getmember = $mysqli->query("select * from `members` where branch = '$branch' ORDER BY fullname");
                while ($resmember = $getmember->fetch_assoc()) { ?>
                    <option value="<?php echo $resmember['id'] ?>">
                        <?php echo $resmember['fullname']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label" for="position">Position</label>
            <input type="text" id="position" class="form-control" placeholder="Position" />
        </div>
        <div class="mb-1 col-md-12">
            <label class="form-label" for="role">Role</label>
            <input type="text" id="role" class="form-control" placeholder="Role" />
        </div>
    </div>


    <div class="row">

        <div class="mb-1 col-md-6">
            <button type="button" id="churchworkerbtn" class="btn btn-primary me-1">Submit</button>
        </div>

    </div>

</form>



<script>
    $("#select_member").select2({
        placeholder: "Select Member",
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
</script>