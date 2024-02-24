<?php $memberid = $_POST['id_index']; ?>
<section class="vertical-wizard">
    <div class="bs-stepper vertical vertical-wizard-example">
        <div class="bs-stepper-header">
            <div class="step active" data-target="#personalinfo" role="tab" id="product-details-trigger">
                <button type="button" class="step-trigger" aria-selected="true">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">General Information</span>
                        <span class="bs-stepper-subtitle">Edit Personal Details</span>
                    </span>
                </button>
            </div>
            <div class="step" data-target="#familyinfo" role="tab" id="familyinfo-trigger">
                <button type="button" class="step-trigger" disabled="disabled">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Family Information</span>
                        <span class="bs-stepper-subtitle">Edit Family Details</span>
                    </span>
                </button>
            </div>

        </div>
        <div class="bs-stepper-content">
            <div id="personalinfo" class="content active dstepper-block" role="tabpanel" aria-labelledby="personal-details-trigger">
                <div class="content-header">
                    <h5 class="mb-0">General Information</h5>
                    <small class="text-muted">Enter Your Personal Details</small>
                </div>
                <div class="dropdown-divider mb-2"></div>
                <div id="personalinfodiv"></div>
            </div>
            <div id="familyinfo" class="content" role="tabpanel" aria-labelledby="familyinfo-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Family Information</h5>
                    <small>Family Details</small>
                </div>
                <div class="dropdown-divider mb-2"></div>
                <div id="familyinfodiv"></div>
            </div>
        </div>
    </div>
</section>


<script>
    //Personal Information
    var memberid = '<?php echo $memberid; ?>';

    $.ajax({
        type: "POST",
        url: "ajaxscripts/forms/editpersonalinfo.php",
        data: {
            memberid
        },
        success: function(text) {
            $('#personalinfodiv').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function() {
            $.unblockUI();
        },
    });

    //Address Information
    $.ajax({
        type: "POST",
        url: "ajaxscripts/forms/editfamilyinfo.php",
        data: {
            memberid
        },
        success: function(text) {
            $('#familyinfodiv').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function() {
            $.unblockUI();
        },
    });
</script>