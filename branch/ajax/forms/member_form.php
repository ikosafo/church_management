<?php include ('../../../../config.php');
$memberid = date('ymdhis') . rand(1, 10000);
?>

<script>
    function SelectTitle(val) {
        var element = document.getElementById('divtitle');
        if (val == 'Other')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

<style>
    .notifyjs-bootstrap-base {
        font-weight: lighter;
        font-size: small;
    }
    .educbus-class {
        cursor: not-allowed;
    }
    .educbus-class a {
        pointer-events: none;
    }
    .educbus-change {
        cursor: hand
    }
    .educbus-change a {
        pointer-events: auto
    }
    .family-class {
        cursor: not-allowed;
    }
    .family-class a {
        pointer-events: none;
    }
    .family-change {
        cursor: hand
    }
    .family-change a {
        pointer-events: auto
    }
    .ministry-class {
        cursor: not-allowed;
    }
    .ministry-class a {
        pointer-events: none;
    }
    .ministry-change {
        cursor: hand
    }
    .ministry-change a {
        pointer-events: auto
    }
    .summary-class {
        cursor: not-allowed;
    }
    .summary-class a {
        pointer-events: none;
    }
    .summary-change {
        cursor: hand
    }
    .summary-change a {
        pointer-events: auto
    }
</style>


<div class="card card-tabs">
    <div class="card-header p-0 no-border">
        <ul class="nav nav-tabs primary-tabs p-l-30 m-0" id="member_form">
            <li class="nav-item" role="presentation"><a href="#personal"
                                                        class="nav-link active show"
                                                        data-toggle="tab"
                                                        aria-expanded="true">Personal Information</a></li>
            <li id="educbus-id" class="nav-item educbus-class" role="presentation"><a
                    href="#educbus"
                    class="nav-link" data-toggle="tab"
                    aria-expanded="true">Education & Business</a></li>
            <li id="family-id" class="nav-item family-class" role="presentation"><a href="#family"
                                                                                    class="nav-link"
                                                                                    data-toggle="tab"
                                                                                    aria-expanded="true">
                    Family
                </a>
            </li>
            <li id="ministry-id" class="nav-item ministry-class" role="presentation"><a href="#ministry"
                                                                                        class="nav-link"
                                                                                        data-toggle="tab"
                                                                                        aria-expanded="true">Ministry Groups</a>
            </li>
            <li id="summary-id" class="nav-item summary-class" role="presentation"><a href="#summary"
                                                                                      class="nav-link"
                                                                                      data-toggle="tab"
                                                                                      aria-expanded="true">Summary</a>
            </li>
        </ul>
    </div>
    <div class="card-body">

        <div class="tab-content">
            <div class="tab-pane fadeIn active" id="personal">
                <div id="success_loc"></div>
                <div id="error_loc"></div>

                <form name="provisional_form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <select id="title" style="width: 100%" onchange='SelectTitle(this.value);'>
                                                <option value=""> Select Title&nbsp;</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Ms">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Dr">Dr</option>
                                                <option value="Professor">Professor</option>
                                                <option value="Pastor">Pastor</option>
                                                <option value="Rev">Rev</option>
                                                <option value="Bishop">Bishop</option>
                                                <option value="Prophet">Prophet</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="divtitle" style="display: none;">
                                            <label for="exampleInputEmail1">Specify title</label>
                                            <div><input type="text" id="othertitle" class="form-control"
                                                        placeholder="Specify Title"/></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Surname</label>
                                    <input type="text" class="form-control" id="surname"
                                           placeholder="Enter Surname">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">First Name</label>
                                    <input type="text" class="form-control" id="firstname"
                                           placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Other Name(s)</label>
                                    <input type="text" class="form-control" id="othername"
                                           placeholder="Enter Other Name(s)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email Address</label>
                                    <input type="text" class="form-control" id="email_address"
                                           placeholder="Enter email address">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Telephone </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+</span>
                                        </div>
                                        <input type="text" class="form-control"
                                               id="telephone" onkeypress="return isNumber(event)"
                                               minlength="10" autocomplete="off"
                                               placeholder="Enter telephone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Alternative Telephone </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+</span>
                                        </div>
                                        <input type="text" class="form-control"
                                               id="alttelephone" onkeypress="return isNumber(event)"
                                               minlength="10" autocomplete="off"
                                               placeholder="Enter alternative telephone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date of Birth</label>
                                    <input type="text" id="birth_date"
                                           class="form-control"
                                           placeholder="Select Date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nationality</label><br/>
                                    <input type="text" id="nationality" class="form-control countryselect"
                                           placeholder="Select Country"/>
                                    <input type="hidden" id="country_code"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hometown</label>
                                    <input type="text" class="form-control" id="hometown"
                                           placeholder="Enter hometown">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Residence</label>
                                    <input type="text" class="form-control" id="residence"
                                           placeholder="Enter residence">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">House Number</label>
                                    <input type="text" class="form-control" id="house_number"
                                           placeholder="Enter house number">
                                </div>
                                <div class="form-group" id="gender">
                                    <label for="exampleInputPassword1">Gender </label>
                                    <br/>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1"
                                               name="gender" value="Male"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2"
                                               name="gender" value="Female"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">Female</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Passport Picture</label>
                                    <input type="file" class="form-control" id="member_picture">
                                    <input type="hidden" id="selected"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <button type="button" class="btn btn-secondary"
                                style="cursor: default" disabled="">Previous
                        </button>
                        <button type="button" style="float: right" class="btn btn-primary" id="savemember">Save and Continue
                        </button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fadeIn" id="educbus">
                <div id="educbus_form_div"></div>
            </div>

            <div class="tab-pane fadeIn" id="family">
                <div id="family_form_div"></div>
            </div>

            <div class="tab-pane fadeIn" id="ministry">
                <div id="ministry_form_div"></div>
            </div>

            <div class="tab-pane fadeIn" id="summary">
                <div id="summary_form_div"></div>
            </div>

        </div>

    </div>


    <script>
        $(document).ready(function () {
            $('#member_picture').uploadifive({
                'auto': false,
                'method': 'post',
                'buttonText': 'Upload image',
                'fileType': 'image/*',
                'multi': false,
                'width': 180,
                'formData': {'randno': '<?php echo $memberid?>'},
                'dnd': false,
                'uploadScript': 'ajax/queries/upload_member_image.php',
                'onUploadComplete': function (file, data) {
                    console.log(data);
                },
                'onSelect': function (file) {
                    // Update selected so we know they have selected a file
                    $("#selected").val('yes');
                },
                'onCancel': function (file) {
                    // Update selected so we know they have no file selected
                    $("#selected").val('');
                }
            });

            $('#title').select2();
            $('#member_branch').select2();
            $(".countryselect").countrySelect({
                preferredCountries: ["gh", "gb"]
            });
            $('#birth_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                orientation: "bottom",
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            });

            $("#start_time").timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
            });

            $("#savemember").click(function () {
                var member_id = '<?php echo $memberid; ?>';
                var title = $("#title").val();
                var othertitle = $("#othertitle").val();
                var surname = $("#surname").val();
                var firstname = $("#firstname").val();
                var othername = $("#othername").val();
                var email_address = $("#email_address").val();
                var telephone = $("#telephone").val();
                var alttelephone = $("#alttelephone").val();
                var birth_date = $("#birth_date").val();
                var nationality = $("#nationality").val();
                var hometown = $("#hometown").val();
                var residence = $("#residence").val();
                var house_number = $("#house_number").val();
                var gender = $('input[name=gender]:checked').val();
                var selected = $("#selected").val();

                var error = '';
                if (title == "") {
                    error += 'Please select title \n';
                    $("#title").focus();
                }
                if (title == "Other" && othertitle == "") {
                    error += 'Please specify title \n';
                    $("#othertitle").focus();
                }
                if (title != "Other" && othertitle != "") {
                    error += 'Specify title should be empty or choose "Other" for title \n';
                }
                if (surname == "") {
                    error += 'Please enter surname \n';
                    $("#surname").focus();
                }
                if (firstname == "") {
                    error += 'Please enter first name \n';
                    $("#firstname").focus();
                }
                if (!email_address.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                    error += 'Please enter valid email \n';
                    $("#email_address").focus();
                }
                if (telephone == "") {
                    error += 'Please enter telephone \n';
                    $("#telephone").focus();
                }
                if (telephone != "" && telephone.length < 10) {
                    error += 'Please enter valid telephone \n';
                    $("#telephone").focus();
                }
                if (alttelephone != "" && alttelephone.length < 10) {
                    error += 'Please enter valid alt telephone \n';
                    $("#alttelephone").focus();
                }
                if (birth_date == "") {
                    error += 'Please select birth date \n';
                }
                if (nationality == "") {
                    error += 'Please select nationality \n';
                    $("#nationality").focus();
                }
                if (hometown == "") {
                    error += 'Please enter hometown \n';
                    $("#hometown").focus();
                }
                if (residence == "") {
                    error += 'Please enter residence \n';
                    $("#residence").focus();
                }
                if (gender == undefined) {
                    error += 'Please select gender  \n';
                }
                if (selected == "") {
                    error += 'Please upload image\n';
                }

                if (error == "") {
                    $.ajax({
                        type: "POST",
                        url: "ajax/queries/save_member.php",
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
                            title: title,
                            othertitle: othertitle,
                            surname: surname,
                            firstname: firstname,
                            othername: othername,
                            email_address: email_address,
                            telephone: telephone,
                            alttelephone: alttelephone,
                            birth_date: birth_date,
                            nationality: nationality,
                            hometown: hometown,
                            residence: residence,
                            house_number: house_number,
                            gender: gender
                        },
                        success: function (text) {
                            //alert(text);
                            $('#member_picture').uploadifive('upload');
                            $.notify("Profile Saved", "success", {position: "top center"});

                            $.ajax({
                                url: "ajax/tables/member_table.php",
                                beforeSend: function () {
                                    KTApp.blockPage({
                                        overlayColor: "#000000",
                                        type: "v2",
                                        state: "success",
                                        message: "Please wait..."
                                    })
                                },
                                success: function (text) {
                                    $('#membertable_div').html(text);
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                },
                                complete: function () {
                                    KTApp.unblockPage();
                                },

                            });

                            $("#member_form a[href='#educbus']").tab('show');
                            $('#educbus-id').removeClass('educbus-class');
                            $('#educbus-id').addClass('educbus-change');

                            $.ajax({
                                type: "POST",
                                url: "ajax/forms/educbus_form.php",
                                data:{member_id:member_id},
                                success: function (text) {
                                    $('#educbus_form_div').html(text);
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
        });
    </script>