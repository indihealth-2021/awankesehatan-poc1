<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KonfigurasiAkun extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('all_controllers');
    }
    public function index()
    {
        $this->all_controllers->check_user_admin_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Konfigurasi Akun",
            $view = "admin/menu_konfigurasi_akun"
        );

        $this->load->view('template', $data);
    }

    public function form_password()
    {
        $this->all_controllers->check_user_admin_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Konfigurasi Password",
            $view = "admin/form_konfigurasi_password"
        );

        $this->load->view('template', $data);
    }

    public function form_username()
    {
        $this->all_controllers->check_user_admin_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Konfigurasi Username",
            $view = "admin/form_konfigurasi_username"
        );

        $this->load->view('template', $data);
    }

    public function update_password()
    {
        $this->all_controllers->check_user_admin_farmasi();

        $data = $this->input->post();
    		$id_user = $this->session->userdata('id_user');
    		$user = $this->db->query('SELECT password FROM master_user WHERE id = '.$this->db->escape($this->session->userdata('id_user')))->row();
    		if(!password_verify($data['passwordlama'], $user->password))
    		{
    			 $this->session->set_flashdata('msg_fail', 'Kata Sandi Lama Tidak Sesuai.');
    			redirect(base_url('admin/KonfigurasiAkun/form_password'));
    		}
    		else{
    			$password = password_hash($data['password'], PASSWORD_DEFAULT,$this->config->item('hash_config'));
    			$data_update = array('password'=>$password);
    			$this->db->set($data_update);
    			$this->db->where(array('id'=>$id_user));
    			$this->db->update('master_user');
    			 $this->session->set_flashdata('msg_success', 'Kata Sandi berhasil diubah.');
    		 redirect(base_url('admin/KonfigurasiAkun/form_password'));
    		}
    }

    public function update_username()
    {
        $this->all_controllers->check_user_admin_farmasi();

        $data = $this->input->post();
        $id_user = $this->session->userdata('id_user');
        $user = $this->db->query('SELECT password FROM master_user WHERE id = ' . $id_user)->row();
        if (md5($data['password']) == $user->password) {
            $data_update = array('username' => $data['username']);
            $this->db->set($data_update);
            $this->db->where(array('id' => $id_user));
            $this->db->update('master_user');
            echo "<script>alert('Username telah diupdate')</script>";
            $this->index();
        } else {
            echo "<script>alert('Password salah!')</script>";
            $this->form_username();
        }
    }
}
