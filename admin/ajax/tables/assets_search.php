<?php include('../../../../config.php');
$branch = $_POST['select_branch'];

if ($branch == "All") {
    $pinq = $mysqli->query("select * from asset_registry ORDER BY itemname");
}
else {
    $pinq = $mysqli->query("select * from asset_registry where branch = '$branch' ORDER BY itemname");
}

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
                    <th>Branch</th>
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>Location</th>
                    <th>Excellent(No.)</th>
                    <th>Good(No.)</th>
                    <th>Fair(No.)</th>
                    <th>Bad(No.)</th>
                    <th>Worse(No.)</th>
                    <th>Code</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($fetch = $pinq->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            $branchid = $fetch['branch'];
                            $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                            $resbranch = $getbranch->fetch_assoc();
                            echo $branchname = $resbranch['name'];
                            ?>
                        </td>
                        <td>
                            <?php $category = $fetch['categoryid'];
                            $getname = $mysqli->query("select * from asset_category where id = '$category'");
                            $resname = $getname->fetch_assoc();
                            $categorycode = $resname['category_code'];
                            echo $categoryname = $resname['category_name'];
                            ?>
                        </td>
                        <td><?php echo $itemname = $fetch['itemname']; ?></td>
                        <td><?php echo $location = $fetch['location']; ?></td>
                        <td><?php echo $fetch['excellent']; ?></td>
                        <td><?php echo $fetch['good']; ?></td>
                        <td><?php echo $fetch['fair']; ?></td>
                        <td><?php echo $fetch['bad']; ?></td>
                        <td><?php echo $fetch['worse']; ?></td>
                        <td>
                            <span style="text-transform: uppercase">
                                <?php echo "CV"."/".substr($branchname,0,3)."/".substr($categorycode,0,3).
                                    "/".substr($itemname,0,3)."/".substr($location,0,3)."/".$fetch['id']; ?>
                            </span>
                        </td>
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
    })

    $('#data_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

</script>