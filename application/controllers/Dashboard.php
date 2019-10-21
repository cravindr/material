<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    public function index()
	{
        $data = array(
            'pagetitle' => 'Dashboard',
            'profile_name' => $this->session->userdata('Loginsession')->user_name
        );

		$this->load->view('dashboard',$data);
	}

	    public function ProfileEdit()
        {
            $mes = $this->session->userdata("Dashboard");
            $id = $this->session->userdata('Loginsession')->user_id;

            if(isset($mes))
            {
                $data = array(
                    'pagetitle' => 'Profile',
                    'profile_name' => $this->session->userdata('Loginsession')->user_name,
                    'message' => $this->Message($mes),
                    'profile' => $this->dashboard_model->getuserbyid($id)
                );
            }
            else
            {
                $data = array(
                    'pagetitle' => 'Profile',
                    'profile_name' => $this->session->userdata('Loginsession')->user_name,
                    'message' => '',
                    'profile' => $this->dashboard_model->getuserbyid($id)
                );
            }

            $this->load->view('profile_edit',$data);
            $this->session->unset_userdata("Dashboard");
        }

        public function ProfileUpdate()
        {
            $data = array(
                'user_name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'user_email' => $this->input->post('email')
            );
                $id = $this->session->userdata('Loginsession')->user_id;

            $result = $this->dashboard_model->UpdateProfile($data,$id);

            if($result == 1)
            {
                $this->session->set_userdata("Dashboard","updated");
                redirect('dashboard/profileedit');
            }
            else
            {
                $this->session->set_userdata("Dashboard","unupdated");
                redirect('dashboard/profileedit');
            }
        }

    public function ChangePassword()
    {
        $mes = $this->session->userdata("Dashboard");


        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Password',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Password',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => ''
            );
        }

        $this->load->view('profile_password_edit',$data);
        $this->session->unset_userdata("Dashboard");
    }

    public function PasswordUpdate()
    {
        $passold = $this->input->post('opass');

        $data = array(
            'newpass' => $this->input->post('npass')
        );

        $oldpass = $this->session->userdata('Loginsession')->password;

        if(md5($passold) == $oldpass) {
            $id = $this->session->userdata('Loginsession')->user_id;
            $result = $this->dashboard_model->changepassword($id, $data['newpass']);

            if($result == 1)
            {
                $this->session->set_userdata("Dashboard","passupdated");
                redirect('dashboard/changepassword');
            }
            else
            {
                $this->session->set_userdata("Dashboard","passunupdated");
                redirect('dashboard/changepassword');
            }
        } else {
            $this->session->set_userdata("Dashboard","oldpasswordwrong");
            redirect('dashboard/changepassword');
        }
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Customer Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Profile Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Profile Record Does not Updated Try again...</div>';
        }
        elseif ($message == 'passupdated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Profile Password Updated Successfully...</div>';
        }
        elseif ($message == 'passunupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Profile Password Does not Updated Try again...</div>';
        }
        elseif ($message == 'oldpasswordwrong')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Current Password is Wrong Please try again...</div>';
        }

        return $mess;
    }
}
