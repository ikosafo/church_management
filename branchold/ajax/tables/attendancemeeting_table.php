<?php include('../../../../config.php');
$branch = $_SESSION['branch'];
$pinq = $mysqli->query("SELECT * FROM `member` WHERE branch = '$branch' ORDER BY surname,firstname,othername");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<?php
$today = date('Y-m-d H:i:s');
$chkattendance = $mysqli->query("select * from `meeting_config` where branch = '$branch' and datefrom <= '$today' AND dateto >= '$today'");
$getcount = mysqli_num_rows($chkattendance);
$resattendance = $chkattendance->fetch_assoc();
$configid = $resattendance['configid'];

if ($getcount == '1') { ?>
    <div class="row">
        <div class="col-md-4">
            MEETING NAME:
            <small><?php echo $resattendance['title'] ?>
            </small>
        </div>
        <div class="col-md-4">
            SERVICE PERIOD:
            <small><?php echo $resattendance['datefrom'].' to '.$resattendance['dateto']; ?>
            </small>
        </div>
        <div class="col-md-4">
            SERVICE DESCRIPTION:
            <small><?php echo $resattendance['description']; ?>
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
                        <th>Member Name</th>
                        <th>Residence</th>
                        <th>Educational Level</th>
                        <th>Occupation</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    while ($fetch = $pinq->fetch_assoc()) {
                        ?>
                        <tr>
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
                                        <span class="kt-user-card-v2__email"><?php echo $fetch['gender'] ?>, <?php echo $fetch['telephone'] ?></span></div>
                                </div>
                            </span>
                            </td>
                            <td><?php echo $fetch['residence']; ?></td>
                            <td><?php echo $fetch['educationallevel']; ?></td>
                            <td><?php echo $fetch['occupation']; ?></td>
                            <td>
                                <?php
                                $getstatus = $mysqli->query("select * from attendancemeeting where configid = '$configid' and
                                                             memberid = '$memberid' and status = '1'");
                                if (mysqli_num_rows($getstatus) == '1') { ?>
                                    <span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Present</span>
                                <?php } else { ?>
                                    <span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">Absent</span>
                                <?php }
                                ?>

                            </td>
                            <td>
                            <span>
                                <div class="dropdown"><a data-toggle="dropdown"
                                                         class="btn btn-sm btn-clean btn-icon btn-icon-md"> <i
                                            class="flaticon-more-1"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <?php
                                            if (mysqli_num_rows($getstatus) == '1') { ?>
                                                <li class="kt-nav__item">
                                                    <a class="kt-nav__link mark_absent"
                                                       member_index="<?php echo $fetch['memberid'] ?>" href="#"> <i
                                                            class="kt-nav__link-icon flaticon2-cross"></i>
                                                        <span class="kt-nav__link-text">Mark as Absent</span>
                                                    </a>
                                                </li>
                                            <?php } else { ?>
                                                <li class="kt-nav__item">
                                                    <a class="kt-nav__link mark_present"
                                                       member_index="<?php echo $fetch['memberid'] ?>" href="#"> <i
                                                            class="kt-nav__link-icon flaticon2-check-mark"></i>
                                                        <span class="kt-nav__link-text">Mark as Present</span>
                                                    </a>
                                                </li>
                                            <?php }
                                            ?>
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link view_member"
                                                   member_index="<?php echo $fetch['memberid'] ?>" href="#"> <i
                                                        class="kt-nav__link-icon flaticon2-file"></i>
                                                    <span class="kt-nav__link-text">View History</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </span>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


<?php } else {
    echo "<span style='color:red'>There is currently no service available. Please Configure Attendance first</span>";
}?>




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

    $(document).off('click', '.mark_present').on('click', '.mark_present', function () {
        var member_index = $(this).attr('member_index');
        var configid = '<?php echo $configid ?>';
        //alert(member_index+' '+configid);

        $.confirm({
            title: 'Mark Present!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Still Absent!');
                    }
                },
                yes: {
                    text: 'Yes, Continue!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/mark_present_meeting.php",
                            data: {
                                member_index: member_index,
                                configid: configid
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/attendancemeeting_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#attendancetable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        KTApp.unblockPage();
                                    },
                                });
                            },

                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).off('click', '.mark_absent').on('click', '.mark_absent', function () {
        var member_index = $(this).attr('member_index');
        var configid = '<?php echo $configid ?>';
        //alert(member_index+' '+configid);

        $.confirm({
            title: 'Mark Absent!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Still Present!');
                    }
                },
                yes: {
                    text: 'Yes, Continue!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/mark_absent_meeting.php",
                            data: {
                                member_index: member_index,
                                configid: configid
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/attendancemeeting_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#attendancetable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        KTApp.unblockPage();
                                    },
                                });
                            },

                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });

</script>