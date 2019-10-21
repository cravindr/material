

<!-- Modal -->
<div id="po_view" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Purchase Order View</h4>
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
                        <td>PO Number :</td>
                        <td class="po_id"></td>
                    </tr>
					<tr>
						<td>Supplier :</td>
						<td class="sup_name"></td>
					</tr>
                    <tr>
                        <td>PO Date :</td>
                        <td class="c_date"></td>
                    </tr>
					<tr>
						<td>Note :</td>
						<td class="note"></td>
					</tr>
					<tr>
						<td>Status :</td>
						<td class="status"></td>
					</tr>
					<tr>
						<table  class="table table-striped table-bordered">
							<thead>
								<tr style="background-color: #9dd597; color: white">
									<th>S.no</th>
									<th>Spare Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Tax %</th>
									<th>Tax Amount</th>
									<th>Total Amount</th>
								</>
							</thead>
							<tbody id="po_view_spares"></tbody>
						</table>
					</tr>
                    </tbody>
                </table>
				<strong >Total Amount  <div id="totalamount"></div></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="po_receive" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Purchase Order View</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="RecivePO">
					<input type="hidden" id="po_id" name="po_id">
				<table class="table table-bordered">
					<thead>
					<tr style="background-color: #ffb8c3; color: white">
						<th width="45%">Property</th>
						<th>Values</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>PO Number :</td>
						<td class="po_id"></td>
					</tr>
					<tr>
						<td>Supplier :</td>
						<td class="sup_name"></td>
					</tr>
					<tr>
						<td>PO Date :</td>
						<td class="c_date"></td>
					</tr>
					<tr>
						<td>Note :</td>
						<td class="note"></td>
					</tr>
					<tr>
						<td>Status :</td>
						<td class="status"></td>
					</tr>
					<tr>
						<table  class="table table-striped table-bordered">
							<thead>
							<tr style="background-color: #9dd597; color: white">
								<th>S.no</th>
								<th>Spare Name</th>
								<th>Price</th>
								<th>Quantity</th>
							</>
							</thead>
							<tbody id="po_receive_spares"></tbody>
						</table>
					</tr>
					</tbody>
				</table>
					<div class="row">
						<div class="col-lg-offset-11 col-lg-1">
							<input type="submit" value="Recive PO" class="btn btn-primary pull-right ">
						</div>

					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
