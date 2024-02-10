<?php
include ('../../config.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from customer where cusid = '$theid'");
$resdetails = $getdetails->fetch_assoc();
$theid = $resdetails['cusid'];
?>

<div class="card">
        <div class="card-body">
          
          <h4 class="fw-bolder border-bottom pb-50 mb-1">View Details</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Full Name:</span>
                            <span><?php echo $resdetails['fullname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Email Address:</span>
                            <span><?php echo $resdetails['emailaddress']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Phone Number:</span>
                            <span><?php echo $resdetails['phonenumber']; ?></span>
                        </li>
                    </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Gender:</span>
                            <span><?php echo $resdetails['gender']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Company Name:</span>
                            <span><?php echo $resdetails['companyname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Nationality:</span>
                            <span><?php echo $resdetails['nationality']; ?></span>
                        </li>
                    </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Residence:</span>
                            <span><?php echo $resdetails['residence']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Address:</span>
                            <span><?php echo $resdetails['address']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Addtional Info:</span>
                            <span><?php echo $resdetails['adinfo']; ?></span>
                        </li>
                    </ul>
                </div>
              </div>
             
             
            </div>
            <div class="row">
		        <div class="col-sm-12 offset-sm-12">
                    <button type="button" id="backtocustomers" class="btn btn-outline-primary waves-effect">Back to customers</button>
                </div>
			</div>
          
        </div>
      </div>


<script>
 $("#backtocustomers").click(function(){
        window.location.href="/viewcustomers";
    });
</script>