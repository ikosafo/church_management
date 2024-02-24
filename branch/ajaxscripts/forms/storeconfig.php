<?php
include('../../../config.php');

$getdetails = $mysqli->query("select * from system_config LIMIT 1");
$resdetails = $getdetails->fetch_assoc();
$random = $resdetails['sysconid'];
$theid = $resdetails['sysid'];

?>
<form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="churchname">Church Name</label>

                <input type="text" id="churchname" class="form-control" placeholder="Company Name" aria-label="Company Name" aria-describedby="churchname" required value="<?php echo $resdetails['churchname'] ?>" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter your church's name.</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="tagline">Tagline (Optional)</label>
                <input type="text" id="tagline" class="form-control" placeholder="Tagline" aria-label="tagline" required value="<?php echo $resdetails['tagline'] ?>" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter tagline</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="tagline">Telephone</label>
                <input type="text" id="telephone" class="form-control" placeholder="Telephone" aria-label="telephone" required value="<?php echo $resdetails['telephone'] ?>" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter telephone</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="logo">Logo</label>
                <input id="file_upload" type="file" multiple="false" />
                <div id="queue"></div>
                <div class="profile-img mt-1">
                    <img src="../<?php echo $resdetails['logo']; ?>" style="width:100px;height:100px" class="rounded img-fluid" alt="User image">
                </div>
                <input type="hidden" id="selected" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter tagline</div>
            </div>
        </div>

    </div>

    <div class="mb-2"></div>
    <button type="submit" id="configbtn" class="btn btn-primary">Update</button>
</form>


<script type="text/javascript">
    $('#file_upload').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload Picture',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        "fileSizeLimit": "20MB",
        'formData': {
            'randno': '<?php echo $random ?>'
        },
        'dnd': false,
        'uploadScript': 'ajaxscripts/queries/upload/configimg.php',
        'onUploadComplete': function(file, data) {
            console.log(data);
        },
        'onSelect': function(file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
        },
        'onCancel': function(file) {
            // Update selected so we know they have no file selected
            $("#selected").val('');
        }
    });




    $("#configbtn").click(function() {

        var churchname = $("#churchname").val();
        var tagline = $("#tagline").val();
        var telephone = $("#telephone").val();

        var error = '';
        if (churchname == "") {
            error += "Please enter church's name \n";
            $("#churchname").focus();
        }
        if (telephone == "") {
            error += 'Please enter telephone \n';
            $("#telephone").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/systemconfig.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    churchname: churchname,
                    tagline: tagline,
                    telephone: telephone
                },
                success: function(text) {
                    $('#file_upload').uploadifive('upload');
                    //alert(text);
                    location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $("#error_loc").notify(error, {
                position: "right"
            });
        }
        return false;

    });
</script>