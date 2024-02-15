<?php
include ('../../../../config.php');

$memberid = $_POST['memberid'];
$paymenttype = $_POST['paymenttype'];
$branch = $_POST['branch'];

if ($paymenttype == 'Offering') {
    $gettable = $mysqli->query("select * from f_offerings where memberid = '$memberid' ORDER by id DESC");
    ?>

    <div class="table-responsive">
        <div class="kt-portlet__body">
            <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Purpose</th>
                    <th>Date Paid</th>
                    <th>Entry Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($restable = $gettable->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $restable['amount']; ?></td>
                        <td><?php echo $restable['purpose']; ?></td>
                        <td><?php echo $restable['date_paid']; ?></td>
                        <td><?php echo $restable['period']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_paymentoff"
                                    i_index="<?php echo $restable['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
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

<?php
}

else if ($paymenttype == 'Tithe') {
    $gettable = $mysqli->query("select * from f_tithe where memberid = '$memberid' ORDER by `year_month` DESC,id DESC");
    ?>

    <div class="table-responsive">
        <div class="kt-portlet__body">
            <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Payment For</th>
                    <th>Payment Mode</th>
                    <th>Date Paid</th>
                    <th>Entry Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($restable = $gettable->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $restable['amount']; ?></td>
                        <td><?php echo $restable['year_month']; ?></td>
                        <td><?php echo $restable['payment_mode']; ?></td>
                        <td><?php echo $restable['date_paid']; ?></td>
                        <td><?php echo $restable['period']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_paymenttithe"
                                    i_index="<?php echo $restable['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
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

    <?php
}

else if ($paymenttype == 'Welfare') {
    $gettable = $mysqli->query("select * from f_welfare where memberid = '$memberid' ORDER by `year_month` DESC,id DESC");
    ?>

    <div class="table-responsive">
        <div class="kt-portlet__body">
            <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Payment For</th>
                    <th>Date Paid</th>
                    <th>Entry Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($restable = $gettable->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $restable['amount']; ?></td>
                        <td><?php echo $restable['year_month']; ?></td>
                        <td><?php echo $restable['date_paid']; ?></td>
                        <td><?php echo $restable['period']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_paymentwelfare"
                                    i_index="<?php echo $restable['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
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

    <?php
}

else if ($paymenttype == 'First Fruit') {
    $gettable = $mysqli->query("select * from f_firstfruit where memberid = '$memberid' ORDER by `year` DESC,id DESC");
    ?>

    <div class="table-responsive">
        <div class="kt-portlet__body">
            <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Payment For</th>
                    <th>Date Paid</th>
                    <th>Entry Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($restable = $gettable->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $restable['amount']; ?></td>
                        <td><?php echo $restable['year']; ?></td>
                        <td><?php echo $restable['date_paid']; ?></td>
                        <td><?php echo $restable['period']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_paymentff"
                                    i_index="<?php echo $restable['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
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

    <?php
}

else if ($paymenttype == 'Contributions') {
    $gettable = $mysqli->query("select * from f_contributions where memberid = '$memberid' ORDER by id DESC");
    ?>

    <div class="table-responsive">
        <div class="kt-portlet__body">
            <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Purpose</th>
                    <th>Date Paid</th>
                    <th>Entry Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($restable = $gettable->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $restable['amount']; ?></td>
                        <td><?php echo $restable['purpose']; ?></td>
                        <td><?php echo $restable['date_paid']; ?></td>
                        <td><?php echo $restable['period']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_paymentcontribution"
                                    i_index="<?php echo $restable['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
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

    <?php
}

else if ($paymenttype == 'Ministry Partners') {
    $gettable = $mysqli->query("select * from f_mpcontributions where memberid = '$memberid' ORDER by id DESC");
    ?>

    <div class="table-responsive">
        <div class="kt-portlet__body">
            <table id="bs4-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Purpose</th>
                    <th>Date Paid</th>
                    <th>Entry Period</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($restable = $gettable->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $restable['amount']; ?></td>
                        <td><?php echo $restable['purpose']; ?></td>
                        <td><?php echo $restable['date_paid']; ?></td>
                        <td><?php echo $restable['period']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_paymentmpartner"
                                    i_index="<?php echo $restable['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-2" style="color: #fff !important;"></i>
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

    <?php
}

?>




<script>
    $(document).off('click', '.delete_paymentoff').on('click', '.delete_paymentoff', function () {
        var theindex = $(this).attr('i_index');

        $.confirm({
            title: 'Delete Payment!',
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
                            url: "ajax/queries/delete_paymentoff.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type:"post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data:{
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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


    $(document).off('click', '.delete_paymenttithe').on('click', '.delete_paymenttithe', function () {
        var theindex = $(this).attr('i_index');

        $.confirm({
            title: 'Delete Payment!',
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
                            url: "ajax/queries/delete_paymenttithe.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type:"post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data:{
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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


    $(document).off('click', '.delete_paymentwelfare').on('click', '.delete_paymentwelfare', function () {
        var theindex = $(this).attr('i_index');

        $.confirm({
            title: 'Delete Payment!',
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
                            url: "ajax/queries/delete_paymentwelfare.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type:"post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data:{
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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


    $(document).off('click', '.delete_paymentff').on('click', '.delete_paymentff', function () {
        var theindex = $(this).attr('i_index');

        $.confirm({
            title: 'Delete Payment!',
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
                            url: "ajax/queries/delete_paymentff.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type:"post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data:{
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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


    $(document).off('click', '.delete_paymentcontribution').on('click', '.delete_paymentcontribution', function () {
        var theindex = $(this).attr('i_index');

        $.confirm({
            title: 'Delete Payment!',
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
                            url: "ajax/queries/delete_paymentcontribution.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type:"post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data:{
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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


    $(document).off('click', '.delete_paymentmpartner').on('click', '.delete_paymentmpartner', function () {
        var theindex = $(this).attr('i_index');

        $.confirm({
            title: 'Delete Payment!',
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
                            url: "ajax/queries/delete_paymentmpartner.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type:"post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data:{
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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
