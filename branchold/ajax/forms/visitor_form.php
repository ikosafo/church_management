<?php include("../../../../config.php"); ?>

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

    <div class="kt-portlet__body">
        <div id="error_loc"></div>
        <div id="success_loc"></div>

        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="full_name">Full Name of Visitor</label>
                <input type="text" class="form-control" id="full_name"
                       placeholder="Enter Full Name of Visitor">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="telephone">Telephone</label>
                <input type="text" class="form-control" id="telephone"
                       placeholder="Enter telephone" onkeypress="return isNumber(event);">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="residence">Residence</label>
                <input type="text" class="form-control" id="residence"
                       placeholder="Enter residence">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="denomination">Current Denomination</label>
                <input type="text" class="form-control" id="denomination"
                       placeholder="Enter denomination">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="hearing_about">How did you hear about us</label>
                <select id="hearing_about" style="width: 100%">
                    <option value="">Select</option>
                    <option value="A Friend">A Friend</option>
                    <option value="Poster">Poster</option>
                    <option value="Flier">Flier</option>
                    <option value="TV">TV</option>
                    <option value="Radio">Radio</option>
                    <option value="Internet">Internet</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="description">Description on your invitation</label>
                <textarea class="form-control" id="description"
                          placeholder="Enter description"></textarea>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-primary" id="save_visitor">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

</form>
<!--end::Form-->



<script>

    $("#hearing_about").select2();

    $("#save_visitor").click(function () {
        var full_name = $("#full_name").val();
        var telephone = $("#telephone").val();
        var residence = $("#residence").val();
        var denomination = $("#denomination").val();
        var hearing_about = $("#hearing_about").val();
        var description = $("#description").val();

        var error = '';
        if (full_name == "") {
            error += 'Please enter full name\n';
            $("#full_name").focus();
        }
        if (telephone == "") {
            error += 'Please enter telephone  \n';
            $("#telephone").focus();
        }
        if (residence == "") {
            error += 'Please enter residence \n';
            $("#residence").focus();
        }
        if (hearing_about == "") {
            error += 'How did you hear about us? \n';
        }
        if (description == "") {
            error += 'Describe how you heard about us \n';
            $("#description").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_visitor.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    full_name: full_name,
                    telephone: telephone,
                    denomination: denomination,
                    residence:residence,
                    hearing_about:hearing_about,
                    description:description
                },
                success: function (text) {
                    //alert(text);
                    if (text == 1) {
                        $('#success_loc').notify("Form submitted","success");
                        $.ajax({
                            url: "ajax/tables/visitor_table.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#visitortable_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/visitor_form.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            success: function (text) {
                                $('#visitorform_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },

                        });

                    } else {
                        $('#error_loc').notify("Visitor details already exists","error");
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
            $('#error_loc').notify(error);
        }
        return false;
    });

</script>