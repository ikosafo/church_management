
<?php include ('includes/header.php') ?>


<!-- BEGIN: Content-->

<div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        
        <div class="content-body"><!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-12 col-12">
                    <div class="card" id="error_loc">
                        <div class="card-body">
                            <div id="pageform_div"></div>
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
  
   //Load category form
    $.ajax({
        url: "ajaxscripts/forms/changepassword.php",
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


   
</script>   


