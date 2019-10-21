<!-- Form validations -->
<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-8">
        <section class="panel panel-info">
            <header class="panel-heading">
               Spares Registration
            </header>
            <div class="panel-body">
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
						<div class="form-group ">
							<label for="spare_size" class="control-label col-lg-2">HSN Code</label>
							<div class="col-lg-10">
								<input class="form-control " id="spare_hsn" name="spare_hsn" type="text"  />
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
        </section>
    </div>
</div>
