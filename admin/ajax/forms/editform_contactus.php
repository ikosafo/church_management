<?php include ('../../../../config.php');
$random = rand(1,10000).date("Ymd");
$id = $_POST['i_index'];

$getdetails = $mysqli->query("select * from website_contactus where id = '$id'");
$resdetails = $getdetails->fetch_assoc();
?>
<!--begin::Form-->

<form class="" autocomplete="off">
    <div class="kt-portlet__body">

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="address">Address</label>
                <textarea class="form-control" id="address"
                         placeholder="Enter Address"><?php echo $resdetails['address'] ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="telephone">Telephone</label>
                <textarea class="form-control" id="telephone" 
                          placeholder="Enter Telephone"><?php echo $resdetails['telephone'] ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="alttelephone">Alternate Telephone</label>
                <textarea class="form-control" id="alttelephone" 
                          placeholder="Enter Alternate Telephone"><?php echo $resdetails['alttelephone'] ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="mail">Mail</label>
                <textarea class="form-control" id="mail"
                         placeholder="Enter Post Address"><?php echo $resdetails['mail'] ?></textarea>
            </div>
        </div>

    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <button type="button" class="btn btn-primary" id="savecontactus">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
</form>
<!--end::Form-->

<script>
    $("#savecontactus").click(function () {
        var address = $("#address").val();
        var telephone = $("#telephone").val();
        var alttelephone = $("#alttelephone").val();
        var mail = $("#mail").val();
        var id = '<?php echo $id; ?>';

        var error = '';
        if (address == "") {
            error += 'Please enter address \n';
            $("#address").focus();
        }
        if (telephone == "") {
            error += 'Please enter telephone \n';
            $("#telephone").focus();
        }
        if (alttelephone == "") {
            error += 'Please enter alternate telephone \n';
            $("#alttelephone").focus();
        }
        if (mail == "") {
            error += 'Please enter post address \n';
            $("#mail").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_contactus_edit.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    address: address,
                    mail:mail,
                    telephone:telephone,
                    alttelephone:alttelephone,
                    id:id
                },
                success: function (text) {
                    if (text == 1) {
                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/contactus_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#contactusform_div').html(text);
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
                            url: "ajax/tables/contactus_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#contactustable_div').html(text);
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
                        $.notify("Contact Us information already exist", {position: "top center"});
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
            $.notify(error, {position: "top center"});
        }
        return false;
    });

</script>