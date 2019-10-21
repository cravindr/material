$(function () {

    var table = $('#supplier').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#supplier tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        SupplierView(data[0]);
    });

    $('#supplier tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        SupplierEdit(data[0]);
    });

    $('#supplier tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#supplier tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        SupplierDelete(data[0]);
    });

});

function SupplierView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.sup_name_view').text(json.sup_name);
            $('.sup_email_view').text(json.sup_email);
            $('.sup_mobile_view').text(json.sup_mobile);
            $('.sup_phone_view').text(json.sup_phone);
            $('.sup_contact_person_view').text(json.sup_contact_person);
            $('.sup_address_view').text(json.sup_address);
            $('.sup_place_view').text(json.sup_place);
            $('.sup_city_view').text(json.sup_city);
            $('.sup_state_view').text(json.sup_state);
            $('.sup_pin_view').text(json.sup_pin);
            $('.gst_no_view').text(json.gst_no);
            $('.state_code_view').text(json.state_code);
            $('.create_at_view').text(json.create_at);
            $('.updated_at_view').text(json.updated_at);
            $('.status_view').text(json.status);

            $('#supplier_view').modal('show');
        }
    });
}

function SupplierDelete(id) {
    var x=confirm("Do you want to delete this Supplier");
    if (x==1) {

        $.ajax({
            url: Deleteurl,
            data: {id: id},
            type: "POST",
            success: function (data) {
                if (data == 1) {
                    window.location.reload();
                }
            }
        });
    }
}

function SupplierEdit(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {
            //alert(data);
            var json = $.parseJSON(data);


            $('#supplier_edit_id').val(json.sup_id);
            $('#supplier_name_edit').val(json.sup_name);
            $('#emailid_edit').val(json.sup_email);
            $('#mobile_edit').val(json.sup_mobile);
            $('#phone_edit').val(json.sup_phone);
            $('#contact_persion_edit').val(json.sup_contact_person);
            $('#address_edit').val(json.sup_address);
            $('#place_edit').val(json.sup_place);
            $('#city_edit').val(json.sup_city);
            $('#state_edit').val(json.sup_state);
            $('#pin_edit').val(json.sup_pin);
            $('#gstno_edit').val(json.gst_no);
            $('#statecode_edit').val(json.state_code);


            $('#supplier_edit').modal('show');
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





