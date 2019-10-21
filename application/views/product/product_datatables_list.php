
<div class="row">
	<input type="hidden" id="getspares" value="<?php echo site_url('product/getspareswithcategoryidjson'); ?>">
	<input type="hidden" id="getcategory" value="<?php echo site_url('product/GetCategoryActiveJson'); ?>">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Product Registration List
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#product_new"><i class="fa fa-plus" aria-hidden="true"></i>Add New</button>
            </header>
            <div class="panel-body">
                <table id="product" class="table table-striped table-bordered bulk_action employee">
                    <thead>
                    <tr style="background-color: #b7fffc; color: white">
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Desc</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>
</div>
