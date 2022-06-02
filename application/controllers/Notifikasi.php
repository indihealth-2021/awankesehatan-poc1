<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();            
        $this->load->library('session');    
	    $this->load->model('all_model');
    }

    public function baca($id){
        $notifikasi = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND id = '.$id)->row();
        if(!$notifikasi){
            show_404();
        }
        $data_notif = array('status'=>1);
        $this->all_model->update('data_notifikasi', $data_notif, array('id'=>$id));
    }

    public function bacaSemua(){
        $list_notifikasi = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        foreach($list_notifikasi as $notifikasi){
            $this->all_model->update('data_notifikasi', array('status'=>1), array('id'=>$notifikasi->id));
        }
    }
}