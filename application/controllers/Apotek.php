<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apotek extends CI_Controller {
	public $data;

	public function __construct() {
		parent::__construct();    
		$this->load->library('session');
		$this->load->library('all_controllers');
    }

	public function getApotek() {
		$id_apotek = $this->input->post("id_apotek");
		
		if($id_apotek) { 
			$list_apotek = $this->db->query('SELECT * FROM master_apotek WHERE id='. $id_apotek)->result_array(); 
		}
		else {
			$list_apotek = $this->db->query("SELECT * FROM master_apotek")->result_array();
		}

		echo json_encode($list_apotek);
	}

	public function getApotekOnUser() {
		//$id_apotek = $this->input->post('id_apotek');
		$id_user = $this->input->post("id_user");
		// if($id_apotek){
		// 	$list_apotek = $this->db->query('SELECT * FROM master_apotek ORDER BY nama')->result_array();
		// 	foreach($list_apotek as $idx=>$apotek){
		// 			if($id_apotek == $apotek['id']){
		// 				$list_apotek[$idx]['selected'] = 'selected';
		// 			}
		// 			else{
		// 				$list_apotek[$idx]['selected'] = '';
		// 			}
		// 	}
			
		// }
		// else{
			if($id_user){
				$user = $this->db->query('SELECT id_apotek FROM master_user WHERE id = '.$id_user)->row();
				if(!$user){
					show_404();
				} 
			}
			$list_apotek = $this->db->query('SELECT * FROM master_apotek ORDER BY nama')->result_array();
			if($id_user){
				foreach($list_apotek as $idx=>$apotek){
					if($user->id_apotek == $apotek['id']){
						$list_apotek[$idx]['selected'] = 'selected';
					}
					else{
						$list_apotek[$idx]['selected'] = '';
					}
				}
			}	

		echo json_encode($list_apotek);
	}
}