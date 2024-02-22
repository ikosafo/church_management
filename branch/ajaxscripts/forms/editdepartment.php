<?php
include('../../../config.php');
$deptid = $_POST['i_index'];

$getdept = $mysqli->query("select * from `department` where id = '$deptid'");
$resdept = $getdept->fetch_assoc();
?>

<p class="card-text font-small mb-2">
    Edit Department
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="departmentname">Department Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="departmentname" autocomplete="off" class="form-control" placeholder="Enter Department Name" value="<?php echo $resdept['department_name']; ?>" />
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="editdepartmentbtn" class="btn btn-warning me-1">Update</button>
            <button type="button" id="canceldepartmentbtn" class="btn btn-primary me-1">Cancel</button>
        </div>
    </div>
</form>



<script>
    $("#canceldepartmentbtn").click(function() {
        location.reload();
    });

    // Add action on form submit
    $("#editdepartmentbtn").click(function() {

        var departmentname = $("#departmentname").val();

        var error = '';
        if (departmentname == "") {
            error += 'Please enter department name \n';
            $("#departmentname").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/department.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    departmentname: departmentname,
                    deptid: '<?php echo $deptid; ?>'
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/adddepartment.php",
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
                            url: "ajaxscripts/tables/departments.php",
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
                        $("#error_loc").notify("Department already exists", {
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