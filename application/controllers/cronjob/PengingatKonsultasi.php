<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengingatKonsultasi extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       
		$this->load->library(array('Key'));   
    }
	
	public function index($token_input){
			$token = 'indihealth.lintasarta.2020';
			if(!$token_input || $token_input != $token){
				die;
			}
			$now = new DateTime('now');
			$semua_jadwal_konsultasi = $this->db->query('SELECT jk.*, p.reg_id as reg_id_pasien, p.id as id_pasien, p.name as nama_pasien, d.id as id_dokter, d.reg_id as reg_id_dokter, d.name as nama_dokter FROM jadwal_konsultasi jk INNER JOIN master_user p ON jk.id_pasien = p.id INNER JOIN master_user d ON jk.id_dokter = d.id ORDER BY jk.tanggal ASC')->result();
			
			foreach($semua_jadwal_konsultasi as $jadwal_konsultasi){
				$waktu_konsultasi = new DateTime($jadwal_konsultasi->tanggal.' '.$jadwal_konsultasi->jam);
				$diff_wk_now = $now->diff($waktu_konsultasi);
				if(!$diff_wk_now->invert && $diff_wk_now->y == 0 && $diff_wk_now->m == 0 && $diff_wk_now->d == 0 && $diff_wk_now->h == 0 && $diff_wk_now->i <= 5){
				
					$notifikasi = 'Jadwal Konsultasi anda dengan Dokter '.$jadwal_konsultasi->nama_dokter.' tinggal 5 menit kurang lagi, segera persiapkan diri anda!';
					$sekarang = $now->format('Y-m-d H:i:s');
					$direct_link = base_url('pasien/JadwalTerdaftar');
					$id_user = json_encode(array($jadwal_konsultasi->id_pasien));
					$msg_notif = array(
						'name'=>'vp',
						'keterangan'=>$notifikasi,
						'tanggal'=>$sekarang,
						'id_user'=>$id_user,
						'direct_link'=>$direct_link,
					);
					$msg_notif = json_encode($msg_notif);
					$this->key->_send_fcm($jadwal_konsultasi->reg_id_pasien, $msg_notif);

					$data_notif = array("id_user"=>$id_user, "notifikasi"=>$notifikasi, "tanggal"=>$sekarang, "direct_link"=>$direct_link);
					$this->db->insert('data_notifikasi', $data_notif);
				
					// REMINDER UNTUK DOKTER
					$notifikasi = 'Jadwal Konsultasi anda dengan Pasien '.$jadwal_konsultasi->nama_pasien.' tinggal 5 menit kurang lagi, segera persiapkan diri anda!';
					$direct_link = base_url('dokter/Teleconsultasi');
					$id_user = json_encode(array($jadwal_konsultasi->id_dokter));
					$msg_notif = array(
						'name'=>'vp',
						'keterangan'=>$notifikasi,
						'tanggal'=>$sekarang,
						'id_user'=>$id_user,
						'direct_link'=>$direct_link,
					);
					$msg_notif = json_encode($msg_notif);
					$this->key->_send_fcm($jadwal_konsultasi->reg_id_pasien, $msg_notif);

					$data_notif = array("id_user"=>$id_user, "notifikasi"=>$notifikasi, "tanggal"=>$sekarang, "direct_link"=>$direct_link);
					$this->db->insert('data_notifikasi', $data_notif);
				}
			}
			if(isset($notifikasi)){
					echo "OK";
			}
			else{
					echo "FAILED";
			}
	}
}