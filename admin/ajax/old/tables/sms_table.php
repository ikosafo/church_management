<?php include('../../../../config.php');
$pinq = $mysqli->query("select * from sms ORDER BY id DESC");
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
                    <th>Group</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Period Sent</th>
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
                            $branchname = $resbranch['name'];
                            if ($branchid == "0") {
                                echo "Admin";
                            }
                            else {
                                echo $branchname;
                            }
                            ?>
                        </td>
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

<script>
    oTable = $('#data-table').DataTable({
        "bLengthChange": false,"order": []
    });

    $('#data_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

</script>