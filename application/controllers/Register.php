<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public $data;

	public function __construct() {
		parent::__construct();
		$this->load->model('all_model');
		$this->load->library('session');
		$this->load->library('send_email');
    }

	public function index() {
		if(!$this->session->has_userdata('id_user')){
			$data['menu_landing'] = 2;
			$this->load->view('register', $data);
		}else{
			redirect('login');
		}
	}

	public function register(){
		$recaptcha = new \ReCaptcha\ReCaptcha($this->config->item('recaptcha_secret_key'));
		$resp = $recaptcha->verify($this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
		if (!$resp->isSuccess()) {
			$this->session->sess_regenerate();
			$this->result->message = 'Registrasi Gagal, Captcha Tidak Sesuai';
			$this->session->set_flashdata('msg_regis',$this->result->message);
			redirect('Register');
		}
		$uppercase = preg_match('@[A-Z]@', $this->input->post('password'));
      $lowercase = preg_match('@[a-z]@', $this->input->post('password'));
      $number    = preg_match('@[0-9]@', $this->input->post('password'));
      $specialChars = preg_match('@[^\w]@', $this->input->post('password'));

      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
				$this->session->set_flashdata('msg_regis', 'Kata sandi harus setidaknya 8 karakter dan harus mencakup setidaknya satu huruf besar, satu angka, dan satu karakter khusus.');
				$this->session->set_flashdata('error_on_regis', 'password');
					redirect('Register');
      }

		if(!$this->session->has_userdata('id_user')){
			$id_pasyankes = $this->db->query('SELECT id FROM master_fasyankes')->row();

			$data = [
				'name'=>$this->input->post('name'),
				'username'=>$this->input->post('username'),
				'email'=>$this->input->post('email'),
				'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT,$this->config->item('hash_config')),
				// 'alamat_jalan'=>$this->input->post('alamat_jalan'),
				// 'alamat_kota'=>$this->input->post('alamat_kota'),
				// 'alamat_kelurahan'=>$this->input->post('alamat_kelurahan'),
				// 'alamat_kecamatan'=>$this->input->post('alamat_kecamatan'),
				// 'kode_pos'=>$this->input->post('kode_pos'),
				'lahir_tanggal'=>$this->input->post('lahir_tanggal'),
				'lahir_tempat'=>$this->input->post('lahir_tempat'),
				'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
				'id_fasyankes' =>$id_pasyankes->id,
				'id_user_kategori'=>$this->input->post('id_user_kategori'),
				'telp'=>$this->input->post('telp'),
				'aktif'=>0,
			];

			$user_created = $this->db->insert('master_user', $data);
			$user_id = $this->db->insert_id();
			if($user_created){
				$this->session->set_flashdata('msg_regis', 'Registrasi Berhasil, akun anda belum aktif, untuk mengaktifkan akun, cek email yang telah didaftarkan!');
				// ------------------------- SEND EMAIL ------------------------------//
				$token = bin2hex(random_bytes(64));
				$this->all_model->update('master_user', array('register_token'=>$token), array('id'=>$user_id));

				// KIRIM EMAIL //
				$data_message['nama'] = $data['name'];
				$data_message['logo'] = base_url("assets/telemedicine/img/iDok.png");
				$data_message['link_verifikasi'] = base_url('register/verifikasi?token='.$token.'&user='.$user_id);
				$this->send_email->send($this->input->post('email'), 'Registrasi Berhasil', $data_message, 'register_email');
				// =========== //



				// ------------------------ END SEND EMAIL ------------------------------ //

				// $last_num = new DateTime('now');
				// $last_num = $last_num->format('dmYHis');

				//$last_medrek = $this->db->query('SELECT no_medrec FROM detail_pasien ORDER BY no_medrec DESC')->row();
				//$last_medrek = ltrim($last_medrek->no_medrec, "0");
				//$last_medrek+=1;
				//$no_medrek = str_pad($last_medrek, 8, "0", STR_PAD_LEFT);

				//$data_detail_pasien = array(
				//	'id_pasien'=>$user_id,
				//	'no_medrec'=>$no_medrek,
				//);
				//$this->db->insert('detail_pasien', $data_detail_pasien);
			}
			else{
				$this->session->set_flashdata('data_regis', $data);
				$usernameIsExists = $this->db->query('SELECT id FROM master_user WHERE username = "'.$data['username'].'"')->row();
				$emailIsExists = $this->db->query('SELECT id FROM master_user WHERE email = "'.$data['email'].'"')->row();
				if($usernameIsExists && $emailIsExists){
					$this->session->set_flashdata('msg_regis', 'Registrasi Gagal ( Username & Email sudah dipakai )');
					$this->session->set_flashdata('error_on_regis', 'usernameAndEmail');
				}
				else if($usernameIsExists){
					$this->session->set_flashdata('msg_regis', 'Registrasi Gagal ( Username sudah dipakai )');
					$this->session->set_flashdata('error_on_regis', 'username');
				}
				else if($emailIsExists){
					$this->session->set_flashdata('msg_regis', 'Registrasi Gagal ( Email sudah dipakai )');
					$this->session->set_flashdata('error_on_regis', 'email');
				}
				redirect('register');
			}

			redirect('Login');
		}
		else{
			redirect('Login');
		}
	}

	public function verifikasi(){
		$token = $this->input->get('token');
		$id_user = $this->input->get('user');

		$user = $this->db->query('SELECT id,register_token,aktif FROM master_user WHERE id = '.$this->db->escape($id_user))->row();
		if(!$this->session->has_userdata('id_user')){
			if($user){
				$user = $this->db->query('SELECT id,register_token,aktif FROM master_user WHERE id = '.$this->db->escape($id_user).' AND register_token = "'.$this->db->escape($token).'"')->row();
				if($user){
					if($user->aktif == 1){
						$this->session->set_flashdata('msg_login', 'GAGAL: Akun ini sudah aktif, tidak perlu aktifasi kembali!');
					}
					else{
						$this->all_model->update('master_user', array('aktif'=>1), array('id'=>$id_user));
						$this->db->insert('detail_pasien', array('id_pasien'=>$id_user, 'accept_tac'=>0));
						$this->session->set_flashdata('msg_login', 'BERHASIL: Akun anda sudah aktif, silahkan login!');
						$this->session->set_flashdata('msg_login_sukses', '1');
					}
				}
				else{
					$this->session->set_flashdata('msg_login', 'GAGAL: Token invalid!');
				}
			}
			else{
				$this->session->set_flashdata('msg_login', 'GAGAL: User tidak ditemukan');
			}
		}
		$data['menu_landing'] = 2;
		$this->load->view('login', $data);
	}

	public function test_email(){
		echo $this->send_email->send('redzasp2303@gmail.com', 'TEST EMAIL');
	}
}
