<?php
include ('../../config.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from customer where cusid = '$theid'");
$resdetails = $getdetails->fetch_assoc();
$theid = $resdetails['cusid'];
?>
<p class="card-text font-small mb-2">
    Edit Customer
</p>
<hr/>
<form class="form form-horizontal">
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="fullname">Full Name</label>
              <input type="text" id="fullname" class="form-control" 
              placeholder="Full Name" value="<?php echo $resdetails['fullname']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="emailaddress">Email Address</label>
              <input type="email" id="emailaddress" class="form-control" 
              placeholder="Email Address"  value="<?php echo $resdetails['emailaddress']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="phonenumber">Phone Number</label>
              <input type="text" id="phonenumber" class="form-control" 
              placeholder="Phone Number"  value="<?php echo $resdetails['phonenumber']; ?>"/>
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="gender">Gender</label>
                <div class="form-group" id="gender">
                    <div>
                        <input type="radio" id="selectmale"
                                name="gender" value="Male"
                                <?php if (@$resdetails['gender'] == "Male") echo "checked" ?>
                                class="custom-control-input">
                        <label class="custom-control-label" for="selectmale">Male</label>
                    
                        <input type="radio" id="selectfemale"
                                name="gender" value="Female"
                                <?php if (@$resdetails['gender'] == "Female") echo "checked" ?>
                                class="custom-control-input" style="margin-left:10px;margin-top:10px">
                        <label class="custom-control-label" for="selectfemale">Female</label>
                    </div>
                </div>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="companyname">Company Name</label>
              <input type="text" id="companyname" class="form-control" 
                        placeholder="Company Name" value="<?php echo $resdetails['companyname']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="nationality">Nationality</label>
              <input type="text" id="nationality" class="form-control" 
                        placeholder="Nationality"  value="<?php echo $resdetails['nationality']; ?>"/>
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="residence">Residence</label>
              <input type="text" id="residence" class="form-control" 
                    placeholder="Residence"  value="<?php echo $resdetails['residence']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="address">Address</label>
              <input type="email" id="address" class="form-control" 
                    placeholder="Address"  value="<?php echo $resdetails['address']; ?>"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="adinfo">Additional Info</label>
              <textarea id="adinfo" class="form-control" placeholder="Additional Info"><?php echo $resdetails['adinfo']; ?></textarea>
            </div>
          </div>
		  <div class="row">
		        <div class="col-sm-12 offset-sm-12">
                    <button type="button" id="customerbtn" class="btn btn-warning me-1">Update</button>
                    <button type="button" id="backtocustomers" class="btn btn-outline-primary waves-effect">Back to customers</button>
                </div>
			</div>
         
        </form>
        
    <script>

     // Add action on form submit
     $("#customerbtn").click(function(){
    
      var fullname = $("#fullname").val();
      var emailaddress = $("#emailaddress").val();
      var phonenumber = $("#phonenumber").val();
      var gender = $('input[name=gender]:checked').val();
      var companyname = $("#companyname").val();
      var nationality = $("#nationality").val();
      var residence = $("#residence").val();
      var address = $("#address").val();
      var adinfo = $("#adinfo").val();
      var theid = '<?php echo $theid; ?>';

      var error = '';
      if (fullname == "") {
          error += 'Please enter full name \n';
          $("#fullname").focus();
      }
      if (emailaddress != "" && !emailaddress.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                error += 'Please enter a valid email \n';
          $("#email_address").focus();
      }
      if (phonenumber == "") {
          error += 'Please enter phone number \n';
          $("#phonenumber").focus();
      }
      if (phonenumber != "" && !$.isNumeric(phonenumber)) {
           error += 'Please enter only digits \n';
          $("#phonenumber").focus();
      }
      if (phonenumber != "" && phonenumber.length != '10') {
           error += 'Please enter ten digits \n';
          $("#phonenumber").focus();
      }
      if (gender == undefined) {
           error += 'Please select gender  \n';
      }
      if (companyname == "") {
          error += 'Please enter company name \n';
          $("#companyname").focus();
      }
      if (nationality == "") {
          error += 'Please enter nationality \n';
          $("#nationality").focus();
      }
      if (residence == "") {
          error += 'Please enter residence \n';
          $("#residence").focus();
      }
      if (address == "") {
          error += 'Please enter address \n';
          $("#address").focus();
      }
      //alert($.isNumeric(phonenumber));
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/customer.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    fullname: fullname,
                    emailaddress: emailaddress,
                    phonenumber: phonenumber,
                    gender: gender,
                    companyname: companyname,
                    nationality: nationality,
                    residence: residence,
                    address: address,
                    adinfo: adinfo,
                    theid:theid
                },
                success: function (text) {
                    //alert(text);
            
                    $.ajax({
                            url: "ajaxscripts/forms/addcustomer.php",
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
                        window.location.href="/viewcustomers";


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
            $("#error_loc").notify(error, {position: "bottom"});
        }
        return false;

    });

    $("#backtocustomers").click(function(){
        window.location.href="/viewcustomers";
    });


</script>