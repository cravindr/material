<div class="row">
    <input type="hidden" id="getspares" value="<?php echo site_url('product/getspareswithcategoryidjson'); ?>">
    <input type="hidden" id="getcategory" value="<?php echo site_url('product/GetCategoryActiveJson'); ?>">
    <?php echo $message; ?>

</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product Register
            </header>
            <div class="panel-body">
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
        </section>
    </div>
</div>