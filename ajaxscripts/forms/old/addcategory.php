<p class="card-text font-small mb-2">
    Add category
</p>
<hr />
<form class="form form-horizontal">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="categoryname">Name</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="categoryname" autocomplete="off" class="form-control" placeholder="Category Name" />
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="categorycode">Category Code</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="categorycode" autocomplete="off" class="form-control" placeholder="Category Code" />
                </div>
            </div>
        </div>

        <div class="col-sm-9 offset-sm-3">
            <button type="button" id="categorybtn" class="btn btn-primary me-1">Submit</button>
        </div>
    </div>
</form>



<script>
    // Add action on form submit
    $("#categorybtn").click(function() {

        var categoryname = $("#categoryname").val();
        var categorycode = $("#categorycode").val();

        var error = '';
        if (categoryname == "") {
            error += 'Please enter category name \n';
            $("#categoryname").focus();
        }
        if (categorycode == "") {
            error += 'Please enter category code \n';
            $("#categorycode").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/category.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    categoryname: categoryname,
                    categorycode: categorycode
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.ajax({
                            url: "ajaxscripts/forms/addcategory.php",
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
                            url: "ajaxscripts/tables/categories.php",
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