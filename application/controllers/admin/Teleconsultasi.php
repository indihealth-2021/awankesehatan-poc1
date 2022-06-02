<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teleconsultasi extends CI_Controller {
	var $menu = 1;

	public function __construct() {
        parent::__construct();       
       		$this->load->library(array('Key'));   
			$this->load->library('session');     
			$this->load->library('all_controllers');   
    }

    public function index() {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Telekonsultasi",
			$view = "admin/manage_teleconsultasi"
		);

		$data['list_jadwal_telekonsultasi'] = $this->db->query('SELECT jk.*,n.poli, d.name as nama_dokter,p.name as nama_pasien FROM jadwal_konsultasi jk INNER JOIN master_user d ON jk.id_dokter=d.id INNER JOIN master_user p ON jk.id_pasien=p.id INNER JOIN detail_dokter dd ON dd.id_dokter = d.id INNER JOIN nominal n ON dd.id_poli = n.id ORDER BY jk.tanggal ASC, jk.jam ASC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_telekonsultasi = $("#table_telekonsultasi").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
								  $("#table_telekonsultasi_filter").remove();
								  $("#search").on("keyup", function(e){
									table_telekonsultasi.search($(this).val()).draw();
								  });

                                    $("#modalHapus").on("show.bs.modal", function(e) {
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                    });
                                });
                              </script>';
		$this->load->view('template', $data);
	}

	// public function tampilTambahJadwal(){
	// 	$data['view'] = 'admin/form_jadwal_konsultasi';
    //   		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
    //   		$data['title'] = 'Tambah Jadwal Telekonsultasi';

	// 	$this->load->view('template', $data);
	// }

	public function tampilEditJadwal($id){
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Edit Jadwal Telekonsultasi",
			$view = "admin/form_edit_jadwal_konsultasi"
		);

		$data['jadwal_konsultasi'] = $this->db->query('SELECT jk.*, d.name as nama_dokter,d.id as id_dokter, nominal.poli as poli_dokter, p.id as id_pasien, p.name as nama_pasien FROM jadwal_konsultasi jk INNER JOIN master_user d ON jk.id_dokter = d.id INNER JOIN master_user p ON jk.id_pasien = p.id LEFT JOIN detail_dokter ON d.id = detail_dokter.id_dokter LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE jk.id = '.$id)->row();
		$data['list_dokter_satu_poli'] = $this->db->query('SELECT master_user.id, master_user.name, master_user.username, master_user.str FROM master_user INNER JOIN detail_dokter ON master_user.id = detail_dokter.id_dokter INNER JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE nominal.poli = "'.$data['jadwal_konsultasi']->poli_dokter.'"')->result();
		if(!$data['jadwal_konsultasi']){
			show_404();
		}
		$data['menu'] = $this->menu;

		$this->load->view('template', $data);
	}

	public function hapusJadwal($id, $id_dokter, $id_pasien){
		$this->all_controllers->check_user_admin();

		$jadwal_konsultasi = $this->db->query('SELECT id_registrasi, id FROM jadwal_konsultasi WHERE id = '.$id)->row();
		if(!$jadwal_konsultasi){
			show_404();
		}
		if($this->db->delete('jadwal_konsultasi', array('id'=>$id))){
			$this->db->delete('assesment', array('id_jadwal_konsultasi'=>$id));
			$this->db->delete('data_registrasi', array('id'=>$jadwal_konsultasi->id_registrasi));
			$this->db->delete('no_antrian', array('id'=>$jadwal_konsultasi->id));
			$this->db->delete('biaya_pengiriman_obat', array('id'=>$jadwal_konsultasi->id_registrasi));
			$dokter = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = '.$id_dokter)->row();
			$pasien = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = '.$id_pasien)->row();
			$admin = $this->db->query('SELECT id,name FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
			$notifikasi = 'Jadwal Telekonsultasi dengan dokter '.$dokter->name.' telah dibatalkan oleh '.$admin->name;
			$now = (new DateTime('now'))->format('Y-m-d H:i:s');
			
			$data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Telekonsultasi/jadwal'));
			$this->db->insert('data_notifikasi', $data_notif);
			$id_notif = $this->db->insert_id();
			
			$msg_notif = array(
					'name'=>'vp',
					'id_notif'=>$id_notif,
					'keterangan'=>$notifikasi,
					'tanggal'=>$now,
					'id_user'=>json_encode(array($pasien->id)),
					'direct_link'=>base_url('pasien/Telekonsultasi/jadwal'),
			);
			$msg_notif = json_encode($msg_notif);
			$user = $this->db->query('SELECT reg_id FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
			$this->key->_send_fcm($pasien->reg_id, $msg_notif);

			// ------------------------------- //

			$notifikasi_2 = 'Jadwal Telekonsultasi dengan pasien '.$pasien->name.' telah dibatalkan oleh '.$admin->name;
			
			$data_notif_2 = array("id_user"=>$dokter->id, "notifikasi"=>$notifikasi_2, "tanggal"=>$now, "direct_link"=>base_url('dokter/Teleconsultasi'));
			$this->db->insert('data_notifikasi', $data_notif_2);
			$id_notif = $this->db->insert_id();
			
			$msg_notif_2 = array(
					'name'=>'vp',
					'id_notif'=>$id_notif,
					'keterangan'=>$notifikasi_2,
					'tanggal'=>$now,
					'id_user'=>json_encode(array($dokter->id)),
					'direct_link'=>base_url('dokter/Teleconsultasi'),
			);
			$msg_notif_2 = json_encode($msg_notif_2);

			$this->key->_send_fcm($dokter->reg_id, $msg_notif_2);

		    $this->session->set_flashdata('msg_jadwal_konsultasi', 'Data berhasil dihapus!');

           	}else{        
      			$this->session->set_flashdata('msg_jadwal_konsultasi', 'Data gagal dihapus!');;    
		}
		redirect(base_url('admin/Teleconsultasi'));
	}

	public function updateJadwal($id){
		$this->all_controllers->check_user_admin();

		$data = $this->input->post();
		$jadwal_konsultasi = $this->db->query('SELECT id,tanggal,jam, id_dokter FROM jadwal_konsultasi WHERE id = '.$id)->row();
		if(!$jadwal_konsultasi){
			show_404();
		}
		$update = $this->all_model->update('jadwal_konsultasi', $data, array('id'=>$id));
		if($update != 0)
		{
			if($update == -1){
				echo '<script>alert("Data gagal disimpan")</script>';
				$this->tampilEditJadwal($id);
			}
			else{
				$isJadwalExists = $this->db->query('SELECT tanggal,jam FROM jadwal_konsultasi WHERE tanggal = "'.$data['tanggal'].'" AND jam = "'.$data['jam'].'" AND id_dokter = '.$data['id_dokter'])->result();
				if(count($isJadwalExists) > 1){
					echo '<script>alert("Waktu sudah ada!")</script>';
					$data_update = array('tanggal'=>$jadwal_konsultasi->tanggal, 'jam'=>$jadwal_konsultasi->jam);
					$this->all_model->update('jadwal_konsultasi', $data_update, array('id'=>$id));
					$this->tampilEditJadwal($id);
				}
				else{
					echo '<script>alert("Data berhasil disimpan")</script>';
					$dokter = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = '.$jadwal_konsultasi->id_dokter)->row();
					$pasien = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = '.$data['id_pasien'])->row();

					$tanggal = $data['tanggal'];
					$jam = $data['jam'];
					if($jadwal_konsultasi->id_dokter != $data['id_dokter']){
						$assesment = $this->db->query('SELECT id FROM assesment WHERE id_jadwal_konsultasi = '.$jadwal_konsultasi->id)->row();
						if($assesment){
							$data_assesment_update = array('id_dokter'=>$data['id_dokter']);
							$this->all_model->update('assesment', $data_assesment_update, array('id_jadwal_konsultasi'=>$jadwal_konsultasi->id));
						}
						
						$dokter_baru = $this->db->query('SELECT id, name, reg_id FROM master_user WHERE id = '.$data['id_dokter'])->row();
						
						$notifikasi = 'Jadwal Telekonsultasi dengan dokter '.ucwords($dokter->name).' pada ['.$tanggal.' '.$jam.'] telah dialihkan ke dokter '.ucwords($dokter_baru->name).' ['.$tanggal.' '.$jam.']';
						$now = (new DateTime('now'))->format('Y-m-d H:i:s');
					
						$data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Telekonsultasi/jadwal'));
						$this->db->insert('data_notifikasi', $data_notif);
						$id_notif = $this->db->insert_id();
						
						$msg_notif = array(
								'name'=>'vp',
								'id_notif'=>$id_notif,
								'keterangan'=>$notifikasi,
								'tanggal'=>$now,
								'id_user'=>json_encode(array($pasien->id)),
								'direct_link'=>base_url('pasien/Telekonsultasi/jadwal'),
						);
						$msg_notif = json_encode($msg_notif);
						$user = $this->db->query('SELECT reg_id FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
						
						$this->key->_send_fcm($pasien->reg_id, $msg_notif);
						
						$notifikasi_2 = 'Jadwal Telekonsultasi dengan pasien '.$pasien->name.' pada ['.$tanggal.' '.$jam.'] telah dialihkan ke dokter '.ucwords($dokter_baru->name).' ['.$tanggal.' '.$jam.']';
						$data_notif_2 = array("id_user"=>$dokter->id, "notifikasi"=>$notifikasi_2, "tanggal"=>$now, "direct_link"=>base_url('dokter/Teleconsultasi'));
						$this->db->insert('data_notifikasi', $data_notif_2);
						$id_notif = $this->db->insert_id();
						
						$msg_notif_2 = array(
								'name'=>'vp',
								'id_notif'=>$id_notif,
								'keterangan'=>$notifikasi_2,
								'tanggal'=>$now,
								'id_user'=>json_encode(array($dokter->id)),
								'direct_link'=>base_url('dokter/Teleconsultasi'),
						);
						$msg_notif_2 = json_encode($msg_notif_2);
						$this->key->_send_fcm($dokter->reg_id, $msg_notif_2);
						
						$notifikasi_2 = 'Jadwal Telekonsultasi dengan pasien '.$pasien->name.' pada ['.$tanggal.' '.$jam.'] telah dialihkan ke dokter '.ucwords($dokter_baru->name).' ['.$tanggal.' '.$jam.']';
						$data_notif_2 = array("id_user"=>$dokter_baru->id, "notifikasi"=>$notifikasi_2, "tanggal"=>$now, "direct_link"=>base_url('dokter/Teleconsultasi'));
						$this->db->insert('data_notifikasi', $data_notif_2);
						$id_notif = $this->db->insert_id();
						
						$msg_notif_2 = array(
								'name'=>'vp',
								'id_notif'=>$id_notif,
								'keterangan'=>$notifikasi_2,
								'tanggal'=>$now,
								'id_user'=>json_encode(array($dokter_baru->id)),
								'direct_link'=>base_url('dokter/Teleconsultasi'),
						);
						$msg_notif_2 = json_encode($msg_notif_2);						
						$this->key->_send_fcm($dokter_baru->reg_id, $msg_notif_2);
					}
					else{
						$notifikasi = 'Jadwal Telekonsultasi dengan dokter '.$dokter->name.' telah diubah ['.$tanggal.' '.$jam.']';
						$now = (new DateTime('now'))->format('Y-m-d H:i:s');
						
						$data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Telekonsultasi/jadwal'));
						$this->db->insert('data_notifikasi', $data_notif);
						$id_notif = $this->db->insert_id();
						
						$msg_notif = array(
								'name'=>'vp',
								'id_notif'=>$id_notif,
								'keterangan'=>$notifikasi,
								'tanggal'=>$now,
								'id_user'=>json_encode(array($pasien->id)),
								'direct_link'=>base_url('pasien/Telekonsultasi/jadwal'),
						);
						$msg_notif = json_encode($msg_notif);
						$user = $this->db->query('SELECT reg_id FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
						
						$this->key->_send_fcm($pasien->reg_id, $msg_notif);

						// ------------------------------- //

						$notifikasi_2 = 'Jadwal Telekonsultasi dengan pasien '.$pasien->name.' telah diubah ['.$tanggal.' '.$jam.']';
						$data_notif_2 = array("id_user"=>$dokter->id, "notifikasi"=>$notifikasi_2, "tanggal"=>$now, "direct_link"=>base_url('dokter/Teleconsultasi'));
						$this->db->insert('data_notifikasi', $data_notif_2);
						$id_notif = $this->db->insert_id();
						
						$msg_notif_2 = array(
								'name'=>'vp',
								'id_notif'=>$id_notif,
								'keterangan'=>$notifikasi_2,
								'tanggal'=>$now,
								'id_user'=>json_encode(array($dokter->id)),
								'direct_link'=>base_url('dokter/Teleconsultasi'),
						);
						$msg_notif_2 = json_encode($msg_notif_2);

						$this->key->_send_fcm($dokter->reg_id, $msg_notif_2);
					}

					$this->session->set_flashdata('msg_jadwal_konsultasi', 'Data Berhasil Disimpan!');
					redirect(base_url('admin/Teleconsultasi'));
				}
			}							
			
		} else {
			$this->session->set_flashdata('msg_jadwal_konsultasi', "Data tidak ada yang disimpan");							
			redirect(base_url('admin/Teleconsultasi/tampilEditJadwal/'.$id));
		}
	}
}
