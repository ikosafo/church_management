<?php include ('../../../../config.php');
$memberid = $_POST['member_id'];
$getchild = $mysqli->query("select * from children where memberid = '$memberid'");
?>

<table class="table"
       style="width:100% !important;">

    <tbody>
    <?php
    while ($resch = $getchild->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $resch['childname']; ?></td>
            <td>
                <button type="button"
                        data-type="confirm"
                        class="btn btn-sm btn-danger js-sweetalert delete_child"
                        i_index="<?php echo $resch['id']; ?>"
                        title="Delete">
                    <i class="flaticon2-trash" style="color:#fff !important;"></i>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <tfoot>

</table>
<script>
    $('#bs4-table').DataTable({
        aaSorting: [],
        dom: 'Bfrtip'
    });

    $(document).off('click', '.delete_child').on('click', '.delete_child', function () {
        var theindex = $(this).attr('i_index');
        var member_id = '<?php echo $memberid ?>';
        $.confirm({
            title: 'Delete Child!',
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
                            url: "ajax/queries/delete_child.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/child_table.php",
                                    data: {member_id:member_id},
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#child_table_div').html(text);
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
