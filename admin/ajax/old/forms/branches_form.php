<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="branch_name">Select User Branch</label>
                <select id="branch_name" style="width: 100%">
                    <option value="">Select User Branch</option>
                    <?php $getbranch = $mysqli->query("select * from branch order by name");
                       while ($resbranch = $getbranch->fetch_assoc()) { ?>
                           <option value="<?php echo $resbranch['id'] ?>"><?php echo $resbranch['name'] ?></option>
                      <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="pastor">Branch Pastor</label>
                <input type="text" class="form-control" id="pastor"
                       placeholder="Enter Pastor's Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="telephone">Telephone</label>
                <input type="text" class="form-control" id="telephone"
                       placeholder="Enter Telephone">
            </div>
        </div>
        <div class="form-group">
            <label>Branch Image</label>
            <input type="file" class="form-control" id="page_image">
            <input type="hidden" id="selected"/>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savebranches">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->

<script>
    $("#branch_name").select2({placeholder:'Select Branch'});

    $(".summernote").summernote({
        placeholder: 'Enter Page text here',
        tabsize: 2,
        height: 100
    });

    $('#page_image').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {'randno': '<?php echo $random?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_branches_image.php',
        'onUploadComplete': function (file, data) {
            console.log(data);
        },
        'onSelect': function (file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
        },
        'onCancel': function (file) {
            // Update selected so we know they have no file selected
            $("#selected").val('');
        }
    });

    $("#savebranches").click(function () {
        var branchid = $("#branch_name").val();
        var pastor = $("#pastor").val();
        var telephone = $("#telephone").val();
        var selected = $("#selected").val();
        var imageid = '<?php echo $random; ?>';
        

        var error = '';
        if (branchid == "") {
            error += 'Please select branch \n';
            $("#branchid").focus();
        }
        if (pastor == "") {
            error += 'Please enter name of pastor \n';
            $("#pastor").focus();
        }
        if (telephone == "") {
            error += 'Please enter telephone \n';
            $("#telephone").focus();
        }
        if (selected == "") {
            error += 'Please upload image\n';
            $("#page_text").focus();
        }
        //alert(branchid);

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_branches.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    pastor: pastor,
                    telephone: telephone,
                    imageid:imageid,
                    branchid:branchid
                },
                success: function (text) {
                    alert(text);
                    $('#page_image').uploadifive('upload');
                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/branches_form.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#branchesform_div').html(text);
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
                        url: "ajax/tables/branches_table.php",
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function (text) {
                            $('#branchestable_div').html(text);
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
            $.notify(error, {position: "top center"});
        }
        return false;
    });

</script>