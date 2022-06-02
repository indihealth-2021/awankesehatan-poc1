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

    public function index($id_pasien){
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
        $pasien = $this->db->query('SELECT id_user_kategori,id,name,foto FROM master_user WHERE id = '.$id_pasien)->row();
        if(!$pasien || $pasien->id_user_kategori != 0){
            show_404();
        }
        $data['pasien'] = $pasien;
        $data['title'] =  'Chat';
        $data['view'] = 'dokter/chat.php';
	    $data['user'] = $this->db->query('SELECT id, name, foto, id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();        


        $data['js_addons'] = "<script src='".base_url('assets/js/message.js')."'></script>";

        $this->load->view('template', $data);
    }

    public function send_notif(){
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

        $pasien = $this->db->query('SELECT id,reg_id,name FROM master_user WHERE id = '.$data['id_pasien'])->row();
        $dokter = $this->db->query('SELECT name FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        // $chat_id = $this->session->userdata('id_user').'_'.$pasien->id;

        $notifikasi = 'Pesan dari '.$dokter->name;
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $msg_notif = array(
                'name'=>'pesan',
                'keterangan'=>$notifikasi,
                'tanggal'=>$now,
                'id_user'=>json_encode(array($pasien->id)),
                'direct_link'=>base_url('pasien/Chat/index/'.$this->session->userdata('id_user')),
        );
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($pasien->reg_id, $msg_notif);

        // $data_notif = array("id_user"=>$id_pasien, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Telekonsultasi/'));
        // $this->db->insert('data_notifikasi', $data_notif);

        echo "OK";
    }
}