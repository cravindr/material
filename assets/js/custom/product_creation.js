var counter = 1;

function AddRow(counter) {
    localStorage.setItem('count',counter);
    var html = '<tr>';
            html += '<td>' +
                        '<button disabled class="btn btn-warning btn-xs">'+ counter +'</button>'+
                    '</td>';
            html += '<td>' +
                        '<select name="category[]" id="category-'+ counter +'" name="category[]" class="selectpicker form-control product-category" title="Product Select" data-live-search="true">' +
                            '<option value="0">Select Product Category....</option><option data-divider="true"></option>'+
                        '</select>' +
                    '</td>';
            html += '<td>' +
                        '<select name="spares[]" id="spares-'+ counter +'" name="spares[]" class="form-control selectpicker"></select>'+
                    '</td>';
            html += '<td>' +
                        '<input name="quantity[]" id="quantity-'+ counter +'" name="quantity[]" class="form-control">'+
                    '</td>';
            html += '<td>' +
                        '<button type="button" id="btndeleterow" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>'+
                    '</td>';
        html += '</tr>';
        return html;
}

$('#btnadd').click(function () {
    var table = AddRow(counter++);
    GetCategory();
   $('#product-body').append(table);
});

$('#product-body').on('click','#btndeleterow', function () {
    $(this).parents('tr').remove();
});

function GetCategory() {
    var catrgoryurl = $('#getcategory').val();
    $.post(catrgoryurl, function (data) {

        var json = $.parseJSON(data);
        var loc = localStorage.getItem('count');
        var itm = '#category-'+loc;
        $.each(json, function (i,v) {
            $(itm).append('<option value="'+v.category_id+'">'+v.category_desc+'</option>');
        });
        $(itm).selectpicker('refresh');
    });
}

$('#product-body').on("change",".product-category",function () {
    var log1 = $(this).attr("id");
	var log=String(log1);
    //console.log(log);

    var thisval = $(this).val();
    var no = log.split('-')[1];
	/*
	var no1 = log.split('-');
	 var no=no1[1];*/

//	console.log('nomber'+no);
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




