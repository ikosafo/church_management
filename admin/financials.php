<?php require('includes/header.php');

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
                                    <small>Search</small>
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__label">
                                    <label>Select Branch:</label>
                                </div>
                                <select class="form-control kt-select2" id="select_branch" name="param">
                                    <option value="">Select Branch</option>
                                    <option value="All">All</option>
                                    <?php
                                    $getconvert = $mysqli->query("select * from branch ORDER BY name");
                                    while ($resconvert = $getconvert->fetch_assoc()){ ?>
                                        <option value="<?php echo $resconvert['id'] ?>"><?php echo $resconvert['name'] ?></option>
                                    <?php } ?>

                                </select>
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

                            <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Select Type:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="fin_type">
                                            <option value="">Select...</option>
                                            <option value="Special Offerings/Seeds">Special Offerings/Seeds</option>
                                            <option value="Tithe">Tithe</option>
                                            <option value="Welfare">Welfare</option>
                                            <option value="First Fruit">First Fruit</option>
                                            <option value="Contributions">Contributions</option>
                                            <option value="Ministry Partners">Ministry Partners</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <button type="button" id="load_btn" class="btn btn-primary">
                                        Click to Load
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="attendance_table_div"></div>
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <div class="col-md-12">
                                <div id="approval_div"></div>
                            </div>
                        </div>-->

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
    var KTSelect2 = {
        init: function () {
            $("#select_branch").select2({placeholder: "Select Branch"})
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });

    $('#datefrom').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $('#dateto').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $("#load_btn").click(function(){
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var fin_type = $("#fin_type").val();
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
        if (fin_type == "") {
            error += 'Please select financial type \n';
            $("#fin_type").focus();
        }
        if (datefrom > dateto) {
            error += 'Please select correct date range \n';
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/financials_search.php",
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
                    fin_type:fin_type,
                    select_branch:select_branch
                },
                success: function (text) {
                    $('#attendance_table_div').html(text);
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


    $("#fin_type").selectpicker();


</script>

