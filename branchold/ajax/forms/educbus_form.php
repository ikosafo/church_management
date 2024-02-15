<?php include("../../../../config.php");
$memberid = $_POST['member_id'];
$geted = $mysqli->query("select * from `member` where memberid = '$memberid'");
$resed = $geted->fetch_assoc();
?>

<div id="success_loc"></div>
<div id="error_loc"></div>
<h6 style="color: red">Field with * are required</h6><hr/>
<form name="educbus_form" method="post" autocomplete="off">
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="educlevel">Educational Level *</label>
                    <select id="educlevel" style="width: 100%">
                        <option value="">Select</option>
                        <option <?php if(@$resed['educationallevel'] == "Tertiary") echo "Selected" ?>>Tertiary</option>
                        <option <?php if(@$resed['educationallevel'] == "'A' Levels") echo "Selected" ?>>'A' Levels</option>
                        <option <?php if(@$resed['educationallevel'] == "'O' Levels") echo "Selected" ?>>'O' Levels</option>
                        <option <?php if(@$resed['educationallevel'] == "Certificate") echo "Selected" ?>>Certificate</option>
                        <option <?php if(@$resed['educationallevel'] == "Secondary") echo "Selected" ?>>Secondary</option>
                        <option <?php if(@$resed['educationallevel'] == "Primary") echo "Selected" ?>>Primary</option>
                        <option <?php if(@$resed['educationallevel'] == "None") echo "Selected" ?>>None</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="institution_attended">Last Institution Attended</label>
                    <input type="text" class="form-control" id="institution_attended"
                           placeholder="Enter institution" value="<?php echo $resed['institutionattended'] ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Qualification</label>
                    <input type="text" class="form-control" id="qualification"
                           placeholder="Enter qualification" value="<?php echo $resed['qualification'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Occupation</label>
                    <input type="text" class="form-control" id="occupation"
                           placeholder="Enter Occupation" value="<?php echo $resed['occupation'] ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Place of Work/Company</label>
                    <input type="text" class="form-control" id="workplace"
                           placeholder="Enter Place of Work" value="<?php echo $resed['workplace'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Job Position</label>
                    <input type="text" class="form-control" id="job_position"
                           placeholder="Enter Job Position" value="<?php echo $resed['jobposition'] ?>">
                </div>
            </div>
        </div>
    </div>

</form>

<div class="card-footer bg-light">
    <button type="button" class="btn btn-secondary" id="previous_personal">Previous
    </button>
    <button type="button" style="float: right" class="btn btn-primary" id="save_educbus">Save and Continue
    </button>
</div>



<script>
    $("#educlevel").select2();

    //Move to Personal Information
    $("#previous_personal").click(function () {
        $("#member_form a[href='#personal']").tab('show');
        $('#personal-id').removeClass('personal-class');
        $('#personal-id').addClass('personal-change');
    });

    $("#save_educbus").click(function () {
        var member_id = '<?php echo $memberid; ?>';
        var educlevel = $("#educlevel").val();
        var institution_attended = $("#institution_attended").val();
        var qualification = $("#qualification").val();
        var occupation = $("#occupation").val();
        var workplace = $("#workplace").val();
        var job_position = $("#job_position").val();
        //alert(member_id);
        var error = '';

        if (educlevel == "") {
            error += 'Please select educational level \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_educbus.php",
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
                    educlevel: educlevel,
                    institution_attended: institution_attended,
                    qualification: qualification,
                    occupation: occupation,
                    workplace: workplace,
                    job_position: job_position
                },
                success: function (text) {
                    //alert(text);
                    $.notify("Education and Business Saved", "success", {position: "top center"});
                    $("#member_form a[href='#family']").tab('show');
                    $('#family-id').removeClass('family-class');
                    $('#family-id').addClass('family-change');

                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/family_form.php",
                        data:{member_id:member_id},
                        success: function (text) {
                            $('#family_form_div').html(text);
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
