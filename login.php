<?php include('includes/authheader.php');
session_destroy(); ?>

<div class="auth-inner my-2">
  <!-- Login basic -->
  <div class="card mb-0" id="error_loc">
    <div class="card-body">
      <a href="index.html" class="brand-logo">
        <!--  Logo here -->
        <h2 class="brand-text text-center text-primary ms-1 text-uppercase"><?php echo getChurchName(); ?> <br /> <small>Management System</small></h2>
      </a>

      <h4 class="card-title text-center mb-1">Welcome 👋</h4>
      <p class="card-text text-center mb-2">Please sign-in to your account</p>

      <form class="auth-login-form mt-2">
        <div class="mb-1">
          <label for="login-username" class="form-label">Username</label>
          <input type="text" class="form-control" id="login-username" autocomplete="off" name="login-username" placeholder="Enter username" aria-describedby="login-username" tabindex="1" autofocus />
        </div>

        <div class="mb-1">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="login-password">Password</label>
            <a href="forgotpassword">
              <small>Forgot Password?</small>
            </a>
          </div>
          <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="login-password" name="login-password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
          </div>
        </div>

        <div class="row">
          <div class="mb-1">
            <div class="form-group" id="usertype">
              <div>
                <input type="radio" id="branchadmin" name="usertype" value="Branch Admin" class="custom-control-input" checked>
                <label class="custom-control-label" for="branchadmin">Branch Admin</label>
                <input type="radio" id="mainadmin" name="usertype" value="Main Admin" class="custom-control-input" style="margin-left:30px;margin-top:10px">
                <label class="custom-control-label" for="mainadmin">Main Admin</label>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-2"></div>
        <button class="btn btn-primary w-100 mb-2" id="login-btn" tabindex="4">Sign in</button>
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


<script>
  $("#login-btn").click(function() {
    //alert('test');
    var username = $("#login-username").val();
    var password = $("#login-password").val();
    var usertype = $('input[name=usertype]:checked').val();
    //alert(usertype);

    var error = '';
    if (username == "") {
      error += 'Please enter username \n';
      $("#ogin-username").focus();
    }
    if (password == "") {
      error += 'Please enter password \n';
      $("#login-password").focus();
    }

    if (error == "") {
      $.ajax({
        type: "POST",
        url: "ajaxscripts/queries/action/login.php",
        beforeSend: function() {
          $.blockUI({
            message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
          });
        },
        data: {
          username: username,
          password: password,
          usertype: usertype
        },
        success: function(text) {
          alert(text);

          if (text == 1) {
            window.location.href = "/branch/";
          } else if (text == 2) {
            window.location.href = "/admin/";
          } else {
            $("#error_loc").notify("Incorrect username or password", {
              position: "right"
            });
          }
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