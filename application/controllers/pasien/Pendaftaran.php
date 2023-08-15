<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();
       		$this->load->library(array('Key'));
        	$this->load->library('session');
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
				// $this->session->set_userdata('_token',hash('sha256', random_string('alnum', 64)));
        $poli = $this->input->get('poli');
        if(!$poli){
            $where = ' WHERE d.aktif = 1';
        }
        else{
            $where = ' WHERE jd.poli = "'.$poli.'" AND d.aktif = 1';
        }
        $hari = $this->input->get('hari');
        $list_hari = array('all','Senin','Selasa','Rabu','Kamis',"Jum'at");
        if(!in_array($hari, $list_hari)){
            $where_2 = ' AND d.aktif = 1 ';
        }
        if(!$hari){
            $where_2 = ' AND d.aktif = 1 ';
        }
        else{
            if($hari == 'all'){
                $where_2 = ' AND d.aktif = 1 ';
            }
            else{
                if($poli){
                    $where_2 = ' AND jd.hari = "'.$hari.'" AND d.aktif = 1 ';
                }
                else{
                    $where_2 = ' AND jd.hari = "'.$hari.'" ';
                }
            }
        }
        $data['view'] = 'pasien/pendaftaran';
        $data['title'] = 'Pendaftaran';
	    $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        // $data['jadwal_terdaftar'] = $this->db->query('SELECT id_jadwal FROM data_registrasi WHERE id_pasien = '.$this->session->userdata('id_user'))->result_array();
        $data['list_jadwal_dokter'] = $this->db->query('SELECT jd.id as id, jd.tanggal as tanggal, jd.waktu as waktu, jd.id_dokter as id_dokter, jd.hari as hari ,d.name as nama_dokter, d.foto as foto_dokter, jd.poli as poli FROM jadwal_dokter jd INNER JOIN nominal ON jd.poli = nominal.poli INNER JOIN master_user d ON jd.id_dokter=d.id'.$where.$where_2.' AND nominal.aktif = 1 AND jd.aktif = 1 ORDER BY jd.hari DESC, jd.waktu ASC')->result_array();

        foreach($data['list_jadwal_dokter'] as $index=>$jadwal_dokter){
            if($jadwal_dokter['tanggal']){
                $now = new DateTime('now');
                $diff_tanggal_now = $now->diff(new DateTime($jadwal_dokter['tanggal']));
                if($diff_tanggal_now->invert){
                    unset($data['list_jadwal_dokter'][$index]);
                }
            }
        }
        $data['data_poli'] = $this->db->query('SELECT DISTINCT poli FROM jadwal_dokter')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_pendaftaran = $("#table_pendaftaran").DataTable({
                                                    "responsive": true,
                                                    "autoWidth": false,
                                                    "lengthChange": false,
                                                    "searching": true,
                                                    "pageLength": 5,
                                                });
                                    $("#table_pendaftaran_filter").remove();
                                    $("#search").on("keyup", function(e){
                                        table_pendaftaran.search($(this).val()).draw();
                                    });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    public function daftar(){

        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }

        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->db->escape($this->session->userdata('id_user')))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }

		// if($this->session->userdata("_token") !==$this->input->get('token'))
		// {
		// 	$this->session->set_flashdata('msg', 'Token Tidak Sesuai!');
		// 	redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
		// }
		// 		$this->session->unset_userdata('_token');
        $id_pasien = $this->session->userdata('id_user');
        $id_jadwal = $this->input->get('id_jadwal');

		if(!$id_jadwal){
			show_404();
		}
        $jadwal_dokter = $this->db->query('SELECT id,hari,tanggal,waktu,id_dokter FROM jadwal_dokter WHERE id = '.$this->db->escape($id_jadwal))->row();

        if($jadwal_dokter->tanggal){
            $tanggal_jadwal_dokter = new DateTime($jadwal_dokter->tanggal);
            $now = new DateTime('now');
            $diff_tanggal_now = $now->diff($tanggal_jadwal_dokter);
            if($diff_tanggal_now->invert){
                $this->session->set_flashdata('msg', 'Anda tidak dapat mendaftar ke jadwal yang sudah kadaluarsa!');
                redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
            }
        }
        switch($jadwal_dokter->hari){
            case 'Senin':
                $hari_dokter = 'Mon';
                break;
            case 'Selasa':
                $hari_dokter = 'Tue';
                break;
            case 'Rabu':
                $hari_dokter = 'Wed';
                break;
            case 'Kamis':
                $hari_dokter = 'Thu';
                break;
            case "Jum'at":
                $hari_dokter = 'Fri';
                break;
            case "Sabtu":
                $hari_dokter = 'Sat';
                break;
            case "Minggu":
                $hari_dokter = 'Sun';
                break;
            default:
                $hari_dokter = '';
                break;
        }
        // $hari_dokter = new DateTime($hari_dokter);
        $spare_waktu_jd = explode('-', str_replace(' ', '', $jadwal_dokter->waktu));
        $jadwal_konsultasi = $this->db->query('SELECT jk.jam,jk.tanggal FROM jadwal_konsultasi jk INNER JOIN data_registrasi dreg ON jk.id_registrasi = dreg.id INNER JOIN jadwal_dokter jd ON dreg.id_jadwal = jd.id WHERE jd.id = '.$this->db->escape($jadwal_dokter->id).' ORDER BY jk.created_at DESC LIMIT 1')->row();
        // echo var_dump($hari_dokter.' '.$spare_waktu_jd[0]);
        // die;
        $jam_awal = new DateTime($hari_dokter.' '.$spare_waktu_jd[0]);
        $jam_terakhir = new DateTime($hari_dokter.' '.$spare_waktu_jd[1]);

        $now = new DateTime('now');
        $diff_spare_now = $now->diff($jam_awal);
	$diff_spare_terakhir = $now->diff($jam_terakhir);
        // echo var_dump(array($now, $spare_waktu_jd[0],$diff_spare_now));
        // die;
        if($diff_spare_now->invert && !$diff_spare_terakhir->invert){
            $this->session->set_flashdata('msg', 'Jadwal ini sedang berlangsung, anda tidak dapat mendaftarkannya sekarang! Tunggu sampai jadwal selesai!');
            redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
        }

        $isRegistered = $this->db->query('SELECT id FROM data_registrasi WHERE id_pasien = '.$this->db->escape($id_pasien).' AND id_jadwal = '.$this->db->escape($id_jadwal))->row();
        if($isRegistered){
            $this->session->set_flashdata('msg', 'Anda tidak bisa mendaftar 2x dalam satu jadwal!');
            redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
        }

        if($jadwal_konsultasi){
            $last_day_konsultasi = new DateTime($jadwal_konsultasi->tanggal);
            $today = new DateTime();
            $three_days_ago = $today->sub(new DateInterval('P3D'));
            $three_days_later = clone $last_day_konsultasi;
            $three_days_later->add(new DateInterval('P3D'));
          
            if ($three_days_ago <= $last_day_konsultasi) {
                $msg = 'Anda telah melakukan konsultasi pada tanggal ' . $last_day_konsultasi->format('d F Y') . '. Anda bisa mendaftar kembali pada tanggal ' . $three_days_later->format('d F Y') . '.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
            }
            
            $last_jam_konsultasi = new DateTime($jadwal_konsultasi->tanggal.' '.$jadwal_konsultasi->jam);
            $last_jam_konsultasi->modify('+30 minutes');
            // echo var_dump($last_jam_konsultasi);
            // die;
            $list_registrasi = $this->db->query('SELECT bukti_pembayaran.id FROM bukti_pembayaran INNER JOIN data_registrasi ON data_registrasi.id = bukti_pembayaran.id_registrasi WHERE data_registrasi.id_jadwal = '.$this->db->escape($id_jadwal).' AND bukti_pembayaran.status = 0')->result();
            foreach($list_registrasi as $registrasi){
                $diff_spare_last = $last_jam_konsultasi->diff($jam_terakhir);
                if($diff_spare_last->h == 0 && $diff_spare_last->i < 30){
                    $last_jam_konsultasi->modify('+7 days');
                }
                else{
                    $last_jam_konsultasi->modify('+30 minutes');
                }
            }
            // $count_list_registrasi = count($list_registrasi);
            // $minutes_plus = $count_list_registrasi*30;

            // if($count_list_registrasi > 0){
            //     $last_jam_konsultasi->modify('+'.$minutes_plus.' minutes');
            // }

//            if(count($list_registrasi) > 0){
//                $last_jam_konsultasi->modify('-30 minutes');
//            }
            $diff_spare_last = $last_jam_konsultasi->diff($jam_terakhir);
//			echo var_dump($diff_spare_last);
//			die;

            // echo var_dump(!$this->input->post('nextWeek') && !$diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30);
            // die;

            if($diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30){
                $this->session->set_flashdata('msg', 'Jadwal Konsultasi untuk minggu ini dan minggu depan sudah penuh, daftar kembali di minggu depan!');
                redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
            }

			$nextWeek = $last_jam_konsultasi->modify('+7 days');
			$nextWeek = $nextWeek->format('[ d-m-Y ]');
            if((!$this->input->post('nextWeek') && !$diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30)){
                $msg = '
                    <script>
                        document.getElementsByTagName("BODY")[0].setAttribute("onload", "myFunction();");

                        function myFunction(){
                            var test = confirm("Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh, jadwal anda akan dialihkan ke minggu depan '.$nextWeek.', apakah anda berkenan?");
                            if(test){
                                var http = new XMLHttpRequest();
                                var url = "'.base_url('pasien/Pendaftaran/daftar?id_jadwal='.$id_jadwal).'";
                                var params = "nextWeek=true";
                                http.open("POST", url, true);

                                //Send the proper header information along with the request
                                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                                http.onreadystatechange = function() {//Call a function when the state changes.
                                    if(http.readyState == 4 && http.status == 200) {
                                        location.href = "'.base_url('pasien/JadwalTerdaftar').'";
                                    }
                                }
                                http.send(params);
                            }
                        }
                    </script>
                ';
                //$this->session->set_flashdata('msg', 'Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh! Daftar di hari lain atau setelah jadwal dokter selesai!');
                $id_dokter = $jadwal_dokter->id_dokter;
                $id_notif = $this->db->insert_id();
                $notifikasi = "Ada pasien yang mendaftar konsultasi.";
                $dokter = $this->db->query('SELECT * FROM master_user WHERE id = '.$this->db->escape($id_dokter))->row();
                $msg_notif = array(
                    'name' => 'pendaftaran_konsultasi',
                    'id_notif' => $id_notif,
                    'keterangan' => $notifikasi,
                    'tanggal' => $now,
                    'id_user' => json_encode(array($id_pasien)),
                    'direct_link' => base_url('dokter/Dokter/#'),
                  );

                  $msg_notif = json_encode($msg_notif);
                  $this->key->_send_fcm($dokter->reg_id, $msg_notif);
                  $this->session->set_flashdata('msg_2', $msg);
                  $data_notif = array("id_user" => $id_dokter, "notifikasi" => $notifikasi, "tanggal" => $now->date, "direct_link" => base_url('dokter/Dokter/#'));
                  $this->db->insert('data_notifikasi', $data_notif);
                  redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
            }

            // if(($spare_waktu_jd[1] == $last_jam_konsultasi && ($diff_spare_last->invert || ($diff_spare_last->d == 0 && $diff_spare_last->h == 0 && $diff_spare_last->i < 30)))){
            //     $this->session->set_flashdata('msg', 'Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh! Daftar di hari lain atau setelah jadwal dokter selesai!');
            //     redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
            // }
        }
        $list_registrasi = $this->db->query('SELECT bukti_pembayaran.id FROM bukti_pembayaran INNER JOIN data_registrasi ON data_registrasi.id = bukti_pembayaran.id_registrasi WHERE data_registrasi.id_jadwal = '.$this->db->escape($id_jadwal).' AND bukti_pembayaran.status = 0')->result();
        foreach($list_registrasi as $registrasi){
            $diff_spare_last = $jam_awal->diff($jam_terakhir);
            if($diff_spare_last->h == 0 && $diff_spare_last->i < 30){
                $jam_awal->modify('+7 days');
            }
            else{
                $jam_awal->modify('+30 minutes');
            }
        }

        $diff_spare_last = $jam_awal->diff($jam_terakhir);
        $now = new DateTime($hari_dokter);
        $now = $now->format('Y-m-d');

        if($diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30){
            $this->session->set_flashdata('msg', 'Jadwal Konsultasi untuk minggu ini dan minggu depan sudah penuh, daftar kembali di minggu depan!');
            redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
        }

		$nextWeek = $jam_awal->modify('+7 days');
		$nextWeek = $nextWeek->format('[ d-m-Y ]');
        if((!$this->input->post('nextWeek') && !$diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30)){
            $msg = '
                <script>
                    document.getElementsByTagName("BODY")[0].setAttribute("onload", "myFunction();");

                    function myFunction(){
                        var test = confirm("Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh, jadwal anda akan dialihkan ke minggu depan '.$nextWeek.', apakah anda berkenan?");
                        if(test){
                            var http = new XMLHttpRequest();
                            var url = "'.base_url('pasien/Pendaftaran/daftar?id_jadwal='.$id_jadwal).'";
                            var params = "nextWeek=true";
                            http.open("POST", url, true);

                            //Send the proper header information along with the request
                            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                            http.onreadystatechange = function() {//Call a function when the state changes.
                                if(http.readyState == 4 && http.status == 200) {
                                    location.href = "'.base_url('pasien/JadwalTerdaftar').'";
                                }
                            }
                            http.send(params);
                        }
                    }
                </script>
            ';
            $this->session->set_flashdata('msg_2', $msg);
            // $this->session->set_flashdata('msg', 'Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh! Daftar di hari lain atau setelah jadwal dokter selesai!');
            redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
        }

        if(!$id_jadwal){
            show_404();
        }
        $jadwal = $this->db->query('SELECT * FROM jadwal_dokter WHERE id = '.$this->db->escape($id_jadwal))->row();

        if(!$jadwal){
            show_404();
        }

        $dokter = $this->db->query('SELECT * FROM master_user WHERE id = '.$this->db->escape($jadwal->id_dokter))->row();

        // Menambah data untuk table pendaftaran
        $pasien = $this->db->query('SELECT * FROM master_user WHERE id = '.$this->db->escape($id_pasien))->row();

        // $data_pendaftaran = array('id_pasien'=>$id_pasien, 'id_jadwal'=>$id_jadwal);
        // $daftar = $this->db->insert('pendaftaran',$data_pendaftaran);
        // $daftar_id = $this->db->insert_id();

	$last_registrasi = $this->db->query('SELECT id FROM data_registrasi ORDER BY created_at DESC LIMIT 1')->row();
	$last_num_regid = explode('-',$last_registrasi->id)[1];
	$last_num_regid = (int) $last_num_regid;
	$last_num_regid++;
	$last_num_regid = (string) $last_num_regid;

	$new_num = str_pad( $last_num_regid, 5, "0", STR_PAD_LEFT );

        // Menambah data untuk table data_registrasi
//        $id_registrasi = 'REG-'.$daftar_id.'-'.$id_pasien;
	$now = (new DateTime('now'))->format('YmdHis');
	$id_registrasi = $pasien->id_fasyankes.'-'.$new_num.'-'.$now;
        $id_status_pembayaran = 0;
        $keterangan = 'Belum Bayar';
        $id_fasyankes = $pasien->id_fasyankes;
        $data_registrasi = array('id'=>$id_registrasi,'id_status_pembayaran'=>$id_status_pembayaran,'keterangan'=>$keterangan, 'id_fasyankes'=>$id_fasyankes, 'id_pasien'=>$id_pasien, 'id_jadwal'=>$id_jadwal);
        $regis = $this->db->insert('data_registrasi', $data_registrasi);

        if($regis){
            $this->session->set_flashdata('msg', 'Pendaftaran Berhasil! Segera lakukan pembayaran.');

            $data3 = array(
                "id_dokter" => $jadwal->id_dokter,
                "id_pasien" => $pasien->id,
                "id_registrasi" => $id_registrasi,
                "tanggal" => (new DateTime("now"))->format("Y-m-d"),
                "jam" => (new DateTime("now"))->format("h:i"),
            );
            $this->db->insert('jadwal_konsultasi', $data3);
        }
        else{
            $this->session->set_flashdata('msg', 'Pendaftaran Gagal!');
        }

        redirect('pasien/JadwalTerdaftar');
    }
}
