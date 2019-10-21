

$(function () {

    var table = $('#mkpo').DataTable( {
		order: [ 0, 'desc' ],
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);
    table.column(5).visible(false);
	//table.column(5).visible(false);

    $('#mkpo tbody').on("click","#btnpo",function () {
        var data = table.row($(this).parents('tr')).data();
		SupplierSelect(data[5]);
		//
    });
});

function SupplierSelect(id) {

	$.ajax({
		url: makeposupplier,
		data: {id:id},
		type: "POST",
		success: function (data) {

			var json = $.parseJSON(data);
				var html = [];
			    $.each(json, function (i,v) {
					html += '<option value="'+v.sup_id+'">'+v.sup_name+'</option>';

				});

			$('#mkposupplier').html(html);
			$('#mkpo_supplier_select').modal('show');
		}
	});
}
















