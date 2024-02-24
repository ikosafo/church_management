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

                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Select Branch for <b>Member</b> Details</label>

                            <div class=" col-lg-4 col-md-9 col-sm-12">
                                <select class="form-control kt-select2" id="select_branch" name="param">
                                        <option value="">Select Branch</option>
                                        <option value="All">All</option>
                                    <?php
                                    $getmember = $mysqli->query("select * from branch ORDER BY name");
                                    while ($resmember = $getmember->fetch_assoc()){ ?>
                                        <option value="<?php echo $resmember['id'] ?>"><?php echo $resmember['name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

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


                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

    <!--End::Dashboard 3-->    </div>




<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>
    var KTSelect2 = {
        init: function () {
            $("#select_branch").select2({placeholder: "Select Branch"})
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });


    $("#select_branch").change(function () {
        var select_branch = $("#select_branch").val();
        $.ajax({
            type: "POST",
            url: "ajax/tables/member_table.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            data: {
                select_branch: select_branch
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
    });



    $(document).on('click', '.memberdetailsbtn', function() {
        var id_index = $(this).attr('memberid');
        //alert(id_index);

        $('html, body').animate({
            scrollTop: $("#approval_div").offset().top
        }, 2000);

        $.ajax({
            type: "POST",
            url: "memberdetails.php",
            data: {
                id_index:id_index
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

