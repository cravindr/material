var check_counter = 0;
var counter = 1;

$(function () {

    var table = $('#po').DataTable( {
        "processing": true,
        "serverSide": true,
		"order": [[ 0, "desc" ]],
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);
	//table.column(5).visible(false);

    $('#po tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        poView(data[0]);
    });

	$('#po tbody').on("click","#btnreceive",function () {
		var data = table.row($(this).parents('tr')).data();
		if(data[5]!='received'){
			poReceive(data[0]);
		}else
		{
			alert("this Purchase Order Already Received");
		}

	});

	$('#po tbody').on("click","#btnedit",function () {
		var data = table.row($(this).parents('tr')).data();
		PrintPo(data[0]);
	});

    $('#po tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });

    $('#po tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();
		Status(data[0]);
    });

	$('#po tbody').on("click","#btnemail",function () {
		var data = table.row($(this).parents('tr')).data();
		PoEmail(data[0]);
	});
});

function PoEmail(id) {
	$.ajax({
		url : emailurl,
		data : {id:id},
		type: 'POST',
		success: function (data) {
			if(data == 1)
			{
				alert("Mail Sent Successfully...");
			}
			else
			{
				alert("Mail Not Sent...");
			}
		}
	});
}

function poView(id) {

	$.ajax({
		url: viewUrl,
		data: {id:id},
		type: "POST",
		success: function (data) {

			var json = $.parseJSON(data);

			$('.po_id').text(json[0].po_id);
			$('.sup_name').text(json[0].sup_name);
			$('.c_date').text(json[0].c_date);
			$('.note').text(json[0].note);
			$('.status').text(json[0].status);
			$('#po_view_spares').empty();
			var totalamount=0;
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
				html += '<td>'+ local_count +'</td>';
				html += '<td>'+ v.spare_name +'</td>';
				html += '<td>'+ v.price +'</td>';
				html += '<td>'+ v.qty +'</td>';
				html += '<td>'+ v.tax +'</td>';
				html += '<td>'+ v.tax_amount +'</td>';
				html += '<td>'+ v.total +'</td>';
				totalamount += parseFloat(v.total);
				$('#po_view_spares').append(html);
			});
			$("#totalamount").text(totalamount.toFixed(2));

			$('#po_view').modal('show');
		}
	});
}

function poReceive(id) {

	$.ajax({
		url: viewUrl,
		data: {id:id},
		type: "POST",
		success: function (data) {

			var json = $.parseJSON(data);

			$('.po_id').text(json[0].po_id);
			$('.sup_name').text(json[0].sup_name);
			$('.c_date').text(json[0].c_date);
			$('.note').text(json[0].note);
			$('.status').text(json[0].status);
			$('#po_id').val(json[0].po_id);
			$('#po_receive_spares').empty();
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
				html += '<td>'+ local_count +'</td>';
				html += '<td>'+ v.spare_name +'</td>';
				html +='<input type="hidden" name="spare_id[]" id="spare_id-'+ local_count +'"  class="form-control tot" value=' +v.spare_id +'>';
				html += '<td>' +
					'<input name="price[]" id="price-'+ local_count +'"  class="form-control tot" value=' +v.price +'>'+
					'</td>';

				html += '<td>' +
					'<input name="qty[]" id="qty-'+ local_count +'"  class="form-control tot" value=' +v.qty +'>'+
					'</td>';


				$('#po_receive_spares').append(html);
			});


			$('#po_receive').modal('show');
		}
	});
}

function PrintPo(id) {
	var url = printpo+'/'+id+'/';
	window.location.href = url;
}
function poDelete(id) {
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

function poEdit(id) {
	check_counter = localStorage.getItem("new_counter");

    $.ajax({
        url: Editurl,
        data: {id:id},
        type: "POST",
        success: function (data) {
            var json = $.parseJSON(data);
				$('#prod_id').val(json[0].po_id);
				$('#po_name_edit').val(json[0].po_name);
				$('#po_desc_edit').val(json[0].po_desc);
				$('#po-edit-body').empty();
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
				html += '<td>' +
					'<button id="btncount" disabled class="btn btn-warning btn-xs">'+ local_count +'</button>'+
					'<input type="hidden" id="detail_id" name="detail_id[]" value="'+ v.id +'">' +
					'</td>';
				html += '<td>' +
					'<select name="category[]" id="category-'+ local_count +'" class="selectpicker form-control po-category" title="po Select" data-live-search="true">' +
					'<option value="0">Select po Category....</option><option data-divider="true"></option>'+
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

				$('#po-edit-body').append(html);

			});

            $('#po_edit').modal('show');
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

//po Edit
function AddRow(counter) {
	localStorage.setItem('count',counter);
	var html = '<tr>';
	html += '<td>' +
		'<button disabled class="btn btn-warning btn-xs">'+ counter +'</button>'+
		'</td>';
	html += '<td>' +
		'<select name="category[]" id="category-'+ counter +'" class="selectpicker form-control po-category" title="po Select" data-live-search="true">' +
		'<option value="0">Select po Category....</option><option data-divider="true"></option>'+
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
	$('#po-edit-body').append(table);
});

$('#po-edit-body').on('click','#btndeleterow', function () {
	$(this).parents('tr').remove();
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

$('#po-edit-body').on("change",".po-category",function () {
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










