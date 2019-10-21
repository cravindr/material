<!-- Form validations -->
<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <section class="panel panel-info">
            <header class="panel-heading">
               Password Change
            </header>
            <div class="panel-body">
                <div class="form">
                    <form id="validationForm" class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('dashboard/passwordupdate'); ?>">
						<div class="form-group ">
							<label for="opass" class="control-label col-lg-2">Current Password<span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control validate[required]" id="opass" name="opass" type="password"  />
							</div>
						</div>
                        <div class="form-group ">
                            <label for="npass" class="control-label col-lg-2">New Password<span class="required">*</span></label>
                            <div class="col-lg-10">
                                <input class="form-control validate[required]" id="npass" name="npass" type="password"  />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cpass" class="control-label col-lg-2">Email<span class="required">*</span></label>
                            <div class="col-lg-10">
                                <input class="form-control validate[required,equals[npass]]" id="cpass" name="cpass" type="password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-9 col-lg-3">
                                <button class="btn btn-primary pull-right" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
