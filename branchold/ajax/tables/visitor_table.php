<?php include ('../../../../config.php');

$branch = $_SESSION['branch'];
$dep = $mysqli->query("SELECT * FROM `visitor` WHERE `branch` = '$branch' ORDER BY `period` DESC");
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
                    <th>Current Denomination</th>
                    <th>How did you hear about us?</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($resdep = $dep->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $resdep['full_name']; ?></td>
                        <td><?php echo $resdep['telephone']; ?></td>
                        <td><?php echo $resdep['residence']; ?></td>
                        <td><?php echo $resdep['denomination']; ?></td>
                        <td><?php echo $resdep['hearing_about']; ?></td>
                        <td><?php echo $resdep['description']; ?></td>
                        <td>
                            <span>
                                <div class="dropdown"><a data-toggle="dropdown"
                                                         class="btn btn-sm btn-clean btn-icon btn-icon-md"> <i
                                            class="flaticon-more-1"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link edit_visitor"
                                                   i_index="<?php echo $resdep['id'] ?>" href="#"> <i
                                                        class="kt-nav__link-icon flaticon2-edit"></i>
                                                    <span class="kt-nav__link-text">Edit</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link delete_visitor"
                                                   i_index="<?php echo $resdep['id'] ?>" href="#"> <i
                                                        class="kt-nav__link-icon flaticon2-trash"></i> <span
                                                        class="kt-nav__link-text">Delete</span> </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </span>
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


    $(document).off('click', '.edit_visitor').on('click', '.edit_visitor', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.ajax({
            type: "POST",
            url: "ajax/forms/editform_visitor.php",
            data: {
                i_index: theindex
            },
            dataType: "html",
            success: function (text) {
                $('#visitorform_div').html(text);
            },
            complete: function () {
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            }
        });
    });

    $(document).off('click', '.delete_visitor').on('click', '.delete_visitor', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Visitor!',
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
                            url: "ajax/queries/delete_visitor.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/visitor_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#visitortable_div').html(text);
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


