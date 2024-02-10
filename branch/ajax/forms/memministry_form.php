<?php include('../../../../config.php');

$memberid = $_POST['member_id'];
$branch = $_SESSION['branch'];
$getm = $mysqli->query("select * from `member` where memberid = '$memberid'");
$resm = $getm->fetch_assoc();
?>

<div id="success_loc"></div>
<div id="error_loc"></div>
<h6 style="color: red">Field with * are required</h6><hr/>

<form name="mmemministry_form" method="post" autocomplete="off">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="mem_department">Department *</label>
                    <select id="mem_department" style="width: 100%">
                        <option value="">Select</option>
                        <?php
                        $department = $resm['department'];
                        $getd = $mysqli->query("select * from department where branch = '$branch' ORDER BY department_name");
                        while ($result = $getd->fetch_assoc()) { ?>
                            <option <?php if (@$department == @$result['id']) echo "Selected" ?>>
                                <?php echo $result['department_name'];?></option>
                        <?php } ?>
                        <option <?php if (@$department == 'None') echo "Selected" ?>>None</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="mem_ministry">Ministry *</label>
                    <select id="mem_ministry" style="width: 100%">
                        <option value="">Select</option>
                        <?php
                        $ministry = $resm['ministry'];
                        $getm = $mysqli->query("select * from ministry where branch = '$branch' ORDER BY ministry_name");
                        while ($result = $getm->fetch_assoc()) { ?>
                            <option <?php if (@$ministry == @$result['id']) echo "Selected" ?>>
                                <?php echo $result['ministry_name'];?></option>
                        <?php } ?>
                        <option <?php if (@$ministry == 'None') echo "Selected" ?>>None</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="mem_cell">Cell *</label>
                    <select id="mem_cell" style="width: 100%">
                        <option value="">Select</option>
                        <?php
                        $cell = $resm['cell'];
                        $getc = $mysqli->query("select * from cell where branch = '$branch' ORDER BY cell_name");
                        while ($result = $getc->fetch_assoc()) { ?>
                            <option <?php if (@$cell == @$result['id']) echo "Selected" ?>>
                                <?php echo $result['cell_name'];?></option>
                        <?php } ?>
                        <option <?php if (@$cell == 'None') echo "Selected" ?>>None</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</form>

<div class="card-footer bg-light">
    <button type="button" class="btn btn-secondary" id="previous_family">Previous
    </button>
    <button type="button" style="float: right" class="btn btn-primary" id="save_memministry">Save and Continue
    </button>
</div>


<script>
    $("#mem_department").select2();
    $("#mem_ministry").select2();
    $("#mem_cell").select2();

    //Move to Personal Information
    $("#previous_family").click(function () {
        $("#member_form a[href='#family']").tab('show');
        $('#family-id').removeClass('family-class');
        $('#family-id').addClass('family-change');
    });


    $("#save_memministry").click(function () {
        var member_id = '<?php echo $memberid; ?>';
        var mem_department = $("#mem_department").val();
        var mem_ministry = $("#mem_ministry").val();
        var mem_cell = $("#mem_cell").val();

        //alert(member_id);
        var error = '';
        if (mem_department == "") {
            error += 'Please select department \n';
        }
        if (mem_ministry == "") {
            error += 'Please select ministry \n';
        }
        if (mem_cell == "") {
            error += 'Please select cell \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_memministry.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    member_id: member_id,
                    mem_department: mem_department,
                    mem_ministry: mem_ministry,
                    mem_cell: mem_cell
                },
                success: function (text) {
                    //alert(text);
                    $.notify("Ministry Information Saved", "success", {position: "top center"});
                    $("#member_form a[href='#summary']").tab('show');
                    $('#summary-id').removeClass('summary-class');
                    $('#summary-id').addClass('summary-change');

                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/summary_form.php",
                        data:{member_id:member_id},
                        success: function (text) {
                            $('#summary_form_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;
    });
</script>
