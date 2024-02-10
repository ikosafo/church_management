<?php include('../../../../config.php');
$pinq = $mysqli->query("select * from website_contactus");
?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<div class="kt-section">

    <div class="kt-section__content responsive">

        <div class="table-responsive">
            <table id="datatable" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Alternate Telephone</th>
                    <th>Mail</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($fetch = $pinq->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $fetch['address']; ?></td>
                        <td><?php echo $fetch['telephone']; ?></td>
                        <td><?php echo $fetch['alttelephone']; ?></td>
                        <td><?php echo $fetch['mail']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-warning edit_contactus"
                                    i_index="<?php echo $fetch['id']; ?>"
                                    title="Edit">
                                <i class="flaticon2-edit ml-2" style="color:#fff !important;"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<script>

    $(document).off('click', '.edit_contactus').on('click', '.edit_contactus', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.ajax({
            type: "POST",
            url: "ajax/forms/editform_contactus.php",
            data: {
                i_index: theindex
            },
            dataType: "html",
            success: function (text) {
                $('#contactusform_div').html(text);
            },
            complete: function () {
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            }
        });
    });

</script>