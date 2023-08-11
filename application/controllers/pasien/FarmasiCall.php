<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FarmasiCall extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Key'));
        $this->load->library('all_controllers');
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
        if($this->input->server('REQUEST_METHOD') != 'POST'){
            redirect(base_url('pasien/Pasien'));
        }
        $data['view'] = 'pasien/farmasi_call';
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
		$data['title'] = 'Panggilan Farmasi';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['room_name'] = $this->input->post('room_name');
        $data['id_farmasi'] = $this->input->post('id_farmasi');

        $data['css_addons'] = '
        <script src="https://meet.jit.si/external_api.js"></script>
        ';

        $data['js_addons'] = "
        <script>
            firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                    firebase.database()
                    .ref('/chats/'+chat_id)
                    .on('child_added', function(snapshot){
                        console.log(snapshot.val());
                        $('#messages').append(template_message(snapshot.val()));
                        $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
                    });
                }
            });
        </script>
        <script src='" . base_url('assets/js/message.js') . "'></script>
        ";

        $this->load->view('template', $data);
    }

    public function jawab(){
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
        $id_farmasi = $data['id_farmasi'];
        $id_pasien = $this->session->userdata('id_user');

        $farmasi = $this->db->query('SELECT f.name, f.reg_id FROM master_user f WHERE f.id_user_kategori = 5 AND f.id_user_level = 2 AND f.id = ?', $id_farmasi)->row();
        $pasien = $this->db->query('SELECT p.name FROM master_user p WHERE p.id_user_kategori = 0 AND p.id = ?', $id_pasien)->row();

        $notifikasi = 'Panggilan dijawab oleh '.$pasien->name;
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $data_notif = array("id_user" => $id_farmasi, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => '#');
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();

        $msg_notif = array(
            'name'=>'accept_panggilan_farmasi_pasien',
            'id_notif'=>$id_notif,
            'keterangan'=>$notifikasi,
            'tanggal'=>$now,
            'id_user'=>json_encode(array($id_farmasi)),
            'direct_link'=>'#'
        );
        $msg_notif = json_encode($msg_notif);
        
        $result = $this->key->_send_fcm($farmasi->reg_id, $msg_notif);

        echo $result;
    }

    public function tolak(){
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
        $id_farmasi = $data['id_farmasi'];
        $id_pasien = $this->session->userdata('id_user');

        $farmasi = $this->db->query('SELECT f.name, f.reg_id FROM master_user f WHERE f.id_user_kategori = 5 AND f.id_user_level = 2 AND f.id = ?', $id_farmasi)->row();
        $pasien = $this->db->query('SELECT p.name FROM master_user p WHERE p.id_user_kategori = 0 AND p.id = ?', $id_pasien)->row();

        $notifikasi = 'Panggilan ditolak oleh '.$pasien->name;
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $data_notif = array("id_user" => $id_farmasi, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => '#');
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();

        $msg_notif = array(
            'name'=>'reject_panggilan_farmasi_pasien',
            'id_notif'=>$id_notif,
            'keterangan'=>$notifikasi,
            'tanggal'=>$now,
            'id_user'=>json_encode(array($id_farmasi)),
            'direct_link'=>'#'
        );
        $msg_notif = json_encode($msg_notif);
        
        $result = $this->key->_send_fcm($farmasi->reg_id, $msg_notif);

        echo $result;
    }
}