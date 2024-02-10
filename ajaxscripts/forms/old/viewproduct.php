<?php
include('../../config.php');
include('../../functions.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from products where prodid = '$theid'");
$resdetails = $getdetails->fetch_assoc();

?>

<div class="card">
    <div class="card-body">

        <h4 class="fw-bolder border-bottom pb-50 mb-1">View Details</h4>
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
        <div class="row">
            <div class="col-sm-12 offset-sm-12">
                <button type="button" id="backtoproducts" class="btn btn-outline-primary waves-effect">Back to products</button>
            </div>
        </div>

    </div>
</div>


<script>
    $("#backtoproducts").click(function() {
        window.location.href = "/viewproducts";
    });
</script>