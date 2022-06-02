<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_konsultasi extends CI_Model {
	public function get_join($id_dokter)
	{
		$this->db->select('master_user.name as nama_dokter, master_user.id, master_user.foto, data_pasien.*, jadwal_dokter.*');
		$this->db->from('master_user');
		$this->db->join('jadwal_dokter', 'master_user.id = jadwal_dokter.id_dokter', 'left');
		$this->db->join('pendaftaran', 'pendaftaran.id_jadwal = jadwal_dokter.id', 'left');
		$this->db->join('data_pasien', 'data_pasien.id = pendaftaran.id_pasien', 'left');
		$this->db->where('jadwal_dokter.id_dokter', $id_dokter);
		$data = $this->db->get();
		return $data->result();
	}
}