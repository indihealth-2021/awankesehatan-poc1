<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends CI_Controller {
	var $menu = 1;

	public function __construct() {
        parent::__construct();      
        // $this->load->model('Assesment_model');
        $this->load->library('all_controllers');
        $this->load->library('key');
    }

    public function remind_minutes(){
        $password = $this->input->get('pwd');
        if(!$password || $password != 'LintAsaRta2021@)@!'){
            show_404();
        }
        $master_web = $this->db->query('SELECT * FROM master_web')->row();
        $remind_at = $master_web->ingatkan_pada;
        $remind_at+=1;
        $remind_every = $master_web->ingatkan_setiap;
        $now = new DateTime('now');
        $date_konsultasi_now = $now->format('Y-m-d');
        $date_konsultasi_until = (new DateTime($now->format('Y-m-d')))->modify('+1 day')->format('Y-m-d');

        $hours_minutes_konsultasi_now = $now->format('H:i:s');
        $hours_minutes_konsultasi_until = (new DateTime($now->format('Y-m-d H:i:s')));
        $hours_minutes_konsultasi_until = $hours_minutes_konsultasi_until->modify('+'.$remind_at.' minutes')->format('H:i:s');
        echo var_dump(array($hours_minutes_konsultasi_now, $hours_minutes_konsultasi_until));
        $list_konsultasi = $this->
                                db->
                                query('SELECT pasien.id as id_pasien, pasien.reg_id as pasien_reg_id, pasien.name as nama_pasien,
                                              dokter.id as id_dokter, dokter.reg_id as dokter_reg_id, dokter.name as nama_dokter,
                                              jadwal_konsultasi.tanggal, jadwal_konsultasi.jam 
                                                FROM jadwal_konsultasi 
                                                INNER JOIN master_user pasien ON pasien.id = jadwal_konsultasi.id_pasien 
                                                INNER JOIN master_user dokter ON dokter.id = jadwal_konsultasi.id_dokter
                                                    WHERE jadwal_konsultasi.tanggal = "'.$date_konsultasi_now.'" 
                                                    AND TIME(jadwal_konsultasi.jam) BETWEEN "'.$hours_minutes_konsultasi_now.'" AND "'.$hours_minutes_konsultasi_until.'"')
                                ->result();
        echo var_dump($now);
        foreach($list_konsultasi as $konsultasi){
            $waktu_sekarang = $now;
            $waktu_konsultasi = new DateTime($now->format('Y-m-d').' '.$konsultasi->jam);

            $diff_ws_wk = $waktu_sekarang->diff($waktu_konsultasi);
            echo var_dump(array("AAAAAAAAAAAAAAAAAAAAAAa=>"=>$diff_ws_wk));
            $konsultasi_jam_ke_menit = $diff_ws_wk->h*60;
            $konsultasi_menit = $konsultasi_jam_ke_menit+$diff_ws_wk->i;
            if($konsultasi_menit == $remind_at-1){
                $notifikasi = 'Jadwal Konsultasi dengan Dokter '.$konsultasi->nama_dokter.' akan dimulai '.$diff_ws_wk->i.' menit lagi!';
            }
            else{
                if($konsultasi_menit == 0){
                    $notifikasi = 'Jadwal Konsultasi dengan Dokter '.$konsultasi->nama_dokter.' akan segera dimulai, tunggu panggilan dari Dokter '.$konsultasi->nama_dokter;
                }
                else if($konsultasi_menit % $remind_every == 0){
                    $notifikasi = 'Jadwal Konsultasi dengan Dokter '.$konsultasi->nama_dokter.' akan dimulai '.$diff_ws_wk->i.' menit lagi!';
                }
            }

            if(isset($notifikasi)){
                $direct_link = base_url('pasien/Telekonsultasi/jadwal');
                $data_notif = array("id_user" => $konsultasi->id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now->format('Y-m-d H:i:s'), "direct_link" => $direct_link);
                $this->db->insert('data_notifikasi', $data_notif);
                $id_notif = $this->db->insert_id();
        
                $msg_notif = array(
                    'name' => 'remind_konsultasi_pasien',
                    'id_notif' => $id_notif,
                    'keterangan' => $notifikasi,
                    'tanggal' => $now->format('d-m-Y H:i:s'),
                    'id_user' => json_encode(array($konsultasi->id_pasien)),
                    'direct_link' => $direct_link,
                );
                $msg_notif = json_encode($msg_notif);
                $this->key->_send_fcm($konsultasi->pasien_reg_id, $msg_notif);                
            }
        }

        echo "OK";
    }
}