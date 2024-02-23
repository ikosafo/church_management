<!-- <style>
    #datatable {
        width: 100%;
        /* Adjust as needed */
        overflow-x: auto;
        /* or scroll if you always want a scrollbar */
        white-space: nowrap;
        /* Prevent wrapping of content */
        padding-bottom: 20px;
        /* Add padding to prevent scrollbar from covering content */
    }

    #datatable::-webkit-scrollbar {
        width: 12px;
        /* Width of the scrollbar */
    }

    #datatable::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Track color */
    }

    #datatable::-webkit-scrollbar-thumb {
        background: #888;
        /* Thumb color */
        border-radius: 6px;
        /* Roundness of the thumb */
    }

    #datatable::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Thumb color on hover */
    }
</style>
 -->

<section id="datatable">

    <form class="faq-search-input mb-1">
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
                <table class="table mt-2 table-sm" id="table-data">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Telephone</th>
                            <th>Residence</th>
                            <th>Previous Denomination</th>
                            <th>How did you hear?</th>
                            <th>Description</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
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
        dom: "Bfrtip",
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            url: "ajaxscripts/tables/pagination/converts.php", // json datasource
        },
        'columns': [{
                data: 'fullname'
            },
            {
                data: 'telephone'
            },
            {
                data: 'residence'
            },
            {
                data: 'denomination'
            },
            {
                data: 'hearing_about'
            },
            {
                data: 'description'
            },
            {
                data: 'action'
            }
        ]
    });
    $('#searchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.deleteconvertbtn').on('click', '.deleteconvertbtn', function() {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Convert!',
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
                            url: "ajaxscripts/queries/delete/convert.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function(text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajaxscripts/tables/newconverts.php",
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