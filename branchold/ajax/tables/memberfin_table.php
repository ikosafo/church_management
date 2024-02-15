<?php include('../../../../config.php');
$financialtype = $_POST['financialtype'];
$branch = $_SESSION['branch'];
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
                <input type="text" id="member_search" class="form-control"
                       placeholder="Search..." aria-describedby="basic-addon1">
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
                'url': 'ajax/paginations/memberfin.php?branch=<?php echo $branch ?>&financialtype=<?php echo $financialtype ?>'
            },
            'columns': [
                {data: 'member'},
                {data: 'residence'},
                {data: 'occupation'},
                {data: 'maritalstatus'},
                {data: 'department'},
                {data: 'action'}
            ]
        });

    $('#member_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

</script>