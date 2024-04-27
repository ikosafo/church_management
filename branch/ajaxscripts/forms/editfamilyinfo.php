<?php
include('../../../config.php');
$random = rand(1, 10) . date("Y-m-d H:i:s");
$branch = $_SESSION['branch'];
$memberid = $_POST['memberid'];

$getdetails = $mysqli->query("select * from `members` where id = '$memberid'");
$resdetails = $getdetails->fetch_assoc();
?>


<style>
    body {
        overflow-x: hidden !important;
    }
</style>


<form autocomplete="off">

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="nextofkin">Next of Kin </label>
            <input type="text" id="nextofkin" class="form-control" placeholder="Next of Kin" value="<?php echo $resdetails['nextofkin'] ?>" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="nextofkinphone">Telephone of Next of Kin</label>
            <input type="number" id="nextofkinphone" class="form-control" placeholder="Telephone of Next of Kin" value="<?php echo $resdetails['nextofkinphone'] ?>" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="spousename">Name of Spouse </label>
            <input type="text" id="spousename" class="form-control" placeholder="Name of Spouse" value="<?php echo $resdetails['spousename'] ?>" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="spousephone">Telephone of Spouse</label>
            <input type="number" id="spousephone" class="form-control" placeholder="Telephone of Spouse" value="<?php echo $resdetails['spousephone'] ?>" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="fathersname">Father's Name </label>
            <input type="text" id="fathersname" class="form-control" placeholder="Father's Name" value="<?php echo $resdetails['fathersname'] ?>" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="fathersphone">Father's Telephone</label>
            <input type="number" id="fathersphone" class="form-control" placeholder="Father's Telephone" value="<?php echo $resdetails['fathersphone'] ?>" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="mothersname">Mother's Name </label>
            <input type="text" id="mothersname" class="form-control" placeholder="Mother's Name" value="<?php echo $resdetails['mothersname'] ?>" />
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="mothersphone">Mother's Telephone</label>
            <input type="number" id="mothersphone" class="form-control" placeholder="Mother's Telephone" value="<?php echo $resdetails['mothersphone'] ?>" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="childrennumber">Number of Children</label>
            <input type="number" id="childrennumber" class="form-control" placeholder="Number of Children" value="<?php echo $resdetails['childrennumber'] ?>" />
        </div>
    </div>


    <div class="d-flex justify-content-between mt-2">

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
    /*    $("#familyinfoprevbtn").click(function() {
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
 */
    //PERSONAL INFORMATION
    $("#familyinfobtn").on("click", (function() {

        var spousename = $("#spousename").val();
        var spousephone = $("#spousephone").val();
        var fathersname = $("#fathersname").val();
        var fathersphone = $("#fathersphone").val();
        var mothersname = $("#mothersname").val();
        var mothersphone = $("#mothersphone").val();
        var childrennumber = $("#childrennumber").val();
        var nextofkin = $("#nextofkin").val();
        var nextofkinphone = $("#nextofkinphone").val();
        var memberid = '<?php echo $memberid; ?>';

        $.ajax({
            type: "POST",
            url: "ajaxscripts/queries/edit/memberfamily.php",
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
                childrennumber,
                memberid,
                nextofkin,
                nextofkinphone
            },
            success: function(text) {
                alert("Member information Updated");
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