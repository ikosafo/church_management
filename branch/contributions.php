<?php require('includes/header.php');
$financialtype = 'Contributions';
?>

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
                                    Financials
                                    <small>Contributions</small>
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="member_table_div"></div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="approval_div"></div>
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
        type: "POST",
        url: "ajax/tables/memberfin_table.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        data: {
            financialtype: '<?php echo $financialtype ?>'
        },
        success: function (text) {
            $('#member_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });

    $(document).on('click', '.paycontributions_btn', function() {
        var id_index = $(this).attr('i_index');
        var branch = '<?php echo $_SESSION['branch']; ?>';

        $('html, body').animate({
            scrollTop: $("#approval_div").offset().top
        }, 2000);

        $.ajax({
            type: "POST",
            url: "paycontributions_member.php",
            data: {
                id_index:id_index,
                branch:branch
            },
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            success: function (text) {
                $('#approval_div').html(text);
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

