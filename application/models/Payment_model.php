<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model {
	public function get_dataPayment($where = null, $order_by = 'bukti_pembayaran.updated_at DESC, bukti_pembayaran.created_at DESC')
	{
		$this->db->select('master_user.name, master_user.email, master_user.lahir_tempat, master_user.lahir_tanggal, master_user.jenis_kelamin, master_user.alamat_jalan, master_user.alamat_kelurahan, master_user.telp, data_registrasi.*, bukti_pembayaran.id as id_bukti, bukti_pembayaran.id_dokter, bukti_pembayaran.photo, bukti_pembayaran.status, bukti_pembayaran.biaya_adm, bukti_pembayaran.biaya_konsultasi, bukti_pembayaran.created_at as tanggal_upload_pembayaran, jadwal_dokter.poli as poli_dokter, d.name as name_dokter');
		$this->db->from('data_registrasi');
		$this->db->join('jadwal_dokter', 'data_registrasi.id_jadwal = jadwal_dokter.id', 'LEFT');
		$this->db->join('master_user as d', 'jadwal_dokter.id_dokter = d.id');
		$this->db->join('master_user', 'master_user.id = data_registrasi.id_pasien', 'LEFT');
		$this->db->join('bukti_pembayaran', 'bukti_pembayaran.id_registrasi = data_registrasi.id', 'RIGHT');
		if($where != null)
		{
			$this->db->where($where);
		}
		$this->db->order_by($order_by);
		$result = $this->db->get()->result();
		return $result;
	}
}
