<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 7/25/2018
 * Time: 11:06 AM
 */

class Category_model extends CI_Model
{
    public function GetCategoryActive()
    {
        $qry = $this->db->get_where('category', array('status' => 'active'));
        return $qry->result();
    }

    public function Save($data)
    {
        $qry = $this->db->insert('category',$data);
        return $qry;
    }
    public function GetElementById($id)
    {
        $qry = $this->db->get_where('category', array('category_id' => $id));
        return $qry->result();
    }

    public function Update($data,$id)
    {
        $this->db->where('category_id', $id);
        $qry = $this->db->update('category', $data);
        return $qry;
    }

    public function Delete($id)
    {
        $qry = $this->db->delete('category', array('category_id' => $id));
        return $qry;
    }

    public function UpdateStatus($id)
    {
        $res = $this->GetElementById($id);
        $this->db->where('category_id', $id);

        if($res[0]->status == 'active')
        {
            $qry = $this->db->update("category", array('status' => 'inactive'));
        }
        else
        {
            $qry = $this->db->update("category", array('status' => 'active'));
        }

        return $qry;

    }


}
?>