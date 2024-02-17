<?php
include('../../../config.php');
$random = rand(1, 10) . date("Y-m-d");
$branch = $_SESSION['branch'];
?>

<style>
    .requiredtext {
        font-size: 11px;
        margin-bottom: 10px;
    }

    .required {
        color: red
    }

    body {
        overflow-x: hidden !important;
    }
</style>

<label class="requiredtext">Field marked <span class="required"> * </span> are required</label>
<form autocomplete="off">

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="spousename">Name of Spouse </label>
            <input type="text" id="spousename" class="form-control" placeholder="Name of Spouse" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="spousephone">Telephone of Spouse</label>
            <input type="number" id="spousephone" class="form-control" placeholder="Telephone of Spouse" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="fathersname">Father's Name </label>
            <input type="text" id="fathersname" class="form-control" placeholder="Father's Name" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="fathersphone">Father's Telephone</label>
            <input type="number" id="fathersphone" class="form-control" placeholder="Father's Telephone" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="mothersname">Mother's Name </label>
            <input type="text" id="mothersname" class="form-control" placeholder="Mother's Name" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="mothersphone">Mother's Telephone</label>
            <input type="number" id="mothersphone" class="form-control" placeholder="Mother's Telephone" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="childrennumber">Number of Children <span class="required"> * </span></label>
            <input type="number" id="childrennumber" class="form-control" placeholder="Number of Children" />
        </div>
    </div>


    <div class="d-flex justify-content-between mt-2">
        <button id="familyinfoprevbtn" class="btn btn-outline-secondary btn-prev waves-effect">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button id="familyinfobtn" class="btn btn-success waves-effect waves-float waves-light">
            <span class="align-middle d-sm-inline-block d-none">Finished</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ms-sm-25 ms-0">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>

</form>


<script>
    $("#familyinfoprevbtn").click(function() {
        $.ajax({
            url: "ajaxscripts/forms/editpersonalinfo.php",
            success: function(text) {
                $('#personalinfodiv').html(text);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
        });
        stepper.to(1);
    });

    //PERSONAL INFORMATION
    $("#familyinfobtn").on("click", (function() {

        var spousename = $("#spousename").val();
        var spousephone = $("#spousephone").val();
        var fathersname = $("#fathersname").val();
        var fathersphone = $("#fathersphone").val();
        var mothersname = $("#mothersname").val();
        var mothersphone = $("#mothersphone").val();
        var childrennumber = $("#childrennumber").val();

        $.ajax({
            type: "POST",
            url: "ajaxscripts/queries/save/memberfamily.php",
            beforeSend: function() {
                $.blockUI({
                    message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                });
            },
            data: {
                spousename,
                spousephone,
                fathersname,
                fathersphone,
                mothersname,
                mothersphone,
                childrennumber
            },
            success: function(text) {
                alert("Member information saved");

                location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function() {
                $.unblockUI();
            },
        });
        return false;

    }))
</script>