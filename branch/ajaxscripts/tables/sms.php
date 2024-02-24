<?php include('../../../config.php');

$branch = $_SESSION['branch'];
$getdata = $mysqli->query("select * from sms where branch = '$branch' ORDER BY id DESC");
?>
<section id="datatable">

    <form class="faq-search-input">
        <div class="input-group input-group-merge">
            <div class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" class="form-control" id="searchtxt" placeholder="Search ...">
        </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table mt-2" id="table-data">
                    <thead>
                        <tr>
                            <th>Group</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Period Sent</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($fetch = $getdata->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $fetch['group']; ?></td>
                                <td><?php echo $fetch['title']; ?></td>
                                <td><?php echo $fetch['message']; ?></td>
                                <td><?php echo $fetch['datesent']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</section>
<!--/ Basic table -->


<script>
    oTable = $('#table-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverMethod': 'post'
    });
    $('#searchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.editdeptbtn').on('click', '.editdeptbtn', function() {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.ajax({
            type: "POST",
            url: "ajaxscripts/forms/editdepartment.php",
            data: {
                i_index: theindex
            },
            dataType: "html",
            success: function(text) {
                $('#pageform_div').html(text);
            },
            complete: function() {},
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            }
        });
    });


    $(document).off('click', '.deletedeptbtn').on('click', '.deletedeptbtn', function() {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Department!',
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
                            url: "ajaxscripts/queries/delete/department.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajaxscripts/tables/departments.php",
                                    beforeSend: function() {
                                        $.blockUI({
                                            message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                                        });
                                    },
                                    success: function(text) {
                                        $('#pagetable_div').html(text);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function() {
                                        $.unblockUI();
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