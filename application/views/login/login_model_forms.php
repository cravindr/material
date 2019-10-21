<!-- Modal -->
<div id="login_forgot_password_form" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Forgot Password From</h4>
            </div>
            <div class="modal-body">
				<div class="form">
					<form id="validationForm" method="post" action="<?php echo site_url('welcome/forgotpassword'); ?>">
						<div class="form-group">
                            <label for="forgot_email_id">Email Address</label>
                            <input type="text" class="form-control validate[required, custom[email]]" name="forgot_email_id" id="forgot_email_id" placeholder="Enter Your Email Address">
						</div>
                        <div class="form-group">
                            <button class="btn btn-warning">Send</button>
                        </div>
					</form>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


