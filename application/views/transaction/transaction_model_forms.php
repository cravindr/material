<div id="transaction_view" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Transaction View</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
					<tr style="background-color: #ffb8c3; color: white">
						<th width="45%">Property</th>
						<th>Values</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Transaction Id :</td>
						<td class="trans_id"></td>
					</tr>
					<tr>
						<td>Name :</td>
						<td class="name"></td>
					</tr>
					<tr>
						<td>Note :</td>
						<td class="note"></td>
					</tr>
					<tr>
						<td>Date :</td>
						<td class="cdate"></td>
					</tr>

					<tr>
						<table  class="table table-striped table-bordered">
							<thead>
							<tr style="background-color: #9dd597; color: white">
								<th>S.no</th>
								<th>Spare Id</th>
								<th>Part No</th>
								<th>Spare Name</th>
								<th>Quantity</th>

							</>
							</thead>
							<tbody id="trans_view_spares"></tbody>
						</table>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>


<div id="transaction_calcel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Transaction View</h4>
			</div>
			<form method="post" action="<?php echo site_url('available/canceltransaction'); ?>  ">

				<input type="hidden" name="trans_id" id="trans_id" >
			<div class="modal-body">
				<table class="table table-bordered">
					<thead>
					<tr style="background-color: #ffb8c3; color: white">
						<th width="45%">Property</th>
						<th>Values</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Transaction Id :</td>
						<td class="trans_id"></td>
					</tr>
					<tr>
						<td>Name :</td>
						<td class="name"></td>
					</tr>
					<tr>
						<td>Note :</td>
						<td class="note"></td>
					</tr>
					<tr>
						<td>Date :</td>
						<td class="cdate"></td>
					</tr>

					<tr>
						<table  class="table table-striped table-bordered">
							<thead>
							<tr style="background-color: #9dd597; color: white">
								<th>S.no</th>
								<th>Spare Id</th>
								<th>Part No</th>
								<th>Spare Name</th>
								<th>Quantity</th>

							</>
							</thead>
							<tbody id="trans_canlcel_spares"></tbody>
						</table>
					</tr>
					</tbody>
				</table>
			</div>
				<div class="row">
					<div class="col-lg-offset-11 col-lg-1">
						<input type="submit" value="Cancel Transaction" class="btn btn-danger pull-right ">
					</div>

				</div>
				<br>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
