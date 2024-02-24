<?php include('../../../config.php');
$branch = $_SESSION['branch'];

$getbdty = $mysqli->query("SELECT * FROM `members` WHERE branch = '$branch'
                           AND MONTH(dob) = MONTH(NOW())
                           AND DAY(dob) = DAY(NOW())");

$getbdmt = $mysqli->query("SELECT * FROM `members` WHERE branch = '$branch'
                           AND MONTH(dob) = MONTH(NOW()) order by dob");

$getbdwk = $mysqli->query("SELECT * FROM `members` WHERE branch = '$branch' AND WEEK(`dob`) = WEEK(NOW())");
?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>



<div class="card">
    <div class="card-header">
        <h4 class="card-title">View Celebrants and Send Wishes</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="birthdaytoday" data-bs-toggle="tab" href="#today-just" role="tab" aria-controls="today-just" aria-selected="true">For Today</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="birthdaymonth" data-bs-toggle="tab" href="#month-just" role="tab" aria-controls="month-just" aria-selected="true">For the Month</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="birthdayweek" data-bs-toggle="tab" href="#week-just" role="tab" aria-controls="week-just" aria-selected="false">For the Week</a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-1">
            <div class="tab-pane active" id="today-just" role="tabpanel" aria-labelledby="birthdaytoday">
                <p>
                    <?php if (mysqli_num_rows($getbdty) == '1') { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Name</th>
                            <th>Gender</th>
                            <th>Telephone</th>
                            <th>Residence</th>
                            <th>Date of Birth</th>
                            <th>Age Today</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $counter = 1;
                        while ($fetch = $getbdty->fetch_assoc()) {
                            $id = $fetch['id'];
                        ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td class="kt-datatable__member">
                                    <span style="width: 294px;">
                                        <div class="kt-user-card-v2">
                                            <div class="kt-user-card-v2__pic">
                                                <?php
                                                $memberid = $fetch['id'];
                                                $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                                $resimage = $getimage->fetch_assoc();
                                                @$theimage = $resimage['image_location'];
                                                if ($theimage != "") { ?>
                                                    <img style="width: 40px;height: 40px" src="../<?php echo $theimage ?>">
                                                <?php } else {
                                                    echo "";
                                                }
                                                ?>

                                            </div>
                                            <div class="kt-user-card-v2__details">
                                                <a class="kt-user-card-v2__name view_member" member_index="<?php echo $fetch['id'] ?>" href="#">
                                                    <?php echo $fetch['fullname']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </span>
                                </td>
                                <td><?php echo $fetch['gender'] ?> </td>
                                <td><?php echo $fetch['telephone'] ?> </td>
                                <td><?php echo $fetch['location'] ?> </td>
                                <td><?php echo $dob = $fetch['dob'] ?> </td>
                                <td><?php
                                    $getage = $mysqli->query("SELECT TIMESTAMPDIFF (YEAR, dob, CURDATE()) AS age FROM `members` where id = '$id'");
                                    $resage = $getage->fetch_assoc();
                                    echo $resage['age'];

                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-label-facebook sendmessage_btn" i_index="<?php echo $id; ?>">
                                        Send Message
                                    </button>
                                </td>
                            </tr>
                        <?php $counter++;
                        }
                        ?>
                    </tbody>

                </table>

                <!-- <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 col-12">
                        <hr />
                        <p class="card-text font-small mb-2">
                            Send Message to Birthday Celebrants
                        </p>

                        <div class="form-group row">
                            <div class="mb-1 col-md-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title">
                            </div>
                            <div class="mb-1 col-md-12">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="10" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="type">Type</label>
                                <select id="type" style="width: 100%">
                                    <option></option>
                                    <option value="To Bank">To Bank</option>
                                    <option value="Expense">Expense</option>
                                </select>
                            </div>
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="purpose">Purpose/Description</label>
                                <textarea class="form-control" id="purpose" placeholder="Enter Purpose"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 col-12">
                        <div id="pagetable_div"></div>
                    </div>
                </div> -->
                <!--   <div class="form-group row">
                    <div class="col-md-5">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Send Message to Birthday Celebrants
                                    </h3>
                                </div>
                            </div>

                            <form class="">
                                <div class="kt-portlet__body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" rows="10" placeholder="Enter Message"></textarea>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <button type="button" class="btn btn-primary" id="saveessagebtn">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Branch Messages
                                    </h3>
                                </div>
                            </div>

                            <div class="kt-portlet__body">
                                <div id="sendmessage_div"></div>
                            </div>

                        </div>
                    </div>
                </div>
 -->
            <?php  } else {
                        echo '<div style="color: red;font-weight: 500;text-align: center">No birthday today!</div><hr/>';
                    } ?>
            </p>
            </div>
            <div class="tab-pane" id="month-just" role="tabpanel" aria-labelledby="birthdaymonth">

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Name</th>
                            <th>Gender</th>
                            <th>Telephone</th>
                            <th>Date of Birth</th>
                            <th>Current Age</th>
                            <th>Residence</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $counter = 1;
                        while ($fetch = $getbdmt->fetch_assoc()) {
                            $id = $fetch['id'];
                        ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td class="kt-datatable__member">
                                    <span style="width: 294px;">
                                        <div class="kt-user-card-v2">
                                            <div class="kt-user-card-v2__pic">
                                                <?php
                                                $memberid = $fetch['id'];
                                                $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                                $resimage = $getimage->fetch_assoc();
                                                @$theimage = $resimage['image_location'];
                                                if ($theimage != "") { ?>
                                                    <img style="width: 40px;height: 40px" src="../<?php echo $theimage ?>">
                                                <?php } else {
                                                    echo "";
                                                }
                                                ?>

                                            </div>
                                            <div class="kt-user-card-v2__details">
                                                <a class="kt-user-card-v2__name view_member" member_index="<?php echo $fetch['id'] ?>" href="#">
                                                    <?php echo $fetch['fullname']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </span>
                                </td>
                                <td><?php echo $fetch['gender'] ?> </td>
                                <td><?php echo $fetch['telephone'] ?> </td>
                                <td><?php echo $dob = $fetch['dob'] ?> </td>
                                <td><?php
                                    $getage = $mysqli->query("SELECT TIMESTAMPDIFF (YEAR, dob, CURDATE()) AS age FROM `members` where id = '$id'");
                                    $resage = $getage->fetch_assoc();
                                    echo $resage['age'];

                                    ?></td>
                                <td><?php echo $fetch['location'] ?> </td>
                            </tr>
                        <?php $counter++;
                        } ?>
                    </tbody>

                </table>

            </div>
            <div class="tab-pane" id="week-just" role="tabpanel" aria-labelledby="birthdayweek">
                <p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Name</th>
                            <th>Gender</th>
                            <th>Telephone</th>
                            <th>Date of Birth</th>
                            <th>Current Age</th>
                            <th>Residence</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $counter = 1;
                        while ($fetch = $getbdwk->fetch_assoc()) {
                            $id = $fetch['id'];
                        ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td class="kt-datatable__member">
                                    <span style="width: 294px;">
                                        <div class="kt-user-card-v2">
                                            <div class="kt-user-card-v2__pic">
                                                <?php
                                                $memberid = $fetch['memberid'];
                                                $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                                $resimage = $getimage->fetch_assoc();
                                                @$theimage = $resimage['image_location'];
                                                if ($theimage != "") { ?>
                                                    <img style="width: 40px;height: 40px" src="../<?php echo $theimage ?>">
                                                <?php } else {
                                                    echo "";
                                                }
                                                ?>

                                            </div>
                                            <div class="kt-user-card-v2__details">
                                                <a class="kt-user-card-v2__name view_member" member_index="<?php echo $fetch['id'] ?>" href="#">
                                                    <?php echo $fetch['fullname']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </span>
                                </td>
                                <td><?php echo $fetch['gender'] ?> </td>
                                <td><?php echo $fetch['telephone'] ?> </td>
                                <td><?php echo $dob = $fetch['dob'] ?> </td>
                                <td><?php
                                    $getage = $mysqli->query("SELECT TIMESTAMPDIFF (YEAR, dob, CURDATE()) AS age FROM `members` where id = '$id'");
                                    $resage = $getage->fetch_assoc();
                                    echo $resage['age'];

                                    ?></td>
                                <td><?php echo $fetch['residence'] ?> </td>
                            </tr>
                        <?php $counter++;
                        } ?>
                    </tbody>

                </table>
                </p>
            </div>
        </div>
    </div>
</div>


<script>
    $.ajax({
        url: "ajax/tables/birthdaymessage_table.php",
        beforeSend: function() {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        success: function(text) {
            $('#sendmessage_div').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function() {
            KTApp.unblockPage();
        },
    });

    $("#saveessagebtn").click(function() {
        var title = $("#title").val();
        var message = $("#message").val();

        var error = '';
        if (title == "") {
            error += 'Please enter title \n';
            $("#title").focus();
        }
        if (message == "") {
            error += 'Please enter message \n';
            $("#message").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/savebdmessageall.php",
                beforeSend: function() {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    branch: '<?php echo $branch ?>',
                    title: title,
                    message: message
                },
                success: function(text) {
                    //alert(text);
                    $.notify("Message sent", "success", {
                        position: "top center"
                    });
                    //$("#mem-table").DataTable().ajax.reload(null, false );
                    $.ajax({
                        url: "ajax/tables/birthdaymessage_table.php",
                        beforeSend: function() {
                            KTApp.blockPage({
                                overlayColor: "#000000",
                                type: "v2",
                                state: "success",
                                message: "Please wait..."
                            })
                        },
                        success: function(text) {
                            $('#sendmessage_div').html(text);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function() {
                            KTApp.unblockPage();
                        },
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    KTApp.unblockPage();
                },
            });
        } else {
            $.notify(error, {
                position: "top center"
            });
        }
        return false;
    });
</script>