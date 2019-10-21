
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

$('#spares').on('click','#btndeleterow', function () {
	$(this).parents('tr').remove();
});

$('#spares_po').on("keyup",".calc",function () {

	var log1 = $(this).attr("id");
	var log=String(log1);
	var no = log.split('-')[1];


	var qty = $('#spare_qty-'+no+'').val();
	var price = $('#spare_price-'+no+'').val();
	var tax = $('#spare_tax-'+no+'').val();

	var total_price = parseFloat(qty) * parseFloat(price);
	var total_tax = (parseFloat(total_price) * parseFloat(tax)/100);
	var row_total = parseFloat(total_price) + parseFloat(total_tax);

	$('#spare_tax_total-'+no+'').val(total_tax);
	$('#row_total-'+no+'').val(row_total);
});







