<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       

        $this->load->library('pagination');
 
        //load the department_model
        $this->load->model('profil_dokter_model');

        $this->load->library(array('Key'));   
        $this->load->library('session');       
    }

    public function index($id_dokter){
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
        $dokter = $this->db->query('SELECT id_user_kategori,id,name,foto FROM master_user WHERE id = '.$id_dokter)->row();
        if(!$dokter || $dokter->id_user_kategori != 2){
            show_404();
        }
        $dokter_in_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id_dokter = '.$dokter->id.' AND id_pasien = '.$this->session->userdata('id_user'))->row();
        if(!$dokter_in_konsultasi){
            show_404();
        }
        $data['dokter'] = $dokter;
        $data['title'] =  'Chat';
        $data['view'] = 'pasien/chat.php';
	    $data['user'] = $this->db->query('SELECT id, name, foto, id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();        


        $data['js_addons'] = "<script src='".base_url('assets/js/message.js')."'></script><script>$('#messages').scrollTop($('#messages')[0].scrollHeight);</script>";

        $this->load->view('template', $data);
    }

    public function send_notif(){
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
        $data = $this->input->post();

        $dokter = $this->db->query('SELECT id,reg_id,name FROM master_user WHERE id = '.$data['id_dokter'])->row();
        $pasien = $this->db->query('SELECT name FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        // $chat_id = $dokter->id.'_'.$this->session->userdata('id_user');

        $notifikasi = 'Pesan dari '.$pasien->name;
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $msg_notif = array(
                'name'=>'pesan',
                'keterangan'=>$notifikasi,
                'tanggal'=>$now,
                'id_user'=>json_encode(array($dokter->id)),
                'direct_link'=>base_url('dokter/Chat/index/'.$this->session->userdata('id_user')),
        );
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($dokter->reg_id, $msg_notif);

        // $data_notif = array("id_user"=>$id_pasien, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Telekonsultasi/'));
        // $this->db->insert('data_notifikasi', $data_notif);

        echo "OK";
    }
}