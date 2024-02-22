<?php
include('../../../config.php');
$keyid = $_POST['i_index'];

$getkey = $mysqli->query("select * from `mnotify` where id = '$keyid'");
$reskey = $getkey->fetch_assoc();
?>

<p class="card-text font-small mb-2">
    Edit Key
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="apikey">Key</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="apikey" autocomplete="off" class="form-control" placeholder="Enter Key" value="<?php echo $reskey['mnotify_key'] ?>" />
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="editkeybtn" class="btn btn-warning me-1">Update</button>
            <button type="button" id="cancelkeybtn" class="btn btn-primary me-1">Cancel</button>
        </div>
    </div>
</form>



<script>
    $("#cancelkeybtn").click(function() {
        location.reload();
    });

    // Add action on form submit
    $("#editkeybtn").click(function() {

        var apikey = $("#apikey").val();

        var error = '';
        if (apikey == "") {
            error += 'Please enter Key \n';
            $("#apikey").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/apikey.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    apikey: apikey,
                    keyid: '<?php echo $keyid; ?>'
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/apikey.php",
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
                            url: "ajaxscripts/tables/apikey.php",
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
                        $("#error_loc").notify("Key already exists", {
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