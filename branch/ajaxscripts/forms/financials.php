<?php include('../../../config.php');
$financialtype = $_POST['financialtype'];
$branch = $_SESSION['branch'];
?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<!-- <div class="kt-section">

    <div class="kt-section__content responsive">
        <div class="kt-searchbar">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                        <i class="la la-search"></i>
                    </span></div>
                <input type="text" id="member_search" class="form-control" placeholder="Search..." aria-describedby="basic-addon1">
            </div>
        </div>

        <div class="table-responsive">
            <table id="mem-table" class="table" style="margin-top: 3% !important;">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Residence</th>
                        <th>Occupation</th>
                        <th>Marital Status</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>


<script>
    oTable = $('#mem-table').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/paginations/financial.php?branch=<?php echo $branch ?>&financialtype=<?php echo $financialtype ?>'
        },
        'columns': [{
                data: 'member'
            },
            {
                data: 'residence'
            },
            {
                data: 'occupation'
            },
            {
                data: 'maritalstatus'
            },
            {
                data: 'department'
            },
            {
                data: 'action'
            }
        ]
    });

    $('#member_search').keyup(function() {
        oTable.search($(this).val()).draw();
    });
</script> -->




<!-- <style>
    #datatable {
        width: 100%;
        /* Adjust as needed */
        overflow-x: auto;
        /* or scroll if you always want a scrollbar */
        white-space: nowrap;
    }
</style> -->


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
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Residence</th>
                            <th>Occupation</th>
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
            'url': 'ajaxscripts/tables/pagination/financials.php?branch=<?php echo $branch ?>&financialtype=<?php echo $financialtype ?>'
        },
        'columns': [{
                data: 'fullname'
            },
            {
                data: 'telephone'
            },
            {
                data: 'age'
            },
            {
                data: 'gender'
            },
            {
                data: 'location'
            },
            {
                data: 'occupation'
            },
            {
                data: 'action'
            }
        ]
    });
    $('#searchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });
</script>