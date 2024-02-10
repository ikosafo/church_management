<?php include('../../../../config.php');
$branch = $_SESSION['branch'];
$pinq = $mysqli->query("select * from document where branch = '$branch' ORDER BY id DESC");
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
                    <th>Title</th>
                    <th>Document</th>
                    <th>Description</th>
                    <th>Period Uploaded</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($fetch = $pinq->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $fetch['document_title']; ?></td>
                        <td>
                            <?php
                            $document_id = $fetch['document_id'];
                            $getfiles = $mysqli->query("select * from document_files where document_id = '$document_id'");
                            while ($resfiles = $getfiles->fetch_assoc()) { ?>
                                <a href="../../ms/<?php echo $resfiles['document_location'] ?>">
                                    View/Download File (<?php echo $resfiles['document_type']; ?>)
                                </a> <br/>
                                <hr/>
                            <?php } ?>
                            <small><i>Click above to View</i></small>

                        </td>
                        <td><?php echo $fetch['document_description']; ?></td>
                        <td><?php echo $fetch['period_uploaded']; ?></td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_doc"
                                    i_index="<?php echo $fetch['id'] ?>" title="Delete">
                                <i class="flaticon2-trash ml-1" style="color: #fff !important;"></i>
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

    $(document).off('click', '.delete_doc').on('click', '.delete_doc', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Document!',
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
                            url: "ajax/queries/delete_document.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/document_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#documenttable_div').html(text);
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