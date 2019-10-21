<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 6/18/2018
 * Time: 10:51 AM
 */

class Po_model extends CI_Model
{

    public function Save($data)
    {
        $qry = $this->db->insert('spares',$data);
        return $qry;
    }
	public function GetElementById($id)
	{
		$qry = $this->db->get_where('purchase_order', array('po_id' => $id));
		return $qry->result();
	}

    public function SparesGetById($id)
	{
		$this->db->get_where("", array("product_id" => $id));
	}

    public function GetSpareWithCategoryId($id)
    {
        $qry = $this->db->query("SELECT
                                           spares.spare_id,
                                           spares.spare_name,
                                           spares.spare_size,
                                           spares.spare_desc,
                                           spares.spare_quantity,
                                           spares.spare_reorder_level,
                                           category.category_desc 
                                        FROM
                                           category 
                                           JOIN
                                              spares 
                                              ON (category.category_id = spares.category_id) 
                                        WHERE
                                           category.category_id = '$id' 
                                           AND category.status = 'active' 
                                           AND spares.status = 'active'");

        return $qry->result();
    }

    public function SavePo($data)
    {
		$this->db->insert("purchase_order", $data);
		return $this->db->insert_id();
    }

	public function Delete($id)
	{
		$qry = $this->db->delete('products', array('product_id' => $id));
		return $qry;
	}

    public function SavePoDetail($data)
    {
      for($i=0; $i<count($data['spare_id']); $i++)
      {
      	if($data['spare_id'][$i]!=0)
		{
			$data1 = array(
				'po_id' => $data['po_id'],
				'spare_id' => $data['spare_id'][$i],
				'qty' => $data['qty'][$i],
				'price' => $data['price'][$i],
				'tax' => $data['tax'][$i],
				'tax_amount' => $data['price'][$i],
				'total' => $data['total'][$i]
			);

			$qry = $this->db->insert("po_detail", $data1);
		}

      }

        return $qry;

    }

    public function GetSupplierNameById($id)
	{
		$qry=$this->db->get_where("supplier", array("sup_id" => $id));
		$res=$qry->result();
		return $res[0]->sup_name;
	}

	public function UpdateStatus($id)
	{
		$res = $this->GetElementById($id);
		$this->db->where('po_id', $id);

		if($res[0]->status == 'active')
		{
			$qry = $this->db->update("purchase_order", array('status' => 'inactive'));
		}
		else
		{
			$qry = $this->db->update("purchase_order", array('status' => 'active'));
		}

		return $qry;

	}

	public function viewPO($id)
	{
		$qry = $this->db->query("SELECT
											pd.po_id,
											po.sup_name,
											po.c_date,
											po.note,
											po.status,
											s.spare_name,
											pd.spare_id,
											pd.price,
											pd.qty,
											pd.tax,
										    pd.tax_amount,
										    pd.total
    									FROM po_detail as pd
    									JOIN purchase_order as po on (po.po_id=pd.po_id)
    									JOIN spares as s on(pd.spare_id=s.spare_id)
    									WHERE po.po_id=$id ");
		return $qry->result();
	}

	public function Transaction($data)
	{
		$po_id=$data["po_id"];



		for($i=0; $i<count($data['spare_id']); $i++)
		{
			if($data['spare_id'][$i]!=0)
			{
				$spare_id= $data['spare_id'][$i];
				$qty= $data['qty'][$i];
				//$po_id = $data['po_id'];


				$data1 = array(
					'po_id' => $data['po_id'],
					'spare_id' => $data['spare_id'][$i],
					'qty' => $data['qty'][$i],
					'trans_date' => $data['cdate']
				);

				$qry = $this->db->insert("spare_transaction", $data1);
				$qry2=$this->db->query("UPDATE spares
												SET spare_quantity=spare_quantity +$qty
												WHERE spare_id='$spare_id'");
				$qry3=$this->db->query("UPDATE purchase_order
											SET status='received'
											WHERE po_id='$po_id'");


			}

		}

		return $qry;
	}

	public function GetPrintPo($id)
	{
		$qry = $this->db->query("SELECT po.sup_name,
											   po.po_id,
											   po.note,
											   po.c_date,
											   s.spare_name,
											   s.spare_part_no,
											   s.spare_uom,
											   pd.price,
											   pd.qty,
											   po.sup_id,
											   sup.sup_email,
											   sup.sup_mobile,
											   sup.sup_address,
											   sup.sup_place,
											   sup.sup_state,
											   sup.sup_pin,
											   sup.gst_no,
											   sup.state_code
										FROM   purchase_order po
												 JOIN po_detail pd
												   ON po.po_id = pd.po_id
												 JOIN spares s
												   ON pd.spare_id = s.spare_id
												 JOIN supplier sup
												   ON sup.sup_id = po.sup_id
										WHERE  po.po_id = '$id'
								");
		return $qry->result();
	}

	public function MakePoGetSupplierWithSpareId($id)
	{
		$qry = $this->db->query("SELECT
										*
									FROM
										 supplier su
										   JOIN
											 spares sp
											 on (
												 find_in_set(su.sup_id,
															 sp.supplier_id))
									WHERE
										sp.spare_id = '$id'");

		return $qry->result();
	}

	public function MakePoGetSpareQuantity($id)
	{
		$qry = $this->db->query("SELECT
											*
										FROM
											 po_requirment_detail pord
											   JOIN
												 spares s
												 ON(
													 pord.spare_id = s.spare_id
													 )
											   JOIN
												 supplier sup
												 ON (
													 Find_in_set(sup.sup_id,
																 s.supplier_id) )
										WHERE
											sup.sup_id = '$id' AND pord.status = 'active'");

		return $qry->result();
	}

	public function RequredPoDetailStatus($id)
	{
		$qry = $this->db->query("UPDATE po_requirment_detail SET status = 'podone' WHERE id in ($id)");
		return $qry;
	}


	public function SendPoMail($poId,$message)
	{
		$qry=$this->db->query("select su.sup_email from purchase_order po
											join supplier su on(po.sup_id=su.sup_id)
											where po.po_id='$poId'");
		$row=$qry->result();


		//$to=$row["sup_email"];
		//$message = "$message";
	
	
		$to=$row[0]->sup_email;

		//echo $to; exit;

		if(filter_var($to, FILTER_VALIDATE_EMAIL))
		{
			$subject = "Purcase order from Sunrise PO Ref#$poId";
			//$headers = "MIME-Version: 1.0" . "\r\n";
			//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			//$headers .= 'From: <purchase@sunrisegmpl.com>' . "\r\n";
			//$headers .= 'Cc: anthu1510@gmail.com' . "\r\n";
			
			        $headers = "Reply-To: Sunrise Purchase Order <info@sunrisegmpl.com>\r\n";
                    $headers .= "Return-Path: Sunrise Purchase Order <info@sunrisegmpl.com>\r\n";
                    $headers .= "From: Sunrise Purchase Order <noreply@sunrisegmpl.com>\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Sender: Sunrise Purchase Order <info@sunrisegmpl.com>\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\"; \r\n";
                    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";


			if (mail($to, $subject, $message, $headers)) {
				//echo 'Your mail has been sent successfully.';
				return 1;
			} else {
				//echo 'Unable to send email. Please try again.';
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}

	public function GetPoMaster($poId)
	{
		$qry=$this->db->query("select * from purchase_order po
											join supplier su on(po.sup_id=su.sup_id)
											where po.po_id='$poId'");

		return $qry->result();
	}

	public function GetPoDetail($poId)
	{
		$qry=$this->db->query("SELECT * FROM po_detail pod JOIN spares s ON pod.spare_id = s.spare_id WHERE  po_id='$poId'");

		return $qry->result();
	}

}
?>
