<?php include('includes/header.php') ?>

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">

        <div class="content-body">

            <?php /*echo $mainreg; */ ?>
            <section class="vertical-wizard">
                <div class="bs-stepper vertical vertical-wizard-example">
                    <div class="bs-stepper-header">
                        <div class="step active" data-target="#productinfo" role="tab" id="product-details-trigger">
                            <button type="button" class="step-trigger" aria-selected="true">
                                <span class="bs-stepper-box">1</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Product Details</span>
                                    <span class="bs-stepper-subtitle">Add Product Details</span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#productsummary" role="tab" id="productsummary-trigger">
                            <button type="button" class="step-trigger" disabled="disabled">
                                <span class="bs-stepper-box">2</span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Summary</span>
                                    <span class="bs-stepper-subtitle">Review Product</span>
                                </span>
                            </button>
                        </div>

                    </div>
                    <div class="bs-stepper-content">
                        <div id="productinfo" class="content active dstepper-block" role="tabpanel" aria-labelledby="product-details-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">Product Information</h5>
                                <small class="text-muted">Enter Your Product Details</small>
                            </div>
                            <div class="dropdown-divider mb-2"></div>
                            <div id="productsinfodiv"></div>
                        </div>
                        <div id="productsummary" class="content" role="tabpanel" aria-labelledby="productsummary-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">Summary</h5>
                                <small>Product Summary</small>
                            </div>
                            <div class="dropdown-divider mb-2"></div>
                            <div id="productsummarydiv"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->

<?php include('includes/footer.php'); ?>


<script>
    //Personal Information
    $.ajax({
        url: "ajaxscripts/forms/addproduct.php",
        success: function(text) {
            $('#productsinfodiv').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
    });

    //Address Information
    $.ajax({
        url: "ajaxscripts/forms/productsummary.php",
        success: function(text) {
            $('#productsummarydiv').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
    });
</script>