<?php include('../../../../config.php');
$pinq = $mysqli->query("select * from website_bannertext ORDER BY id DESC");
?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


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
            <table id="datatable" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Text</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($fetch = $pinq->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $fetch['bannertext']; ?></td>
                        <td>
                        <button type="button"
                                    data-type="confirm"
                                    class="btn btn-danger delete_text"
                                    i_index="<?php echo $fetch['id']; ?>"
                                    title="Delete">
                                <i class="flaticon2-trash ml-2" style="color:#fff !important;"></i>
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
    oTable =  $("#datatable").DataTable({
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

    $(document).off('click', '.delete_text').on('click', '.delete_text', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Text!',
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
                            url: "ajax/queries/delete_bannertext.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/bannertext_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#bannertexttable_div').html(text);
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