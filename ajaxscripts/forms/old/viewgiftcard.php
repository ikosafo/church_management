<?php
include ('../../config.php');
include ('../../functions.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from giftcard g JOIN customer c ON g.customerid = c.cusid 
                            where g.giftid = '$theid'");
$resdetails = $getdetails->fetch_assoc();

?>

<div class="card">
        <div class="card-body">
          
          <h4 class="fw-bolder border-bottom pb-50 mb-1">View Details</h4>
            <div class="row">
              <div class="col-md-12">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Customer Name:</span>
                            <span><?php echo $resdetails['fullname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Giftcard Number:</span>
                            <span><?php echo $resdetails['giftnumber']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Giftcard Value:</span>
                            <span><?php echo $resdetails['giftvalue']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Description:</span>
                            <span><?php echo $resdetails['description']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Period Added:</span>
                            <span><?php echo $resdetails['datetime'].' ('.time_elapsed_string($resdetails['datetime']).')'; ?></span>
                        </li>
                      
                    </ul>
                </div>
              </div>
            
             
            </div>
            <div class="row">
		        <div class="col-sm-12 offset-sm-12">
                    <button type="button" id="backtogiftcards" class="btn btn-outline-primary waves-effect">Back to gift cards</button>
                </div>
			</div>
          
        </div>
      </div>


<script>
 $("#backtogiftcards").click(function(){
        window.location.href="/giftcard";
    });
</script>