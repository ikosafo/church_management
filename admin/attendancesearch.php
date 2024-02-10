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

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Select Branch</label>
                                    </div>
                                    <select class="form-control kt-select2" id="select_branch" name="param">
                                        <option value="">Select Branch</option>
                                        <option value="All">All</option>
                                        <?php
                                        $getmeeting = $mysqli->query("select * from branch ORDER BY name");
                                        while ($resmeeting = $getmeeting->fetch_assoc()){ ?>
                                            <option value="<?php echo $resmeeting['id'] ?>"><?php echo $resmeeting['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Select Date From:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input type="text" class="form-control" id="datefrom"
                                               placeholder="Select Start Period" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Select Date To:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input type="text" class="form-control" id="dateto"
                                               placeholder="Select Start Period" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Search Query:</label>
                                    </div>
                                    <button type="button" id="load_btn" class="btn btn-primary">
                                        Click to load Data
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="meeting_table_div"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>
    var KTSelect2 = {
        init: function () {
            $("#select_branch").select2({placeholder: "Select Branch"});
            $('#datefrom').datetimepicker().on('change', function(){
                $('.datetimepicker').hide();
            });

            $('#dateto').datetimepicker().on('change', function(){
                $('.datetimepicker').hide();
            });
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });


    $("#load_btn").click(function(){
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var select_branch = $("#select_branch").val();

        var error = '';
        if (select_branch == "") {
            error += 'Please select branch \n';
            $("#select_branch").focus();
        }
        if (datefrom == "") {
            error += 'Please select search start date \n';
            $("#datefrom").focus();
        }
        if (dateto == "") {
            error += 'Please select search end date \n';
            $("#dateto").focus();
        }
        if (datefrom > dateto) {
            error += 'Please select correct date range \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/attendance_search_meeting.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    datefrom: datefrom,
                    dateto:dateto,
                    select_branch:select_branch
                },
                success: function (text) {
                    $('#meeting_table_div').html(text);
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

