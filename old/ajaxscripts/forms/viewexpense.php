<?php
include('../../config.php');
include('../../functions.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from expenses where expid = '$theid'");
$resdetails = $getdetails->fetch_assoc();

?>

<div class="card">
    <div class="card-body">

        <h4 class="fw-bolder border-bottom pb-50 mb-1">View Details</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Date of Expense:</span>
                            <span><?php echo $resdetails['expdate']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Amount:</span>
                            <span><?php echo $resdetails['amount']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Payment Mode:</span>
                            <span><?php echo $resdetails['paymentmode']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Receipient:</span>
                            <span><?php echo $resdetails['receipient']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Approved By:</span>
                            <span><?php echo $resdetails['approvedby']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Reason for Payment:</span>
                            <span><?php echo $resdetails['reason']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-container">
                    <ul class="list-unstyled">

                        <li class="mb-75">
                            <span class="fw-bolder me-25">Description:</span>
                            <span><?php echo $resdetails['description']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Date of Entry:</span>
                            <span><?php echo $resdetails['datetime']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-12 offset-sm-12">
                <button type="button" id="backtoexpenses" class="btn btn-outline-primary waves-effect">Back to expenses</button>
            </div>
        </div>

    </div>
</div>


<script>
    $("#backtoexpenses").click(function() {
        window.location.href = "/viewexpenses";
    });
</script>