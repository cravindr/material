<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 7/25/2018
 * Time: 10:55 AM
 */

class Supplier_model extends CI_Model
{
    public function GetSupplierActive()
    {
        $qry = $this->db->get_where("supplier", array('status' => 'active'));
        return $qry->result();
    }

    public function Save($data)
    {
        $qry = $this->db->insert('supplier',$data);
        return $qry;
    }

    public function GetElementById($id)
    {
        $qry = $this->db->get_where('supplier', array('sup_id' => $id));
        return $qry->result();
    }

    public function Update($data,$id)
    {
        $this->db->where('sup_id', $id);
        $qry = $this->db->update('supplier', $data);
        return $qry;
    }

    public function Delete($id)
    {
        $qry = $this->db->delete('supplier', array('sup_id' => $id));
        return $qry;
    }

    public function UpdateStatus($id)
    {
        $res = $this->GetElementById($id);
        $this->db->where('sup_id', $id);

        if($res[0]->status == 'active')
        {
            $qry = $this->db->update("supplier", array('status' => 'inactive'));
        }
        else
        {
            $qry = $this->db->update("supplier", array('status' => 'active'));
        }

        return $qry;

    }
}
?>