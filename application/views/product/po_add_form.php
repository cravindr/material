<div class="row">

    <input type="hidden" id="getspare" value="<?php echo site_url('porder/GetSpareBySupplierJson'); ?>">
    <input type="hidden" id="getsupplier" value="<?php echo site_url('porder/GetSupplierActiveJson'); ?>">
	<input type="hidden" id="getcategory" value="<?php echo site_url('product/GetCategoryActiveJson'); ?>">
	<input type="hidden" id="getspearprice" value="<?php echo site_url('porder/GetSparePriceById'); ?>">
    <?php echo $message; ?>

</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product Register
            </header>
            <div class="panel-body">
                <form id="validationForm" method="post" action="<?php echo site_url('porder/PoSave'); ?>">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: bold">Po Number</label>
                            <input type="text" class="form-control validate[required]" name="po_no" id="po_no" placeholder="Enter Po Number">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: bold">Supplier</label>
                            <select name="supplier" id="supplier" class="form-control selectpicker validate[required]" title="Please Select Suppler">
                            </select>
                        </div>
                    </div>
                </div>


					<div class="row">
						<div class="form-group">
							<div class="col-lg-2 col-md-2">
								<label style="font-weight: bold">Supplier's Ref/Order No.</label>
								<input type="text" id="sup_ref_no" name="sup_ref_no" class="form-control" placeholder="Supplier's Ref/Order No.">
							</div>
							<div class="col-lg-2 col-md-2">
								<label style="font-weight: bold">Mode/Terms of Payment</label>
								<input type="text" id="terms_of_payment" name="terms_of_payment" class="form-control" placeholder="Mode/Terms of Payment">
							</div>
							<div class="col-lg-2 col-md-2">
								<label style="font-weight: bold">Other Reference(s)</label>
								<input type="text" id="other_reference" name="other_reference" class="form-control" placeholder="Other Reference(s)">
							</div>
							<div class="col-lg-2 col-md-2">
								<label style="font-weight: bold">Despatch through</label>
								<input type="text" id="despatch" name="despatch" class="form-control" placeholder="Despatch through">
							</div>
							<div class="col-lg-2 col-md-2">
								<label style="font-weight: bold">Destination</label>
								<input type="text" id="destination" name="destination" class="form-control" placeholder="Destination">
							</div>
                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <div class="radio">
                                        <label><input type="radio" id="tax_type" name="tax_type" value="c" checked>CGST/SGST</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" id="tax_type" name="tax_type" value="i">IGST</label>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label style="font-weight: bold">Note</label>
								<textarea rows="3" name="note" id="note" class="form-control" placeholder="Enter the Note"></textarea>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label style="font-weight: bold">Terms of Delivery</label>
								<textarea rows="3" name="terms_of_d" id="terms_of_d" class="form-control" placeholder="Enter the Terms of Delivery"></textarea>
							</div>
						</div>
					</div>


                <table id="spares" class="table table-striped table-bordered bulk_action employee">
                    <thead>
                    <tr style="background-color: #b7fffc; color: white">
                        <th width="1%">S.No</th>
                        <th width="35%">Spares</th>
                        <th width="15%">Quantity</th>
                        <th width="10%">Price</th>
                        <th width="10%">Tax %</th>
                        <th width="10%">Tax Amount</th>
                        <th width="10%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                    </thead>

                    <tbody id="product-body"></tbody>


                </table>
                <button type="button" class="btn btn-info" id="btnadd">Add</button>
                    <button class="btn btn-success pull-right">Store</button>
                </form>
            </div>
        </section>
    </div>
</div>
