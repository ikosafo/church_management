<p class="card-text font-small mb-2">
    Change Password
</p>
<hr/>
<form class="form form-horizontal">
            <div class="row">
            <div class="col-12">
                    <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="currentpassword">Current Password</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="password" id="currentpassword" class="form-control" 
                            placeholder="Current Password" />
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="newpassword">New Password</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="password" id="newpassword" class="form-control" 
                            placeholder="New Password" />
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="confirmpassword">Confirm Password</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="password" id="confirmpassword" class="form-control" 
                            placeholder="Confirm Password" />
                    </div>
                    </div>
                </div>
            
            
            <div class="col-sm-9 offset-sm-3">
                <button type="button" id="categorybtn" class="btn btn-primary me-1">Submit</button>
            </div>
            </div>
 </form>



<script>
     // Add action on form submit
     $("#categorybtn").click(function(){
    
      var currentpassword = $("#currentpassword").val();
      var newpassword = $("#newpassword").val();
      var confirmpassword = $("#confirmpassword").val();

      var error = '';
      if (currentpassword == "") {
          error += 'Please enter current password \n';
          $("#currentpassword").focus();
      }
      if (newpassword == "") {
          error += 'Please enter new assword \n';
          $("#newpassword").focus();
      }
      if (confirmpassword == "") {
          error += 'Please confirm new password \n';
          $("#confirmpassword").focus();
      }
      if (confirmpassword != "" && newpassword != confirmpassword) {
          error += 'Passwords does not match \n';
          $("#confirmpassword").focus();
      }
      
      if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/changepassword.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    currentpassword: currentpassword,
                    newpassword: newpassword,
                    confirmpassword:confirmpassword
                },
                success: function (text) {
                    //alert(text);
            
                    if (text == 1) {
                        $.notify("Password changed successfully", "success",{position: "top right"});
                        $.ajax({
                            url: "ajaxscripts/forms/changepassword.php",
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
                    }
                    else {
                      $.notify("Current password error", {position: "top right"});
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
            $.notify(error, {position: "top right"});
        }
        return false;

    });

</script>