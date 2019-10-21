/*$(function () {
	GetSupplier();
});*/

GetSupplier();

var counter = 1;

function AddRow(counter) {
    localStorage.setItem('count',counter);
    var html = '<tr>';
            html += '<td>' +
                        '<button disabled class="btn btn-warning btn-xs">'+ counter +'</button>'+
                    '</td>';

            html += '<td>' +
                        '<select name="spares[]" id="spares-'+ counter +'" name="spares[]" class="form-control spares_change selectpicker">' +
				'<option value="0">Select Spares....</option><option data-divider="true"></option>'+
				'</select>'+
                    '</td>';
            html += '<td>' +
                        '<input name="quantity[]" id="quantity-'+ counter +'" name="quantity[]" class="form-control tot">'+
                    '</td>';
			html += '<td>' +
				'<input name="price[]" id="price-'+ counter +'"  class="form-control tot">'+
				'</td>';
	html += '<td>' +
		'<input name="tax[]" id="tax-'+ counter +'"  class="form-control tot" readonly>'+
		'</td>';
	html += '<td>' +
		'<input name="tax_amount[]" id="tax_amount-'+ counter +'"  class="form-control tot" readonly>'+
		'</td>';
	html += '<td>' +
		'<input name="rowtotal[]" id="rowtotal-'+ counter +'"  class="form-control rowtotal" readonly>'+
		'</td>';

            html += '<td>' +
                        '<button type="button" id="btndeleterow" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>'+
                    '</td>';
        html += '</tr>';
        return html;
}

$('#btnadd').click(function () {
	var suppid = $('#supplier').val();
	if(suppid)
	{
		var table = AddRow(counter++);
		GetSpares();
		$('#product-body').append(table);


	}
    else
	{
		alert("Please Select Supplier");

	}
});

$('#product-body').on('click','#btndeleterow', function () {
    $(this).parents('tr').remove();

});

/*function GetCategory() {
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
}*/

function GetSpares() {

	var suppid = $('#supplier').val();
	var sparesurl=$("#getspare").val();


	$.post(sparesurl,{id: suppid}, function (data) {

		var json = $.parseJSON(data);
		var loc = localStorage.getItem('count');
		var itm = '#spares-'+loc;
		$.each(json, function (i,v) {
			$(itm).append('<option value="'+v.spare_id+'">'+v.spare_name+'</option>');
		});
		$(itm).selectpicker('refresh');
	});
}


function GetSupplier() {

	var supplerurl = $('#getsupplier').val();
	//console.log(supplerurl);
	$.post(supplerurl, function (data) {

		var json = $.parseJSON(data);
		//var loc = localStorage.getItem('count');
		//var itm = '#category-'+loc;
		$.each(json, function (i,v) {
			$('#supplier').append('<option value="'+v.sup_id+'">'+v.sup_name+'</option>');
		});
		$('#supplier').selectpicker('refresh');
	});
}





$('#supplier').on("change",function () {
	$("#product-body").empty();
	counter=1;
	localStorage.setItem('count',counter);
});



$('#product-body').on("change",".spares_change",function () {


    var log1 = $(this).attr("id");
	var log=String(log1);
    var thisval = $(this).val();

    var no = log.split('-')[1];
	/*
	var no1 = log.split('-');
	 var no=no1[1];*/
    var sparepricesurl = $('#getspearprice').val();

    // Get Data from selected category items

    $.post(sparepricesurl, {id: thisval}, function (data) {

       var json = $.parseJSON(data);

        console.log(json)

       $.each(json, function (i,v) {
          //$('#spares-'+no+'').append('<option value="'+v.spare_id+'">'+v.spare_name+'</option>');

		   $('#price-'+no+'').val(v.spare_price);
		   $('#tax-'+no+'').val(v.spare_tax);
// aditional code
		   var price_r=$('#price-'+no+'').val();
		   var tax_r=$('#tax-'+no+'').val();

		   var qty_r=$('#quantity-'+no+'').val();
		   var tax_amount_r=(parseFloat(price_r) * parseFloat(qty_r)* parseFloat(tax_r))/100;
		   $('#tax_amount-'+no+'').val(tax_amount_r);
		   var tot_r=parseFloat(price_r) * parseFloat(qty_r)+tax_amount_r ;

		   var qty_r=$('#rowtotal-'+no+'').val(tot_r);
		   //

       });
        $('#spares-'+no+'').selectpicker('refresh');
    });
});


$('#product-body').on("keyup",".tot",function () {



	var log1 = $(this).attr("id");
	var log=String(log1);
	var thisval = $(this).val();

	var no = log.split('-')[1];
	/*
	var no1 = log.split('-');
	 var no=no1[1];*/

	var price_r=$('#price-'+no+'').val();
	var tax_r=$('#tax-'+no+'').val();

	var qty_r=$('#quantity-'+no+'').val();
	var tax_amount_r=(parseFloat(price_r) * parseFloat(qty_r)* parseFloat(tax_r))/100;
	$('#tax_amount-'+no+'').val(tax_amount_r);
	var tot_r=parseFloat(price_r) * parseFloat(qty_r)+tax_amount_r ;

	var qty_r=$('#rowtotal-'+no+'').val(tot_r);

});



