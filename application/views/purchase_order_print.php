
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Purchase Order</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/custom_invoice_style.css'); ?>">
</head>
<body>

<table width="100%">
	<tbody>
	<tr>
		<td width="100%">
			<table width="100%">
				<tbody>
					<tr>
						<td width="30%" style="text-align: center">
							<h2>Address</h2>
							<p style="font-weight: bold">928/929, B-79, 4th Main Cross,</p>
							<p  style="font-weight: bold">Cauverypura, Magadi Road,</p>
							<p  style="font-weight: bold">Kamakshipalya, Kamakshipalya,</p>
							<p  style="font-weight: bold">Bengaluru, Karnataka 560079</p>
						</td>
						<td width="35%">
							<center>
								<h1 style="color: #ff6d33">Purchase Order</h1>
								<img src="<?php echo base_url('assets/img/logo.jpg'); ?>" width="150px">
							</center>
						</td>
						<td width="35%" style="text-align: center">
							<h2>Contact</h2>
							<p  style="font-weight: bold">Phone: +91 080 2348 0089</p>
							<p  style="font-weight: bold">Mobile: +91 93436 72010</p>
							<p  style="font-weight: bold">Email: corporate@sunrisegmpl.in</p>
							<p  style="font-weight: bold">Web: www.sunrisegmpl.com</p>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
	</tbody>
</table>
<hr>

<?php
/*echo "<pre>";
print_r($po_detail);
echo "</pre>";
exit;*/
if($po_detail[0]->sup_id)
{
	?>
	<table width="100%">
		<tbody>
		<tr>
			<td width="5%"></td>
			<td width="60%">
				<p class="address-title">SUPPLIER ADDRESS :</p>
				<table width="100%" class="address-disp">
					<tbody>
					<?php
					$cusfrtdet = array(
						$po_detail[0]->sup_address,
						$po_detail[0]->sup_place
					);

					$cussecdet = array(
						$po_detail[0]->sup_state,
						$po_detail[0]->sup_pin,
					);

					$mobcusdet = array($po_detail[0]->sup_mobile);

					//print_r($det);
					$cusfrstdec = implode(', ',array_filter($cusfrtdet));
					$cussecdet = implode(', ',array_filter($cussecdet));
					$cusphone = implode(', ',array_filter($mobcusdet));

					?>
					<tr>
						<td><div class="p">
								<table width="100%">
									<tr>
										<td width="10%"><img src="<?php echo base_url('assets/img/icons/home.png'); ?>" width="15px"></td>
										<td width="90%"><?php echo ($cusfrstdec); ?></td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php echo ($cussecdet); ?>
							</div>
						</td>
					</tr>
					<tr>
						<td><div class="p">
								<table width="100%">
									<tr>
										<td width="10%"><img src="<?php echo base_url('assets/img/icons/old_phone-512.png'); ?>" width="15px"></td>
										<td width="90%"><?php echo ($cusphone); ?></td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td><div class="p">
								<img src="<?php echo base_url('assets/img/icons/email-icon--clipart-best-22.png'); ?>" width="15px">&nbsp;
								<?php echo ($po_detail[0]->sup_email); ?>
							</div>
						</td>
					</tr>
					<tr>
						<td width="50%"><div class="p">
								<img src="<?php echo base_url('assets/img/icons/gst.png'); ?>" width="15px">&nbsp;
								<?php echo 'GSTIN :'."\n".($po_detail[0]->gst_no); ?>
							</div>
						</td>
						<td width="50%"><div class="p">
								<?php echo 'STATE CODE :'."\n".($po_detail[0]->state_code); ?>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
			</td>
			<td width="35%">
				<table width="100%" class="invoice-disp">
					<tbody>
					<tr>
						<td colspan="2" style="text-align: center; color: red; font-weight: bold"><div class="doctype"></div></td>
					</tr>
					<tr>
						<td>Purchase No : </td>
						<td class="inv-bold"><?php echo $po_detail[0]->po_id; ?></td>
					</tr>
					<tr>
						<td>Purchase Date : </td>
						<td class="inv-bold"><?php echo date('d-m-Y', strtotime($po_detail[0]->c_date)); ?></td>
					</tr>
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}

?>
<hr>

<table class="prod_tab" width="100%">
	<thead>
	<tr>
		<th width="3%">S.No</th>
		<th width="30%">Spare Name</th>
		<th>Part No</th>
		<th>UOM</th>
		<th>Price</th>
		<th>Qty</th>
		<th>Total</th>
	</tr>
	</thead>
	<tbody class="border">
	<?php $sno=1; foreach ($po_detail as $v) { ?>

		<tr>
			<td style="padding-left: 5px"><?php echo $sno++;?></td>
			<td style="padding-left: 5px"><?php echo $v->spare_name; ?></td>
			<td style="padding-left: 5px"><?php echo $v->spare_part_no; ?></td>
			<td style="padding-left: 5px"><?php echo $v->spare_uom; ?></td>
			<td  style="text-align: right"><?php echo $v->price; ?></td>
			<td  style="text-align: right"><?php echo $v->qty; ?></td>
			<td style="text-align: right">
				<?php
					$tot = $v->qty * $v->price;
					echo number_format((float)$tot, 2, '.', '');
				?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>


<!--<div class="footer-tab">
	<table class="total-list">
		<tbody>
		<tr>
			<td class="terms-and-conditions" rowspan="7" width="35%">
				<h4><u>Terms and Conditions</u></h4>

				<p>1. Payment should be make by A/c Payee Cheque / Draft Only.</p>
				<p>2. Any Problems in recived Dyes Yarns should be intimated fous within 48 hrs. as in hank form. Otherwise deemed to be order.</p>
				<p>3. Subject to Namakkal jurisdction only.</p>
			</td>
			<td class="bank-details" rowspan="7" width="35%">
				<h4><u>BANK ACCOUNT DETAILS</u></h4>

				<p>Bank Name   : <b>CITY UNION BANK</b></p>
				<p>Account No  : <b>510909010072652</b></p>
				<p>Branch Name : <b>Brough Road, Erode</b></p>
				<p>IFSC Code   : <b>CIUB0000059</b></p>
			</td>
			<?php /*if($invoice_master['igst'] == 0.00){ */?>
		<tr class="amount-details">
			<td>Gross Amount</td>
			<td class="amount-display">
				<?php /*echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['total']; */?>
			</td>
		</tr>
		<tr class="amount-details">
			<td>Total CGST</td>
			<td class="amount-display">
				<?php /*echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['sgst']; */?>
			</td>
		</tr>
		<tr class="amount-details">
			<td>Total SGST</td>
			<td class="amount-display">
				<?php /*echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['cgst']; */?>
			</td>
		</tr>
		<?php /*} else { */?>
			<tr class="amount-details">
				<td>Total IGST</td>
				<td class="amount-display">
					<?php /*echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['igst']; */?>
				</td>
			</tr>
		<?php /*} */?>
		<tr class="amount-details">
			<td>Total Amount</td>
			<td class="amount-display">
				<?php /*echo "&#x20b9;&nbsp;&nbsp;".$invoice_master['net_amount']; */?>
			</td>
		</tr>
		<tr class="amount-details">
			<td>Round Off </td>
			<td class="amount-display">
				<?php
/*				$v1 = $invoice_master['net_amount'];
				$v2 = round($v1);
				$v3 = $v2-$v1;
				echo "&#x20b9;&nbsp;&nbsp;".sprintf("%01.2f", $v3);
				*/?>
			</td>
		</tr>
		<tr class="amount-details">
			<td>Net Amount</td>
			<td class="amount-display">
				<?php /*echo "&#x20b9;&nbsp;&nbsp;".sprintf("%01.2f", $v2); */?>
			</td>
		</tr>
		</tr>
		</tbody>
	</table>

	<table class="authsign">
		<tbody>
		<tr>
			<td width="70%" class="amountinwords">
				<p>Amount In Words : <strong><?php /*echo $invoice_master['amount_in_words']; */?></strong></p>
			</td>
			<td width="30%" class="auth-signatore">
				<b>FOR SRI COLOURS</b>
			</td>
		</tr>
		</tbody>
	</table>
</div>-->




</body>

<script src="<?php echo base_url('assets/js/jquery.js'); ?>" type="text/javascript"></script>

<script>
	$(function(){
		test1();
	});

	function test1() {
		$('.doctype').text('Original Copy');
		window.print();
	}

	function test2() {
		$('.doctype').text('Duplicate Copy');
		window.print();
	}

	function test3() {
		$('.doctype').text('Duplicate Copy');
		window.print();
	}

</script>
</html>


