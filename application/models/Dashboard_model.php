<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 6/7/2018
 * Time: 6:38 PM
 */

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        $this->Redirect();
    }

    public function Redirect()
    {
        $login = $this->session->userdata('Loginsession');

        if(!isset($login))
        {
            redirect('welcome/');
        }
    }

    public function DateTime()
    {
        date_default_timezone_set('Asia/Kolkata');
        $time = date('Y-m-d H:i:s');
        return $time;
    }

    public function GetUserById($id)
    {
        $qry =  $this->db->get_where("users", array("user_id" => $id));
        return $qry->result();
    }

    public function ChangePassword($id, $pass)
    {
        $qry = $this->db->update("users", array( "password" => md5($pass), "user_id" => $id ));
        return $qry;
    }
    public function UpdateProfile($data, $id)
    {
        $qry = $this->db->update("users", $data, array("user_id" => $id));
        return $qry;
    }
}
?>