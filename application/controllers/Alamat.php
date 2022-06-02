<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat extends CI_Controller {
	public $data;

	public function __construct() {
		parent::__construct();    
		$this->load->library('session');
		$this->load->library('all_controllers');
    }

    public function getProvinsi(){
		$id_user = $this->input->post('id_user');
		$id_user_getter = $this->session->userdata('id_user');
		$user_getter = $this->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = '.$id_user_getter)->row();
		if($user_getter->id_user_kategori != 5 && $user_getter->id_user_level != 1){
			if($id_user != $id_user_getter){
				show_404();
			}
		}
		$id_provinsi = $this->input->post('id_provinsi');
		if($id_provinsi){
			$list_provinsi = $this->db->query('SELECT * FROM master_provinsi ORDER BY name')->result_array();
			foreach($list_provinsi as $idx=>$provinsi){
					if($id_provinsi == $provinsi['id']){
						$list_provinsi[$idx]['selected'] = 'selected';
					}
					else{
						$list_provinsi[$idx]['selected'] = '';
					}
			}
			
		}
		else{
			if($id_user){
				$user = $this->db->query('SELECT alamat_provinsi FROM master_user WHERE id = '.$id_user)->row();
				if(!$user){
					show_404();
				} 
			}
			$list_provinsi = $this->db->query('SELECT * FROM master_provinsi ORDER BY name')->result_array();
			if($id_user){
				foreach($list_provinsi as $idx=>$provinsi){
					if($user->alamat_provinsi == $provinsi['id']){
						$list_provinsi[$idx]['selected'] = 'selected';
					}
					else{
						$list_provinsi[$idx]['selected'] = '';
					}
				}
			}	
		}

        echo json_encode($list_provinsi);
    }

    public function getKotKab(){
        $id_provinsi = $this->input->post('id_provinsi');
		$id_kotkab = $this->input->post('id_kotkab');
		if($id_kotkab){
			$list_kotkab = $this->db->query('SELECT * FROM master_kota WHERE id = "'.$id_kotkab.'"')->result_array();
		}
		else{
			$list_kotkab = $this->db->query('SELECT * FROM master_kota WHERE id_provinsi = "'.$id_provinsi.'" ORDER BY name')->result_array();
		}

        echo json_encode($list_kotkab);
    }

    public function getKelurahan(){
        $id_kecamatan = $this->input->post('id_kecamatan');
		$id_kelurahan = $this->input->post('id_kelurahan');
		if($id_kelurahan){
			$list_kelurahan = $this->db->query('SELECT * FROM master_kelurahan WHERE id = "'.$id_kelurahan.'"')->result_array();
		}
		else{
			$list_kelurahan = $this->db->query('SELECT * FROM master_kelurahan WHERE id_kecamatan = "'.$id_kecamatan.'" ORDER BY name')->result_array();
		}

        echo json_encode($list_kelurahan);
    }

    public function getKecamatan(){
        $id_kota = $this->input->post('id_kota');
		$id_kecamatan = $this->input->post('id_kecamatan');
		
		if($id_kecamatan){
			$list_kecamatan = $this->db->query('SELECT * FROM master_kecamatan WHERE id = "'.$id_kecamatan.'"')->result_array();
		}
		else{
			$list_kecamatan = $this->db->query('SELECT * FROM master_kecamatan WHERE id_kota = "'.$id_kota.'" ORDER BY name')->result_array();
		}

        echo json_encode($list_kecamatan);
    }
	
	public function testdoang(){
		$this->load->view('testdoang');
	}
}