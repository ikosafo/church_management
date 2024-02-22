<?php
include('../../../config.php');

$memberid = $_POST['memberid'];
$paymenttype = $_POST['paymenttype'];
$branch = $_POST['branch'];

if ($paymenttype == 'Offering') {
    $gettable = $mysqli->query("select * from f_offerings where memberid = '$memberid' ORDER by id DESC");
?>

    <div class="table-responsive">

        <form class="faq-search-input">
            <div class="input-group input-group-merge">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="offsearchtxt" placeholder="Search ...">
            </div>
        </form>
        <table id="off-data" class="table" style="margin-top: 3% !important;">
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
                            <button type="button" data-type="confirm" class="avatar bg-light-danger p-50 m-0 js-sweetalert delete_paymentoff" i_index="<?php echo $restable['id'] ?>" title="Delete" style="border:none">
                                <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
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

<?php
} else if ($paymenttype == 'Tithe') {
    $gettable = $mysqli->query("select * from f_tithe where memberid = '$memberid' ORDER by `year_month` DESC,id DESC");
?>

    <div class="table-responsive">
        <form class="faq-search-input">
            <div class="input-group input-group-merge">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="tithesearchtxt" placeholder="Search ...">
            </div>
        </form>
        <table id="tithe-data" class="table" style="margin-top: 3% !important;">
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
                            <button type="button" data-type="confirm" class="avatar bg-light-danger p-50 m-0 js-sweetalert delete_paymentoff" i_index="<?php echo $restable['id'] ?>" title="Delete" style="border:none">
                                <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
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

<?php
} else if ($paymenttype == 'Welfare') {
    $gettable = $mysqli->query("select * from f_welfare where memberid = '$memberid' ORDER by `year_month` DESC,id DESC");
?>

    <div class="table-responsive">
        <form class="faq-search-input">
            <div class="input-group input-group-merge">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="welfaresearchtxt" placeholder="Search ...">
            </div>
        </form>
        <table id="welfare-data" class="table" style="margin-top: 3% !important;">
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
                            <button type="button" data-type="confirm" class="avatar bg-light-danger p-50 m-0 js-sweetalert delete_paymentoff" i_index="<?php echo $restable['id'] ?>" title="Delete" style="border:none">
                                <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
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

<?php
} else if ($paymenttype == 'First Fruit') {
    $gettable = $mysqli->query("select * from f_firstfruit where memberid = '$memberid' ORDER by `year` DESC,id DESC");
?>

    <div class="table-responsive">
        <form class="faq-search-input">
            <div class="input-group input-group-merge">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="firstfruitsearchtxt" placeholder="Search ...">
            </div>
        </form>
        <table id="firstfruit-data" class="table" style="margin-top: 3% !important;">
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
                            <button type="button" data-type="confirm" class="avatar bg-light-danger p-50 m-0 js-sweetalert delete_paymentoff" i_index="<?php echo $restable['id'] ?>" title="Delete" style="border:none">
                                <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
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

<?php
} else if ($paymenttype == 'Contributions') {
    $gettable = $mysqli->query("select * from f_contributions where memberid = '$memberid' ORDER by id DESC");
?>

    <div class="table-responsive">
        <form class="faq-search-input">
            <div class="input-group input-group-merge">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="contributionssearchtxt" placeholder="Search ...">
            </div>
        </form>
        <table id="contributions-data" class="table" style="margin-top: 3% !important;">
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
                            <button type="button" data-type="confirm" class="avatar bg-light-danger p-50 m-0 js-sweetalert delete_paymentoff" i_index="<?php echo $restable['id'] ?>" title="Delete" style="border:none">
                                <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
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

<?php
} else if ($paymenttype == 'Partners') {
    $gettable = $mysqli->query("select * from f_mpcontributions where memberid = '$memberid' ORDER by id DESC");
?>

    <div class="table-responsive">
        <form class="faq-search-input">
            <div class="input-group input-group-merge">
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="form-control" id="partnerssearchtxt" placeholder="Search ...">
            </div>
        </form>
        <table id="partners-data" class="table" style="margin-top: 3% !important;">
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
                            <button type="button" data-type="confirm" class="avatar bg-light-danger p-50 m-0 js-sweetalert delete_paymentoff" i_index="<?php echo $restable['id'] ?>" title="Delete" style="border:none">
                                <div class="avatar-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-medium-5">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
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

<?php
}

?>



<script>
    oTable = $('#off-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#offsearchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });

    oTable = $('#tithe-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#tithesearchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });

    oTable = $('#welfare-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#welfaresearchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });

    oTable = $('#firstfruit-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#firstfruitsearchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });

    oTable = $('#contributions-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#contributionssearchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });


    oTable = $('#partners-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#partnerssearchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.delete_paymentoff').on('click', '.delete_paymentoff', function() {
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
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_paymentoff.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                $.ajax({
                                    type: "post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function() {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data: {
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function(text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        KTApp.unblockPage();
                                    },
                                });
                            },
                            complete: function() {},
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).off('click', '.delete_paymenttithe').on('click', '.delete_paymenttithe', function() {
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
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_paymenttithe.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                $.ajax({
                                    type: "post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function() {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data: {
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function(text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        KTApp.unblockPage();
                                    },
                                });
                            },
                            complete: function() {},
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).off('click', '.delete_paymentwelfare').on('click', '.delete_paymentwelfare', function() {
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
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_paymentwelfare.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                $.ajax({
                                    type: "post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function() {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data: {
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function(text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        KTApp.unblockPage();
                                    },
                                });
                            },
                            complete: function() {},
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).off('click', '.delete_paymentff').on('click', '.delete_paymentff', function() {
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
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_paymentff.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                $.ajax({
                                    type: "post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function() {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data: {
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function(text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        KTApp.unblockPage();
                                    },
                                });
                            },
                            complete: function() {},
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).off('click', '.delete_paymentcontribution').on('click', '.delete_paymentcontribution', function() {
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
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_paymentcontribution.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                $.ajax({
                                    type: "post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function() {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data: {
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function(text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        KTApp.unblockPage();
                                    },
                                });
                            },
                            complete: function() {},
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });


    $(document).off('click', '.delete_paymentmpartner').on('click', '.delete_paymentmpartner', function() {
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
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_paymentmpartner.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                $.ajax({
                                    type: "post",
                                    url: "ajax/tables/mempayment_table.php",
                                    beforeSend: function() {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    data: {
                                        memberid: '<?php echo $memberid ?>',
                                        paymenttype: '<?php echo $paymenttype ?>',
                                        branch: '<?php echo $branch ?>'
                                    },
                                    success: function(text) {
                                        $('#paymenttable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        KTApp.unblockPage();
                                    },
                                });
                            },
                            complete: function() {},
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });
</script>