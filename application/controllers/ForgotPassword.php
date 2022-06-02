<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->load->view('forgot_password.php');
    }

    public function send_request(){
			$recaptcha = new \ReCaptcha\ReCaptcha($this->config->item('recaptcha_secret_key'));
			$resp = $recaptcha->verify($this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
			if (!$resp->isSuccess()) {
				$this->session->sess_regenerate();
				$this->result->message = 'Captcha Tidak Sesuai';
				$this->session->set_flashdata('msg_regis',$this->result->message);
				redirect('ForgotPassword');
			}
        $password = substr(md5(mt_rand()), 0, 8);

        if(!empty($this->input->post('email'))){
            $this->db->where('email', $this->input->post('email'));
            $check = $this->db->get('master_user');

            if($check->num_rows() > 0){

                // $data['email'] = $this->input->post('email');
                $data_message['password'] = $password;
                $data_message['logo'] = "https://telemedicinelintas.indihealth.com/assets/telemedicine/img/iDok.png";
                // Set to, from, message, etc.
                $message = $this->load->view('forgot',$data_message, TRUE);

                $data = array(
                    'mail'      => $this->input->post('email'),
                    'pesan' => $message,
                    'subjek' => 'Forgot Password'
                );

                $data_string = json_encode($data);

                $curl = curl_init('http://indihealth.com/api/Send');

                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
                );

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

                // Send the request
                $result = curl_exec($curl);

                // Free up the resources $curl is using
                curl_close($curl);

                $datapwd = array(
                    'password' => password_hash($password, PASSWORD_DEFAULT,$this->config->item('hash_config')),
                );
                $this->db->where('email', $this->input->post('email'));
                $this->db->update('master_user', $datapwd);

                $response['status'] = true;
                $this->session->set_flashdata('msg_forgot_pass', 'Password baru telah dikirim ke email anda!');
                redirect(base_url('login'));

            }else{
                $response['status'] = false;
                $response['msg'] = 'Password baru telah dikirim ke email anda!';
                $this->session->set_flashdata('msg_forgot_pass', $response['msg']);
                redirect(base_url('ForgotPassword'));
            }
        }else {
			$response['msg'] = 'Masukan Email';
            $this->session->set_flashdata('msg_forgot_pass', $response['msg']);
            redirect(base_url('ForgotPassword'));
		}
    }
}
