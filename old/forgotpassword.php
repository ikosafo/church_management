<?php include('includes/authheader.php'); ?>

<div class="auth-inner my-2">
  <!-- Login basic -->
  <div class="card mb-0">
    <div class="card-body">
      <a href="index.html" class="brand-logo">
        <!--  Logo here -->
        <h2 class="brand-text text-primary ms-1 text-uppercase">POS System</h2>
      </a>

      <h4 class="card-title mb-1">Forgot Password? 🔒</h4>
      <p class="card-text mb-2">Enter your phone number and we'll send you a code to reset your password</p>

      <form class="auth-forgot-password-form mt-2">
        <div class="mb-1">
          <label for="phonenumber" class="form-label">Phone</label>
          <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter phone number" aria-describedby="phonenumber" tabindex="1" autofocus />
        </div>
        <button type="button" class="btn btn-primary w-100" id="sendcode" tabindex="2">Send reset code</button>
      </form>

      <p class="text-center mt-2">
        <a href="login"> <i data-feather="chevron-left"></i> Back to login </a>
      </p>
      <button id="sendSMSButton">Send SMS</button>
    </div>
  </div>
  <!-- /Forgot Password basic -->
</div>
</div>

</div>
</div>
</div>
<!-- END: Content-->

<?php include('includes/authfooter.php'); ?>

<!-- <script>
  $("#sendcode").click(function() {
    //console.log('check this first');
    var endPoint = 'https://api.mnotify.com/api/sms/quick';
    var apiKey = 'd0a4550e3e35dc77f849';
    var url = endPoint + '?key=' + apiKey;

    var recipientNumbers = ['0557824143', '0205737464'];
    var sender = 'mNotify';
    var message = 'API messaging is fun!';
    var isSchedule = 'false';
    var scheduleDate = '';

    var data = {
      recipient: recipientNumbers,
      sender: sender,
      message: message,
      is_schedule: isSchedule,
      schedule_date: scheduleDate
    };

    $.ajax({
      type: "POST",
      url: url,
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function(response) {
        console.log(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
</script>
 -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $("#sendSMSButton").click(function() {
    $.ajax({
      type: "POST",
      url: "functionsms.php", // Path to your send_sms.php script
      success: function(response) {
        alert("SMS sent!"); // Display a confirmation message
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert("SMS sending failed!"); // Display an error message
      }
    });
  });
</script>