<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Telekonsultasi extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function getTanggalKonsultasi($id_registrasi){
		$data_registrasi = $this->db->query('SELECT dr.id, jd.id as id_jadwal FROM data_registrasi dr INNER JOIN jadwal_dokter jd ON dr.id_jadwal = jd.id WHERE dr.id = "'.$id_registrasi.'" AND dr.id_status_pembayaran != 1')->row();
		if(!$data_registrasi){
            header('Content-Type: application/json');
            $result = array(
                'status'=> false
            );
            echo json_encode($result);
            return;
		}
		
		$jadwal_dokter = $this->db->query('SELECT id, waktu, tanggal, hari FROM jadwal_dokter WHERE id = '.$data_registrasi->id_jadwal)->row();
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
        $spare_waktu_jd = explode('-', str_replace(' ', '', $jadwal_dokter->waktu));
        $jam_awal = new DateTime($hari_dokter.' '.$spare_waktu_jd[0]);
        $jam_terakhir = new DateTime($hari_dokter.' '.$spare_waktu_jd[1]);
        
        $jadwal_konsultasi = $this->db->query('SELECT jk.jam,jk.tanggal FROM jadwal_konsultasi jk INNER JOIN data_registrasi dreg ON jk.id_registrasi = dreg.id INNER JOIN jadwal_dokter jd ON dreg.id_jadwal = jd.id WHERE jd.id = '.$data_registrasi->id_jadwal.' ORDER BY jk.created_at DESC LIMIT 1')->row();
        if($jadwal_konsultasi){
			$waktu_konsultasi = new DateTime($jadwal_konsultasi->tanggal.' '.$jadwal_konsultasi->jam);
			$waktu_konsultasi->modify('+30 minutes');
		}
       
		$list_data_registrasi = $this->db->query('SELECT dr.id, jd.id as id_jadwal FROM data_registrasi dr INNER JOIN jadwal_dokter jd ON dr.id_jadwal = jd.id WHERE dr.id_jadwal = '.$data_registrasi->id_jadwal.' AND dr.id_status_pembayaran = 2')->result();
		foreach($list_data_registrasi as $dr){
			if(isset($waktu_konsultasi)){
				$diff_spare_last = $waktu_konsultasi->diff($jam_terakhir);
                if($diff_spare_last->h == 0 && $diff_spare_last->i < 30){
                    $waktu_konsultasi->modify('+7 days');
                }
                else{
                    $waktu_konsultasi->modify('+30 minutes');
                }
			}
			else{
				$diff_spare_last = $jam_awal->diff($jam_terakhir);
				if($diff_spare_last->h == 0 && $diff_spare_last->i < 30){
					$jam_awal->modify('+7 days');
				}
				else{
					$jam_awal->modify('+30 minutes');
				}
			}
        }
        $now = new DateTime('now');
        $diff_spare_now = $now->diff($jam_terakhir);
        if($diff_spare_now->invert){
            $jam_awal->modify('+7 days');
        }
		
		if(isset($waktu_konsultasi)){
			$wkt_konsultasi = $waktu_konsultasi;
		}
		else{
			$wkt_konsultasi = $jam_awal;
        }
        $diff_wkt_now = $now->diff($wkt_konsultasi);
        if($diff_wkt_now->invert){
            $wkt_konsultasi->modify('+7 days');
        }
		

        $day_eng = $wkt_konsultasi->format('D');
        if($day_eng == 'Mon'){
            $day_ind = 'Senin';
        }else if($day_eng == 'Tue'){
        $day_ind = 'Selasa';
        }else if($day_eng == 'Wed'){
        $day_ind = 'Rabu';
        }else if($day_eng == 'Thu'){
        $day_ind = 'Kamis';
        }else if($day_eng == 'Fri'){
        $day_ind = 'Jum\'at';
        }else if($day_eng == 'Sat'){
        $day_ind = 'Sabtu';
        }else if($day_eng == 'Sun'){
        $day_ind = 'Minggu';
        }else{
        $day_ind = 'Unkown';
        }

		$tgl_konsultasi = $wkt_konsultasi->format('d-m-Y');
        $waktu_konsultasi = $wkt_konsultasi->format('H:i');
        $waktu_konsultasi_berakhir = $wkt_konsultasi;
        $waktu_konsultasi_berakhir = ($waktu_konsultasi_berakhir->modify('+30 Minutes'))->format('H:i');
        $wkt_konsultasi = $day_ind.', '.$tgl_konsultasi;
        header('Content-Type: application/json');
        $result = array(
            'status'=> true,
            'data'=> array(
                'tanggal_konsultasi'=>$wkt_konsultasi,
                'waktu_konsultasi'=>$waktu_konsultasi,
                'waktu_konsultasi_berakhir'=>$waktu_konsultasi_berakhir
            )
        );
		echo json_encode($result);
	}
}