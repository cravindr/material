$(function () {

    var table = $('#category').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#category tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        CategoryView(data[0]);
    });

    $('#category tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        CategoryEdit(data[0]);
    });

    $('#category tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#category tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        CategoryDelete(data[0]);
    });

});

function CategoryView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.category_name_view').text(json.category_desc);


            $('.category_created_at_view').text(json.created_at);
            $('.category_updated_at_view').text(json.updated_at);
            $('.category_status_view').text(json.status);

            $('#category_view').modal('show');
        }
    });
}

function CategoryDelete(id) {
    var x=confirm("Do you want to delete this Category");
    if (x==1)
    {
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

}

function CategoryEdit(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {
            //alert(data);
            var json = $.parseJSON(data);


            $('#category_edit_id').val(json.category_id);
            $('#category_desc_edit').val(json.category_desc);
            $('#category_edit').modal('show');
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





