<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 6/18/2018
 * Time: 10:51 AM
 */

class Spares_model extends CI_Model
{
    public function Save($data)
    {
        $qry = $this->db->insert('spares',$data);
        return $qry;
    }

    public function GetElementById($id)
    {
        $qry = $this->db->get_where('spares', array('spare_id' => $id));
        return $qry->result();
    }

    public function Update($data,$id)
    {
        $this->db->where('spare_id', $id);
        $qry = $this->db->update('spares', $data);
        return $qry;
    }

    public function UpdateStatus($id)
    {
        $res = $this->GetElementById($id);
        $this->db->where('spare_id', $id);

        if($res[0]->status == 'active')
        {
            $qry = $this->db->update("spares", array('status' => 'inactive'));
        }
        else
        {
            $qry = $this->db->update("spares", array('status' => 'active'));
        }

        return $qry;

    }

    public function Delete($id)
    {
        $qry = $this->db->delete('spares', array('spare_id' => $id));
        return $qry;
    }

	public function GetSparesBySupplier($id)
	{
		$qry = $this->db->query ("SELECT * FROM spares WHERE find_in_set($id,supplier_id) and status='active'");
		return $qry->result();
	}
	public function GetSparesPriceById($id)
	{
		$qry = $this->db->get_where('spares', array('spare_id' => $id));
		return $qry->result();
	}
}
?>
