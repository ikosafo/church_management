<?php include('../../../../config.php');
$pinq = $mysqli->query("select * from website_image_slider ORDER BY id DESC");
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
                        <th>Image</th>
                        <th>Image Type</th>
                        <th>Image Size</th>
                        <th>Date Uploaded</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                while ($fetch = $pinq->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><img src="../<?php echo $fetch['image_location'] ?>" width="100" height="50"/></td>
                        <td><?php echo $fetch['image_type']; ?></td>
                        <td><?php echo $fetch['image_size']; ?></td>
                        <td><?php echo $fetch['dateuploaded']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-danger delete_slider"
                                    i_index="<?php echo $fetch['id']; ?>"
                                    title="Delete">
                                <i class="flaticon2-trash ml-2" style="color:#fff !important;"></i>
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
    oTable = $('#data-table').DataTable({
        "bLengthChange": false,"order": []
    });

    $('#data_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $(document).off('click', '.delete_slider').on('click', '.delete_slider', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Slider!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_slider.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/addslider_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#slidertable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        KTApp.unblockPage();
                                    },
                                });
                            },

                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });
</script>