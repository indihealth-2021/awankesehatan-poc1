<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
	var $menu = 6;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('all_model');
		$this->load->model('payment_model');
		$this->load->library(array('Key'));
		$this->load->library('session');
		$this->load->library('all_controllers');

		$this->load->library('send_email');
	}


	// public function menu_pembayaran()
	// {
	// 	if (!$this->session->userdata('is_login')) {
	// 		redirect(base_url('Login'));
	// 	}
	// 	$valid = $this->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
	// 	if ($valid->id_user_kategori != 5) {
	// 		if ($valid->id_user_kategori == 0) {
	// 			redirect(base_url('pasien/Pasien'));
	// 		} else {
	// 			redirect(base_url('dokter/Dashboard'));
	// 		}
	// 	} else {
	// 		if ($valid->id_user_level == 2) {
	// 			redirect(base_url('admin/FarmasiVerifikasiObat'));
	// 		}
	// 	}
	// 	$data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

	// 	if ($this->session->userdata('is_login')) {
	// 		$data['menu'] = $this->menu;
	// 		$data['view'] = 'admin/menu_pembayaran';
	// 		$data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
	// 		$data['title'] = 'Menu Pembayaran';
	// 		$this->load->view('template', $data);
	// 	}
	// }

	public function index()
	{
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Verifikasi Pembayaran",
			$view = "admin/manage_payment"
		);
		
		$temp = $this->payment_model->get_dataPayment(array('data_registrasi.id_status_pembayaran' => 2, 'bukti_pembayaran.metode_pembayaran' => 1, 'bukti_pembayaran.status' => 0), 'bukti_pembayaran.created_at');
		$master_web = $this->db->query('SELECT * FROM master_web')->row();
		foreach ($temp as $key => $value) {
			$value->photo = base_url('assets/images/bukti_pembayaran/' . $value->photo);
			if ($value->poli_dokter) {
				$biaya_adm = $value->biaya_adm ? $value->biaya_adm:0;
				$biaya_konsultasi = $value->biaya_konsultasi ? $value->biaya_konsultasi:0;
				$harga_poli = $this->db->query('SELECT harga FROM nominal WHERE poli = "' . strtoupper($value->poli_dokter) . '"')->row();
				$value->total_biaya = 'Rp. ' . number_format($biaya_konsultasi+$biaya_adm, 2, ',', '.');
			} else {
				$value->total_biaya = '';
			}
		}
		$data['payment'] = $temp;
		$data['css_addons'] = '
<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
<style>
.myImg {
border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}
/* The Modal (background) */
// .modal {
//   display: none; /* Hidden by default */
//   position: fixed; /* Stay in place */
//   z-index: 1; /* Sit on top */
//   padding-top: 100px; /* Location of the box */
//   left: 0;
//   top: 0;
//   width: 100%; /* Full width */
//   height: 100%; /* Full height */
//   overflow: auto; /* Enable scroll if needed */
//   background-color: rgb(0,0,0); /* Fallback color */
//   background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
// }

// /* Modal Content (Image) */
// .modal-content {
//   margin: auto;
//   display: block;
//   width: 80%;
//   max-width: 700px;
// }

// /* Caption of Modal Image (Image Text) - Same Width as the Image */
// #caption {
//   margin: auto;
//   display: block;
//   width: 80%;
//   max-width: 700px;
//   text-align: center;
//   color: #ccc;
//   padding: 10px 0;
//   height: 150px;
// }

// /* Add Animation - Zoom in the Modal */
// .modal-content, #caption {
//   animation-name: zoom;
//   animation-duration: 0.6s;
// }

// @keyframes zoom {
//   from {transform:scale(0)}
//   to {transform:scale(1)}
// }

// /* The Close Button */
// .close {
//   position: absolute;
//   top: 90px;
//   right: 290px;
//   color: #fff;
//   font-size: 50px;
//   font-weight: bold;
//   transition: 0.3s;
// }

// .close:hover,
// .close:focus {
//   color: #fff;
//   font-size: 60px;
//   text-decoration: none;
//   cursor: pointer;
// }

// /* 100% Image Width on Smaller Screens */
// @media only screen and (max-width: 700px){
//   .modal-content {
//     width: 100%;
//   }
// }
</style>
// 		';
		$data['js_addons'] = "
<script>
$(document).ready(function () {
$('img').on('click', function () {
	var image = $(this).attr('src');
var alt = $(this).attr('alt');
	$('#exampleModal').on('show.bs.modal', function () {
		$('.modal-body').attr('src', image);
	$('#caption').val(alt);
	});
});
});
</script> 
							<script src='" . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . "'></script>
							<script src='" . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . "'></script>
							<script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . "'></script>
							<script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . "'></script>
							<script>
							$(document).ready(function () {
								var table_verifikasi_payment = $('#table_verifikasi_payment').DataTable({
								'responsive': true,
								'autoWidth': false,
								'lengthChange': false,
								'searching': true,
								'pageLength': 5,
								});
								$('#table_verifikasi_payment_filter').remove();
								$('#search').on('keyup', function(e){
								  table_verifikasi_payment.search($(this).val()).draw();
								});
							});
							</script>
// 		";

		$this->load->view('template', $data);
	}
	// public function get_detail_payment()
	// {
	// 	if (!$this->session->userdata('is_login')) {
	// 		redirect(base_url('Login'));
	// 	}
	// 	$valid = $this->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
	// 	if ($valid->id_user_kategori != 5) {
	// 		if ($valid->id_user_kategori == 0) {
	// 			redirect(base_url('pasien/Pasien'));
	// 		} else {
	// 			redirect(base_url('dokter/Dashboard'));
	// 		}
	// 	} else {
	// 		if ($valid->id_user_level == 2) {
	// 			redirect(base_url('admin/FarmasiVerifikasiObat'));
	// 		}
	// 	}
	// 	$data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

	// 	if ($this->session->userdata('is_login')) {
	// 		$id_register = $this->input->post('id');
	// 		$data['menu'] = $this->menu;
	// 		$data['view'] = 'admin/manage_payment';
	// 		$data['payment'] = $this->payment_model->get_dataPayment(array('data_registrasi.id' => $id_register));
	// 		$data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
	// 		$data['title'] = 'Detail Pembayaran';
	// 		// var_dump($data);
	// 		$this->load->view('template', $data);
	// 	} else {
	// 		redirect('Login');
	// 	}
	// }
	public function create()
	{
		$this->all_controllers->check_user_admin();

		date_default_timezone_set('Asia/Bangkok');
		//$date = date('Y-m-d');
		$data = $this->input->post(); // field sesuaikan dengan databse
		//$data['created_at'] = $date;
		echo json_encode($data);
		die();
		$save = $this->all_model->insert_('bukti_pembayaran', $data);
		if ($save) {
			if (!empty($_FILES['photo']['name'])) {
				$config['upload_path'] = "./assets/images/payment";
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = 5000;
				$config['max_width'] = 6000;
				$config['max_height'] = 6000;
				$config['encrypt_name'] = false;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('foto')) {
					$upload = array('result', $this->upload->display_errors());
				} else {

					$up = array(
						'photo' => $this->upload->data('file_name'),
					);
					$upload = $this->all_model->update_($up, array('id' => $save), 'data_news');
				}
			}
			$response = array('status' => $save, 'message' => 'Data berhasil disimpan');
		} else {
			$response = array('status' => $save, 'message' => 'Data gagal disimpan');
		}
		// echo $date;
		return $response;
	}
	public function update($id)
	{
		$this->all_controllers->check_user_admin();

		//$data = $this->input->post(); // sesuaikan dengan field database
		//$id   = $data['id'];
		//unset($data['id']);
		$bukti = $this->all_model->get_payment(array('bukti_pembayaran.id' => $id));
		$isExists = $this->db->query('SELECT id_status_pembayaran FROM data_registrasi WHERE id = "' . $bukti[0]->id_registrasi . '"')->row();
		if ($isExists->id_status_pembayaran == 1) {
			show_404();
		}
		foreach ($bukti as $key => $value) {
			$id = $value->id_dokter;
			$data2['id_pasien'] = $value->id_pasien;
			$data2['id_dokter'] = $id;
		}

		$data = array('status' => 1);
		$data1 = array('id_status_pembayaran' => 1, 'keterangan' => 'Lunas');

		$id_jadwal = $this->db->query('SELECT id_jadwal FROM data_registrasi WHERE id = "' . $bukti[0]->id_registrasi . '"')->row();
		$jadwal = $this->db->query('SELECT waktu, id, tanggal, id_dokter,hari FROM jadwal_dokter WHERE id = ' . $id_jadwal->id_jadwal)->row();
		if($jadwal->tanggal){
			$tgl_dokter = new DateTime($jadwal->tanggal);
			$now = new DateTime('now');
			$diff_spare_now_tgl_dokter = $now->diff($tgl_dokter);
			if($diff_spare_now_tgl_dokter->invert){
				$this->session->set_flashdata('msg_payment', 'Tidak dapat mendaftar ke jadwal yang sudah kadaluarsa');
				redirect(base_url('admin/Payment'));
			}
		}
		$spare_waktu_dokter = explode('-', str_replace(' ', '', $jadwal->waktu));
		$last_konsultasi = $this->db->query('SELECT reg.id_jadwal, jk.jam, jk.tanggal, jd.tanggal as tanggal_dokter, jd.hari as hari_dokter, jd.waktu as waktu_dokter FROM jadwal_konsultasi jk INNER JOIN (SELECT reg.id_jadwal, reg.id FROM data_registrasi reg WHERE reg.id_jadwal = ' . $id_jadwal->id_jadwal . ') as reg ON jk.id_registrasi = reg.id INNER JOIN jadwal_dokter jd ON reg.id_jadwal = jd.id ORDER BY jk.created_at DESC LIMIT 1')->row();
		if ($last_konsultasi) {
			$dateLastKonsultasi = new DateTime($last_konsultasi->tanggal . ' ' . $last_konsultasi->jam);
			$now = new DateTime('now');
			$diff_spare_last_now = $now->diff($dateLastKonsultasi);
			if ($diff_spare_last_now->invert) {
				switch ($last_konsultasi->hari_dokter) {
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
				$jd_this_week = new DateTime($hari_dokter);
				$jd_this_week = $jd_this_week->format('Y-m-d');
				$last_konsultasi->tanggal = $jd_this_week;
				$last_konsultasi->jam = $spare_waktu_dokter[0];
				$last_konsultasi->jam = new DateTime($last_konsultasi->jam);
				$last_konsultasi->jam = $last_konsultasi->jam->modify('-30 minutes');
				$last_konsultasi->jam = $last_konsultasi->jam->format('H:i');
			}
			$jam_detik = new DateTime($spare_waktu_dokter[1]);
			$jam_detik = $jam_detik->modify("-30 minutes");
			$jam_detik = $jam_detik->format("H:i");
			if ($last_konsultasi->tanggal_dokter) {
				$now = new DateTime('now');
				$diff_reg_time = $now->diff(new DateTime($last_konsultasi->tanggal));
				if ($dif_reg_time->invert) {
					$tanggal = new DateTime($last_konsultasi->tanggal);
					$tanggal = $tanggal->modify("+7 days");
					$tanggal = $tanggal->format('Y-m-d');
					$jam = $spare_waktu_dokter[0];
				} else {
					if ($last_konsultasi->jam == $jam_detik) {
						$tanggal = new DateTime($last_konsultasi->tanggal);
						$tanggal = $tanggal->modify("+7 days");
						$tanggal = $tanggal->format('Y-m-d');
						$jam = $spare_waktu_dokter[0];
					} else {
						$tanggal = $last_konsultasi->tanggal;
						$jam = new DateTime($last_konsultasi->jam);
						$jam = $jam->modify("+30 minutes");
						$jam = $jam->format("H:i");
					}
				}
			} else {
				$now = new DateTime('now');
				$hari_sekarang = $now;
				switch ($last_konsultasi->hari_dokter) {
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
				$hari_dokter = new DateTime($hari_dokter . ' ' . $spare_waktu_dokter[1]);
				$diff_hari = $hari_sekarang->diff($hari_dokter);
				// echo var_dump($diff_hari);
				// die;
				if ($diff_hari->invert) {
					$tanggal = $last_konsultasi->tanggal;
					$tanggal = $now->modify('+7 Days');
					$tanggal = $tanggal->format('Y-m-d');
					$jam = $spare_waktu_dokter[0];
				} else {
					// echo var_dump(array($last_konsultasi->jam == $jam_detik));
					// die;
					if ($last_konsultasi->jam == $jam_detik) {
						$tanggal = new DateTime($last_konsultasi->tanggal);
						$tanggal = $tanggal->modify("+7 days");
						$tanggal = $tanggal->format('Y-m-d');
						$jam = $spare_waktu_dokter[0];
					} else {
						$tanggal = $last_konsultasi->tanggal;
						$jam = new DateTime($last_konsultasi->jam);
						$jam = $jam->modify("+30 minutes");
						$jam = $jam->format("H:i");
					}
				}
			}
		} else {
			if ($jadwal->tanggal) {
				$now = new DateTime('now');
				$diff_reg_time = $now->diff(new DateTime($jadwal->tanggal));
				if ($diff_reg_time->invert) {
					$this->session->set_flashdata('msg_payment', 'Tidak dapat mendaftar ke jadwal yang sudah kadaluarsa');
					redirect(base_url('admin/Payment'));
				} else {
					$tanggal = $jadwal->tanggal;
					$jam = $spare_waktu_dokter[0];
				}
			} else {
				$now = new DateTime('now');
				$hari_sekarang = $now;
				switch ($jadwal->hari) {
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
				$jam_terakhir = new DateTime($hari_dokter . ' ' . $spare_waktu_dokter[1]);
				$jam_awal = new DateTime($hari_dokter. ' ' . $spare_waktu_dokter[0]);
				$hari_dokter = $jam_awal;
				$diff_hari = $hari_sekarang->diff($hari_dokter);

				$now = new DateTime('now');
				$diff_spare_now = $now->diff($jam_terakhir);
				if ($diff_spare_now->invert) {
					$tanggal = $now->modify('+7 days');
				} else {
					$tanggal = $now->modify('+' . $diff_hari->d . ' Days');
					$tanggal = $tanggal->modify('+' . $diff_hari->h . ' Hours');
					$tanggal = $tanggal->modify('+' . $diff_hari->m . ' Minutes');
					$tanggal = $tanggal->modify('+' . $diff_hari->s . ' Seconds');
				}
				$tanggal = $tanggal->format('Y-m-d');
				$jam = $spare_waktu_dokter[0];
			}
		}
		// $jadwal_konsultasi = $this->db->query('SELECT tanggal, jam, hari FROM jadwal_konsultasi WHERE id_pasien = '.$bukti[0]->id_pasien.' AND tanggal = "'.$tanggal.'"')->row();
		// if($jadwal_konsultasi){
		// 	$tanggal = new DateTime($tanggal);
		// 	$tanggal = $tanggal->modify('+7 Days');
		// 	$tanggal = $tanggal->format('Y-m-d');
		// }
		$data3 = array(
			"id_dokter" => $jadwal->id_dokter,
			"id_pasien" => $bukti[0]->id_pasien,
			"id_registrasi" => $bukti[0]->id_registrasi,
			"tanggal" => $tanggal,
			"jam" => $jam,
		);
		$this->db->insert('jadwal_konsultasi', $data3);
		// echo var_dump($data3);
		// die;
		$id_jadwal_konsultasi = $this->db->insert_id();
		$assesment = $this->db->query('SELECT assesment.* FROM assesment INNER JOIN jadwal_konsultasi ON assesment.id_jadwal_konsultasi = jadwal_konsultasi.id WHERE assesment.id_pasien = ' . $bukti[0]->id_pasien . ' ORDER BY assesment.created_at DESC')->row();
		$dokter = $this->db->query('SELECT id,name FROM master_user WHERE id = ' . $jadwal->id_dokter)->row();
		// if ($assesment) {
		// 	$data_assesment = array(
		// 		"id_pasien" => $bukti[0]->id_pasien,
		// 		"id_jadwal_konsultasi" => $id_jadwal_konsultasi,
		// 		"id_dokter" => $jadwal->id_dokter,
		// 		"berat_badan" => $assesment->berat_badan,
		// 		"tinggi_badan" => $assesment->tinggi_badan,
		// 		"tekanan_darah" => $assesment->tekanan_darah,
		// 		"suhu" => $assesment->suhu,
		// 		"merokok" => $assesment->alkohol,
		// 		"kecelakaan" => $assesment->kecelakaan,
		// 		"operasi" => $assesment->operasi,
		// 		"dirawat" => $assesment->dirawat,
		// 		"keluhan" => $assesment->keluhan,
		// 	);
		// 	$this->db->insert('assesment', $data_assesment);
		// 	$notifikasi = 'Pembayaran telah diverifikasi. Isi Assesment untuk Jadwal Telekonsultasi dengan dokter ' . $dokter->name . ' yang telah dibuat [' . $tanggal . ' ' . $jam . ']';
		// 	$direct_link = base_url('pasien/Assesment?id_jadwal_konsultasi=' . $id_jadwal_konsultasi);
		// } else {
		$notifikasi = 'Pembayaran telah diverifikasi. Isi Assessment untuk Jadwal Telekonsultasi dengan dokter ' . $dokter->name . ' yang telah dibuat [' . $tanggal . ' ' . $jam . ']';
		$direct_link = base_url('pasien/Assesment?id_jadwal_konsultasi=' . $id_jadwal_konsultasi);
		// }


		$loginuser = $this->db->query('SELECT name,reg_id FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
		$konsultasi = $this->db->query('SELECT p.name as nama_pasien, p.email as email_pasien FROM jadwal_konsultasi INNER JOIN master_user p ON jadwal_konsultasi.id_pasien = p.id WHERE jadwal_konsultasi.id = ' . $id_jadwal_konsultasi)->row();
		$now = (new DateTime('now'))->format('Y-m-d H:i:s');
		$pasien_reg = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $bukti[0]->id_pasien)->row();

		$data_notif = array("id_user" => $bukti[0]->id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $direct_link);
		$this->db->insert('data_notifikasi', $data_notif);
		$id_notif = $this->db->insert_id();

		$msg_notif = array(
			'name' => 'vp',
			'id_notif' => $id_notif,
			'keterangan' => $notifikasi,
			'tanggal' => $now,
			'id_user' => json_encode(array($bukti[0]->id_pasien)),
			'direct_link' => $direct_link,
		);
		$msg_notif = json_encode($msg_notif);
		$user = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $bukti[0]->id_pasien)->row();
		$this->key->_send_fcm($pasien_reg->reg_id, $msg_notif);

		$dokter_reg = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $dokter->id)->row();
		$notifikasi_2 = 'Jadwal Telekonsultasi dengan pasien ' . $konsultasi->nama_pasien . ' telah dibuat [' . $tanggal . ' ' . $jam . ']';

		$now_2 = (new DateTime('now'))->format('Y-m-d H:i:s');

		$data_notif_2 = array("id_user" => $dokter->id, "notifikasi" => $notifikasi_2, "tanggal" => $now_2, "direct_link" => base_url('dokter/Teleconsultasi'));
		$this->db->insert('data_notifikasi', $data_notif_2);
		$id_notif = $this->db->insert_id();

		$msg_notif_2 = array(
			'name' => 'vp',
			'id_notif' => $id_notif,
			'keterangan' => $notifikasi_2,
			'tanggal' => $now_2,
			'id_user' => json_encode(array($dokter->id)),
			'direct_link' => base_url('dokter/Teleconsultasi'),
		);
		$msg_notif_2 = json_encode($msg_notif_2);
		$user = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $bukti[0]->id_pasien)->row();
		$this->key->_send_fcm($dokter_reg->reg_id, $msg_notif_2);


		$save = $this->all_model->update_($data, array('id' => $bukti[0]->id), 'bukti_pembayaran');
		$save1 = $this->all_model->update_($data1, array('id' => $bukti[0]->id_registrasi), 'data_registrasi');
		if ($save && $save1) {
			$hasil = $this->db->query('SELECT id FROM no_antrian WHERE id_jadwal = '.$jadwal->id);
			if (empty($hasil->result())) {
				$data2['created_at'] = date('Y-m-d');
				$data2['antrian'] = 1;
				$data2['id_jadwal'] = $jadwal->id;
				$data2['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

				$this->all_model->insert('no_antrian', $data2);
			} else {

				$data2['antrian'] = $hasil->num_rows() + 1;
				$data2['created_at'] = date('Y-m-d');
				$data2['id_jadwal'] = $jadwal->id;
				$data2['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

				$this->all_model->insert('no_antrian', $data2);
			}

			$response = array('status' => $save, 'message' => 'Pembayaran terverifikasi');
			$this->session->set_flashdata('msg_payment', 'Pembayaran Terverifikasi');

			// KIRIM EMAIL //
			$data_message['nama_pasien'] = $konsultasi->nama_pasien;
			$data_message['nama_dokter'] = $dokter->name;
			$data_message['konsultasi_detail'] = $notifikasi;
			$data_message['logo'] = base_url("assets/telemedicine/img/logo.png");
			$this->send_email->send(
				$konsultasi->email_pasien,
				'Pembayaran Telah Diverifikasi',
				$data_message,
				'admin/payment_verif_email'
			);
			// ========= //
		} else {
			$response = array('status' => $save, 'message' => 'Pembayaran tidak terverifikasi');
			$this->session->set_flashdata('msg_payment', 'Pembayaran Tidak Terverifikasi');
		}

		redirect(base_url('admin/payment'));
	}
	public function delete($id)
	{
		$this->all_controllers->check_user_admin();

		$bukti_deleted = $this->db->query('SELECT id_registrasi, id_pasien,photo FROM bukti_pembayaran WHERE id = ' . $id)->row();
		$data_registrasi = $this->db->query('SELECT master_user.name as nama_dokter FROM data_registrasi INNER JOIN jadwal_dokter ON data_registrasi.id_jadwal = jadwal_dokter.id INNER JOIN master_user ON jadwal_dokter.id_dokter = master_user.id WHERE data_registrasi.id = "' . $bukti_deleted->id_registrasi . '"')->row();
		if (!$bukti_deleted) {
			show_404();
		}
		//if(file_exists(FCPATH."assets/images/bukti_pembayaran/".$bukti_deleted->photo)){
		//unlink(FCPATH."assets/images/bukti_pembayaran/".$bukti_deleted->photo);
		//}
		$user_bukti = $bukti_deleted->id_pasien;
		$pasien = $this->db->query('SELECT name,email FROM master_user WHERE id = ' . $bukti_deleted->id_pasien)->row();
		$id_regis = $bukti_deleted->id_registrasi;
		$data_regis_update = array('id_status_pembayaran' => 0, 'keterangan' => 'Belum Bayar');
		$this->db->set($data_regis_update);

		$this->db->where('id', $id_regis);
		$this->db->update('data_registrasi');
		//$this->db->delete('data_registrasi', array('id' => $id_regis));
		$this->db->delete('biaya_pengiriman_obat', array('id_registrasi'=>$id_regis));
		$verifier = $this->db->query('SELECT name,reg_id FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
		if ($this->all_model->update('bukti_pembayaran', array("status" => 2), array('id' => $id))) {
			$this->session->set_flashdata('msg_payment', 'Bukti Pembayaran berhasil dihapus');
			$pasien_reg = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $user_bukti)->row();
			$notifikasi = 'Pembayaran anda gagal terverifikasi oleh ' . $verifier->name;
			$now = (new DateTime('now'))->format('Y-m-d H:i:s');

			$data_notif = array("id_user" => $user_bukti, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('pasien/JadwalTerdaftar'));
			$this->db->insert('data_notifikasi', $data_notif);
			$id_notif = $this->db->insert_id();

			$msg_notif = array(
				'name' => 'vp',
				'id_notif' => $id_notif,
				'keterangan' => $notifikasi,
				'tanggal' => $now,
				'id_user' => json_encode(array($user_bukti)),
				'direct_link' => base_url('pasien/JadwalTerdaftar'),
			);
			$msg_notif = json_encode($msg_notif);

			$this->key->_send_fcm($pasien_reg->reg_id, $msg_notif);

			// KIRIM EMAIL //
			$data_message['nama_pasien'] = $pasien->name;
			$data_message['nama_dokter'] = $data_registrasi->nama_dokter;
			$data_message['nama_admin'] = $verifier->name;
			$data_message['logo'] = base_url("assets/telemedicine/img/logo.png");
			$this->send_email->send(
				$pasien->email,
				'Pembayaran Tidak Valid',
				$data_message,
				'admin/payment_failed_email'
			);
			// ========== //
		} else {
			$this->session->set_flashdata('msg_payment', "Bukti Pembayaran gagal dihapus");
		}

		redirect(base_url('admin/payment'));
	}
}
