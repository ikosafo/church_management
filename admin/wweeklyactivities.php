<?php require('includes/header.php') ?>

<!-- begin:: Subheader -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader"></div>
<!-- end:: Subheader -->


<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Applications/User/Profile3-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__body">

                        <div class="kt-portlet__head kt-portlet__head--lg mb-4">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Website
                                    <small>Weekly Activities</small>
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->

                        <div class="form-group row">
                            <div class="col-md-5 col-xs-12 col-sm-12">
                                <div id="wwaform_div"></div>
                            </div>
                            <div class="col-md-7 col-xs-12 col-sm-12">
                                <div id="wwatable_div"></div>
                            </div>
                        </div>
                        <!--end::Form-->

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

</div>
<!--End::Dashboard 3-->
<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>

    $.ajax({
        url: "ajax/forms/wa_form.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function (text) {
            $('#wwaform_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });


    $.ajax({
        url: "ajax/tables/wa_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function (text) {
            $('#wwatable_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });

</script>

