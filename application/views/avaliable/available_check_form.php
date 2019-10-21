<div class="row">
    <input type="hidden" id="getproduct" value="<?php echo site_url('available/getproductjson'); ?>">
    <?php echo $message; ?>

</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product Check
            </header>
            <div class="panel-body">
                <form id="validationForm" method="post" action="<?php echo site_url('available/'); ?>">
					<div class="row">
						<div class="col-lg-6 form-group">
							<label>
								Production For
							</label>
							<input type="text" name="name" id="name" class="col-lg-6 form-control" placeholder="Production for..">
						</div>
						<div class="col-lg-6 form-group">
							<label>
								Note
							</label>
							<textarea  name="note" id="note" class="col-lg-6 form-control" placeholder="Short Note about the Spares taken"></textarea>
						</div>

					</div>
                    <table id="product" class="table table-striped table-bordered bulk_action employee">
                        <thead>
                        <tr style="background-color: #b7fffc; color: white">
                            <th width="1%">S.No</th>
                            <th width="50%">Product</th>
                            <th width="20%">Quantity</th>
                            <th width="5%">Action</th>
                        </tr>
                        </thead>
                        <tbody id="product-body">
						</tbody>
                    </table>
                    <button type="button" class="btn btn-info" id="btnadd">Add Product</button>
                    <button class="btn btn-success pull-right">Calculate</button>
                </form>
            </div>
        </section>
    </div>
</div>
