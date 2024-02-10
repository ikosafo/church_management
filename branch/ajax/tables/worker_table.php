<?php include('../../../../config.php');
$branch = $_SESSION['branch'];
$getworker = $mysqli->query("select * from `branchworker` w JOIN `member` m where m.id = w.memberid and m.branch = '$branch'");
//$select_branch = $_POST['select_branch'];
?>

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

                    <th>Full Name</th>
                    <th>Telephone</th>
                    <th>Residence</th>
                    <th>Role</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($resworker = $getworker->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $resworker['firstname'].' '.$resworker['othername'].' '.$resworker['surname']; ?></td>
                        <td><?php echo $resworker['telephone']; ?></td>
                        <td><?php echo $resworker['residence']; ?></td>
                        <td><?php echo $resworker['role']; ?></td>
                        <td><?php echo $resworker['position']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_worker"
                                    i_index="<?php echo $resworker['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-1" style="color: #fff !important;"></i>
                            </button>
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


    $(document).off('click', '.delete_worker').on('click', '.delete_worker', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Worker!',
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
                            url: "ajax/queries/delete_worker.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/worker_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#workertable_div').html(text);
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