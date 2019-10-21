<div class="row">
    <input type="hidden" id="getspares" value="<?php echo site_url('product/getspareswithcategoryidjson'); ?>">
    <input type="hidden" id="getcategory" value="<?php echo site_url('product/GetCategoryActiveJson'); ?>">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Purchase Order
            </header>
            <div class="panel-body">
                <form id="validationForm" method="post" action="<?php echo site_url('porder/reqposave'); ?>">
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
                        <th width="5%">S.no</th>
                        <th width="40%">Spare Name</th>
                        <th width="15%">Spares Qty</th>
                        <th width="10%">Price</th>
                        <th width="5%">Tax</th>
                        <th width="10%">Tax Amount</th>
                        <th width="10%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="spares_po">
						<?php $sno=1; foreach ($spares_details as $val) { ?>

							<?php $spare_qty = str_replace("-","",$val->qty); ?>
							<?php $tax_total = $val->spare_tax * $val->spare_price/100 * $spare_qty; ?>
							<?php $row_total = $val->spare_price*$spare_qty + $tax_total; ?>

							<tr>
								<td><?php echo $sno++; ?></td>
								<td><input type="text" name="spare_name[]" id="spare_name-<?php echo $sno; ?>" class="form-control" value="<?php echo $val->spare_name; ?>" readonly></td>
								<td><input type="text" name="quantity[]" id="spare_qty-<?php echo $sno; ?>" class="form-control calc" value="<?php echo $spare_qty; ?>"></td>
								<td><input type="text" name="price[]" id="spare_price-<?php echo $sno; ?>" class="form-control calc" value="<?php echo $val->spare_price; ?>"></td>
								<td><input type="text" name="tax[]" id="spare_tax-<?php echo $sno; ?>" class="form-control" value="<?php echo $val->spare_tax; ?>" readonly></td>
								<td><input type="text" name="tax_amount[]" id="spare_tax_total-<?php echo $sno; ?>" class="form-control" value="<?php echo $tax_total; ?>" readonly></td>
								<td><input type="text" name="rowtotal[]" id="row_total-<?php echo $sno; ?>" class="form-control" value="<?php echo $row_total; ?>" readonly></td>
								<td><button id="btndeleterow" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>


								<input type="hidden" name="spares[]" id="spare_id-<?php echo $sno; ?>" class="form-control" value="<?php echo $val->spare_id; ?>">
								<input type="hidden" name="po_req_mas_id[]" id="po_req_mas_id-<?php echo $sno; ?>" class="form-control" value="<?php echo $val->po_req_mast_id; ?>">
								<input type="hidden" name="supplier" id="supplier-<?php echo $sno; ?>" class="form-control" value="<?php echo $val->sup_id; ?>">
								<input type="hidden" name="po_req_id[]" id="po_req_id-<?php echo $sno; ?>" class="form-control" value="<?php echo $val->id; ?>">
							</tr>
						<?php } ?>
					</tbody>
                </table>
                    <button class="btn btn-success pull-right">Store</button>
                </form>
            </div>
        </section>
    </div>
</div>
