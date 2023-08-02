<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conference extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('all_model');
    $this->load->library(array('Key'));
    $this->load->library('session');
  }
  public function delete_dir($target)
  {
    if (is_dir($target)) {
      $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

      foreach ($files as $file) {
        delete_files($file);
      }

      rmdir($target);
    } elseif (is_file($target)) {
      unlink($target);
    }
  }

  public function testingNotif(){
    $result = $this->key->_send_fcm('dh1d1qssEd98BsrEJjw-AU:APA91bEeKBZCEQ7u9I5a_QKCe-3gRuEMhb0SN2WKOAHrHP7M_peuIBAY3D0lyFa9aFxgY_kW6vvB7FjQr7UyxQfiediML7RmBMgdDmudSBdg-t5XCHRRsD3qK5cxRn2SpxvMYUX6nyVq', json_encode(array('name'=>'vp', 'keterangan'=>'testing', 'direct_link'=>'https://telemedicinelintasdemo2.indihealth.com/pasien/Pasien')));
    echo $result;
  }

  public function call()
  {
    $id = $this->input->post('reg');
    $id_pasien = $this->input->post('id_pasien');
    $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');
    $roomName = $this->input->post('roomName');
    $dokter = $this->db->query('SELECT id, name FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
    $pasien = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $id_pasien)->row();
    $notifikasi = 'Panggilan konsultasi dari Dokter ' . $dokter->name;
    $now = (new DateTime('now'))->format('Y-m-d H:i:s');

    $data_notif = array("id_user" => $id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => '#');
    $this->db->insert('data_notifikasi', $data_notif);
    $id_notif = $this->db->insert_id();

    $msg_notif = array(
      'name' => 'panggilan_konsultasi_pasien',
      'id_notif' => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_dokter' => $dokter->id,
      'id_user' => json_encode(array($id_pasien)),
      'id_jadwal_konsultasi' => $id_jadwal_konsultasi,
      'roomName' => $roomName,
      'direct_link' => '#',
    );
    $msg_notif = json_encode($msg_notif);

    $result = $this->key->_send_fcm($pasien->reg_id, $msg_notif);

    $data_history = array("activity" => "Panggilan Konsultasi", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $id_pasien);
    $this->db->insert('data_history_log_dokter', $data_history);

    echo $result;
  }
  public function RegId()
  {
    $dat = $this->input->post();
    $where = array('id' => $this->session->userdata('id_user'));
    $ok = false;
    $hasil = $this->all_model->update_($dat, $where, "master_user");

    if ($hasil) {
      $ok = true;
    }
    echo $ok;
  }
  public function jawab()
  {
    $id_dokter = $this->input->post('id_dokter');
    $id = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $id_dokter)->row();
    $id = $id->reg_id;
    $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');

    $now = new DateTime('now');
    $now = $now->format('Y/m/d H:i:s');
    $jadwal_konsultasi = $this->db->query('SELECT bukti_pembayaran.id as id_bp FROM jadwal_konsultasi INNER JOIN bukti_pembayaran ON jadwal_konsultasi.id_registrasi = bukti_pembayaran.id_registrasi WHERE jadwal_konsultasi.id = '.$id_jadwal_konsultasi.' AND bukti_pembayaran.status = 1')->row();
    $this->all_model->update('bukti_pembayaran', array('tanggal_konsultasi'=>$now), array('id'=>$jadwal_konsultasi->id_bp));

    $pasien = $this->db->query('SELECT id, name FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
    $notifikasi = 'Konsultasi Dijawab oleh ' . $pasien->name;
    $now = (new DateTime('now'))->format('Y-m-d H:i:s');

    $data_notif = array("id_user" => $id_dokter, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => '#');
    $this->db->insert('data_notifikasi', $data_notif);
    $id_notif = $this->db->insert_id();

    $msg_notif = array(
      'name' => 'panggilan_konsultasi_dokter',
      'id_notif' => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_user' => json_encode(array($id_dokter)),
      'direct_link' => '#',
    );
    $msg_notif = json_encode($msg_notif);

    $result = $this->key->_send_fcm($id, $msg_notif);

    $data_history = array("activity" => "Menerima Panggilan Konsultasi", "id_user" => $id_dokter, "target_id_user" => $this->session->userdata('id_user'));
    $this->db->insert('data_history_log_dokter', $data_history);

    echo $result;
  }

  public function reject()
  {
    $id_dokter = $this->input->post('id_dokter');
    $dokter = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = ' . $id_dokter)->row();
    $pasien = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();

    $notifikasi = 'Konsultasi Ditolak oleh ' . $pasien->name;
    $now = (new DateTime('now'))->format('Y-m-d H:i:s');

    $data_notif = array("id_user" => $id_dokter, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => '#');
    $this->db->insert('data_notifikasi', $data_notif);
    $id_notif = $this->db->insert_id();

    $msg_notif = array(
      'name' => 'reject_konsultasi',
      'id_notif' => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_user' => json_encode(array($id_dokter)),
      'direct_link' => '#',
    );
    $msg_notif = json_encode($msg_notif);

    $result = $this->key->_send_fcm($dokter->reg_id, $msg_notif);

    $data_history = array("activity" => "Menolak Panggilan Konsultasi", "id_user" => $id_dokter, "target_id_user" => $this->session->userdata('id_user'));
    $this->db->insert('data_history_log_dokter', $data_history);

    echo $result;
  }

  public function end() {
    $id_jadwal_konsultasi = $this->input->get("id_jadwal_konsultasi");
    $id_pasien = $this->input->get("id_pasien");
  }


  public function end_call()
  {
    // echo var_dump($this->input->post('data_konsultasi').'&'.$this->input->post('data_konsultasi_2'));
    // die;
    $id = $this->input->post('reg');
    $id_pasien = $this->input->post('id_pasien');
    $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');
    $jadwal_konsultasi = $this->db->query('SELECT id,id_registrasi FROM jadwal_konsultasi WHERE id = ' . $id_jadwal_konsultasi)->row();
    $dokter = $this->db->query('SELECT id,name,reg_id FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
    $pasien = $this->db->query('SELECT reg_id,name FROM master_user WHERE id = ' . $id_pasien)->row();
    if ($jadwal_konsultasi) {
      $this->db->delete('jadwal_konsultasi', array('id' => $jadwal_konsultasi->id));
    } else {
      show_404();
    }
    $no_antrian = $this->db->query('SELECT id FROM no_antrian WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
    if ($no_antrian) {
      $this->db->delete('no_antrian', array('id' => $no_antrian->id));
    }

    $data_registrasi = $this->db->query('SELECT id FROM data_registrasi WHERE id = ' . $jadwal_konsultasi->id_registrasi);
    if ($data_registrasi) {
      $this->db->delete('data_registrasi', array('id' => $jadwal_konsultasi->id_registrasi));
    }

    if (is_dir(FCPATH . 'assets/files/attachments/' . $dokter->id . '_' . $id_pasien)) {
      $this->delete_dir(FCPATH . 'assets/files/attachments/' . $dokter->id . '_' . $id_pasien);
    }

    $notifikasi = 'Panggilan konsultasi dari Dokter ' . $dokter->name . ' berakhir';
    $now = (new DateTime('now'))->format('Y-m-d H:i:s');

    $data_notif = array("id_user" => $id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('pasien/Pasien/#'));
    $this->db->insert('data_notifikasi', $data_notif);
    $id_notif = $this->db->insert_id();
    $msg_notif = array(
      'name' => 'panggilan_konsultasi_berakhir_pasien',
      'id_notif' => $id_notif,
      'keterangan' => $notifikasi,
      'tanggal' => $now,
      'id_user' => json_encode(array($id_pasien)),
      'direct_link' => base_url('pasien/Pasien/#'),
    );
    $msg_notif = json_encode($msg_notif);

    $this->key->_send_fcm($pasien->reg_id, $msg_notif);

    $notifikasi_2 = 'Panggilan konsultasi dengan Pasien ' . $pasien->name . ' berakhir';
    $now_2 = (new DateTime('now'))->format('Y-m-d H:i:s');
    $data_konsultasi = $this->input->post('data_konsultasi') . '&' . $this->input->post('data_konsultasi_2');

    $data_notif_2 = array("id_user" => $dokter->id, "notifikasi" => $notifikasi_2, "tanggal" => $now_2, "direct_link" => base_url('dokter/Dashboard/#'));
    $this->db->insert('data_notifikasi', $data_notif_2);
    $id_notif = $this->db->insert_id();
    $msg_notif_2 = array(
      'name' => 'panggilan_konsultasi_berakhir_dokter',
      'id_notif' => $id_notif,
      'keterangan' => $notifikasi_2,
      'tanggal' => $now_2,
      'id_user' => json_encode(array($dokter->id)),
      'data_konsultasi' => $data_konsultasi,
      'chat_id' => $this->input->post('chat_id'),
      'direct_link' => base_url('dokter/Dashboard/#'),
    );
    $msg_notif_2 = json_encode($msg_notif_2);

    $this->key->_send_fcm($dokter->reg_id, $msg_notif_2);

    $data_history = array("activity" => "Konsultasi Berakhir", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $id_pasien);
    $this->db->insert('data_history_log_dokter', $data_history);

    echo 'OK';
  }

  public function cancel_call(){
    $id_dokter = $this->session->userdata('id_user');
    $id_pasien = $this->input->post('id_pasien');
    $pasien = $this->db->query('SELECT reg_id FROM master_user WHERE id = '.$id_pasien.' AND id_user_kategori = 0')->row();
    $msg_notif = array(
      'name'=>'reject_by_dokter',
      'keterangan'=>'Panggilan Konsultasi Dibatalkan',
      'tanggal'=>(new DateTime())->format('d-m-Y'),
      'id_user'=>json_encode(array($id_pasien)),
      'direct_link'=>'#'
    );
    $this->key->_send_fcm($pasien->reg_id, json_encode($msg_notif));

    $data_history = array("activity" => "Panggilan Konsultasi Dibatalkan", "id_user" => $id_dokter, "target_id_user" => $id_pasien);
    $this->db->insert('data_history_log_dokter', $data_history);

    echo "OK";
  }
}
