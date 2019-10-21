<body class="login-img3-body">

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 well" style="margin-top: 10%">
            <form id="validationForm" method="post" action="<?php echo site_url('welcome/savenewpassword'); ?>">
            <div class="form-group">
                <label for="">Enter your OTP</label>
                <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP">
            </div>
            <div class="form-group">
                <label for="">Enter New Password</label>
                <input type="password" name="pass" id="pass" class="form-control" placeholder="Enter New Password">
            </div>
            <div class="form-group">
                <label for="">Enter Conform Password</label>
                <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Enter Conform Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Reset</button>
            </div>
        </form>
        </div>
    </div>

</div>

</body>