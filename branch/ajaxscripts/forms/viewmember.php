<?php
include('../../../config.php');
include('../../../functions.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from `members` where id = '$theid'");
$resdetails = $getdetails->fetch_assoc();

?>

<div class="card">
    <div class="card-body">

        <h4 class="fw-bolder border-bottom pb-50 mb-1">View Details</h4>
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Full Name:</span>
                            <span><?php echo $resdetails['fullname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Maiden Name:</span>
                            <span><?php echo $resdetails['maidenname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Telephone:</span>
                            <span><?php echo $resdetails['telephone']; ?></span>
                        </li>

                        <li class="mb-75">
                            <span class="fw-bolder me-25">Date of Birth:</span>
                            <span><?php echo $resdetails['dob']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Age:</span>
                            <span><?php echo $resdetails['age']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Birth Place:</span>
                            <span><?php echo $resdetails['birthplace']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Gender:</span>
                            <span><?php echo $resdetails['gender']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">GPS Address:</span>
                            <span><?php echo $resdetails['gpsaddress']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Residence:</span>
                            <span><?php echo $resdetails['location']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="info-container">
                    <ul class="list-unstyled">


                        <li class="mb-75">
                            <span class="fw-bolder me-25">Hometown:</span>
                            <span><?php echo $resdetails['hometown']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Nationality:</span>
                            <span><?php echo $resdetails['nationality']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Communicant:</span>
                            <span><?php echo $resdetails['communicant']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Date of Baptism:</span>
                            <span><?php echo $resdetails['baptismdate']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Confirmation Date:</span>
                            <span><?php echo $resdetails['confirmationdate']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Email Address:</span>
                            <span><?php echo $resdetails['emailaddress']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Occupation:</span>
                            <span><?php echo $resdetails['occupation']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Place of Work:</span>
                            <span><?php echo $resdetails['placeofwork']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Society:</span>
                            <span><?php
                                    @$getsociety = $mysqli->query("SELECT * FROM ministry WHERE id = '{$resdetails['society']}'");
                                    @$ressociety = $getsociety->fetch_assoc();
                                    echo @$ressociety['ministry_name'] ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="list-unstyled">
                    <li class="mb-75">
                        <span class="fw-bolder me-25">Picture:</span>
                        <span><?php
                                $memberid = $resdetails['random'];
                                $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                $resimage = $getimage->fetch_assoc();
                                @$theimage = $resimage['image_location'];
                                if ($theimage != "") { ?>
                                <img style="width: 100px;height: 100px" src="../../<?php echo $theimage ?>">
                            <?php } else {
                                    echo "";
                                }
                            ?></span>
                    </li>
                </ul>
            </div>
        </div>


        <h5 class="fw-bolder border-bottom pb-50 mb-1 mt-3">FAMILY</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Name of Spouse:</span>
                            <span><?php echo $resdetails['spousename']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Spouse's Phone:</span>
                            <span><?php echo $resdetails['spousephone']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Father's Name:</span>
                            <span><?php echo $resdetails['fathersname']; ?></span>
                        </li>

                        <li class="mb-75">
                            <span class="fw-bolder me-25">Father's Phone:</span>
                            <span><?php echo $resdetails['fathersphone']; ?></span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-container">
                    <ul class="list-unstyled">

                        <li class="mb-75">
                            <span class="fw-bolder me-25">Mother's Name:</span>
                            <span><?php echo $resdetails['mothersname']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Mother's Phone:</span>
                            <span><?php echo $resdetails['mothersphone']; ?></span>
                        </li>
                        <li class="mb-75">
                            <span class="fw-bolder me-25">Number of Children:</span>
                            <span><?php echo $resdetails['childrennumber']; ?></span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12 offset-sm-12">
                <button type="button" id="backtomembers" class="btn btn-outline-primary waves-effect">Back to Members</button>
            </div>
        </div>

    </div>
</div>


<script>
    $("#backtomembers").click(function() {
        window.location.href = "/branch/viewmembers";
    });
</script>