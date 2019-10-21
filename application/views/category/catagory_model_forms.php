<!-- Modal -->
<div id="category_new" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Category Register</h4>
            </div>
            <div class="modal-body">
                <div class="form">
                    <form id="validationForm" class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('category/categorysave'); ?>">
                        <div class="form-group ">
                            <label for="spare_name" class="control-label col-lg-2">Category Name<span class="required">*</span></label>
                            <div class="col-lg-10">
                                <input class="form-control validate[required]" id="category_desc" name="category_desc" type="text" />
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="category_edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Category Edit Form</h4>
            </div>
            <div class="modal-body">
                <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo site_url('category/categoryupdate'); ?>">
                    <div class="form-group ">
                        <label for="cname" class="control-label col-lg-2">Category Name<span class="required">*</span></label>
                        <div class="col-lg-10">
                            <input type="hidden" id="category_edit_id" name="category_edit_id">
                            <input class="form-control" id="category_desc_edit" name="category_desc_edit" type="text" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary pull-right" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="category_view" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Category View</h4>
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
                        <td>Category Name :</td>
                        <td class="category_name_view"></td>
                    </tr>





                    <tr>
                        <td>Spare Created Date :</td>
                        <td class="category_created_at_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Updated Date :</td>
                        <td class="category_updated_at_view"></td>
                    </tr>
                    <tr>
                        <td>Spare Status :</td>
                        <td class="category_status_view"></td>
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