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
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="newpassword">New Password</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" class="form-control form-control-merge" id="newpassword" tabindex="2" placeholder="Enter new password" />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="confirmpassword">Confirm Password</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" class="form-control form-control-merge" id="confirmpassword" tabindex="2" placeholder="Enter new password" />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                </div>

                <button type="button" class="btn btn-primary w-100" id="sendcode" tabindex="2">Reset Password</button>
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