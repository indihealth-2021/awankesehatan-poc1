<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalTerdaftar extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();
       		$this->load->library(array('Key'));   
        	$this->load->library('session');   
            $this->load->model('all_model');
            $this->load->model('JadwalTerdaftar_model');
    }

    public function index(){
        // redirect(base_url("pasien/Telekonsultasi/jadwal")); exit();
        
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
        $poli = $this->input->get('poli');
        // if(!$poli){
        //     $where = ' ORDER BY jd.hari DESC, jd.waktu ASC';
        // }
        // else{
        //     $where = ' AND jd.poli = "'.$poli.'" ORDER BY jd.hari DESC, jd.waktu ASC';
        // }
        // $data['list_jadwal_terdaftar'] = $this->db->query('SELECT dr.id, dr.id_jadwal, jd.waktu, jd.hari, jd.tanggal, d.name as nama_dokter, dr.id_status_pembayaran, n.harga, jd.poli, n.biaya_adm as biaya_adm_poli, bukti_pembayaran.biaya_adm as biaya_adm_bukti, bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti FROM data_registrasi dr INNER JOIN jadwal_dokter jd ON dr.id_jadwal = jd.id INNER JOIN master_user d ON jd.id_dokter = d.id INNER JOIN nominal n ON jd.poli = n.poli LEFT JOIN bukti_pembayaran ON dr.id = bukti_pembayaran.id_registrasi WHERE dr.id_pasien = '.$this->session->userdata('id_user').$where)->result_array();
        $data['list_jadwal_terdaftar'] = $this->JadwalTerdaftar_model->get_all_by_id_pasien($this->session->userdata('id_user'), $poli);
        $data['data_poli'] = $this->db->query('SELECT DISTINCT poli FROM jadwal_dokter')->result();
        $data['master_web'] = $this->db->query('SELECT * FROM master_web')->row();


        $data['view'] = 'pasien/jadwal_terdaftar';
        $data['title'] = 'Jadwal Terdaftar';
	    $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_jadwal_terdaftar = $("#table_jadwal_terdaftar").DataTable({
                                        "autoWidth": true,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                    });

                                    $("#table_jadwal_terdaftar_filter").remove();
                                    $("#search").on("keyup", function(e){
                                        table_jadwal_terdaftar.search($(this).val()).draw();
                                    });

                                    $("#modalHapus").on("show.bs.modal", function(e) {
										var id_registrasi = $(e.relatedTarget).data("id-registrasi");
										$.ajax({
											method : "GET",
											url    : baseUrl+"pasien/api/Telekonsultasi/getTanggalKonsultasi/"+id_registrasi,
											success : function(data){
                                                $(e.currentTarget).find("#tanggal").html(data.data.tanggal_konsultasi);
                                                console.log(data);
											},
											error : function(data){
                                                console.log(JSON.stringify(data));
											}
										});    
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                        
										var title = $(e.relatedTarget).data("title");
										$(e.currentTarget).find(".title").text(title);
                                        $(e.currentTarget).find(".title-2").text(title);
                                    });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    public function cancel($id_registrasi){
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
        $data_registrasi = $this->db->query('SELECT id FROM data_registrasi WHERE id = "'.$id_registrasi.'"')->row();
        $bukti_pembayaran = $this->db->query('SELECT id,photo,status FROM bukti_pembayaran WHERE id_registrasi = "'.$id_registrasi.'" AND status = 0')->row();
        if(!$data_registrasi){
            show_404();
        }
        if($bukti_pembayaran){
            if($bukti_pembayaran->status){
                $this->session->set_flashdata("msg_jadwal_terdaftar","Pendaftaran sudah terjadwal, tidak dapat dibatalkan!");
                redirect(base_url('pasien/JadwalTerdaftar'));
            }
            else{
                $this->db->delete('bukti_pembayaran', array('id_registrasi'=>$id_registrasi, 'status'=>0));
                unlink(FCPATH."assets/images/bukti_pembayaran/".$bukti_pembayaran->photo);
                // $this->db->delete('data_registrasi', array('id'=>$id_registrasi));
                $data_update = array(
                    'keterangan'=>'Belum Bayar',
                    'id_status_pembayaran'=>0,
                );
                $this->all_model->update('data_registrasi', $data_update, array('id'=>$id_registrasi));

                $this->db->delete('biaya_pengiriman_obat', array('id_registrasi'=>$id_registrasi));

                $uploader = $this->db->query('SELECT name,reg_id FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
                $admins = $this->db->query('SELECT id FROM master_user WHERE id_user_kategori = 5')->result();
                $admins_id = [];
                for($i=0;$i<count($admins);$i++){
                    $admins_id[$i] = $admins[$i]->id;
                }

                $notifikasi = 'Pembayaran dibatalkan oleh '.$uploader->name;
                $now = (new DateTime('now'))->format('Y-m-d H:i:s');
                $msg_notif = array(
                    'name'=>'vp',
                            'keterangan'=>$notifikasi,
                            'tanggal'=>$now,
                            'id_user'=>json_encode($admins_id),
                            'direct_link'=>base_url('admin/Payment'),
                );
                $msg_notif = json_encode($msg_notif);

                $to = $uploader->reg_id;
                $this->key->_send_fcm($to, $msg_notif);

                $data_notif = array("id_user"=>implode(',',$admins_id), "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('admin/Payment'));
                $this->db->insert('data_notifikasi', $data_notif);

                $this->session->set_flashdata("msg_jadwal_terdaftar","Pembayaran dibatalkan!");
                redirect(base_url('pasien/JadwalTerdaftar'));
            }
        }
        else{
            $this->db->delete('data_registrasi', array('id'=>$id_registrasi));
            $this->db->delete('jadwal_konsultasi', array('id_registrasi'=>$id_registrasi));
            $this->session->set_flashdata("msg_jadwal_terdaftar", "Pendaftaran dibatalkan!");
            redirect(base_url('pasien/JadwalTerdaftar'));
        }
    }
    
    public function getTanggalKonsultasi($id_registrasi){
		$data_registrasi = $this->db->query('SELECT dr.id, jd.id as id_jadwal FROM data_registrasi dr INNER JOIN jadwal_dokter jd ON dr.id_jadwal = jd.id WHERE dr.id = "'.$id_registrasi.'" AND dr.id_status_pembayaran != 1')->row();
		if(!$data_registrasi){
			show_404();
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
			$waktu_konsultasi = new DateTime($jadwal_konsultasi->tanggal+' '+$jadwal_konsultasi->jam);
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
		
		$wkt_konsultasi = $wkt_konsultasi->format('d-m-Y');
		echo $wkt_konsultasi;
	}

}
