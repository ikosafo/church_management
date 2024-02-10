<?php include('../../../../config.php');
$branch = $_POST['select_branch'];

if ($branch == "All") {
    $getbdty = $mysqli->query("SELECT * FROM `member` WHERE MONTH(birthdate) = MONTH(NOW())
                           AND DAY(birthdate) = DAY(NOW())");

    $getbdmt = $mysqli->query("SELECT * FROM `member` WHERE MONTH(birthdate) = MONTH(NOW()) order by birthdate");

    $getbdwk = $mysqli->query("SELECT * FROM `member` WHERE WEEK(`birthdate`) = WEEK(NOW())");
}
else {
    $getbdty = $mysqli->query("SELECT * FROM `member` WHERE branch = '$branch'
                           AND MONTH(birthdate) = MONTH(NOW())
                           AND DAY(birthdate) = DAY(NOW())");

    $getbdmt = $mysqli->query("SELECT * FROM `member` WHERE branch = '$branch'
                           AND MONTH(birthdate) = MONTH(NOW()) order by birthdate");

    $getbdwk = $mysqli->query("SELECT * FROM `member` WHERE branch = '$branch' AND WEEK(`birthdate`) = WEEK(NOW())");
}

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<div class="kt-section">

    <div class="kt-section__content responsive">
        <div class="row">
            <!--begin::Portlet-->
            <div class="kt-portlet">

                <div class="kt-portlet__body">
                    <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-success" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#birthdaytoday" role="tab">
                                For Today
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#birthdaymonth" role="tab">
                                For the Month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#birthdayweek" role="tab">
                                For the Week
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="birthdaytoday" role="tabpanel">
                            <?php if (mysqli_num_rows($getbdty) == '1') { ?>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Branch</th>
                                        <th>Member Name</th>
                                        <th>Gender</th>
                                        <th>Telephone</th>
                                        <th>Residence</th>
                                        <th>Date of Birth</th>
                                        <th>Age Today</th>
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
                                            <td>
                                                <?php
                                                $branchid = $fetch['branch'];
                                                $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                                                $resbranch = $getbranch->fetch_assoc();
                                                echo $resbranch['name'];
                                                ?>
                                            </td>
                                            <td class="kt-datatable__member">
                            <span style="width: 294px;">
                                <div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__pic">
                                        <?php
                                        $memberid = $fetch['memberid'];
                                        $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                        $resimage = $getimage->fetch_assoc();
                                        $theimage = $resimage['image_location'];
                                        if ($theimage != "") { ?>
                                            <img style="width: 40px;height: 40px"
                                                 src="../<?php echo $theimage ?>">
                                        <?php } else {
                                            echo "";
                                        }
                                        ?>

                                    </div>
                                    <div class="kt-user-card-v2__details">
                                        <a class="kt-user-card-v2__name view_member"
                                           member_index="<?php echo $fetch['memberid'] ?>"
                                           href="#">
                                            <?php echo $fetch['surname'].' '.$fetch['firstname'].' '.$fetch['othername'] ?>
                                        </a>
                                    </div>
                                </div>
                            </span>
                                            </td>
                                            <td><?php echo $fetch['gender'] ?> </td>
                                            <td><?php echo $fetch['telephone'] ?> </td>
                                            <td><?php echo $fetch['residence'] ?> </td>
                                            <td><?php echo $dob = $fetch['birthdate'] ?> </td>
                                            <td><?php
                                                $getage = $mysqli->query("SELECT TIMESTAMPDIFF (YEAR, birthdate, CURDATE()) AS age FROM `member` where id = '$id'");
                                                $resage = $getage->fetch_assoc();
                                                echo $resage['age'];

                                                ?>
                                            </td>
                                        </tr>
                                        <?php $counter++; }
                                    ?>
                                    </tbody>

                                </table>

                            <?php  }
                            else {
                                echo '<div style="color: red;font-weight: 500;text-align: center">No birthday today!</div><hr/>';
                            }?>

                        </div>
                        <div class="tab-pane" id="birthdaymonth" role="tabpanel">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch</th>
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
                                        <td>
                                            <?php
                                            $branchid = $fetch['branch'];
                                            $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                                            $resbranch = $getbranch->fetch_assoc();
                                            echo $resbranch['name'];
                                            ?>
                                        </td>
                                        <td class="kt-datatable__member">
                                            <span style="width: 294px;">
                                                <div class="kt-user-card-v2">
                                                    <div class="kt-user-card-v2__pic">
                                                        <?php
                                                        $memberid = $fetch['memberid'];
                                                        $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                                        $resimage = $getimage->fetch_assoc();
                                                        $theimage = $resimage['image_location'];
                                                        if ($theimage != "") { ?>
                                                            <img style="width: 40px;height: 40px"
                                                                 src="../<?php echo $theimage ?>">
                                                        <?php } else {
                                                            echo "";
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="kt-user-card-v2__details">
                                                        <a class="kt-user-card-v2__name view_member"
                                                           member_index="<?php echo $fetch['memberid'] ?>"
                                                           href="#">
                                                            <?php echo $fetch['surname'].' '.$fetch['firstname'].' '.$fetch['othername'] ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </span>
                                        </td>
                                        <td><?php echo $fetch['gender'] ?> </td>
                                        <td><?php echo $fetch['telephone'] ?> </td>
                                        <td><?php echo $dob = $fetch['birthdate'] ?> </td>
                                        <td><?php
                                            $getage = $mysqli->query("SELECT TIMESTAMPDIFF (YEAR, birthdate, CURDATE()) AS age FROM `member` where id = '$id'");
                                            $resage = $getage->fetch_assoc();
                                            echo $resage['age'];

                                            ?></td>
                                        <td><?php echo $fetch['residence'] ?> </td>
                                    </tr>
                                    <?php $counter++; } ?>
                                </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="birthdayweek" role="tabpanel">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch</th>
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
                                        <td>
                                            <?php
                                            $branchid = $fetch['branch'];
                                            $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                                            $resbranch = $getbranch->fetch_assoc();
                                            echo $resbranch['name'];
                                            ?>
                                        </td>
                                        <td class="kt-datatable__member">
                                            <span style="width: 294px;">
                                                <div class="kt-user-card-v2">
                                                    <div class="kt-user-card-v2__pic">
                                                        <?php
                                                        $memberid = $fetch['memberid'];
                                                        $getimage = $mysqli->query("select * from `member_images` where memberid = '$memberid'");
                                                        $resimage = $getimage->fetch_assoc();
                                                        $theimage = $resimage['image_location'];
                                                        if ($theimage != "") { ?>
                                                            <img style="width: 40px;height: 40px"
                                                                 src="../<?php echo $theimage ?>">
                                                        <?php } else {
                                                            echo "";
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="kt-user-card-v2__details">
                                                        <a class="kt-user-card-v2__name view_member"
                                                           member_index="<?php echo $fetch['memberid'] ?>"
                                                           href="#">
                                                            <?php echo $fetch['surname'].' '.$fetch['firstname'].' '.$fetch['othername'] ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </span>
                                        </td>
                                        <td><?php echo $fetch['gender'] ?> </td>
                                        <td><?php echo $fetch['telephone'] ?> </td>
                                        <td><?php echo $dob = $fetch['birthdate'] ?> </td>
                                        <td><?php
                                            $getage = $mysqli->query("SELECT TIMESTAMPDIFF (YEAR, birthdate, CURDATE()) AS age FROM `member` where id = '$id'");
                                            $resage = $getage->fetch_assoc();
                                            echo $resage['age'];

                                            ?></td>
                                        <td><?php echo $fetch['residence'] ?> </td>
                                    </tr>
                                    <?php $counter++; } ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!--end::Portlet-->

        </div>


    </div>
</div>


