$(function () {

    var table = $('#spares').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#spares tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        SparesView(data[0]);
    });

    $('#spares tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        SparesEdit(data[0]);
    });

    $('#spares tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#spares tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        SparesDelete(data[0]);
    });

});

function SparesView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.spare_name_view').text(json.spare_name);
            $('.spare_part_no_view').text(json.spare_part_no);
            $('.spare_size_view').text(json.spare_size);
            $('.spare_hsn_view').text(json.spare_hsn);
            $('.spare_desc_view').text(json.spare_desc);
            $('.spare_price_view').text(json.spare_price);
            $('.spare_tax_view').text(json.spare_tax);
            $('.spare_quantity_view').text(json.spare_quantity);
            $('.spare_reorder_level_view').text(json.spare_reorder_level);
            $('.created_at_view').text(json.created_at);
            $('.updated_at_view').text(json.updated_at);
            $('.status_view').text(json.status);

            $('#spares_view').modal('show');
        }
    });
}

function SparesDelete(id) {
    $.ajax({
        url: Deleteurl,
        data: {id:id},
        type: "POST",
        success: function (data) {
            if(data == 1)
            {
                window.location.reload();
            }
        }
    });
}

function SparesEdit(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

                $('#spares_edit_id').val(json.spare_id);
                $('#spare_part_edit_no').val(json.spare_part_no);
                $('#spare_name_edit').val(json.spare_name);
                $('#spare_size_edit').val(json.spare_size);
                $('#spare_hsn_edit').val(json.spare_hsn);
                $('#spare_desc_edit').val(json.spare_desc);
                $('#spare_price_edit').val(json.spare_price);
                $('#spare_tax_edit').val(json.spare_tax);
                $('#spare_qty_edit').val(json.spare_quantity);
                $('#spare_reorder_level_edit').val(json.spare_reorder_level);
				$('#supplier_id_edit').selectpicker('val', json.supplier_id.split(','));
				$('#spare_edit_category').selectpicker('val', json.category_id);
				$('#spare_edit_uom').selectpicker('val', json.spare_uom);

            $('#spares_edit').modal('show');
        }
    });
}

function Status(id) {
    $.post(statusurl, {id:id}, function (data) {
        if(data == 1)
        {
            window.location.reload();
        }
        else
        {
            window.location.reload();
        }
    });
}





