<?php include('../../../../config.php');

$branch = $_SESSION['branch'];
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$attendance_status = $_POST['attendance_status'];

if ($attendance_status == "All") {
    $getatt = $mysqli->query("select * from attendance where branch = '$branch' AND datereported >= '$datefrom' AND datereported <= '$dateto'");
}
else {
    $getatt = $mysqli->query("select * from attendance where branch = '$branch' AND
                              datereported >= '$datefrom' AND datereported <= '$dateto' AND status = '$attendance_status'");
}

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

    <div class="row">
        <div class="col-md-4">
            START PERIOD:
            <small><?php echo $datefrom ?></small>
        </div>
        <div class="col-md-4">
            END PERIOD:
            <small><?php echo $dateto ?></small>
        </div>
        <div class="col-md-4">
            STATUS:
            <small><?php if ($attendance_status == '1') {
                    echo "Present";
                }
                else if ($attendance_status == '0'){
                    echo "Absent";
                } else {
                    echo "All";
                }
                ?>
            </small>
        </div>
    </div>
    <hr/>


    <div class="kt-section">

        <div class="kt-section__content responsive">
            <div class="kt-searchbar">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                                <i class="la la-search"></i>
                            </span></div>
                    <input type="text" id="data_search" class="form-control"
                           placeholder="Search..." aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="table-responsive">
                <table id="data-table" class="table" style="margin-top: 3% !important;">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Service Period</th>
                            <th>Member</th>
                            <th>Period Reported</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    while ($fetch = $getatt->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php $configid = $fetch['configid'];
                                $getservice = $mysqli->query("select * from service_config where configid = '$configid'");
                                $resservice = $getservice->fetch_assoc();
                                $serviceid = $resservice['serviceid'];
                                $getname = $mysqli->query("select * from service where id = '$serviceid'");
                                $resname = $getname->fetch_assoc();
                                echo $resname['service_name'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $resservice['datefrom'].' - '.$resservice['dateto'];
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
                                            <?php $getmember = $mysqli->query("SELECT * FROM `member` WHERE memberid = '$memberid'");
                                                  $resmember = $getmember->fetch_assoc();

                                                echo $resmember['surname'].' '.$resmember['firstname'].' '.$resmember['othername'] ?>
                                        </a>
                                        <span class="kt-user-card-v2__email"><?php echo $resmember['gender'] ?>, <?php echo $resmember['telephone'] ?></span></div>
                                </div>
                            </span>
                            </td>
                            <td>
                              <?php echo $fetch['datereported'] ?>
                            </td>
                            <td>
                                <?php
                                $getstatus = $fetch['status'];
                                if ($getstatus == '1') { ?>
                                    <span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Present</span>
                                <?php } else { ?>
                                    <span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Absent</span>
                                <?php }
                                ?>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>



<script>
    oTable =  $("#data-table").DataTable({
        responsive: !0,
        dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
        buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        "bLengthChange": false,"order": [],

    }), $("#export_print").on("click", function (e) {
        e.preventDefault(), t.button(0).trigger()
    }), $("#export_copy").on("click", function (e) {
        e.preventDefault(), t.button(1).trigger()
    }), $("#export_excel").on("click", function (e) {
        e.preventDefault(), t.button(2).trigger()
    }), $("#export_csv").on("click", function (e) {
        e.preventDefault(), t.button(3).trigger()
    }), $("#export_pdf").on("click", function (e) {
        e.preventDefault(), t.button(4).trigger()
    });

    $('#data_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

</script>