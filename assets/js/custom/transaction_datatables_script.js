$(function () {

    var table = $('#transaction').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    /*table.column(0).visible(false);*/

    $('#transaction tbody').on("click","#btnview",function () {
		var data = table.row($(this).parents('tr')).data();
		TransView(data[0]);
	});

	$('#transaction tbody').on("click","#btnprint",function () {
		var data = table.row($(this).parents('tr')).data();

		if(data[6]=='active')
		{
			alert("Printout " +data[0] );
		}
		else
		{
			alert("Unable to take printout bcz the Transaction Already Cancled.");
		}
	});

    $('#transaction tbody').on("click","#btndelete",function () {
        var data = table.row($(this).parents('tr')).data();

        if(data[6]=='active')
		{
			TransDelete(data[0]);
		}
		else
		{
			alert("The Transaction Already Cancled");
		}

    });




});

function TransView(id) {

	$.ajax({
		url: Viewurl,
		data: {id:id},
		type: "POST",
		success: function (data) {

			var json = $.parseJSON(data);
console.log(json);
			$('.trans_id').text(json[0].trans_id);
			$('.name').text(json[0].name);
			$('.note').text(json[0].note);
			$('.cdate').text(json[0].cdate);

			$('#trans_view_spares').empty();
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
				html += '<td>'+ local_count +'</td>';
				html += '<td>'+ v.spare_id +'</td>';
				html += '<td>'+ v.spare_part_no +'</td>';
				html += '<td>'+ v.spare_name +'</td>';
				html += '<td>'+ v.qty +'</td>';

				$('#trans_view_spares').append(html);
			});


			$('#transaction_view').modal('show');
		}
	});
}


function TransDelete(id) {

	$.ajax({
		url: Viewurl,
		data: {id:id},
		type: "POST",
		success: function (data) {

			var json = $.parseJSON(data);

			$('.trans_id').text(json[0].trans_id);
			$('.name').text(json[0].name);
			$('.note').text(json[0].note);
			$('.cdate').text(json[0].cdate);
			$('#trans_id').val(json[0].trans_id);
			//$('#trans_canlcel_spares').empty();
			$('#trans_canlcel_spares').empty();
			$.each(json, function (i,v) {
				var local_count =  parseInt(i) + parseInt(1);
				var html = '<tr>';
				html += '<td>'+ local_count +'</td>';
				html += '<td>'+ v.spare_id +'</td>';
				html += '<td>'+ v.spare_part_no +'</td>';
				html += '<td>'+ v.spare_name +'</td>';
				html += '<td>'+ v.qty +'</td>';
				html +='<input type="hidden" name="spare_id[]" id="spare_id-'+ local_count +'"   value=' +v.spare_id +'>';
				html += '<input type="hidden" name="qty[]" id="qty-'+ local_count +'"  class="form-control tot" value=' +v.qty +'>';


				$('#trans_canlcel_spares').append(html);

			});


			$('#transaction_calcel').modal('show');
		}
	});
}








