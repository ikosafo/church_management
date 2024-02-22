<?php
include('../../../config.php');
$societyid = $_POST['i_index'];

$getsociety = $mysqli->query("select * from `ministry` where id = '$societyid'");
$ressociety = $getsociety->fetch_assoc();
?>

<p class="card-text font-small mb-2">
    Edit Society
</p>
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="societyname">Society Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="societyname" autocomplete="off" class="form-control" placeholder="Enter Society Name" value="<?php echo $ressociety['ministry_name']; ?>" />
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="editsocietybtn" class="btn btn-warning me-1">Update</button>
            <button type="button" id="cancelsocietybtn" class="btn btn-primary me-1">Cancel</button>
        </div>
    </div>
</form>



<script>
    $("#cancelsocietybtn").click(function() {
        location.reload();
    });
    // Add action on form submit
    $("#editsocietybtn").click(function() {
        var societyname = $("#societyname").val();

        var error = '';
        if (societyname == "") {
            error += 'Please enter society name \n';
            $("#societyname").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/society.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    societyname: societyname,
                    societyid: '<?php echo $societyid; ?>'
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addsociety.php",
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
                            url: "ajaxscripts/tables/societies.php",
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
                        $("#error_loc").notify("Society already exists", {
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