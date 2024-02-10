<form class="form form-horizontal">
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="fullname">Full Name</label>
              <input type="text" id="fullname" class="form-control" autocomplete="off" placeholder="Full Name" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="emailaddress">Email Address</label>
              <input type="email" id="emailaddress" class="form-control" autocomplete="off" placeholder="Email Address" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="phonenumber">Phone Number</label>
              <input type="text" id="phonenumber" class="form-control" autocomplete="off" placeholder="Phone Number" />
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="gender">Gender</label>
                <div class="form-group" id="gender">
                    <div>
                        <input type="radio" id="selectmale"
                                name="gender" value="Male"
                                class="custom-control-input">
                        <label class="custom-control-label" for="selectmale">Male</label>
                    
                        <input type="radio" id="selectfemale"
                                name="gender" value="Female"
                                class="custom-control-input" style="margin-left:10px;margin-top:10px">
                        <label class="custom-control-label" for="selectfemale">Female</label>
                    </div>
                </div>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="companyname">Company Name</label>
              <input type="text" id="companyname" class="form-control" autocomplete="off" 
                        placeholder="Company Name" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="nationality">Nationality</label>
              <input type="text" id="nationality" class="form-control" autocomplete="off" placeholder="Nationality" />
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="residence">Residence</label>
              <input type="text" id="residence" class="form-control" autocomplete="off" placeholder="Residence" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="address">Address</label>
              <input type="email" id="address" class="form-control" autocomplete="off" placeholder="Address" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="adinfo">Additional Info</label>
              <textarea id="adinfo" class="form-control" placeholder="Additional Info"></textarea>
            </div>
          </div>
		  <div class="row">
		        <div class="col-sm-12 offset-sm-12">
                    <button type="button" id="customerbtn" class="btn btn-primary me-1">Submit</button>
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
                url: "ajaxscripts/queries/save/customer.php",
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
                    adinfo: adinfo
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

</script>