<?php include('includes/authheader.php');
$random = rand(1, 10) . date("Y-m-d");
?>

<div class="auth-inner my-2" style="max-width:700px !important">
    <!-- Login basic -->
    <div class="card mb-0" id="error_loc">
        <div class="card-body">
            <a href="/systemconfig" class="brand-logo">
                <!--  Logo here -->
                <h2 class="brand-text text-primary ms-1 text-uppercase">Church Management System Configuration</h2>
            </a>

            <h4 class="card-title mb-1 text-center">Please fill in the form to set up account</h4>
            <hr>

            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="churchname">Church Name</label>

                            <input type="text" id="churchname" class="form-control" placeholder="Company Name" aria-label="Company Name" aria-describedby="churchname" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter your church's name.</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="tagline">Tagline (Optional)</label>
                            <input type="text" id="tagline" class="form-control" placeholder="Tagline" aria-label="tagline" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter tagline</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="tagline">Telephone</label>
                            <input type="text" id="telephone" class="form-control" placeholder="Telephone" aria-label="telephone" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter telephone</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="logo">Logo</label>
                            <input id="file_upload" type="file" multiple="false" />
                            <div id="queue"></div>
                            <input type="hidden" id="selected" />

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter tagline</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="username">System User</label>
                            <input type="text" id="username" class="form-control" placeholder="Username" aria-label="username" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter username</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="password">User Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Password" aria-label="password" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter password</div>
                        </div>
                    </div>

                </div>

                <div class="mb-2"></div>
                <button type="submit" id="configbtn" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
    <!-- /Login basic -->
</div>
</div>

</div>
</div>
</div>
<!-- END: Content-->

<?php include('includes/authfooter.php'); ?>


<script type="text/javascript">
    $('#file_upload').uploadifive({
        'auto': false,
        //'checkScript'      : 'app-assets/uploadifive/check-exists.php',
        'uploadScript': 'ajaxscripts/queries/upload/sysconlogo.php',
        'formData': {
            'randno': '<?php echo $random ?>'
        },
        'queueID': 'queue',
        "fileType": '.gif, .jpg, .png, .jpeg',
        "multi": false,
        "height": 30,
        "width": 150,
        "fileSizeLimit": "20MB",
        "uploadLimit": 10,
        "buttonText": "Select Image",
        'removeCompleted': true,
        'onUploadComplete': function(file, data) {
            var obj = JSON.parse(data);
            console.log(data);
            //alert('hi');
        },
        'onSelect': function(file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
        },
        onCancel: function(file) {
            $("#selected").val('');
            //alert(file.name + " 已取消上传~!");
        },
        onFallback: function() {
            //alert("该浏览器无法使用!");
        },
        onUpload: function(file) {
            $("#selected").val('yes');
            //document.getElementById("submit").disabled = true;
        },
    });



    $("#configbtn").click(function() {

        var churchname = $("#churchname").val();
        var tagline = $("#tagline").val();
        var telephone = $("#telephone").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var selected = $("#selected").val();
        var sysconid = '<?php echo $random; ?>';
        //alert(churchname);

        var error = '';
        if (churchname == "") {
            error += "Please enter church's name \n";
            $("#churchname").focus();
        }
        if (telephone == "") {
            error += 'Please enter telephone \n';
            $("#telephone").focus();
        }
        if (username == "") {
            error += 'Please enter username \n';
            $("#username").focus();
        }
        if (password == "") {
            error += 'Please enter password \n';
            $("#password").focus();
        }
        if (password != "" && password.length < 6) {
            error += 'Password length should not be less 6 \n';
            $("#password").focus();
        }
        if (selected != "yes") {
            error += 'Please upload logo \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/systemconfig.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    churchname: churchname,
                    tagline: tagline,
                    telephone: telephone,
                    username: username,
                    password: password,
                    sysconid: sysconid
                },
                success: function(text) {
                    $('#file_upload').uploadifive('upload');
                    //alert(text);
                    window.location.href = "login";
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