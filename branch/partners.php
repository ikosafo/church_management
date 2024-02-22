<?php include('includes/header.php');
$financialtype = 'Partners';
?>


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
                                <h4 class="card-title" id="error_loc">Partners</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div id="pageform_div"></div>
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

                </div>
            </section>
            <!-- Basic Horizontal form layout section end -->



        </div>
    </div>
</div>

<!-- END: Content-->


<?php include('includes/footer.php') ?>


<script>
    $.ajax({
        type: "POST",
        url: "ajaxscripts/forms/financials.php",
        beforeSend: function() {
            $.blockUI({
                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
            });
        },
        data: {
            financialtype: '<?php echo $financialtype ?>'
        },
        success: function(text) {
            //alert(text);
            $('#pageform_div').html(text);

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function() {
            $.unblockUI();
        },
    });

    $(document).on('click', '.paypartners_btn', function() {
        var id_index = $(this).attr('i_index');
        var branch = '<?php echo $_SESSION['branch']; ?>';
        //alert(id_index + ' ' + branch);

        $('html, body').animate({
            scrollTop: $("#approval_div").offset().top
        }, 2000);

        $.ajax({
            type: "POST",
            url: "partnerspayment.php",
            data: {
                id_index: id_index,
                branch: branch
            },
            beforeSend: function() {
                $.blockUI({
                    message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                });
            },
            success: function(text) {
                $('#approval_div').html(text);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function() {
                $.unblockUI();
            },

        });


    });
</script>