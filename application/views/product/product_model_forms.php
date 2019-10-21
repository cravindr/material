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
                <h4 class="modal-title">Product Edit Form</h4>
            </div>
            <div class="modal-body">
				<form id="validationForm" method="post" action="<?php echo site_url('product/productquantityupdate'); ?>">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-6">
								<label style="font-weight: bold">Product Name</label>
								<input type="text" name="product_name_edit" id="product_name_edit" class="form-control validate[required]" placeholder="Enter the Product Name">
								<input type="hidden" name="prod_id" id="prod_id">
							</div>
							<div class="col-lg-6">
								<label style="font-weight: bold">Product Description</label>
								<input type="text" name="product_desc_edit" id="product_desc_edit" class="form-control" placeholder="Enter the Product Description">
							</div>
						</div>
					</div>
					<table id="product_edit_table" class="table table-striped table-bordered bulk_action employee">
						<thead>
						<tr style="background-color: #b7fffc; color: white">
							<th width="1%">S.No</th>
							<th width="50%">Category</th>
							<th width="15%">Spares</th>
							<th width="10%">Quantity</th>
							<th width="5%">Action</th>
						</tr>
						</thead>

						<tbody id="product-edit-body"></tbody>


					</table>
					<button type="button" class="btn btn-info" id="btneditadd">Add</button>
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
<div id="product_view" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product View</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
					<tr style="background-color: #ffb8c3; color: white">
                        <th width="45%">Property</th>
                        <th>Values</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Product Name :</td>
                        <td class="product_name"></td>
                    </tr>
					<tr>
						<td>Product Desc :</td>
						<td class="product_desc"></td>
					</tr>
                    <tr>
                        <td>Product Status :</td>
                        <td class="status"></td>
                    </tr>
					<tr>
						<table  class="table table-striped table-bordered">
							<thead>
								<tr style="background-color: #9dd597; color: white">
									<th>S.no</th>
									<th>Category</th>
									<th>Spares</th>
									<th>Quantity</th>
								</>
							</thead>
							<tbody id="product_view_spares"></tbody>
						</table>
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
