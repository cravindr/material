<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Purchase</title>
<style>
	.text-header{
		margin-bottom: 1em;
		font-weight: bold;
		font-size: 16px;
		padding-left: 5px;
	}

	.address-text-bold{
		padding-left: 5px;
		font-size: 16px;
		font-weight: bold;
		margin-bottom: 9px;
	}



	.address-text{
		padding-left: 5px;
		font-size: 14px;
		margin-bottom: 4px;
	}

	.fill{
		font-size: 14px;
		font-weight: bold;
		padding-left: 10px;
	}

	.bordered tr ,.bordered th,.bordered td{
		border: 1px solid black;
		border-collapse: collapse;
	}

	.itemdesc{
		margin-top: 25px;
	}

	.align-right{
		text-align: right;
	}

	.itemdesc,tr,.itemdesc th,.itemdesc td{
		border-collapse: collapse;
		border: 1px solid black;
	}

	.pad-right{
		float: right;
		text-align: center;
		height: 100px;
	}

	#footer {
		position: absolute;
		bottom:0;
		padding-right: 0;
	}

	.withoutborder tr td{
		border: 0 !important;
	}

	.footer-text-bold {
		font-weight: bold;
	}


</style>
</head>
<body id="getallpo">

	<table width="100%">
		<thead>
			<tr>
				<th style="text-align: center"><h1>Purchase Order</h1></th>
			</tr>
		</thead>
	</table>

	<table class="bordered" width="100%">
		<tbody>
			<tr>
				<td width="50%">
					<table width="100%"  rules="rows">
						<tbody>
							<tr>
								<td>
									<div class="text-header">Invoice To</div>
									<div class="address-text-bold">SUNRISE GARMENT MACHINERY PRIVATE LIMITED</div>
									<div class="address-text">No.928/928, 4th Main, Kaveripura,</div>
									<div class="address-text">Magadi Main Road,</div>
									<div class="address-text">Kamakshipalya,</div>
									<div class="address-text">Bangalore – 560 079. Karnataka.</div>
									<div class="address-text">Phone  : +91 080 – 2348 4038/2348 0089/2348 0092,</div>
									<div class="address-text">Mobile : +91 93436 72010,</div>
									<div class="address-text">Email   : corporate@sunrisegmpl.in</div>
									<div class="address-text">Web     : www.sunrisegmpl.com</div>
								</td>
							</tr>
							<!--<tr>
								<td>
									<div class="text-header">Dispached To</div>
									<div class="address-text-bold">SUNRISE GARMENT MACHINERY PRIVATE LIMITED</div>
									<div class="address-text">No.928/928, 4th Main, Kaveripura,</div>
									<div class="address-text">Magadi Main Road,</div>
									<div class="address-text">Kamakshipalya,</div>
									<div class="address-text">Bangalore – 560 079. Karnataka.</div>
								</td>
							</tr>-->
							<tr>
								<td>
									<div class="text-header">Supplier</div>
									<div class="address-text-bold"><?php echo $po_master[0]->sup_name; ?></div>
									<div class="address-text"><?php echo $po_master[0]->sup_address; ?></div>
									<div class="address-text"><?php echo $po_master[0]->sup_place; ?></div>
									<div class="address-text"><?php echo $po_master[0]->sup_city; ?></div>
									<div class="address-text"><?php echo $po_master[0]->sup_state.','.$po_master[0]->sup_pin; ?></div>
									<div class="address-text"><?php echo "GSTIN : ".$po_master[0]->gst_no; ?></div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td width="50%"  style="vertical-align:top">
					<table width="100%"  rules="rows">
						<tbody>
							<tr>
								<td>
									<div class="address-text-bold">Po No.</div>
                                    <?php if(empty($po_master[0]->po_no_manu)) { ?>
									    <div class="fill"><?php echo sprintf("%04d",  $po_master[0]->po_id); ?></div>
                                    <?php } else { ?>
                                        <div class="fill"><?php echo $po_master[0]->po_no_manu; ?></div>
                                    <?php }  ?>
								</td>
								<td>
									<div class="address-text-bold">Dated</div>
									<div class="fill"><?php echo date('d-m-Y'); ?></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<div class="address-text-bold">Mode/Terms of Payment</div>
									<div class="fill"><?php echo $po_master[0]->terms_of_payment; ?></div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="address-text-bold">Supplier's Ref/Order No.</div>
									<div class="fill"><?php echo $po_master[0]->supplier_ref_no; ?></div>
								</td>
								<td>
									<div class="address-text-bold">Other Reference(s)</div>
									<div class="fill"><?php echo $po_master[0]->other_reference; ?></div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="address-text-bold">Despatch through</div>
									<div class="fill"><?php echo $po_master[0]->despatch; ?></div>
								</td>
								<td>
									<div class="address-text-bold">Destination</div>
									<div class="fill"><?php echo $po_master[0]->destination; ?></div>
								</td>
							</tr>
							<tr rules="">
							   <td width="100%" colspan="2" style="height: 16em;  vertical-align: top">
											<div class="address-text-bold">Terms of Delivery</div>
											<div class="fill"><?php echo $po_master[0]->terms_of_delivery; ?></div>
										</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>

	<table class="bordered itemdesc" width="100%">
		<thead>
			<tr>
				<th>SI No</th>
				<th>Description of Goods</th>
				<th>HSN Code</th>
				<th>Quantity</th>
				<th>UOM</th>
				<th>Rate</th>
                <th>Tax %</th>
				<th>Total</th>
                <?php if($po_master[0]->tax_type == 'i'){ ?>
                    <th>IGST Amount</th>
                <?php } else { ?>
                    <th>CGST</th>
                    <th>SGST</th>
                <?php }  ?>
				<th>Total with Tax</th>
			</tr>
		</thead>
		<tbody>
			<?php $sno=1; foreach ($po_detail as $v ){ ?>

				<?php
						$total_amount = $v->price * $v->qty;
						$tax_amount = $total_amount * $v->spare_tax/100;

						$total_amount_with_tax_amount = $total_amount + $tax_amount;
						$sumtotal[] = $total_amount_with_tax_amount;
						$sum_total_amount[] = $total_amount;
						$sum_tax_amount[] = $tax_amount;
				?>

				<tr>
					<td><?php echo $sno++; ?></td>
					<td><?php echo $v->spare_name; ?></td>
					<td><?php echo $v->spare_hsn; ?></td>
					<td class="align-right"><?php echo number_format($v->qty,2); ?></td>
					<td><?php echo $v->spare_uom; ?></td>
					<td class="align-right"><?php echo number_format($v->price,2); ?></td>
					<td class="align-right"><?php echo $v->spare_tax; ?></td>
					<td class="align-right">
                        <?php echo number_format((float)$total_amount, 2, '.', ''); ?>
                    </td>

                    <?php if($po_master[0]->tax_type == 'i'){ ?>
                        <td class="align-right">
                            <?php echo number_format((float)$tax_amount, 2, '.', ''); ?>
                        </td>
                    <?php } else { ?>
                        <td class="align-right">
                            <?php $cgst = $tax_amount/2; echo number_format((float)$cgst, 2, '.', '');?>
                        </td>
                        <td class="align-right">
                            <?php $sgst = $tax_amount/2; echo number_format((float)$sgst, 2, '.', '');?>
                        </td>
                    <?php }  ?>
					<td class="align-right">
                        <?php echo number_format((float)$total_amount_with_tax_amount, 2, '.', ''); ?>
                    </td>
				</tr>
			<?php } ?>
			<?php for($i=$sno; $i<=25; $i++){ ?>
				<tr style="border: 0 !important;">
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
					<td style="border: 0 !important;">&nbsp;</td>
                    <?php if($po_master[0]->tax_type != 'i'){ ?>
                        <td style="border: 0 !important;">&nbsp;</td>
                    <?php }  ?>
				</tr>
			<?php } ?>
		</tbody>
	</table>



	<table class="bordered" width="100%" style="margin-top: 1em">
		<tr>
			<td width="50%">
				<table width="100%">
					<tbody>
					<tr>
						<td>
							<div class="address-text-bold">Amount Chargeable(in words)</div>
							<div><?php $tot = array_sum($sumtotal);  echo strtoupper(getIndianCurrency(round($tot))); ?></div>
						</td>
					</tr>
					</tbody>
				</table>
			</td>
			<td width="50%">
				<table width="100%" rules="rows">
					<tbody>
					<tr>
						<td width="60" class="align-right">Total Amount</td>
						<td width="40" class="align-right"><?php $sum_tot = array_sum($sum_total_amount); echo number_format((float)$sum_tot, 2, '.', ''); ?></td>
					</tr>
					<tr>
                        <?php $total_tax = array_sum($sum_tax_amount); $tax_tot = number_format((float)$total_tax, 2, '.', '');  $cgst_tot = $tax_tot/2;?>
                        <?php if($po_master[0]->tax_type == 'i'){ ?>
						<td width="60" class="align-right">IGST Amount</td>
                        <?php } else { ?>
                            <td width="60"  class="align-right"><?php echo "CGST: ".$cgst_tot." + "."SGST: ".$cgst_tot." "; ?></td>
                        <?php }?>
						<td width="40" class="align-right"><?php $total_tax = array_sum($sum_tax_amount); echo number_format((float)$total_tax, 2, '.', ''); ?></td>
					</tr>
					<tr>
						<td width="60" class="align-right">Round Off</td>
						<td width="40" class="align-right"><?php $round_amount = round($tot); $round_off =  $round_amount - $tot; echo number_format((float)$round_off, 2, '.', '')?></td>
					</tr>
					<tr>
						<td width="60" class="align-right">Total Amount With Tax</td>
						<td width="40" class="align-right"><?php echo number_format((float)$round_amount, 2, '.', ''); ?></td>
					</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>

	<table class="pad-right" width="40%" frame="box">
		<tr>
			<td style="vert-align: top">
				<div class="footer-text-bold">For SUNRISE GARMENT MACHINERY PRIVATE LTD</div>
			</td>
		</tr>
		<tr>
			<td style="vert-align: bottom">
				<div class="footer-text-bold">Authorised Signatory</div>
			</td>
		</tr>
	</table>






</body>

<script>
function PrintPo(){
    window.print();
}
PrintPo();
</script>

</html>

<?php

function getIndianCurrency($number)
{
	$decimal = round($number - ($no = floor($number)), 2) * 100;
	$hundred = null;
	$digits_length = strlen($no);
	$i = 0;
	$str = array();
	$words = array(0 => '', 1 => 'one', 2 => 'two',
		3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
		7 => 'seven', 8 => 'eight', 9 => 'nine',
		10 => 'ten', 11 => 'eleven', 12 => 'twelve',
		13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
		16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
		19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
		40 => 'forty', 50 => 'fifty', 60 => 'sixty',
		70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	$digits = array('', 'hundred','thousand','lakh', 'crore');
	while( $i < $digits_length ) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += $divider == 10 ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
		} else $str[] = null;
	}
	$Rupees = implode('', array_reverse($str));
	$paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;
}
?>
