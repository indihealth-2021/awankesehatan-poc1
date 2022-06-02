<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KonfigurasiAkun extends CI_Controller {
	public $data;

	public function __construct() {
        	parent::__construct();
        	$this->load->model('all_model');
        	$this->load->library(array('Key'));
    	}
	public function index(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		$data['view'] = 'dokter/menu_konfigurasi_akun';
		$data['title'] = 'Konfigurasi Akun';
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


		$this->load->view('template', $data);
	}

	public function form_password(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		$data['view'] = 'dokter/form_konfigurasi_password';
		$data['title'] = 'Konfigurasi Password';
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

		$this->load->view('template', $data);
	}

	public function form_username(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		$data['view'] = 'dokter/form_konfigurasi_username';
		$data['title'] = 'Konfigurasi Username';
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

		$this->load->view('template', $data);
	}

	public function update_password(){
		if(!$this->session->userdata('is_login')){
				redirect(base_url('Login'));
		}
		$valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->db->escape($this->session->userdata('id_user')))->row();
		if($valid->id_user_kategori != 2){
			if($valid->id_user_kategori == 0){
					redirect(base_url('pasien/Pasien'));
			}
				else{
						redirect(base_url('admin/Admin'));
				}
		}

		$data = $this->input->post();
		$id_user = $this->session->userdata('id_user');
		$user = $this->db->query('SELECT password FROM master_user WHERE id = '.$this->db->escape($this->session->userdata('id_user')))->row();
		if(!password_verify($data['passwordlama'], $user->password))
		{
			 $this->session->set_flashdata('msg_fail', 'Kata Sandi Lama Tidak Sesuai.');
			redirect(base_url('dokter/KonfigurasiAkun/form_password'));
		}
		else{
			$password = password_hash($data['password'], PASSWORD_DEFAULT,$this->config->item('hash_config'));
			$data_update = array('password'=>$password);
			$this->db->set($data_update);
			$this->db->where(array('id'=>$id_user));
			$this->db->update('master_user');
			 $this->session->set_flashdata('msg_success', 'Kata Sandi berhasil diubah.');
		 redirect(base_url('dokter/KonfigurasiAkun/form_password'));
		}
	}

	public function update_username(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		$data = $this->input->post();
		$id_user = $this->session->userdata('id_user');
		$user = $this->db->query('SELECT password FROM master_user WHERE id = '.$id_user)->row();
		if(md5($data['password']) == $user->password){
			$data_update = array('username'=>$data['username']);
			$this->db->set($data_update);
			$this->db->where(array('id'=>$id_user));
			$this->db->update('master_user');
			echo "<script>alert('Username telah diupdate')</script>";
			$this->index();
		}
		else{
			echo "<script>alert('Password salah!')</script>";
			$this->form_username();
		}
	}
}
