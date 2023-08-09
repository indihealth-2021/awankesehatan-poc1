<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FarmasiCall extends CI_Controller
{
    var $menu = 6;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Key'));
        $this->load->library('all_controllers');
    }

    public function pasien()
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Panggil Pasien",
            $view = "admin/farmasi_call_pasien"
        );
        $data['list_pasien'] = $this->db->query('SELECT p.id, p.name, dp.no_medrec FROM master_user p INNER JOIN detail_pasien dp ON dp.id_pasien = p.id WHERE p.id_user_kategori = 0')->result();
        $data['css_addons'] = '
        <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
        <script src="https://meet.jit.si/external_api.js"></script>
        ';
        $data['js_addons'] = "
            <script>
                $(document).ready(function(){
                    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
                    $('select[name=pasien]').change(function(){
                        $('#panggil-pasien').prop('disabled', false);
                    });
                    $('#konten-panggilan').hide();

                    $('#panggil-pasien').click(function(){
                        $('#messages').empty();
                        var iframes = document.getElementsByTagName('iframe');
                        for (var i = 0; i < iframes.length; i++) {
                            iframes[i].parentNode.removeChild(iframes[i]);
                        }
                        $('#konten-panggilan').show();
                        function makeid(length) {
                            var result = '';
                            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            var charactersLength = characters.length;
                            for (var i = 0; i < length; i++) {
                                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                            }
                            return result;
                        }
                        let uniqid = makeid(12);    
                        const id_farmasi = ".$this->session->userdata('id_user').";
                        const id_user = $('select[name=pasien]').val();
                        $('#btn-stop-farmasi').attr('data-id-user', id_user);

                        id_pasien = id_user;
                        chat_id = id_farmasi+'_'+id_user;
                        get_chat(chat_id);

                        foto_pasien = baseUrl+'/assets/telemedicine/img/default.png';
                        room_name = 'telemedicine_lintas_' + id_farmasi + '_' + id_user + '_' + uniqid;
                        const p_or_d = 'p';
                        const postData = 'id_user='+id_user+'&p_or_d='+p_or_d+'&room_name='+room_name;
                        $.ajax({
                            url: baseUrl+'admin/FarmasiCall/call',
                            method: 'POST',
                            data: postData,
                            success: function(data){
                                $('#memanggil').modal('show'); 
                                start_consultation();   
                            },
                            error: function(err){
                                console.log('GAGAL: Laporkan ke admin terkait hal ini!');
                            }
                        });
                    });

                    function get_chat(endpoint){
                        firebase.auth().onAuthStateChanged(function(user) {
                            if (user) {
                                firebase.database()
                                .ref('/chats/'+endpoint)
                                .on('child_added', function(snapshot){
                                    console.log(snapshot.val());
                                    $('#messages').append(template_message(snapshot.val()));
                                    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
                                });
                            }
                        });
                    }
                });
            </script>
            <script src='" . base_url('assets/js/message.js') . "'></script>
        ";

        $this->load->view('template', $data);
    }

    public function dokter()
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Panggil Dokter",
            $view = "admin/farmasi_call_dokter"
        );
        $data['list_dokter'] = $this->db->query('SELECT d.id, d.name FROM master_user d WHERE d.id_user_kategori = 2')->result();
        $data['css_addons'] = '
        <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
        <script src="https://meet.jit.si/external_api.js"></script>
        ';
        $data['js_addons'] = "
            <script>
                $(document).ready(function(){
                    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
                    $('select[name=dokter]').change(function(){
                        $('#panggil-dokter').prop('disabled', false);
                    });

                    $('#panggil-dokter').click(function(){
                        $('#messages').empty();
                        var iframes = document.getElementsByTagName('iframe');
                        for (var i = 0; i < iframes.length; i++) {
                            iframes[i].parentNode.removeChild(iframes[i]);
                        }
                        $('#konten-panggilan').prop('hide', true);
                        function makeid(length) {
                            var result = '';
                            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            var charactersLength = characters.length;
                            for (var i = 0; i < length; i++) {
                                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                            }
                            return result;
                        }
                        let uniqid = makeid(12);    
                        const id_farmasi = ".$this->session->userdata('id_user').";
                        const id_user = $('select[name=dokter]').val();
                        $('#btn-stop-farmasi').attr('data-id-user', id_user);

                        id_pasien = id_user;
                        chat_id = id_farmasi+'_'+id_user;
                        get_chat(chat_id);

                        foto_pasien = baseUrl+'/assets/telemedicine/img/default.png';
                        room_name = 'telemedicine_lintas_' + id_farmasi + '_' + id_user + '_' + uniqid;
                        const p_or_d = 'd';
                        const postData = 'id_user='+id_user+'&p_or_d='+p_or_d+'&room_name='+room_name;
                        $.ajax({
                            url: baseUrl+'admin/FarmasiCall/call',
                            method: 'POST',
                            data: postData,
                            success: function(data){
                                $('#memanggil').modal('show'); 
                                start_consultation();   
                            },
                            error: function(err){
                                console.log('GAGAL: Laporkan ke admin terkait hal ini!');
                            }
                        });
                    });

                    function get_chat(endpoint){
                        firebase.auth().onAuthStateChanged(function(user) {
                            if (user) {
                                firebase.database()
                                .ref('/chats/'+endpoint)
                                .on('child_added', function(snapshot){
                                    console.log(snapshot.val());
                                    $('#messages').append(template_message(snapshot.val()));
                                    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
                                });
                            }
                        });
                    }
                });
            </script>
            <script src='" . base_url('assets/js/message.js') . "'></script>
        ";

        $this->load->view('template', $data);
    }

    public function call(){
        $this->all_controllers->check_user_farmasi();

        $data = $this->input->post();
        $p_or_d = $data['p_or_d'];
        $id_user = $data['id_user'];
        $id_farmasi = $this->session->userdata('id_user');
        $room_name = $data['room_name'];

        $farmasi = $this->db->query('SELECT f.name FROM master_user f WHERE f.id_user_kategori = 5 AND f.id_user_level = 2 AND f.id = ?', $id_farmasi)->row();
        $notifikasi = 'Panggilan konsultasi dari Farmasi: '.$farmasi->name;
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');

        $data_notif = array(
        'id_user' => $id_user,
        'notifikasi' => $notifikasi,
        'tanggal' => $now,
        'direct_link' => '#'
        );
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();

        $nama_notif = $p_or_d == 'p' ? 'panggilan_farmasi_pasien' : 'panggilan_farmasi_dokter';
        $msg_notif = array(
            'name' => $nama_notif,
            'id_notif' => $id_notif,
            'keterangan' => $notifikasi,
            'id_farmasi' => $id_farmasi,
            'id_user' => json_encode(array($id_user)),
            'room_name' => $room_name,
            'direct_link' => '#'
        );
        $msg_notif = json_encode($msg_notif);

        $dokter_or_pasien = $p_or_d == 'p' ? '0':'2';
        $user = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = ? AND id = ?', array($dokter_or_pasien, $id_user))->row();
        $result = $this->key->_send_fcm($user->reg_id, $msg_notif);
        echo $result;
    }

    public function akhiri(){
        $this->all_controllers->check_user_farmasi();

        $data = $this->input->post();
        $p_or_d = $data['p_or_d'];
        $id_user = $data['id_user'];
        $id_farmasi = $this->session->userdata('id_user');

        $farmasi = $this->db->query('SELECT f.name FROM master_user f WHERE f.id_user_kategori = 5 AND f.id_user_level = 2 AND f.id = ?', $id_farmasi)->row();
        $notifikasi = 'Panggilan konsultasi dari Farmasi: '.$farmasi->name.' telah berakhir';
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');

        $data_notif = array(
        'id_user' => $id_user,
        'notifikasi' => $notifikasi,
        'tanggal' => $now,
        'direct_link' => '#'
        );
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();

        $nama_notif = $p_or_d == 'p' ? 'akhiri_panggilan_farmasi_pasien' : 'akhiri_panggilan_farmasi_dokter';
        $msg_notif = array(
            'name' => $nama_notif,
            'id_notif' => $id_notif,
            'keterangan' => $notifikasi,
            'id_farmasi' => $id_farmasi,
            'id_user' => json_encode(array($id_user)),
            'direct_link' => '#'
        );
        $msg_notif = json_encode($msg_notif);

        $dokter_or_pasien = $p_or_d == 'p' ? '0':'2';
        echo $dokter_or_pasien;
        $user = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = ? AND id = ?', array($dokter_or_pasien, $id_user))->row();
        $result = $this->key->_send_fcm($user->reg_id, $msg_notif);
        echo $result;
    }
}