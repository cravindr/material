var check_counter = 0;
var counter = 1;

$(function () {

    var table = $('#product').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#product tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        ProductView(data[0]);
    });

    $('#product tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        ProductEdit(data[0]);
    });

    $('#product tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#product tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
        ProductDelete(data[0]);
    });
});

function ProductView(id) {
    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {

            var json = $.parseJSON(data);

            $('.product_name').text(json[0].product_name);
			$('.product_desc').text(json[0].product_desc);
			$('.status').text(json[0].status);
			$('#product_view_spares').empty();
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
						html += '<td>'+ local_count +'</td>';
						html += '<td>'+ v.category_desc +'</td>';
						html += '<td>'+ v.spare_name +'</td>';
						html += '<td>'+ v.qty +'</td>';

				$('#product_view_spares').append(html);
			});


            $('#product_view').modal('show');
        }
    });
}

function ProductDelete(id) {
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

function ProductEdit(id) {
	check_counter = localStorage.getItem("new_counter");

    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {
            var json = $.parseJSON(data);
				$('#prod_id').val(json[0].product_id);
				$('#product_name_edit').val(json[0].product_name);
				$('#product_desc_edit').val(json[0].product_desc);
				$('#product-edit-body').empty();
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
				html += '<td>' +
					'</input><button id="btncount" disabled class="btn btn-warning btn-xs">'+ local_count +'</button>'+
					'<input type="hidden" id="detail_id" name="detail_id[]" value="'+ v.id +'">' +
					'<input type="hidden" id="prod_id" name="prod_id[]" value="'+ v.product_id +'">' +
					'</td>';
				html += '<td>' +
					'<select name="category[]" id="category-'+ local_count +'" class="selectpicker form-control product-category" title="Product Select" data-live-search="true">' +
					'<option value="0">Select Product Category....</option><option data-divider="true"></option>'+
					'</select>' +
					'</td>';
				html += '<td>' +
					'<select name="spares[]" id="spares-'+ local_count +'" class="form-control selectpicker"></select>'+
					'</td>';
				html += '<td>' +
					'<input name="quantity[]" id="quantity-'+ local_count +'" class="form-control">'+
					'</td>';
				html += '<td>' +
					'<button type="button" id="btndeleterow" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>'+
					'</td>';
				html += '</tr>';

				var catrgoryurl = $('#getcategory').val();
				$.post(catrgoryurl, function (data) {

					var json = $.parseJSON(data);
					var loc = local_count;
					var itm = '#category-'+loc;
					$.each(json, function (i,v) {
						$(itm).append('<option value="'+v.category_id+'">'+v.category_desc+'</option>');
					});
					$(itm).selectpicker('refresh');
					$('#category-'+loc+'').selectpicker('val',v.category_id);
				});



				var sparesurl = $('#getspares').val();

				// Get Data from selected category items
				var cat_id = v.category_id;
				$.post(sparesurl, {id: cat_id}, function (data) {

					var json = $.parseJSON(data);

					$('#spares-'+local_count+'').empty();
					$.each(json, function (i,v) {
						$('#spares-'+local_count+'').append('<option value="'+v.spare_id+'">'+v.spare_name+'</option>');
					});
					$('#spares-'+local_count+'').selectpicker('refresh');

					$('#spares-'+local_count+'').selectpicker('val',v.spare_id);
					$('#quantity-'+local_count+'').val(v.qty);
				});

				localStorage.setItem("new_counter",local_count);

				$('#product-edit-body').append(html);

			});

            $('#product_edit').modal('show');
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


//Product Edit
function AddRow(counter) {
	localStorage.setItem('count',counter);
	var html = '<tr>';
	html += '<td>' +
		'<button disabled class="btn btn-warning btn-xs">'+ counter +'</button>'+
		'</td>';
	html += '<td>' +
		'<select name="category[]" id="category-'+ counter +'" class="selectpicker form-control product-category" title="Product Select" data-live-search="true">' +
		'<option value="0">Select Product Category....</option><option data-divider="true"></option>'+
		'</select>' +
		'</td>';
	html += '<td>' +
		'<select name="spares[]" id="spares-'+ counter +'" class="form-control selectpicker"></select>'+
		'</td>';
	html += '<td>' +
		'<input name="quantity[]" id="quantity-'+ counter +'" class="form-control">'+
		'</td>';
	html += '<td>' +
		'<button type="button" id="btndeleterow" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>'+
		'</td>';
	html += '</tr>';
	return html;
}

$('#btneditadd').click(function () {

	if(check_counter > 0)
	{
		var count = localStorage.getItem("new_counter");
		 counter = parseInt(count) + parseInt(1);
		localStorage.setItem("new_counter",counter)
	}

	var table = AddRow(counter++);
	GetCategory();
	$('#product-edit-body').append(table);
});

$('#product-edit-body').on('click','#btndeleterow', function () {
    var id = $(this).closest('tr').find('#detail_id').val();   // Finds the closest row <tr>
    $(this).parents('tr').remove();
	$.post(detaildeleteid , { id:id }, function (data) {
	    if(!data == 1){
            alert('something Wrong');
        }
    });
});

function GetCategory() {
	var catrgoryurl = $('#getcategory').val();
	$.post(catrgoryurl, function (data) {

		var json = $.parseJSON(data);
		var loc = localStorage.getItem("counter");
		var itm = '#category-'+loc;
		console.log(loc);
		$.each(json, function (i,v) {
			$(itm).append('<option value="'+v.category_id+'">'+v.category_desc+'</option>');
		});
		$(itm).selectpicker('refresh');
	});
}

$('#product-edit-body').on("change",".product-category",function () {
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










