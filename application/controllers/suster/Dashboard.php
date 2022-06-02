<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	var $menu = 2;

	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
    
    }

    public function index() {
    	$data['menu'] = 0;
		$this->load->view('dokter/index', $data);
	}
	
	private function _get_json_data($status = FALSE, $message = '', $data = NULL) {
        	$result = new stdClass();
        
        	$result->status = $status;
        	$result->message = $message;
        	$result->data = $data;

        	return $result;
    	} 
	private function _get_user($username) {
            $where = array('username' => $username);

            return $this->all_model->select('master_user', 'row', $where);
   	}

	public function profil_dokter(){
		$data['view'] = 'dokter/profil_dokter';
		$this->load->view('dokter/template', $data);
	}
    public function cek_jadwal_dokter() {
        $data['view'] = 'dokter/cek_jadwal_dokter';
        $this->load->view('dokter/template', $data);
    }
    public function view_news(){
        $data['view'] = 'dokter/view_news';
        $this->load->view('dokter/template', $data);
    }
    public function teleconsultasi_pasien(){
        $data['view'] = 'dokter/teleconsultasi_pasien';
        $this->load->view('dokter/template', $data);
    }
    public function cek_jadwal_suster() {
        $data['view'] = 'dokter/cek_jadwal_suster';
        $this->load->view('dokter/template', $data);
    }
    public function selfassesment_pasien() {
        $data['view'] = 'dokter/selfassesment_pasien';
        $this->load->view('dokter/template', $data);
    }
    public function history_pasien() {

        $data['view'] = 'dokter/history_pasien';
        $this->load->view('dokter/template', $data);
    }
    public function history_log() {

        $data['view'] = 'dokter/history_log';
        $this->load->view('dokter/template', $data);
    }
}
