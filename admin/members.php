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
                                <h4 class="card-title" id="error_loc">Members</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-6">
                                        <select class="form-control kt-select2" id="selectbranch" name="selectbranch">
                                            <option value="">Select Branch</option>
                                            <option value="All">All</option>
                                            <?php
                                            $getmember = $mysqli->query("select * from `branch` ORDER BY `name`");
                                            while ($resmember = $getmember->fetch_assoc()) { ?>
                                                <option value="<?php echo $resmember['id'] ?>"><?php echo $resmember['name'] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div id="pagetable_div"></div>
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
    $("#selectbranch").select2({
        placeholder: "Select Branch",
        allowClear: true
    });
    //Load table

    $("#selectbranch").change(function() {
        var selectbranch = $("#selectbranch").val();
        $.ajax({
            type: "POST",
            url: "ajaxscripts/tables/members.php",
            beforeSend: function() {
                $.blockUI({
                    message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                });
            },
            data: {
                selectbranch: selectbranch
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
    });



    //View member details after icon click
    $(document).on('click', '.viewmemberbtn', function() {
        var id_index = $(this).attr('i_index');
        //alert(id_index);
        $.ajax({
            type: "POST",
            url: "ajaxscripts/forms/viewmember.php",
            data: {
                id_index: id_index
            },
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
    });
</script>