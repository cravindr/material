<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
        $data = array(
            'pagetitle' => 'Users'
        );

		$this->load->view('login',$data);
	}

	public function Login()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        $this->load->model('welcome_model');
        $result = $this->welcome_model->login($data);
        //print_r($result[0]); exit;

            if(!$result == 0)
            {
                $this->session->set_userdata('Loginsession',$result[0]);
                redirect('dashboard/');
            }
            else
            {
                redirect('welcome/');
            }
    }

    public function SaveNewPassword()
    {
            $data = array(
                    'otp' => $this->input->post('otp'),
                    'pass' => $this->input->post('pass')
            );

        $user_id = $this->welcome_model->getuserbyotp($data['otp']);

        $res = $this->welcome_model->SaveOTP($user_id,$data['otp']);

            if($res == 1)
            {
                ?>
                <script>
                    alert('Password Successfully Reseted...');
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Password Does not Reset...');
                </script>
                <?php
                redirect('welcome/');
            }
    }

    public function PassswordResetForm()
    {
        $data = array(
            'pagetitle' => 'Reset'
        );

        $this->load->view('password_rest_form',$data);
    }

    public function ForgotPassword()
    {
	    $email = $this->input->post('forgot_email_id');
        $this->load->model('welcome_model');
        $res = $this->welcome_model->getbyemail($email);

            if($res['rows'] == 1)
            {
                $email = $res['result'][0]->user_email;
                $user_id = $res['result'][0]->user_id;
                $otp = rand(100000,999999);

                $saved_otp = $this->welcome_model->saveotp($user_id,$otp);

                    if($saved_otp == 1)
                    {
                        $sent = $this->ForgotEmailSend($email, $otp);

                            if($sent == 1)
                            {
                                ?>
                                <script>
                                    alert('Your Password Reset OTP is Send Your mail id... please Check..');
                                </script>
                                <?php

                                redirect('welcome/passswordresetform');
                            } else {
                                ?>
                                <script>
                                    alert('Something Wrong please try again...');
                                </script>
                                <?php
                            }
                    }
                    else
                    {
                        ?>
                        <script>
                            alert('Something Wrong please try again...');
                        </script>
                        <?php
                    }
            } else {
                ?>
                    <script>
                        alert('Email address is not Exists...');
                    </script>
                <?php
            }



    }

    public function ForgotEmailSend($to,$randomNumber)
    {
        $message = "your One Time Reset Pin: .$randomNumber";
        $subject = "Sunrise Password Reset";
        //$headers = "MIME-Version: 1.0" . "\r\n";
        //$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //$headers .= 'From: <purchase@sunrisegmpl.com>' . "\r\n";
        //$headers .= 'Cc: anthu1510@gmail.com' . "\r\n";

        $headers = "From: Sunrise Password Reset <noreply@sunrisegmpl.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
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

    public function Logout()
    {
        $this->session->unset_userdata('loginsession');
        redirect('welcome/');
    }
}
