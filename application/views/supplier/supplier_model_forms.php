<!-- Modal -->
<div id="supplier_new" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Supplier Register</h4>
            </div>
            <div class="modal-body">
                <div class="form">
                    <form id="validationForm" class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('supplier/suppliersave'); ?>">
                        <div class="form-group ">
                            <div class="row col-lg-12">

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                    <label for="spare_name" class="control-label ">Suppler Name<span class="required">*</span></label>
                                        </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  validate[required]" id="supplier_name" name="supplier_name" type="text" />
                                    </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">Email Id</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  validate[custom[email]]" id="emailid" name="emailid" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group ">
                            <div class="row col-lg-12">

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">Mobile No</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control"   id="mobile" name ="mobile" type="text" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="contact_persion" class="control-label ">Contact Person</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="contact_persion" name="contact_persion" type="text" />
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

						<div class="form-group ">
							<div class="row col-lg-12">

								<div class="col-lg-6">
									<div class="row ">
										<div class="col-lg-4">
											<label for="phone" class="control-label ">Phone No</label>
										</div>
										<div class="col-lg-8">
											<input class="form-control"   id="phone" name ="phone" type="text">
										</div>
									</div>
								</div>

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">Address</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea name="address" id="address" name="address" class="col-lg-12"></textarea>

                                        </div>
                                    </div>
                                </div>

							</div>

						</div>

                        <div class="form-group ">
                            <div class="row col-lg-12">

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">Place</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  " id="place" name="place" type="text" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">City</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  " id="city" name="city" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group ">
                            <div class="row col-lg-12">

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">State</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  validate[required]" id="state" name="state" type="text" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">PIN</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  " id="pin" name="pin" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group ">
                            <div class="row col-lg-12">

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">GST No</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  " id="gstno" name="gstno" type="text" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row ">
                                        <div class="col-lg-4">
                                            <label for="spare_name" class="control-label ">State Code</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control  " id="statecode" name="statecode" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-9 col-lg-3">
                                <button class="btn btn-primary pull-right" type="submit">Save</button>
                            </div>
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


<!-- Modal -->
<div id="supplier_edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Supplier Edit Form</h4>
            </div>
            <div class="modal-body">
                <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('supplier/supplierupdate'); ?>">
                    <div class="form-group ">
                        <div class="row col-lg-12">
                            <input type="hidden" id="supplier_edit_id" name="supplier_edit_id">
                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">Suppler Name<span class="required">*</span></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  validate[required]" id="supplier_name_edit" name="supplier_name_edit" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">Email Id</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  validate[custom[email]]" id="emailid_edit" name="emailid_edit" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group ">
                        <div class="row col-lg-12">

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">Mobile No</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control "  id="mobile_edit" name="mobile_edit" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">Address</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <textarea  id="address_edit" name="address_edit" class="col-lg-12"></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

					<div class="form-group ">
						<div class="row col-lg-12">

							<div class="col-lg-6">
								<div class="row ">
									<div class="col-lg-4">
										<label for="phone_edit" class="control-label ">Phone No</label>
									</div>
									<div class="col-lg-8">
										<input class="form-control"   id="phone_edit" name ="phone_edit" type="text">
									</div>
								</div>
							</div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="contact_persion" class="control-label ">Contact Person</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="contact_persion_edit" name="contact_persion_edit" type="text" />
                                    </div>
                                </div>
                            </div>
						</div>

					</div>

                    <div class="form-group ">
                        <div class="row col-lg-12">

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">Place</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  " id="place_edit" name="place_edit" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">City</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  " id="city_edit" name="city_edit" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group ">
                        <div class="row col-lg-12">

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">State</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  validate[required]" id="state_edit" name="state_edit" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">PIN</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  " id="pin_edit" name="pin_edit" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group ">
                        <div class="row col-lg-12">

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">GST No</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  " id="gstno_edit" name="gstno_edit" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <label for="spare_name" class="control-label ">State Code</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control  " id="statecode_edit" name="statecode_edit" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-9 col-lg-3">
                            <button class="btn btn-primary pull-right" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="supplier_view" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Spares View</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="45%">Property</th>
                        <th>Values</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Supplier Name :</td>
                        <td class="sup_name_view"></td>
                    </tr>
                    <tr>
                        <td>Email Id :</td>
                        <td class="sup_email_view"></td>
                    </tr>
                    <tr>
                        <td>Mobile No :</td>
                        <td class="sup_mobile_view"></td>
                    </tr>
					<tr>
						<td>Phone No :</td>
						<td class="sup_phone_view"></td>
					</tr>
                    <tr>
                        <td>Contact Person :</td>
                        <td class="sup_contact_person_view"></td>
                    </tr>
                    <tr>
                        <td>Address :</td>
                        <td class="sup_address_view"></td>
                    </tr>
                    <tr>
                        <td>Place :</td>
                        <td class="	sup_place_view"></td>
                    </tr>
                    <tr>
                        <td>City :</td>
                        <td class="sup_city_view"></td>
                    </tr>
                    <tr>
                        <td>State :</td>
                        <td class="sup_state_view"></td>
                    </tr>
                    <tr>
                        <td>Pin :</td>
                        <td class="sup_pin_view"></td>
                    </tr>
                    <tr>
                        <td>GST No :</td>
                        <td class="gst_no_view"></td>
                    </tr> <tr>
                        <td>State Code :</td>
                        <td class="state_code_view"></td>
                    </tr> <tr>
                        <td>Created At :</td>
                        <td class="	create_at_view"></td>
                    </tr></tr> <tr>
                        <td>Updated At :</td>
                        <td class="	updated_at_view"></td>
                    </tr></tr> <tr>
                        <td>Status :</td>
                        <td class="	status_view"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
