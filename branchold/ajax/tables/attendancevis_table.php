<?php include ('../../../../config.php');

$branch = $_SESSION['branch'];
$dep = $mysqli->query("SELECT * FROM `attendance` WHERE `branch` = '$branch' and visitor != '' ORDER BY `datereported` DESC");
?>

<style>
    .dataTables_filter {
        display: none;
    }
</style>

<span>
    Not a member?, View details here<br/> New Attendants not in list
</span>
<hr/>

<?php
$today = date('Y-m-d H:i:s');
$chkattendance = $mysqli->query("select * from service_config where branch = '$branch' and datefrom <= '$today' AND dateto >= '$today'");
$getcount = mysqli_num_rows($chkattendance);
$resattendance = $chkattendance->fetch_assoc();
$configid = $resattendance['configid'];

if ($getcount == '1') { ?>
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
                <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    while ($resdep = $dep->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $resdep['visitor']; ?></td>
                            <td><?php echo $resdep['telephone']; ?></td>
                            <td>
                                <button type="button"
                                        data-type="confirm"
                                        class="btn btn-sm btn-danger js-sweetalert delete_visitoratt"
                                        i_index="<?php echo $resdep['id'] ?>" title="Delete">
                                    <i class="flaticon2-trash" style="color: #fff !important;"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                </table>
            </div>
        </div>
    </div>
<?php } ?>



<script>

    oTable = $('#bs4-table').DataTable({
        "bLengthChange": false,"order": []
    });

    $('#data_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.delete_visitoratt').on('click', '.delete_visitoratt', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Visitor Attendance!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_visitoratt.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/attendancevis_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#attendancevistable_div').html(text);
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


