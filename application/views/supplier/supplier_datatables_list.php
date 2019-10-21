<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Supplier Registration List
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#supplier_new"><i class="fa fa-plus" aria-hidden="true"></i>Add New</button>
            </header>
            <div class="panel-body">
                <table id="supplier" class="table table-striped table-bordered bulk_action ">
                    <thead>
                    <tr style="background-color: #b7fffc; color: white">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Place</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>
</div>