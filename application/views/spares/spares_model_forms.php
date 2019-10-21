<!-- Modal -->
<div id="spares_new" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Spares Register</h4>
            </div>
            <div class="modal-body">
				<div class="form">
					<form id="validationForm" class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('spares/sparesave'); ?>">
						<div class="form-group ">
							<label for="spare_name" class="control-label col-lg-2">Part No<span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control validate[required]" id="spare_part_no" name="spare_part_no" type="text" />
							</div>
						</div>
						<div class="form-group ">
							<label for="spare_name" class="control-label col-lg-2">Spare Name<span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control validate[required]" id="spare_name" name="spare_name" type="text" />
							</div>
						</div>
						<div class="form-group ">
							<label for="spare_size" class="control-label col-lg-2">Spare Size</label>
							<div class="col-lg-10">
								<input class="form-control " id="spare_size" name="spare_size" type="text"  />
							</div>
						</div>
						<div class="form-group">
							<label for="curl" class="control-label col-lg-2">Description</label>
							<div class="col-lg-10">
								<textarea class="form-control " id="spare_desc" name="spare_desc"></textarea>
							</div>
						</div>
						<div class="form-group ">
							<label for="spare_size" class="control-label col-lg-2">Spare Price</label>
							<div class="col-lg-10">
								<input class="form-control " id="spare_price" name="spare_price" type="text"  />
							</div>
						</div>

						<div class="form-group ">
							<label for="spare_size" class="control-label col-lg-2">Spare Tax %</label>
							<div class="col-lg-10">
								<input class="form-control " id="spare_tax" name="spare_tax" type="text"  />
							</div>
						</div>

						<div class="form-group ">
							<label for="cname" class="control-label col-lg-2">Spare Uom <span class="required">*</span></label>
							<div class="col-lg-10">
								<select id="spare_uom" name="spare_uom" class="validate[required] form-control selectpicker"  title="Select Category">
                                    <option value="Box">Box</option>
                                    <option value="Coil">Coil</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Inch">Inch</option>
                                    <option value="Kgs">KGS</option>
                                    <option value="Length">Length</option>
                                    <option value="Ltrs">Litre</option>
                                    <option value="Mtrs">Meter</option>
                                    <option value="Nos">Number</option>
                                    <option value="Rolls">Roll</option>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="cname" class="control-label col-lg-2">Category <span class="required">*</span></label>
							<div class="col-lg-10">
								<select id="category" name="category" class="validate[required] form-control selectpicker"  title="Select Category">
									<?php foreach ($category as $cat) { ?>
										<option value="<?php echo $cat->category_id; ?>"><?php echo $cat->category_desc; ?></option>
									<?php }?>
								</select>
							</div>
						</div>

						<div class="form-group ">
							<label for="cname" class="control-label col-lg-2">Quantity <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control validate[required,custom[number]]" id="spare_qty" name="spare_qty"  type="text"  />
							</div>
						</div>

						<div class="form-group ">
							<label for="cname" class="control-label col-lg-2">Reorder Level <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control validate[required,custom[number]]" id="spare_reorder_level" name="spare_reorder_level"  type="text"  />
							</div>
						</div>

						<div class="form-group ">
							<label for="cname" class="control-label col-lg-2">Supplier</label>
							<div class="col-lg-10">
								<select id="supplier" name="supplier[]" class="form-control selectpicker show-tick" title="Select Supplier" multiple>
									<?php foreach ($supplier as $sub) { ?>
										<option value="<?php echo $sub->sup_id; ?>"><?php echo $sub->sup_name; ?></option>
									<?php }?>
								</select>
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
<div id="spares_edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Spares Edit Form</h4>
            </div>
            <div class="modal-body">
                <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('spares/sparesupdate'); ?>">
					<div class="form-group ">
						<label for="spare_name" class="control-label col-lg-2">Part No<span class="required">*</span></label>
						<div class="col-lg-10">
							<input class="form-control validate[required]" id="spare_part_edit_no" name="spare_part_edit_no" type="text" />
						</div>
					</div>
					<div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">Spare Name<span class="required">*</span></label>
                        <div class="col-lg-10">
                            <input type="hidden" id="spares_edit_id" name="spares_edit_id">
                            <input class="form-control" id="spare_name_edit" name="spare_name_edit" type="text" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Spare Size <span class="required">*</span></label>
                        <div class="col-lg-10">
                            <input class="form-control " id="spare_size_edit" name="spare_size_edit" type="text"  />
                        </div>
                    </div>
					<div class="form-group ">
						<label for="spare_size" class="control-label col-lg-2">HSN Code</label>
						<div class="col-lg-10">
							<input class="form-control " id="spare_hsn_edit" name="spare_hsn_edit" type="text"  />
						</div>
					</div>
                    <div class="form-group ">
                        <label for="curl" class="control-label col-lg-2">Description</label>
                        <div class="col-lg-10">
                            <textarea class="form-control " id="spare_desc_edit" name="spare_desc_edit"></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">Price <span class="required">*</span></label>
                        <div class="col-lg-10">
                            <input class="form-control" id="spare_price_edit" name="spare_price_edit" type="text"  />
                        </div>
                    </div>

					<div class="form-group ">
						<label for="cname" class="control-label col-lg-2">Tax % <span class="required">*</span></label>
						<div class="col-lg-10">
							<input class="form-control" id="spare_tax_edit" name="spare_tax_edit" type="text"  />
						</div>
					</div>

					<div class="form-group ">
						<label for="cname" class="control-label col-lg-2">Spare Uom <span class="required">*</span></label>
						<div class="col-lg-10">
							<select id="spare_edit_uom" name="spare_edit_uom" class="validate[required] form-control selectpicker"  title="Select Category">
								<option value="Kg">Kilo Gram</option>
								<option value="Mtr">Meter</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>

					<div class="form-group ">
						<label for="cname" class="control-label col-lg-2">Category <span class="required">*</span></label>
						<div class="col-lg-10">
							<select id="spare_edit_category" name="spare_edit_category" class="validate[required] form-control selectpicker"  title="Select Category">
								<?php foreach ($category as $cat) { ?>
									<option value="<?php echo $cat->category_id; ?>"><?php echo $cat->category_desc; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">Quantity <span class="required">*</span></label>
                        <div class="col-lg-10">
                            <input class="form-control" id="spare_qty_edit" name="spare_qty_edit"  type="text"  />
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">Reorder Level <span class="required">*</span></label>
                        <div class="col-lg-10">
                            <input class="form-control" id="spare_reorder_level_edit" name="spare_reorder_level_edit"  type="text"  />
                        </div>
                    </div>

					<div class="form-group ">
						<label for="cname" class="control-label col-lg-2">Supplier</label>
						<div class="col-lg-10">
							<select id="supplier_id_edit" name="supplier_id_edit[]" class="form-control selectpicker show-tick" title="Select Supplier" multiple>
								<?php foreach ($supplier as $sub) { ?>
									<option value="<?php echo $sub->sup_id; ?>"><?php echo $sub->sup_name; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
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
<div id="spares_view" class="modal fade" role="dialog">
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
						<td>Part No :</td>
						<td class="spare_part_no_view"></td>
					</tr>
                    <tr>
                        <td>Spare Name :</td>
                        <td class="spare_name_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Size :</td>
                        <td class="spare_size_view"></td>
                    </tr>
					<tr>
						<td>Spare HSN :</td>
						<td class="spare_hsn_view"></td>
					</tr>
                    <tr>
                        <td>Spare Description :</td>
                        <td class="spare_desc_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Price :</td>
                        <td class="spare_price_view"></td>
                    </tr>
					<tr>
						<td>Spare Tax % :</td>
						<td class="spare_tax_view"></td>
					</tr>
                    <tr>
                        <td>Spare Quantity :</td>
                        <td class="spare_quantity_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Reorder Level :</td>
                        <td class="spare_reorder_level_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Created Date :</td>
                        <td class="created_at_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Updated Date :</td>
                        <td class="updated_at_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Status :</td>
                        <td class="status_view"></td>
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
