<?php
include ('../../config.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from staff where stid = '$theid'");
$resdetails = $getdetails->fetch_assoc();
$random = $resdetails['generatedid'];
$theid = $resdetails['stid'];
?>

<p class="card-text font-small mb-2">
    Edit User 
</p>
<hr/>
<section class="horizontal-wizard">
  <div class="bs-stepper horizontal-wizard-example">
    <div class="bs-stepper-header" role="tablist" id="error_loc">
      <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">1</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Personal Information</span>
            <span class="bs-stepper-subtitle">Add Personal Info</span>
          </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      <div class="step" data-target="#address-step" role="tab" id="address-step-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">2</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Address</span>
            <span class="bs-stepper-subtitle">Add Address</span>
          </span>
        </button>
      </div>
      <div class="line">
        <i data-feather="chevron-right" class="font-medium-2"></i>
      </div>
      <div class="step" data-target="#identification-step" role="tab" id="identification-step-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">3</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">Identification</span>
            <span class="bs-stepper-subtitle">Add Identification</span>
          </span>
        </button>
      </div>
    </div>
    <div class="bs-stepper-content">
      <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
        <div class="content-header">
          <h5 class="mb-0">Personal Information</h5>
          <small class="text-muted">Enter Your Account Details</small>
        </div>
        <form>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="fullname">Full Name</label>
              <input type="text" id="fullname" name="fullname" class="form-control" 
              placeholder="Full Name" value="<?php echo $resdetails['fullname']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="emailaddress">Email Address</label>
              <input type="email" id="emailaddress" name="emailaddress" class="form-control" 
              placeholder="Email Address"  value="<?php echo $resdetails['emailaddress']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="phonenumber">Phone Number</label>
              <input type="text" id="phonenumber" name="phonenumber" class="form-control" onkeypress="return isNumber(event)"
              placeholder="Phone Number"  value="<?php echo $resdetails['telephone']; ?>" />
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="gender">Gender</label>
                <div class="form-group" id="gender">
                    <div>
                        <input type="radio" id="selectmale"
                                name="gender" value="Male"
                                class="custom-control-input" <?php if (@$resdetails['gender'] == "Male") echo "checked" ?>>
                        <label class="custom-control-label" for="selectmale">Male</label>
                    
                        <input type="radio" id="selectfemale"
                                name="gender" value="Female" <?php if (@$resdetails['gender'] == "Female") echo "checked" ?>
                                class="custom-control-input" style="margin-left:10px;margin-top:10px">
                        <label class="custom-control-label" for="selectfemale">Female</label>
                    </div>
                </div>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="dateofbirth">Date of Birth</label>
              <input type="text" id="dateofbirth" name="dateofbirth" class="form-control" 
                        placeholder="Date of Birth" value="<?php echo $resdetails['birthdate']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="nationality">Nationality</label>
              <input type="text" id="nationality" name="nationality" class="form-control" 
                    placeholder="Nationality" value="<?php echo $resdetails['nationality']; ?>"/>
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="staffid">Staff ID</label>
              <input type="text" id="staffid" name="staffid" class="form-control" 
              placeholder="Staff ID" value="<?php echo $resdetails['staffid']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="position">Position</label>
              <input type="text" id="position" name="position" class="form-control" 
              placeholder="Position" value="<?php echo $resdetails['position']; ?>" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="educationallevel">Educational Level</label>
              <select id="educationallevel" name="educationallevel" class="select2 form-control">
                  <option></option>
                  <option <?php if (@$resdetails['educationallevel'] == "Certificate") echo "Selected" ?>>Certificate</option>
                  <option <?php if (@$resdetails['educationallevel'] == "Diploma") echo "Selected" ?>>Diploma</option>
                  <option <?php if (@$resdetails['educationallevel'] == "Bachelors") echo "Selected" ?>>Bachelors</option>
                  <option <?php if (@$resdetails['educationallevel'] == "Masters") echo "Selected" ?>>Masters</option>
                  <option <?php if (@$resdetails['educationallevel'] == "PhD") echo "Selected" ?>>PhD</option>
                  <option <?php if (@$resdetails['educationallevel'] == "None") echo "Selected" ?>>None</option>
                </select>
            </div>
          </div>
        </form>
       
        <div class="d-flex justify-content-between">
          <button class="btn btn-outline-secondary btn-prev" disabled>
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
          </button>
        </div>
      </div>
      <div id="address-step" class="content" role="tabpanel" aria-labelledby="address-step-trigger">
        <div class="content-header">
          <h5 class="mb-0">Address</h5>
          <small>Enter your address</small>
        </div>
        <form>
          <div class="row">
            <div class="mb-1 col-md-6">
              <label class="form-label" for="residence">Residence</label>
              <input type="text" id="residence" name="residence" class="form-control" 
              placeholder="Residence" value="<?php echo $resdetails['residence']; ?>"/>
            </div>
            <div class="mb-1 col-md-6">
              <label class="form-label" for="address">Address</label>
              <input type="text" id="address" name="address" class="form-control" 
              placeholder="Address" value="<?php echo $resdetails['address']; ?>"/>
            </div>
            <div class="mb-1 col-md-6">
              <label class="form-label" for="hometown">Hometown</label>
              <input type="text" id="hometown" name="hometown" class="form-control" 
              placeholder="Hometown" value="<?php echo $resdetails['hometown']; ?>" />
            </div>
            <div class="mb-1 col-md-6">
              <label class="form-label" for="religion">Religion</label>
              <input type="text" id="religion" name="religion" class="form-control" 
              placeholder="Religion" value="<?php echo $resdetails['religion']; ?>" />
            </div>
          </div>
         
        </form>
        <div class="d-flex justify-content-between">
          <button class="btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
          </button>
        </div>
      </div>
      <div id="identification-step" class="content" role="tabpanel" aria-labelledby="identification-step-trigger">
        <div class="content-header">
          <h5 class="mb-0">Identification</h5>
          <small>Enter your identification details</small>
        </div>
        <form>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="idtype">ID Type</label>
              <select id="idtype" name="idtype" class="select2 form-control">
                  <option></option>
                  <option <?php if (@$resdetails['idtype'] == "Voters") echo "Selected" ?>>Voters</option>
                  <option <?php if (@$resdetails['idtype'] == "Passport") echo "Selected" ?>>Passport</option>
                  <option <?php if (@$resdetails['idtype'] == "Drivers License") echo "Selected" ?>>Drivers License</option>
                  <option <?php if (@$resdetails['idtype'] == "Ghana Card") echo "Selected" ?>>Ghana Card</option>
                  <option <?php if (@$resdetails['idtype'] == "Health Insurance") echo "Selected" ?>>Health Insurance</option>
                  <option <?php if (@$resdetails['idtype'] == "Others") echo "Selected" ?>>Others</option>
                </select>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="idnumber">ID Number</label>
              <input type="text" id="idnumber" name="idnumber" class="form-control" 
              placeholder="ID Number"  value="<?php echo $resdetails['idnumber']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="passportpic">Passport Picture</label>
              <input id="passportpic" type="file" multiple="false"/>
                <div id="queue"></div>
                <input type="hidden" id="selected" name="selected"/>
                    <div class="profile-img mt-1">
                        <img src="<?php $getimage = $mysqli->query("select * from staff_images where random = '$random'");
                                $resimage = $getimage->fetch_assoc();
                                echo $resimage['imageloc'];
                                ?>" style="width:50%" class="rounded img-fluid" alt="User image">
                    </div>
            </div>
           
          </div>
         
        </form>
        <div class="d-flex justify-content-between">
          <button class="btn btn-primary btn-prev">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
          </button>
          <button class="btn btn-success btn-submit">Edit</button>
        </div>
      </div>
      
    </div>
  </div>
</section>

<button type="button" id="backtousers" class="btn btn-outline-primary waves-effect">Back to users</button>
                
            
<script>
    // Page jquery scripts
    $("#dateofbirth").flatpickr();
    $("#educationallevel").select2({
        placeholder: "Select educational level",
        allowClear: true
    });
    $("#idtype").select2({
        placeholder: "Select ID Type",
        allowClear: true
    });

    $("#backtousers").click(function(){
        window.location.href="/viewusers";
    });


    //Image
      $('#passportpic').uploadifive({
        'auto'             : true,
        //'checkScript'      : 'app-assets/uploadifive/check-exists.php',
        'uploadScript'     : 'ajaxscripts/queries/upload/passportpic.php',
        'formData': {'randno': '<?php echo $random ?>'},
        'queueID'          : 'queue',
        "fileType": '.gif, .jpg, .png, .jpeg',
        "multi": false,
        "height": 30,
        "width": 150,
        "fileSizeLimit": "20MB",
        "uploadLimit": 10,
        "buttonText": "Edit Image",
        'removeCompleted' : true,
        'onUploadComplete' : function(file, data) {
            var obj = JSON.parse(data);
            console.log(data);
            alert(data);
        },
        'onSelect': function (file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
            },
        onCancel : function(file) {
            $("#selected").val('');
            //alert(file.name + " 已取消上传~!");
        },
        onFallback : function() {
            //alert("该浏览器无法使用!");
        },
        onUpload : function(file) {
            $("#selected").val('yes');
            //document.getElementById("submit").disabled = true;
        },
    });


// Add action on form submit
    $(function () {
    "use strict";
    var e = document.querySelectorAll(".bs-stepper"),
        n = $(".select2"),
        i = document.querySelector(".horizontal-wizard-example"),
        r = document.querySelector(".vertical-wizard-example"),
        t = document.querySelector(".modern-wizard-example"),
        o = document.querySelector(".modern-vertical-wizard-example");
    if (void 0 !== typeof e && null !== e)
        for (var l = 0; l < e.length; ++l)
            e[l].addEventListener("show.bs-stepper", function (e) {
                for (var n = e.detail.indexStep, i = $(e.target).find(".step").length - 1, r = $(e.target).find(".step"), t = 0; t < n; t++) {
                    r[t].classList.add("crossed");
                    for (var o = n; o < i; o++) r[o].classList.remove("crossed");
                }
                if (0 == e.detail.to) {
                    for (var l = n; l < i; l++) r[l].classList.remove("crossed");
                    r[0].classList.remove("crossed");
                }
            });
    if (
        (n.each(function () {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>');
        }),
        void 0 !== typeof i && null !== i)
    ) {
        var d = new Stepper(i);
        $(i)
            .find("form")
            .each(function () {
                $(this).validate({
                    rules: {
              
                      fullname: { required: !0 },
                      gender: { required: !0 },
                      emailaddress: { /* required: !0, */ email: !0 },
                      phonenumber: {required: true, digits: true, minlength: 10,maxlength: 10 },
                      dateofbirth: { required: !0 },
                      nationality: { required: !0 },
                      staffid: { required: !0 },
                      position: { required: !0 },
                      educationallevel: { required: !0 },
                      residence: { required: !0 },
                      address: { required: !0 },
                      hometown: { required: !0 },
                      religion: { required: !0 },
                      idtype: { required: !0 },
                      idnumber: { required: !0 },
                      username: { required: !0 },
                      userpassword: { required: true, minlength: 6 },
                      confirmpassword: { required: !0, equalTo: "#userpassword" },
                    },
                });
            }),
            $(i)
                .find(".btn-next")
                .each(function () {
                    $(this).on("click", function (e) {
                        //alert('test')
                        $(this).parent().siblings("form").valid() ? d.next() : e.preventDefault();
                    });
                }),
            $(i)
                .find(".btn-prev")
                .on("click", function () {
                    d.previous();
                }),
            $(i)
                .find(".btn-submit")
                .on("click", function () {
                   $(this).parent().siblings("form").valid() && alert("Submitted..!!");
                   var fullname = $("#fullname").val();
                    var gender = $('input[name=gender]:checked').val();
                    var emailaddress = $("#emailaddress").val();
                    var phonenumber = $("#phonenumber").val();
                    var dateofbirth = $("#dateofbirth").val();
                    var nationality = $("#nationality").val();
                    var staffid = $("#staffid").val();
                    var position = $("#position").val();
                    var educationallevel = $("#educationallevel").val();
                    var residence = $("#residence").val();
                    var address = $("#address").val();
                    var hometown = $("#hometown").val();
                    var religion = $("#religion").val();
                    var idtype = $("#idtype").val();
                    var idnumber = $("#idnumber").val();
                    var random = '<?php echo $random; ?>';
                    var theid = '<?php echo $theid; ?>';
                    //alert(gender);
                    var error = '';
                   

                    if (error == "") {
                      $.ajax({
                          type: "POST",
                          url: "ajaxscripts/queries/edit/user.php",
                          beforeSend: function () {
                                  $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                          },
                          data: {
                              fullname: fullname,
                              gender: gender,
                              emailaddress: emailaddress,
                              phonenumber: phonenumber,
                              dateofbirth: dateofbirth,
                              nationality: nationality,
                              staffid: staffid,
                              position: position,
                              educationallevel: educationallevel,
                              residence: residence,
                              address: address,
                              hometown: hometown,
                              religion: religion,
                              idtype: idtype,
                              idnumber: idnumber,
                              random: random,
                              theid: theid
                          },
                          success: function (text) {
                              //alert(text);
                             
                              if (text == 1) {
                                 //Load user form
                                  $.ajax({
                                      url: "ajaxscripts/forms/adduser.php",
                                      beforeSend: function () {
                                          $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                                      },
                                      success: function (text) {
                                          $('#pageform_div').html(text);
                                      },
                                      error: function (xhr, ajaxOptions, thrownError) {
                                          alert(xhr.status + " " + thrownError);
                                      },
                                      complete: function () {
                                          $.unblockUI();
                                      },
                                  });
                                //$('#passportpic').uploadifive('upload');
                                window.location.href="/viewusers";

                              }
                              else {
                                $("#error_loc").notify("Username already exists", {position: "top"});
                              }
                          },
                          error: function (xhr, ajaxOptions, thrownError) {
                              alert(xhr.status + " " + thrownError);
                          },
                          complete: function () {
                              $.unblockUI();
                          },
                      });
                    }
            else {
                $("#error_loc").notify(error, {position: "top"});
            }
            return false;    
                  

                    
                });
    }
 
 
});
	
	
</script>