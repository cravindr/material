<!-- Form validations -->
<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <section class="panel panel-info">
            <header class="panel-heading">
               Profile Edit
            </header>
            <div class="panel-body">
                <div class="form">
                    <form id="validationForm" class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('dashboard/profileupdate'); ?>">
						<div class="form-group ">
							<label for="Name" class="control-label col-lg-2">Name<span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control validate[required]" id="name" name="name" type="text" value="<?php  echo $profile[0]->user_name; ?>" />
							</div>
						</div>
                        <div class="form-group ">
                            <label for="username" class="control-label col-lg-2">Username<span class="required">*</span></label>
                            <div class="col-lg-10">
                                <input class="form-control validate[required]" id="username" name="username" type="text" value="<?php  echo $profile[0]->username; ?>" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email" class="control-label col-lg-2">Email<span class="required">*</span></label>
                            <div class="col-lg-10">
                                <input class="form-control validate[required,custom[email]]" id="email" name="email" type="text" value="<?php  echo $profile[0]->user_email; ?>" />
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
