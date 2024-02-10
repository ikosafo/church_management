<?php
include('../../config.php');
include('../../functions.php');
$getdetails = $mysqli->query("select * from products ORDER BY prodid DESC LIMIT 1");
$resdetails = $getdetails->fetch_assoc();
$prodid = $resdetails['prodid'];

?>


<div class="row">
    <div class="col-md-6">
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-75">
                    <span class="fw-bolder me-25">Product Name:</span>
                    <span><?php echo $resdetails['productname']; ?></span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Quantity:</span>
                    <span><?php echo $resdetails['quantity']; ?></span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Low stock threshold:</span>
                    <span><?php echo $resdetails['stockthreshold']; ?></span>
                </li>

                <li class="mb-75">
                    <span class="fw-bolder me-25">Supplier:</span>
                    <span><?php echo $resdetails['supplier']; ?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-75">
                    <span class="fw-bolder me-25">Expiry Date:</span>
                    <span><?php echo $resdetails['expirydate']; ?></span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Variations:</span>
                    <span><?php echo $resdetails['variations']; ?></span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Cost Price:</span>
                    <span><?php echo $resdetails['costprice']; ?></span>
                </li>

                <li class="mb-75">
                    <span class="fw-bolder me-25">Selling Price:</span>
                    <span><?php echo $resdetails['sellingprice']; ?></span>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between mt-2">
    <button i_index=<?php echo $prodid; ?> class="editproductbtn btn btn-secondary waves-effect waves-float waves-light" id="editproduct">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        <span class="align-middle d-sm-inline-block d-none">Edit Product</span>
    </button>
    <button id="addnewproduct" class="btn btn-success waves-effect waves-float waves-light">
        <span class="align-middle d-sm-inline-block d-none">Add New</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ms-sm-25 ms-0">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
    </button>
</div>



<script>
    $("#addnewproduct").click(function() {
        window.location.href = "/addproduct";
    });

    //Edit product after icon click
    $(document).on('click', '.editproductbtn', function() {
        var id_index = $(this).attr('i_index');
        //alert(id_index);
        $.ajax({
            type: "POST",
            url: "ajaxscripts/forms/editproduct.php",
            data: {
                id_index: id_index
            },
            beforeSend: function() {
                $.blockUI({
                    message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                });
            },
            success: function(text) {
                var stepper = new Stepper(document.querySelector('.bs-stepper'))
                stepper.to(1);
                $('#productsinfodiv').html(text);
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