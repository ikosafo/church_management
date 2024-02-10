<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$i_index = $_POST['i_index'];

$query = $mysqli->query("select * from cell where id = '$i_index'");
$result = $query->fetch_assoc();
?>
<!--begin::Form-->


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="cell_name">Cell Name</label>
                <input type="text" class="form-control" id="cell_name"
                       placeholder="Enter Cell Name" value="<?php echo $result['cell_name']; ?>">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editcell">Edit</button>
                <button type="button" class="btn btn-secondary" id="cancelcell">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $('#editcell').click(function () {
        var cell_name = $('#cell_name').val();
        var id_index = '<?php echo $i_index ?>';

        var error = '';
        if (cell_name == "") {
            error += 'Please enter cell name \n';
            $("#cell_name").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_celledit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    cell_name: cell_name,
                    id_index: id_index
                },
                success: function (text) {
                    //alert(text);

                    if (text == 1) {
                        $("#success_loc").notify("Cell updated","success");
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/cell_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#cellform_div').html(text);
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
                            url: "ajax/tables/cell_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#celltable_div').html(text);
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
                        $("#error_loc").notify("Cell already exists", {position: "top center"});
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





    $('#cancelcell').click(function () {

        $.ajax({
            url: "ajax/forms/cell_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#cellform_div').html(text);
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