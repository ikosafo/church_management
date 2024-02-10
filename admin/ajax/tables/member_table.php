<?php include('../../../../config.php');
$select_branch = $_POST['select_branch'];
?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<div class="kt-separator kt-separator--dashed"></div>

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
            <table id="prov-table" class="table" style="margin-top: 3% !important;">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <!--<th>Email Address</th>-->
                        <th>Telephone</th>
                        <th>Residence</th>
                        <th>Marital Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>


<script>

    oTable =  $("#prov-table").DataTable({
        stateSave: true,
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/paginations/member.php?branch=<?php echo $select_branch ?>'
        },
        'columns': [
            {data: 'branchid'},
            {data: 'fullname'},
            {data: 'gender'},
            /*{data: 'emailaddress'},*/
            {data: 'telephone'},
            {data: 'residence'},
            {data: 'maritalstatus'},
            {data: 'id'},
        ],
        responsive: !0,
        dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
        buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        "bLengthChange": false
    }),
        $("#export_print").on("click", function (e) {
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

</script>