<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 6/7/2018
 * Time: 6:45 PM
 */

class Welcome_model extends CI_Model
{
    public function Login($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $qry = $this->db->query("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = md5('$password') AND `status` = 'active'");

        //return $this->db->last_query();


        if(!$qry->num_rows() == 0)
        {
            return $qry->result();
        }
        else
        {
            return 0;
        }
    }

    public function GetByEmail($email)
    {
       $qry =  $this->db->get_where("users", array("user_email" => $email));

       $res = array(
           'result' =>  $qry->result(),
           'rows' =>  $qry->num_rows()
       );
       return $res;
    }

    public function GetUserByOtp($otp)
    {
       $qry =  $this->db->get_where("users", array("otp" => $otp));
       $user =  $qry->result();
       return $user[0]->user_id;
    }
    public function SaveOTP($id,$otp)
    {
        $qry = $this->db->update("users", array("user_id" => $id, "otp" => $otp));
        return $qry;
    }

    public function ChangePassword($id, $pass)
    {
        $qry = $this->db->update("users", array( "password" => md5($pass), "user_id" => $id ));
            if($qry == 1)
            {
                $qry1 = $this->db->update("users", array( "otp" => '', "user_id" => $id ));
            }
        return $qry1;
    }
}
?>