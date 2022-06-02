<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ALL_Controllers{
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('all_model');
    }

    public function get_data_view($title="", $view=""){
        $data['list_notifikasi'] = $this->CI->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->CI->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['user'] = $this->CI->all_model->select('master_user', 'row', 'id = ' . $this->CI->session->userdata('id_user'));
        $data['title'] = $title;
        $data['view'] = $view;

        if($data['user']->id_user_kategori == 5){
            $data['menu'] = 0;
        }

        return $data;
    }

    public function check_user(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori == 2){
            redirect(base_url('dokter/Dashboard'));
        }
        else if($valid->id_user_kategori == 0){
            redirect(base_url('pasien/Pasien'));
        }
        else{
            if($valid->id_user_level == 1){
                redirect(base_url('admin/Admin'));
            }
            else{
                redirect(base_url('admin/FarmasiVerifikasiObat'));
            }
        }        
    }

    public function check_user_admin(){
        if (!$this->CI->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->CI->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 5) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('dokter/Dashboard'));
            }
        } else {
            if ($valid->id_user_level == 2) {
                redirect(base_url('admin/FarmasiVerifikasiObat'));
            }
        }
    }

    public function check_user_admin_farmasi(){
        if (!$this->CI->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->CI->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 5) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('dokter/Dashboard'));
            }
        }
    }

    public function check_user_farmasi(){
        if(!$this->CI->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori,id_user_level FROM master_user WHERE id = '.$this->CI->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 5){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('dokter/Dashboard'));
            }
        }
        else{
            if($valid->id_user_level == 1){
                redirect(base_url('admin/Admin'));
            }
        }
    }

    public function check_user_pasien(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                if($valid->id_user_level == 1){
                    redirect(base_url('admin/Admin'));
                }
                else{
                    redirect(base_url('admin/FarmasiVerifikasiObat'));
                }
            }
        }
    }
}