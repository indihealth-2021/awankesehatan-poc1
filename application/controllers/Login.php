<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
		 $this->result = new stdClass();
		 $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		 $this->load->library('session');
	     $this->load->library(array('Key'));
	 }

	public function index(){
		if(!$this->session->has_userdata('web_token')){
			if(get_cookie('cookielogin[is_login]')){
				$this->db->select('*');
				$this->db->from('master_user');
				$this->db->group_start();
				$this->db->where('username', get_cookie('cookielogin[user]'));
				$this->db->or_where('email', get_cookie('cookielogin[user]'));
				$this->db->group_end();
				$this->db->where('password', md5(get_cookie('cookielogin[password]')));
				$user = $this->db->get()->row();

				if($user){
					$this->session->set_userdata(array(
						'web_token'=> md5(uniqid()),
						'id_user'  => $user->id,
						'is_login' => true
					));
					$this->_category_check($user);
				}
			}
			$data['menu_landing'] = 2;
			$this->load->view('login', $data);
		}
		else{
			$this->data = $this->all_model->select('master_user', 'row', 'web_token = "'.$this->db->escape($this->session->userdata('web_token')).'"');
			if(!is_null($this->data))
			{
				$this->_category_check($this->data);
			} else {
				redirect('login');
			}
		}
	}

	public function login() {

		$this->throttle_check();
		if($this->blockRequest())
		{
			$this->result->message = 'Terlalu banyak pengulangan login, Mohon tunggu '.($this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_block')-time()).' detik lagi.';
			$this->session->set_flashdata('msg_login',$this->result->message);
			redirect('Login');
		}

		///THROTTLE LOGIN CEK
		$recaptcha = new \ReCaptcha\ReCaptcha($this->config->item('recaptcha_secret_key'));
		$resp = $recaptcha->verify($this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
		if (!$resp->isSuccess()) {
			$this->session->sess_regenerate();
			$this->result->message = 'Login Gagal, Captcha Tidak Sesuai';
			$this->session->set_flashdata('msg_login',$this->result->message);
			redirect('Login');
		}
		//
		try{
			$post = [
						'app_id' => 'TK-IDOKLINTAS',
						'project_name' => 'LINTASARTA TELEKONSULTASI iDok',
						'domain' => $_SERVER['SERVER_NAME'],
						'server_ip' => gethostbyname($_SERVER['SERVER_NAME']),
						'type' => 'WEB-APP',
						'operating_system' => php_uname(),
						'software_server' => $_SERVER['SERVER_SOFTWARE'],
						'last_online' => date('Y-m-d H:i:s'),
						'detected_at' => date('Y-m-d H:i:s'),
			];

			$ch = curl_init('https://tx-app.indihealth.com/api/v1/trx/rpd/hit');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

			$response = curl_exec($ch);
			curl_close($ch);
		}
		catch(\Exception $e)
		{

		}

		/////
		//$this->data = $this->all_model->select('master_user', 'row', 'email = "' . $this->input->post('email') . '" or username = "' . $this->input->post('email') .'"');

		$this->db->select('*');
		$this->db->from('master_user');
		$this->db->where('email', $this->input->post('email'));
		$this->db->or_where('username', $this->input->post('email'));
		$this->data = $this->db->get()->row();



		if (!is_null($this->data)) {



			if (password_verify($this->input->post('password'), $this->data->password)) {
					$this->session->sess_regenerate();
				if ($this->data->aktif != 0) {
					//$this->_fasyankes_auth();

					$token = md5(uniqid());
					$is_update = $this->all_model->update(
						'master_user',
						array('web_token' => $token),
						array('id' => $this->data->id)
					);
					if ($is_update == 1) {
						$this->result->status = true;
						$this->result->data = $this->data;
						$this->session->set_userdata(array(
							'web_token'=> $token,
							'id_user'  => $this->data->id,
							'is_login' => true
						));
						// echo var_dump($this->session->userdata());
						// die;
						// TAMBAH KE ACTIVITY LOG DENGAN NAMA ACTIVITY = Login
						$this->load->library('user_agent');

						if ($this->agent->is_browser())
						{
								$agent = $this->agent->browser().' '.$this->agent->version();
						}
						elseif ($this->agent->is_robot())
						{
								$agent = $this->agent->robot();
						}
						elseif ($this->agent->is_mobile())
						{
								$agent = $this->agent->mobile();
						}
						else
						{
								$agent = 'Unidentified User Agent';
						}

						$ip_address = $this->input->ip_address();

						$data = array(
							"id_user"=>$this->session->userdata('id_user'),
							"ip"=>$ip_address,
							"user_agent"=>$agent,
							"activity"=>'Login'
						);

						$this->db->insert('log_activity', $data);
						// ============================================================ //
						if($this->input->post('remember_me')){
							set_cookie('cookielogin[is_login]', true, time()+3600);
							set_cookie('cookielogin[user]', $this->input->post('email'), time()+3600);
							// set_cookie('cookielogin[pass]', $this->input->post('password'), time()+3600);
						}
						$this->_category_check($this->data);
					} else {
						//THROTTLE LOGIN ACTIVATOR
							$this->throttle_login();
							///
						$this->result->status = false;
						$this->result->message = 'Login gagal, silahkan coba lagi';
						$this->session->set_flashdata('msg_login',$this->result->message);
						redirect('Login');
					}
				} else {
					$this->result->status = false;
					$this->result->message = 'Akun yang dimaksud telah dinonaktifkan oleh admin / Akun yang dimaksud belum aktif!';
					$this->session->set_flashdata('msg_login',$this->result->message);
					redirect('Login');
				}
			} else {
				$this->throttle_login();
				$this->result->status = false;
				$this->result->message = 'Username atau password yang dimasukkan salah';
				$this->session->set_flashdata('msg_login',$this->result->message);
				redirect('Login');
			}
		} else {
				$this->throttle_login();
			$this->result->status = false;
			$this->result->message = 'Username atau password yang dimasukkan salah';
			$this->session->set_flashdata('msg_login',$this->result->message);
			redirect('Login');
		}

	}
	private function _category_check($userdata) {
		switch ($userdata->id_user_kategori) {
			case '0':
				redirect(base_url('pasien/Pasien'));
				break;
			case '2' :
				redirect(base_url('dokter/Dashboard'));
				break;
			case '5':
				if($userdata->id_user_level == 1){
					redirect(base_url('admin/Admin'));
				}
				else if($userdata->id_user_level == 2){
					redirect(base_url('admin/FarmasiVerifikasiObat'));
				}
				break;
		}
	}

    private function _fasyankes_auth() {
    	if (! is_null($this->data->id_fasyankes)) {
    		$where = array(
	    		'id' => $this->db->escape($this->data->id_fasyankes),
	    		'aktif' => 1
	    	);

	    	$this->data->fasyankes = $this->all_model->select('master_fasyankes', 'row', $where);

	    	if (! $this->data->fasyankes) {
	    		$this->result->message = 'Fasyankes dari akun yang dimaksud telah dinonaktifkan, silahkan hubungi Admin';
				$this->session->set_flashdata('msg',$this->result->message);
				redirect('Login');
	    	}

	    	$this->_kota_auth($this->data->fasyankes->id_kota);
    	}
    }

    private function _kota_auth($id_kota) {
    	$where = array(
    		'id' => $id_kota,
    		'aktif' => 1
    	);

    	$this->data->kota = $this->all_model->select('master_kota', 'row', $where);
		// echo var_dump($this->db->error());
		// die;

    	if (! $this->data->kota) {
    		$result->message = 'Kota dari fasyankes telah dinonaktifkan, silahkan hubungi Admin';
			$this->session->set_flashdata('msg',$this->result->message);
			redirect('Login');
    	}

    	$this->_provinsi_auth($this->data->kota->id_provinsi);
    }

    private function _provinsi_auth($id_provinsi) {
    	$where = array(
    		'id' => $this->db->escape($id_provinsi),
    		'aktif' => 1
    	);

    	$this->data->provinsi = $this->all_model->select('master_provinsi', 'row', $where);

    	if (! $this->data->provinsi) {
    		$this->result->message = 'Provinsi dari fasyankes telah dinonaktifkan, silahkan hubungi Admin';
			$this->session->set_flashdata('msg',$this->result->message);
			redirect('Login');
    	}
    }

		//THROTTLE LOGIN ENGGINE
		private function throttle_login()
		{
			// var_dump(var_dump($this->cache->file->cache_info()));
			// exit();
				if(!empty($this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_block')))
				{
						return true;
				}
				 $getCache = empty($this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_throttle'))?0:$this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_throttle');
				 $this->cache->file->save(md5($_SERVER['REMOTE_ADDR']).'_throttle',$this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_throttle')+1, 180);

				 return true;
		}

		private function block_login()
		{
				 $this->cache->file->save(md5($_SERVER['REMOTE_ADDR']).'_block',time() + 180, 180);

				 return true;
		}

		private function throttle_check()
		{


				 if($this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_throttle')>=3)
				 {
						$this->block_login();
						return false;
				 }

				 return true;
		}

		private function blockRequest()
		{

				 if($this->cache->file->get(md5($_SERVER['REMOTE_ADDR']).'_block'))
				 {
						return true;
				 }

				 return false;
		}
		//end THROTTLE LOGIN ENGINE irfa update

}
