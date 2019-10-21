<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 27-07-2018
 * Time: 11:50 AM
 */

class Available_model extends CI_Model
{

    public function GetElementById($id)
    {
        $qry = $this->db->get_where('spares', array('spare_id' => $id));
        return $qry->result();
    }

    public function GetProductSpares($id)
    {
        $qry=$this->db->query("select spare_id,qty from product_detail where product_id=$id");
        return $this->fnObjectArrayToAssociativeArray( $qry->result());
    }

    public function fnObjectArrayToAssociativeArray($ObjArray)
    {
        $ar=array();
        foreach ( $ObjArray as $k=>$v)
        {

            $ar[$v->spare_id]=$v->qty;

        }
        return $ar;
    }

    function fnAddArray($array_01,$array_02)
    {
        $keyUnion = array_unique(array_merge(array_keys($array_01), array_keys($array_02)));
        $res = array();
        foreach ($keyUnion as $k => $v) {

            $res[$v] = (isset($array_01[$v]) ? $array_01[$v] : 0) + (isset($array_02[$v]) ? $array_02[$v] : 0);
        }

        return $res;
    }

    function fnArrayMultiplay($arr,$val)
    {
        $res=array();

        foreach ($arr as $k => $v)
        {
            $res[$k]=$arr[$k]*$val;
        }

        return $res;

    }

    public function GetProduct()
	{
		$qty = $this->db->get_where("products" , array('status' => 'active'));
		return  $qty->result();
	}

	public function Transaction($data)
	{
		$res1=$data["result"];
		$stockinfo=$data["stockinfo"];

		$arg=array(
			'name'=>$stockinfo[0]['name'],
			'note'=>$stockinfo[0]['note'],
			'cdate'=>$stockinfo[0]['date'],
			'status'=>'active'
		);

		$qry1=$this->db->insert("transaction",$arg);
		$trans_id=	$this->db->insert_id();

		foreach ($res1 as $res)
		{
			$spare_id=$res["spare_id"];
			$qty=$res["qty_need"]*(-1);
			$date=$stockinfo[0]['date'];
			$data1 = array(
				'trans_id' => $trans_id,
				'spare_id' => $spare_id,
				'qty' => $qty,
				'trans_date' => $date
			);
			$qry2=$this->db->insert("spare_transaction",$data1);

			$qry2=$this->db->query("UPDATE spares
												SET spare_quantity=spare_quantity + $qty
												WHERE spare_id='$spare_id'");

		}
		return $trans_id;
	}
	public function Po_requirment($data)
	{
		$res1=$data["result"];
		$stockinfo=$data["stockinfo"];

		$arg=array(
			'name'=>$stockinfo[0]['name'],
			'note'=>$stockinfo[0]['note'],
			'cdate'=>$stockinfo[0]['date'],
			'status'=>'active'
		);

		$qry1=$this->db->insert("po_requirment_master",$arg);
		$trans_id=	$this->db->insert_id();

		foreach ($res1 as $res)
		{
			$spare_id=$res["spare_id"];
			$qty=$res["qty_required"];
			$date=$stockinfo[0]['date'];
			$data1 = array(
				'po_req_mast_id' => $trans_id,
				'spare_id' => $spare_id,
				'qty' => $qty,
				'status' => 'active'
			);
			if($qty<0)
			{
				$qry2=$this->db->insert("po_requirment_detail",$data1);
			}




		}
		return $trans_id;
	}



	public function viewTransaction($id)
	{
		$qry = $this->db->query("SELECT 
											   t.trans_id,
											   t.name,
											   t.note,
											   t.cdate,
											   st.spare_id,
											   s.spare_part_no,
											   s.spare_name, 
											   st.qty 
									FROM spare_transaction as st
									JOIN transaction as t ON(st.trans_id=t.trans_id)
									JOIN spares as s ON(st.spare_id=s.spare_id)
									WHERE t.trans_id='$id'");
		return $qry->result();
	}



	public function TransactionCancel($data)
	{
		$trans_id=$data['trans_id'];
		$spare_id=$data['spare_id'];
		$qty_id=$data['qty'];
		$date_tran=$data['date'];









		for($i=0; $i<count($data['spare_id']); $i++)
		{
			if($data['spare_id'][$i]!=0)
			{
				$spare_id= $data['spare_id'][$i];
				$qty= $data['qty'][$i] * (-1);

				$data1 = array(
					'trans_id' => $trans_id,
					'spare_id' => $spare_id,
					'qty' => $qty,
					'trans_date' => $date_tran
				);

				$qry1=$this->db->insert("spare_transaction",$data1);
				$qry2=$this->db->query("UPDATE spares
												SET spare_quantity=spare_quantity +$qty
												WHERE spare_id='$spare_id'");

				$qry3=$this->db->query("UPDATE transaction
											SET status='cancled'
											WHERE trans_id='$trans_id'");

			}

		}

		return $qry3;
	}


}
