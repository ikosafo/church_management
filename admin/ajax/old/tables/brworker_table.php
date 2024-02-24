<?php include('../../../../config.php');

$select_branch = $_POST['select_branch'];
if ($select_branch == "All") {
    $getworker = $mysqli->query("select * from `branchworker` w JOIN `member` m where m.id = w.memberid");
}
else {
    $getworker = $mysqli->query("select * from `branchworker` w JOIN `member` m where m.id = w.memberid AND m.branch = '$select_branch'");
}

//$select_branch = $_POST['select_branch'];
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
            <table id="data-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Branch</th>
                    <th>Full Name</th>
                    <th>Telephone</th>
                    <th>Residence</th>
                    <th>Role</th>
                    <th>Position</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($resworker = $getworker->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php
                            $branchid = $resworker['branch'];
                            $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                            $resbranch = $getbranch->fetch_assoc();
                            echo $resbranch['name'];
                            ?>
                        </td>
                        <td><?php echo $resworker['firstname'].' '.$resworker['othername'].' '.$resworker['surname']; ?></td>
                        <td><?php echo $resworker['telephone']; ?></td>
                        <td><?php echo $resworker['residence']; ?></td>
                        <td><?php echo $resworker['role']; ?></td>
                        <td><?php echo $resworker['position']; ?></td>
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

</script>