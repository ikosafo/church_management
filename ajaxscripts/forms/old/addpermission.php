<?php
include('../../config.php');
?>
<p class="card-text font-small mb-2">
    Add Permission
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="user">Select User/Staff</label>
                </div>
                <div class="col-sm-9">
                    <select class="form-select" id="user">
                        <option></option>
                        <?php
                        $getuser = $mysqli->query("select * from staff where status IS NULL");
                        while ($resuser = $getuser->fetch_assoc()) { ?>
                            <option value="<?php echo $resuser['stid'] ?>"><?php echo $resuser['fullname'] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="permissions">Permissions</label>
                </div>
                <div class="col-sm-9">
                    <select class="form-select" id="permissions" multiple>
                        <optgroup label="Products">
                            <option value="Add, View and Search Products">Add, View and Search Products</option>
                            <option value="New Arrivals">New Arrivals</option>
                        </optgroup>
                        <optgroup label="Sales">
                            <option value="Add and View Sales">Add and View Sales</option>
                            <option value="Sales Statistics">Statistics</option>
                        </optgroup>
                        <optgroup label="Customers">
                            <option value="Add and View Customers">Add and View Customers</option>
                            <option value="Customers Statistics">Statistics</option>
                        </optgroup>
                        <optgroup label="Suppliers">
                            <option value="Add and View Suppliers">Add and View Suppliers</option>
                            <option value="Suppliers Statistics">Statistics</option>
                        </optgroup>
                        <optgroup label="Expenses">
                            <option value="Add and View Expenses">Add and View Expenses</option>
                            <option value="Expenses Statistics">Statistics</option>
                        </optgroup>
                        <optgroup label="Users">
                            <option value="Add and View Users">Add and View Users</option>
                            <option value="User Permissions">Permissions</option>
                        </optgroup>
                        <optgroup label="Users">
                            <option value="Add and View Users">Add and View Users</option>
                            <option value="User Permissions">Permissions</option>
                        </optgroup>
                        <optgroup label="Extras">
                            <option value="Inventory">Inventory</option>
                            <option value="Gift Cards">Gift Cards</option>
                            <option value="Messages">Messages</option>
                            <option value="Logs">Logs</option>
                            <option value="Store Configuration">Store Configuration</option>
                        </optgroup>
                    </select>

                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="permissionbtn" class="btn btn-primary me-1">Submit</button>
        </div>
    </div>
</form>



<script>
    //Jquery plugins
    $("#user").select2({
        placeholder: "Select user",
        allowClear: true
    });

    $("#permissions").select2({
        placeholder: "Select permission(s)",
        allowClear: true
    });

    // Add action on form submit
    $("#permissionbtn").click(function() {

        var permission = $("#permissions").val();
        var user = $("#user").val();
        //alert(permission);


        var error = '';
        if (user == "") {
            error += 'Please select user \n';
        }
        if (permission == "") {
            error += 'Please select permission \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/permission.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    user: user,
                    permission: permission
                },
                success: function(text) {

                    $.ajax({
                        url: "ajaxscripts/forms/addpermission.php",
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
                        url: "ajaxscripts/tables/permissions.php",
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