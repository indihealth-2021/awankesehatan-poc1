<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	var $menu = 2;

	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
		$this->load->model('master_jadwal_model');      
    }
    public function get_antrian()
    {
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
    	if($this->session->userdata('is_login')){
        	$data['menu'] = $this->menu;
        	$where = array('no_antrian.id_dokter' => $this->session->userdata('id_user'));
        	$data['view'] = 'dokter/antrian_pasien';
			$data['antrian'] = $this->master_jadwal_model->getAll_antrian_pasien($where);
			$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));  
	        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
  
      			$data['title'] = 'Antrian Pasien';
			$this->load->view('template', $data);
        } else {
      		redirect('Login');
    	}
    }
}
