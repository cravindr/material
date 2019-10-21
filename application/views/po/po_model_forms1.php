<!-- Modal -->
<div id="product_new" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Register</h4>
            </div>
            <div class="modal-body">
				<div class="form">
					<form id="validationForm" method="post" action="<?php echo site_url('product/productquantitysave'); ?>">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6">
									<label style="font-weight: bold">Product Name</label>
									<input type="text" name="product_name" id="product_name" class="form-control validate[required]" placeholder="Enter the Product Name">
									<input type="hidden" id="getspares" value="<?php echo site_url('product/getspareswithcategoryidjson'); ?>">
									<input type="hidden" id="getcategory" value="<?php echo site_url('product/GetCategoryActiveJson'); ?>">
								</div>
								<div class="col-lg-6">
									<label style="font-weight: bold">Product Description</label>
									<input type="text" name="product_desc" id="product_desc" class="form-control" placeholder="Enter the Product Description">
								</div>
							</div>
						</div>
						<table id="spares" class="table table-striped table-bordered bulk_action employee">
							<thead>
							<tr style="background-color: #b7fffc; color: white">
								<th width="1%">S.No</th>
								<th width="50%">Category</th>
								<th width="15%">Spares</th>
								<th width="10%">Quantity</th>
								<th width="5%">Action</th>
							</tr>
							</thead>

							<tbody id="product-body"></tbody>


						</table>
						<button type="button" class="btn btn-info" id="btnadd">Add</button>
						<button class="btn btn-success pull-right">Store</button>
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
<div id="product_edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Spares Edit Form</h4>
            </div>
            <div class="modal-body">
				<form id="validationForm" method="post" action="<?php echo site_url('product/productquantitysave'); ?>">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label style="font-weight: bold">Product Name</label>
								<input type="text" name="product_name_edit" id="product_name_edit" class="form-control validate[required]" placeholder="Enter the Product Name">
								<input type="hidden" id="getspares" value="<?php echo site_url('product/getspareswithcategoryidjson'); ?>">
								<input type="hidden" id="getcategory" value="<?php echo site_url('product/GetCategoryActiveJson'); ?>">
							</div>
							<div class="col-lg-6">
								<label style="font-weight: bold">Product Description</label>
								<input type="text" name="product_desc_edit" id="product_desc_edit" class="form-control" placeholder="Enter the Product Description">
							</div>
						</div>
					</div>
					<table id="spares" class="table table-striped table-bordered bulk_action employee">
						<thead>
						<tr style="background-color: #b7fffc; color: white">
							<th width="1%">S.No</th>
							<th width="50%">Category</th>
							<th width="15%">Spares</th>
							<th width="10%">Quantity</th>
							<th width="5%">Action</th>
						</tr>
						</thead>

						<tbody id="product-body"></tbody>


					</table>
					<button type="button" class="btn btn-info" id="btnadd">Add</button>
					<button class="btn btn-success pull-right">Update</button>
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
                        <td>Spare Name :</td>
                        <td class="spare_name_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Size :</td>
                        <td class="spare_size_view"></td>
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
