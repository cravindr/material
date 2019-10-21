<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Spares Registration List
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#spares_new"><i class="fa fa-plus" aria-hidden="true"></i>Add New</button>
            </header>
            <div class="panel-body">
                <table id="spares" class="table table-striped table-bordered bulk_action employee">
                    <thead>
                    <tr style="background-color: #b7fffc; color: white">
                        <th>ID</th>
                        <th>Part No</th>
                        <th>HSN</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Re-order</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>
</div>
