<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$i_index = $_POST['i_index'];
$getassets = $mysqli->query("select * from asset_registry where id = '$i_index'");
$resassets = $getassets->fetch_assoc();

?>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>


<form class="" autocomplete="off">

    <div class="kt-portlet__body" id="error_loc">
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="category">Category</label>
                <select id="category" style="width: 100%">
                    <option value="">Select</option>

                    <?php
                    $categoryid = $resassets['categoryid'];
                    $queryed = $mysqli->query("select * from asset_category ORDER BY category_name");
                    while ($resulted = $queryed->fetch_assoc()) { ?>
                        <option <?php if (@$categoryid == @$resulted['id']) echo "Selected" ?>><?php echo $resulted['category_name'] ?></option>
                    <?php } ?>



                   <!-- <?php /*$getcat = $mysqli->query("select * from asset_category ORDER BY category_name");
                    while ($rescat = $getcat->fetch_assoc()){*/?>
                        <option value="<?php /*echo $rescat['id'] */?>"><?php /*echo $rescat['category_name'] */?></option>
                    --><?php /*} */?>

                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="item_name">Item Name</label>
                <input type="text" class="form-control" id="item_name" autocomplete="on"
                       placeholder="Enter Item Name" value="<?php echo $resassets['itemname']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location"
                       placeholder="Enter Location" value="<?php echo $resassets['location']; ?>">
            </div>

            <div class="col-lg-6 col-md-6">
                <label for="excellent">State/Condition (Excellent)</label>
                <input type="text" class="form-control" id="excellent"
                       onkeypress="return isNumber(event)"
                       placeholder="Enter Number" value="<?php echo $resassets['excellent']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="good">State/Condition (Good)</label>
                <input type="text" class="form-control" id="good"
                       onkeypress="return isNumber(event)"
                       placeholder="Enter Number" value="<?php echo $resassets['good']; ?>">
            </div>

            <div class="col-lg-6 col-md-6">
                <label for="fair">State/Condition (Fair)</label>
                <input type="text" class="form-control" id="fair"
                       onkeypress="return isNumber(event)"
                       placeholder="Enter Number" value="<?php echo $resassets['fair']; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="bad">State/Condition (Bad)</label>
                <input type="text" class="form-control" id="bad"
                       onkeypress="return isNumber(event)"
                       placeholder="Enter Number" value="<?php echo $resassets['bad']; ?>">
            </div>

            <div class="col-lg-6 col-md-6">
                <label for="worse">State/Condition (Worse)</label>
                <input type="text" class="form-control" id="worse"
                       onkeypress="return isNumber(event)"
                       placeholder="Enter Number" value="<?php echo $resassets['worse']; ?>">
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="editassets">Update</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->


<script>

    $("#item_state").select2({placeholder:"Select State"});
    $("#category").select2({placeholder:"Select Category"});

    $('#editassets').click(function () {
        var category = $('#category').val();
        var item_name = $('#item_name').val();
        var location = $('#location').val();
        var excellent = $('#excellent').val();
        var good = $('#good').val();
        var fair = $('#fair').val();
        var bad = $('#bad').val();
        var worse = $('#worse').val();
        var id = '<?php echo $i_index ?>';
        //alert(category);

        var error = '';
        if (category == "") {
            error += 'Please select category \n';
            $("#category").focus();
        }
        if (item_name == "") {
            error += 'Please enter item name \n';
            $("#item_name").focus();
        }
        if (location == "") {
            error += 'Please enter location \n';
            $("#location").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_assetsedit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    category: category,
                    item_name: item_name,
                    location: location,
                    excellent: excellent,
                    good: good,
                    fair: fair,
                    bad: bad,
                    worse: worse,
                    id:id
                },
                success: function (text) {
                    //alert(text);

                    $("#success_loc").notify("Assets Added","success");
                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/assets_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#assetsform_div').html(text);
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
                        url: "ajax/tables/assets_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#assetstable_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            KTApp.unblockPage();
                        },
                    });


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


</script>