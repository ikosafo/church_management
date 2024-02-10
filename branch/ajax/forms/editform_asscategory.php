<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$i_index = $_POST['i_index'];

$query = $mysqli->query("select * from asset_category where id = '$i_index'");
$result = $query->fetch_assoc();
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name"
                       placeholder="Enter asscategory Name" value="<?php echo $result['category_name']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="category_code">Category Code</label>
                <input type="text" class="form-control" id="category_code"
                       placeholder="Enter asscategory Name" value="<?php echo $result['category_code']; ?>">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editcategory">Edit</button>
                <button type="button" class="btn btn-secondary" id="cancelcategory">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#editcategory').click(function () {
        var category_name = $('#category_name').val();
        var category_code = $('#category_code').val();
        var id_index = '<?php echo $i_index ?>';

        var error = '';
        if (category_name == "") {
            error += 'Please enter category name \n';
            $("#category_name").focus();
        }
        if (category_code == "") {
            error += 'Please enter category code \n';
            $("#category_code").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_asscategoryedit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    category_name: category_name,
                    category_code: category_code,
                    id_index: id_index
                },
                success: function (text) {
                    //alert(text);

                    if (text == 1) {
                        $("#success_loc").notify("Category updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/asscategory_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#asscategoryform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },
                        });
                        $.ajax({
                            type: "POST",
                            url: "ajax/tables/asscategory_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#asscategorytable_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },
                        });
                    }
                    else {
                        $("#error_loc").notify("Category already exists", {position: "top center"});
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });

        }
        else {
            $("#error_loc").notify(error, {position: "top center"});
        }
        return false;
    });





    $('#cancelcategory').click(function () {

        $.ajax({
            url: "ajax/forms/asscategory_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#asscategoryform_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },
        });

    });


</script>