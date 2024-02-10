<?php
include ('../../config.php');
$theid = $_POST['id_index'];
$getdetails = $mysqli->query("select * from supplier where supid = '$theid'");
$resdetails = $getdetails->fetch_assoc();
?>
<p class="card-text font-small mb-2">
    Edit Supplier
</p>
<hr/>
<form class="form form-horizontal">
        <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="companyname">Company Name</label>
              <input type="text" id="companyname" class="form-control" 
                        placeholder="Company Name" value="<?php echo $resdetails['companyname']; ?>"/>
            </div>
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
          </div>
          
          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="phonenumber">Phone Number</label>
              <input type="text" id="phonenumber" class="form-control" 
                value="<?php echo $resdetails['phonenumber']; ?>"
                placeholder="Phone Number" onkeypress="return isNumber(event)"/>
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="city">City</label>
              <input type="text" id="city" class="form-control" placeholder="City"
              value="<?php echo $resdetails['city']; ?>" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="address">Address</label>
              <input type="email" id="address" class="form-control" 
              value="<?php echo $resdetails['address']; ?>"
              placeholder="Address" />
            </div>
           
          </div>

          <div class="row">
            <div class="mb-1 col-md-4">
              <label class="form-label" for="accnumber">Account No.</label>
              <input type="text" id="accnumber" class="form-control" 
              value="<?php echo $resdetails['accnumber']; ?>"
              placeholder="Account No." />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="accbalance">Store Account Balance</label>
              <input type="text" id="accbalance" class="form-control" 
              value="<?php echo $resdetails['accbalance']; ?>"
              placeholder="Store Account Balance" />
            </div>
            <div class="mb-1 col-md-4">
              <label class="form-label" for="adinfo">Additional Info</label>
              <textarea id="adinfo" class="form-control" placeholder="Additional Info"><?php echo $resdetails['adinfo'] ?></textarea>
            </div>
            
          </div>
		      <div class="row">
		        <div class="col-sm-12 offset-sm-12">
                    <button type="button" id="supplierbtn" class="btn btn-warning me-1">Update</button>
                    <button type="button" id="backtosuppliers" class="btn btn-outline-primary waves-effect">Back to suppliers</button>
                </div>
		    	</div>
         
        </form>
        
    <script>
     // Add action on form submit
     $("#supplierbtn").click(function(){
    
      var companyname = $("#companyname").val();
      var fullname = $("#fullname").val();
      var emailaddress = $("#emailaddress").val();
      var phonenumber = $("#phonenumber").val();
      var city = $("#city").val();
      var address = $("#address").val();
      var accnumber = $("#accnumber").val();
      var accbalance = $("#accbalance").val();
      var adinfo = $("#adinfo").val();
      var theid = '<?php echo $theid; ?>';

      var error = '';
      if (companyname == "") {
          error += 'Please enter company name \n';
          $("#companyname").focus();
      }
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
      if (city == "") {
          error += 'Please enter city \n';
          $("#city").focus();
      }
      if (address == "") {
          error += 'Please enter address \n';
          $("#address").focus();
      }
     
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/supplier.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    companyname: companyname,
                    fullname: fullname,
                    emailaddress: emailaddress,
                    phonenumber: phonenumber,
                    city: city,
                    address: address,
                    accnumber: accnumber,
                    accbalance: accbalance,
                    adinfo: adinfo,
                    theid:theid
                },
                success: function (text) {
                    //alert(text);
            
                    $.ajax({
                            url: "ajaxscripts/forms/addsupplier.php",
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
                        window.location.href="/viewsuppliers";


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


    $("#backtosuppliers").click(function(){
        window.location.href="/viewsuppliers";
    });


</script>