<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembayaranObat extends CI_Controller
{
  var $menu = 6;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('all_model');
    $this->load->library(array('Key'));
    $this->load->model('pembayaran_obat_model');

    $this->load->library('session');
    $this->load->library('all_controllers');
    $this->load->library('my_pagination');
    $this->load->library('pagination');

    $this->load->library('send_email');
  }

  public function index()
  {
    $this->all_controllers->check_user_admin();
    $data = $this->all_controllers->get_data_view(
      $title = "Verifikasi Pembayaran Obat",
      $view = "admin/manage_payment_obat"
    );

    // $data['list_resep'] = $this->db->query("SELECT resep_dokter.id, resep_dokter.created_at, bpo.foto as foto_bukti, bpo.status as status_bukti, bpo.id as id_bukti, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, biaya_pengiriman_obat.biaya_pengiriman, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN master_user p ON resep_dokter.id_pasien = p.id INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id LEFT JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi WHERE bpo.status = 0 GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY created_at DESC")->result();
    $data['list_resep'] = $this->db->query("SELECT resep_dokter.id, bpo.created_at, bpo.foto as foto_bukti, bpo.status as status_bukti, bpo.id as id_bukti, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.harga_obat as harga_kustom, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN master_user p ON resep_dokter.id_pasien = p.id INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id LEFT JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi WHERE bpo.status = 0 AND bpo.metode_pembayaran = 1 GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY created_at DESC")->result();
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
                                  var table_verifikasi_obat = $('#table_verifikasi_obat').DataTable({
                                    'responsive': true,
                                    'autoWidth': false,
                                    'lengthChange': false,
                                    'searching': true,
                                    'pageLength': 5,
                                  });
                                  $('#table_verifikasi_obat_filter').remove();
                                  $('#search').on('keyup', function(e){
                                    table_verifikasi_obat.search($(this).val()).draw();
                                  });
                                });
                              </script>
// 		";
    $this->load->view('template', $data);
  }

  public function history()
  {
    $this->all_controllers->check_user_admin();
    $data = $this->all_controllers->get_data_view(
      $title = "History Pembayaran Obat",
      $view = "admin/manage_history_payment_obat"
    );

    $nama_pasien = isset($_GET['nama_pasien']) ? $_GET['nama_pasien'] : null;
    $count_rows = count($this->pembayaran_obat_model->get_all_history($nama_pasien));
    $config = $this->my_pagination->paginate(5, 4, $count_rows, base_url('admin/PembayaranObat/history'));
    $this->pagination->initialize($config);
    $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $data['uri_segment'] = $this->uri->segment(4);
    $data['pagination'] = $this->pagination->create_links();

    // $data['list_resep'] = $this->db->query("SELECT resep_dokter.id, resep_dokter.created_at, bpo.foto as foto_bukti, bpo.status as status_bukti, bpo.created_at as tanggal_pembayaran, bpo.id as id_bukti, bpo.claim_number, bpo.metode_pembayaran, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, nominal.poli as nama_poli, p.name as nama_pasien, biaya_pengiriman_obat.biaya_pengiriman, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat, bukti_pembayaran.tanggal_konsultasi FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi INNER JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE bpo.status != 0 GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY bpo.updated_at DESC, resep_dokter.created_at DESC")->result();
    $data['list_resep'] = $this->pembayaran_obat_model->get_all_history($nama_pasien, null, $config['per_page'], $data['page']);
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
                                  $('#table_histori').DataTable({
                                    'responsive': true,
                                    'autoWidth': false,
                                    'lengthChange': false,
                                    'searching': true,
                                    'pageLength': 5,
                                  });
                                });
                              </script>
// 		";
    $this->load->view('template', $data);
  }

  public function verif($id_bukti)
  {
    $this->all_controllers->check_user_admin();

    $bukti_pembayaran_obat = $this->db->query('SELECT status,id_pasien,id_jadwal_konsultasi FROM bukti_pembayaran_obat WHERE id = ' . $id_bukti)->row();
    if (!$bukti_pembayaran_obat) {
      show_404();
    }

    $data_bukti_update = array('status' => 1);
    $this->all_model->update('bukti_pembayaran_obat', $data_bukti_update, array('id' => $id_bukti));

    $notifikasi = 'Pembayaran resep obat telah diverifikasi.';
    $now = (new DateTime('now'))->format('Y-m-d H:i:s');
    $pasien_reg = $this->db->query('SELECT name, reg_id, email FROM master_user WHERE id = ' . $bukti_pembayaran_obat->id_pasien)->row();
    $direct_link = base_url('pasien/ResepDokter/pembayaran/' . $bukti_pembayaran_obat->id_jadwal_konsultasi);

    $data_notif = array("id_user" => $bukti_pembayaran_obat->id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $direct_link);
    $this->db->insert('data_notifikasi', $data_notif);
    $id_notif = $this->db->insert_id();

    $msg_notif = array(
      'name' => 'vp',
      "id_notif" => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_user' => json_encode(array($bukti_pembayaran_obat->id_pasien)),
      'direct_link' => $direct_link,
    );
    $msg_notif = json_encode($msg_notif);
    $user = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $bukti_pembayaran_obat->id_pasien)->row();
    $this->key->_send_fcm($pasien_reg->reg_id, $msg_notif);

    // Send notification to admin farmasi
    $farmasi_reg = $this->db->query('SELECT name, reg_id, email FROM master_user WHERE id_apotek = ' . $bukti_pembayaran_obat->id_apotek)->row();
    $msg_notif2 = array(
      'name' => 'vp',
      "id_notif" => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_user' => json_encode(array($bukti_pembayaran_obat->id_pasien)),
      'direct_link' => $direct_link,
    );
    $msg_notif2 = json_encode($msg_notif2);
    $this->key->_send_fcm($farmasi_reg->reg_id, $msg_notif2);


    // KIRIM EMAIL //
    $data_message['nama_pasien'] = $pasien_reg->name;
    $data_message['judul'] = 'Pembayaran Obat Telah Diverifikasi';
    $data_message['isi'] = 'Resep Dokter di bawah ini <b>Telah Diverifikasi</b>.';
    $data_message['resep'] = $this->db->query("SELECT resep_dokter.id, resep_dokter.created_at, d.name as nama_dokter,GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id WHERE resep_dokter.id_jadwal_konsultasi = " . $bukti_pembayaran_obat->id_jadwal_konsultasi . " AND id_pasien = " . $bukti_pembayaran_obat->id_pasien . " GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY created_at DESC")->row();
    $data_message['logo'] = base_url("assets/telemedicine/img/logo.png");
    $this->send_email->send(
      $pasien_reg->email,
      'Pembayaran Obat Telah Diverifikasi',
      $data_message,
      'admin/payment_verif_obat_email'
    );
    // ============ //

    $this->session->set_flashdata('msg_pmbyrn_obat', 'Bukti pembayaran telah diverifikasi');
    redirect(base_url('admin/PembayaranObat'));
  }

  public function delete($id_bukti)
  {
    $this->all_controllers->check_user_admin();

    $bukti_pembayaran_obat = $this->db->query('SELECT status,id_pasien,id_jadwal_konsultasi FROM bukti_pembayaran_obat WHERE id = ' . $id_bukti)->row();
    if (!$bukti_pembayaran_obat) {
      show_404();
    }

    $data_bukti_update = array('status' => 2);
    $this->all_model->update('bukti_pembayaran_obat', $data_bukti_update, array('id' => $id_bukti));

    $notifikasi = 'Pembayaran resep obat gagal diverifikasi.';
    $now = (new DateTime('now'))->format('Y-m-d H:i:s');
    $pasien_reg = $this->db->query('SELECT name, reg_id, email FROM master_user WHERE id = ' . $bukti_pembayaran_obat->id_pasien)->row();
    $direct_link = base_url('pasien/ResepDokter/pembayaran/' . $bukti_pembayaran_obat->id_jadwal_konsultasi);

    $data_notif = array("id_user" => $bukti_pembayaran_obat->id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $direct_link);
    $this->db->insert('data_notifikasi', $data_notif);
    $id_notif = $this->db->insert_id();

    $msg_notif = array(
      'name' => 'vp',
      'id_notif' => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_user' => json_encode(array($bukti_pembayaran_obat->id_pasien)),
      'direct_link' => $direct_link,
    );
    $msg_notif = json_encode($msg_notif);
    $user = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $bukti_pembayaran_obat->id_pasien)->row();
    $this->key->_send_fcm($pasien_reg->reg_id, $msg_notif);

    // KIRIM EMAIL //
    $data_message['nama_pasien'] = $pasien_reg->name;
    $data_message['judul'] = 'Pembayaran Obat Gagal Diverifikasi';
    $data_message['isi'] = 'Resep Dokter di bawah ini <b>Gagal Diverifikasi</b>.';
    $data_message['resep'] = $this->db->query("SELECT resep_dokter.id, resep_dokter.created_at, d.name as nama_dokter,GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id WHERE resep_dokter.id_jadwal_konsultasi = " . $bukti_pembayaran_obat->id_jadwal_konsultasi . " AND id_pasien = " . $bukti_pembayaran_obat->id_pasien . " GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY created_at DESC")->row();
    $data_message['logo'] = base_url("assets/telemedicine/img/logo.png");
    $this->send_email->send(
      $pasien_reg->email,
      'Pembayaran Obat Gagal Diverifikasi',
      $data_message,
      'admin/payment_verif_obat_email'
    );
    // =============== //

    $this->session->set_flashdata('msg_pmbyrn_obat', 'Bukti pembayaran dihapus');
    redirect(base_url('admin/PembayaranObat'));
  }
}
