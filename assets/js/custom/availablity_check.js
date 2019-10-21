var counter = 1;

function AddRow(counter) {
    localStorage.setItem('count',counter);
    var html = '<tr>';
            html += '<td>' +
                        '<button disabled class="btn btn-warning btn-xs">'+ counter +'</button>'+
                    '</td>';
            html += '<td>' +
                        '<select name="product[]" id="product-'+ counter +'" class="selectpicker form-control productcls" title="Product Select" data-live-search="true">' +
                            '<option value="0">Select Product....</option><option data-divider="true"></option>'+
                        '</select>' +
                    '</td>';
            html += '<td>' +
                        '<input id="quantity-'+ counter +'" name="quantity[]" class="form-control">'+
                    '</td>';
            html += '<td>' +
                        '<button type="button" id="btndeleterow" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>'+
                    '</td>';
        html += '</tr>';
        return html;
}

$('#btnadd').click(function () {
    var table = AddRow(counter++);
    GetProduct();
   $('#product-body').append(table);
});

$('#product-body').on('click','#btndeleterow', function () {
    $(this).parents('tr').remove();
});

function GetProduct() {
    var producturl = $('#getproduct').val();
    $.post(producturl, function (data) {

        var json = $.parseJSON(data);
        var loc = localStorage.getItem('count');
        var itm = '#product-'+loc;
        $.each(json, function (i,v) {
            $(itm).append('<option value="'+v.product_id+'">'+v.product_name+'</option>');
        });
        $(itm).selectpicker('refresh');
    });
}

$('#product-body').on("change",".productcls",function () {
    var log = $(this).attr("id");
    var thisval = $(this).val();
    var no = log.split('-')[1];

    var sparesurl = $('#getspares').val();

    // Get Data from selected category items

    $.post(sparesurl, {id: thisval}, function (data) {

       var json = $.parseJSON(data);
        $('#spares-'+no+'').empty();
       $.each(json, function (i,v) {
          $('#spares-'+no+'').append('<option value="'+v.spare_id+'">'+v.spare_name+'</option>');
       });
        $('#spares-'+no+'').selectpicker('refresh');
    });
});




