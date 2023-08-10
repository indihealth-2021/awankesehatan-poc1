<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();            
        $this->load->library('session');    
        $this->load->model('all_model');
        $this->load->model('jadwal_telekonsultasi_model');
        $this->load->model('JadwalTerdaftar_model');
        $this->load->library(array('Key'));
    }

    public function index(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['view'] = 'pasien/index';
        $data['title'] = 'Dashboard';
        // $data['user'] = $this->db->query('SELECT id,name, foto, id_user_kategori, vip FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $query = $this->db->query('SELECT id, name, foto, vip, id_user_kategori, reg_id, alamat_jalan, alamat_kelurahan, alamat_kecamatan, alamat_kota, alamat_provinsi,kode_pos FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['user'] = $query;

        $alamatColumns = ['alamat_jalan', 'alamat_kelurahan', 'alamat_kecamatan', 'alamat_kota', 'alamat_provinsi', 'kode_pos'];

        $dataNotComplete = false;

        foreach ($alamatColumns as $column) {
            if (empty($query->$column)) {
                $dataNotComplete = true;
            }
        }

        $data['data_not_complete'] = $dataNotComplete;

        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $news = $this->db->query('SELECT * FROM data_news ORDER BY created_at DESC limit 0,2')->result();
        foreach ($news as $key => $value) {
            $value->foto = base_url("assets/images/news/".$value->foto);            
        }
       #$data['list_berita'] = $news;      
       #$data['list_dokter'] = $this->db->query('SELECT master_user.foto, master_user.name, nominal.poli FROM master_user LEFT JOIN detail_dokter ON detail_dokter.id_dokter = master_user.id LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE master_user.id_user_kategori = 2 AND master_user.aktif = 1 ORDER BY detail_dokter.pengalaman_kerja DESC LIMIT 0,7')->result();
       $data['list_jadwal_konsultasi'] = $this->jadwal_telekonsultasi_model->get_all_by_id_pasien($this->session->userdata('id_user'), null, 5);
       $data['list_jadwal_terdaftar'] = $this->JadwalTerdaftar_model->get_all_by_id_pasien($this->session->userdata('id_user'), null, 5);

        $this->load->view('template', $data);
    }
    public function RegId(){     
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }   
        $dat = $this->input->post();
        $where = array('id' => $this->session->userdata('id_user')); 
        $ok = false;
        $hasil = $this->all_model->update_($dat,$where,"master_user");                  
        
       if($hasil){
           $ok = true;
       }
       echo $ok;
    }

    public function accept_tac(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $id_user = $this->session->userdata('id_user');
        $user = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$id_user)->row();
        if($user->id_user_kategori == 0){
            $detail_pasien = $this->db->query('SELECT id FROM detail_pasien WHERE id_pasien = '.$id_user)->row();
            if($detail_pasien){
                $this->all_model->update('detail_pasien', array('accept_tac'=>1), array('id_pasien'=>$id_user));
            }
            else{
                $this->db->insert('detail_pasien', array('id_pasien'=>$id_user, 'accept_tac'=>1));
            }
        }

        echo "OK";
    }
}
