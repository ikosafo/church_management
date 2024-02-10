<?php include('includes/header.php') ?>


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
                                <h4 class="card-title">Sales</h4>
                            </div>
                            <div class="card-body">
                                <div id="pagetable_div"></div>
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
    //Load customer table
    $.ajax({
        url: "ajaxscripts/tables/currentsales.php",
        beforeSend: function() {
            $.blockUI({
                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
            });
        },
        success: function(text) {
            $('#pagetable_div').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function() {
            $.unblockUI();
        },

    });

    //Print receipt button on index page
    $(document).on('click', '.printreceipt', function() {
        var id_index = $(this).attr('i_index');
        //alert(id_index);
        // Create a form dynamically
        var form = $('<form action="printreceiptsales.php" method="POST"></form>');
        form.append('<input type="hidden" name="newsaleid" value="' + id_index + '">');

        // Append the form to the body and submit it
        $('body').append(form);
        form.submit();

    });
</script>