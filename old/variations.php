
<?php include ('includes/header.php') ?>


<!-- BEGIN: Content-->

<div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        
        <div class="content-body"><!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-5 col-12">
                    <div class="card" id="error_loc">
                        <div class="card-header">
                            <h4 class="card-title">Product Variations</h4>
                        </div>
                        <div class="card-body">
                            <div id="pageform_div"></div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-7 col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">Variations</h4>
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


<?php include ('includes/footer.php') ?>


<script>
  
   //Load variation form
    $.ajax({
        url: "ajaxscripts/forms/addvariation.php",
        beforeSend: function () {
            $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
        },
        success: function (text) {
            $('#pageform_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });


    //Load variation table
    $.ajax({
        url: "ajaxscripts/tables/variations.php",
        beforeSend: function () {
            $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
        },
        success: function (text) {
            $('#pagetable_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });


    //Edit variation after icon click
    $(document).on('click', '.editvariationbtn', function() {
        var id_index = $(this).attr('i_index');
        //alert(id_index);
            $.ajax({
                type: "POST",
                url: "ajaxscripts/forms/editvariation.php",
                data: {
                    id_index: id_index
                },
                beforeSend: function () {
                    $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                success: function (text) {
                    $('#pageform_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },

            });

    });


    //Delete variation after icon click
    $(document).off('click', '.deletevariationbtn').on('click', '.deletevariationbtn', function () {
        var theindex = $(this).attr('i_index');
        
        $.confirm({
            title: 'Delete Record!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajaxscripts/queries/delete/variations.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajaxscripts/tables/variations.php",
                                    beforeSend: function () {
                                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                                    },
                                    success: function (text) {
                                        $('#pagetable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        $.unblockUI();
                                    },

                                });
                            },

                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });


    });


    


</script>   


