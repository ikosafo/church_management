<?php include('includes/header.php') ?>

<style>
    body,
    html {
        overflow-x: hidden;
    }
</style>


<!-- BEGIN: Content-->

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">

        <div class="content-body"><!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="error_loc">Account Search</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                        <label class="form-label" for="datefrom">Select Date From: </label>
                                        <input type="text" class="form-control" id="datefrom" placeholder="Select Start Period" autocomplete="off">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                        <label class="form-label" for="dateto">Select Date To: </label>
                                        <input type="text" class="form-control" id="dateto" placeholder="Select End Period" autocomplete="off">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                        <label class="form-label" for="dateto">Select Type: </label>
                                        <select class="form-control bootstrap-select" id="acc_type">
                                            <option></option>
                                            <option value="Receivals">Receivals</option>
                                            <option value="Payments">Payments</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                        <label class="form-label">Search Query:</label>
                                        <button type="button" id="load_btn" class="btn btn-primary">
                                            Click to load Data
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div id="search_table_div"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Basic Horizontal form layout section end -->



        </div>
    </div>
</div>

<!-- END: Content-->


<?php include('includes/footer.php') ?>


<script>
    $("#datefrom").flatpickr();
    $("#dateto").flatpickr();
    $("#acc_type").select2({
        placeholder: "Select Type",
        allowClear: true
    });


    $("#load_btn").click(function() {
        var datefrom = $("#datefrom").val();
        var dateto = $("#dateto").val();
        var acc_type = $("#acc_type").val();

        var error = '';
        if (datefrom == "") {
            error += 'Please select search start date \n';
            $("#datefrom").focus();
        }
        if (dateto == "") {
            error += 'Please select search end date \n';
            $("#dateto").focus();
        }
        if (acc_type == "") {
            error += 'Please select account type \n';
            $("#acc_type").focus();
        }
        if (datefrom > dateto) {
            error += 'Please select correct date range \n';
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/search/accounts.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    datefrom: datefrom,
                    dateto: dateto,
                    acc_type: acc_type
                },
                success: function(text) {
                    $('#search_table_div').html(text);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $.notify(error, {
                position: "top center"
            });
        }
        return false;
    });
</script>