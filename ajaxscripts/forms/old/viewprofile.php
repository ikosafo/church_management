<?php
include ('../../config.php');
include ('../../functions.php');
$username = $_SESSION['username'];
$getdetails = $mysqli->query("select * from staff where username = '$username'");
$resdetails = $getdetails->fetch_assoc();

?>

<div class="card">
        <div class="card-body">
          
            <div class="row">
              <div class="col-md-6">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Full Name:</span>
                            <span><?php echo $resdetails['fullname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Gender:</span>
                            <span><?php echo $resdetails['gender']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Birth Date:</span>
                            <span><?php echo $resdetails['birthdate']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Telephone:</span>
                            <span><?php echo $resdetails['telephone']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Email Address:</span>
                            <span><?php echo $resdetails['emailaddress']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Residence:</span>
                            <span><?php echo $resdetails['residence']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Address:</span>
                            <span><?php echo $resdetails['address']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Educational Background:</span>
                            <span><?php echo $resdetails['educationallevel']; ?></span>
                        </li>
                    </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">ID Type:</span>
                            <span><?php echo $resdetails['idtype']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">ID Number:</span>
                            <span><?php echo $resdetails['idnumber']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Hometowm:</span>
                            <span><?php echo $resdetails['hometown']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Staff ID:</span>
                            <span><?php echo $resdetails['staffid']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Nationality:</span>
                            <span><?php echo $resdetails['nationality']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Position:</span>
                            <span><?php echo $resdetails['position']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Religion:</span>
                            <span><?php echo $resdetails['religion']; ?></span>
                        </li>
                        
                    </ul>
                </div>
              </div>
             
             
            </div>
           
            <?php
              $getlog = $mysqli->query("select * from logs where user = '$username' ORDER BY logid DESC LIMIT 5");?>
            <div class="row mt-3">
                <div class="table-responsive"> 
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Section</th>
                            <th>Activity</th>
                            <th>Date Time</th>
                            <th>Status</th>
                            <th>IP</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($reslog = $getlog->fetch_assoc()) { ?>
                         <tr>
                            <td><?php echo $reslog['section'] ?></td>
                            <td><?php echo $reslog['message'] ?></td>
                            <td><?php echo $reslog['logdate'] ?></td>
                            <td><?php echo $reslog['action'] ?></td>
                            <td><?php echo $reslog['ipaddress'] ?></td>
                           
                          </tr>
                        <?php }
                        ?>
                        
                         
                        </tbody>
                      </table>
                    </div>

                    <div class="row mt-2 ml-5">
                        <div class="col-sm-12 offset-sm-12">
                            <button type="button" id="viewlogs" 
                            class="btn btn-sm btn-outline-primary waves-effect">View all logs</button>
                        </div>
                    </div>
            </div>
          
        </div>
      </div>


<script>
 $("#viewlogs").click(function(){
        window.location.href="/userlogs";
    });
</script>