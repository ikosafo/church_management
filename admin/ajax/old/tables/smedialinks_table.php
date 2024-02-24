<?php include('../../../../config.php');
$pinq = $mysqli->query("select * from website_smedialinks");
?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<div class="kt-section">

    <div class="kt-section__content responsive">

        <div class="table-responsive">
            <table id="data-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th>FaceBook Link</th>
                    <th>Youtube Link</th>
                    <th>Twitter Link</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($fetch = $pinq->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $fetch['facebook']; ?></td>
                        <td><?php echo $fetch['youtube']; ?></td>
                        <td><?php echo $fetch['twitter']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-warning edit_media"
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

    $(document).off('click', '.edit_media').on('click', '.edit_media', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.ajax({
            type: "POST",
            url: "ajax/forms/editform_smedialinks.php",
            data: {
                i_index: theindex
            },
            dataType: "html",
            success: function (text) {
                $('#smedialinksform_div').html(text);
            },
            complete: function () {
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            }
        });
    });

</script>