<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_jadwal_model extends CI_Model {
        public function get_all($id_layanan, $date) {
                $this->db->select('
                        master_kota.id, 
                        master_kota.nama AS nama_kota, 
                        master_provinsi.nama AS nama_provinsi, 
                        GROUP_CONCAT(CASE WHEN master_user.id_user_level = 1 THEN master_user.nama ELSE NULL END SEPARATOR "<br>") AS pengampu_nasional,
                        GROUP_CONCAT(CASE WHEN master_user.id_user_level = 2 THEN master_user.nama ELSE NULL END SEPARATOR "<br>") AS pengampu_provinsi,
                        GROUP_CONCAT(CASE WHEN master_user.id_user_level = 3 THEN master_user.nama ELSE NULL END SEPARATOR "<br>") AS pengampu_kota
                ');

                $this->db->from('master_kota');

                $this->db->join('master_provinsi', 'master_kota.id_provinsi = master_provinsi.id');
                $this->db->join('data_jadwal', 'master_kota.id = data_jadwal.id_kota AND data_jadwal.tanggal = "'.$date.'"', 'LEFT');
                $this->db->join('data_akses_layanan', 'data_jadwal.id_akses_layanan = data_akses_layanan.id AND data_akses_layanan.id_layanan = "'.$id_layanan.'"', 'LEFT');
                $this->db->join('master_user', 'data_akses_layanan.id_user = master_user.id AND master_user.id_user_level IS NOT NULL', 'LEFT');
                
                // $this->db->where('master_kota.id in(SELECT id_kota FROM master_fasyankes)');
                $this->db->where('master_kota.id in(SELECT id_kota FROM master_fasyankes where aktif = 1)');
                $this->db->where('master_kota.aktif', 1);
                $this->db->where('master_provinsi.aktif', 1);
                
                $this->db->group_by('master_kota.id');

                $query = $this->db->get();
                $result = $query->result();

                return $result;
        }

        public function get_detail($data) {
                $this->db->select('
                        master_user.*, 
                        data_akses_layanan.id AS id_akses_layanan, 
                        data_jadwal.id AS id_jadwal, 
                        app_user_kategori.nama AS nama_jenis, 
                        app_user_level.nama AS nama_level
                ');
                
                $this->db->from('master_user');
                
                $this->db->join('app_user_level', 'master_user.id_user_level = app_user_level.id');
                $this->db->join('app_user_kategori', 'master_user.id_user_kategori = app_user_kategori.id AND app_user_kategori.id_parent IS NOT NULL');
                $this->db->join('master_fasyankes', 'master_user.id_fasyankes = master_fasyankes.id');
                $this->db->join('master_kota', 'master_fasyankes.id_kota = master_kota.id');
                $this->db->join('data_akses_layanan', 'master_user.id = data_akses_layanan.id_user AND data_akses_layanan.id_layanan = "'.$data['id_layanan'].'"');
                $this->db->join('data_jadwal', 'data_akses_layanan.id = data_jadwal.id_akses_layanan AND data_jadwal.tanggal = "'.$data['date'].'" AND data_jadwal.id_kota = "'.$data['id_kota'].'"', 'LEFT');

                $this->db->where('master_user.aktif', 1);
                $this->db->where('app_user_level.id', 1);
                $this->db->or_where('master_fasyankes.id_kota', $data['id_kota']);
                $this->db->where('app_user_level.id', 3);
                $this->db->where('master_user.aktif', 1);
                $this->db->or_where('master_kota.id_provinsi', $data['id_provinsi']);
                $this->db->where('app_user_level.id', 2);
                $this->db->where('master_user.aktif', 1);

                $this->db->order_by('app_user_level.id', 'ASC');

                $this->db->group_by('master_user.id');

                $query = $this->db->get();
                $result = $query->result();

                return $result;
        }

        public function delete_jadwal($data) {
                $query = 'DELETE data_jadwal 
                          FROM data_jadwal 
                                JOIN data_akses_layanan ON data_jadwal.id_akses_layanan = data_akses_layanan.id
                          WHERE data_jadwal.id_kota = "'. $data['id_kota'] .'" AND 
                                data_jadwal.tanggal = "'. $data['date'] .'" AND
                                data_akses_layanan.id_layanan = "'.$data['id_layanan'].'"';

                $this->db->query($query);
                
                return $this->db->affected_rows();
        }
	public function get_jadwal_dokter($where)
	{
		$this->db->select('master_user.*, master_user.aktif as user_aktif, jadwal_dokter.*, jadwal_dokter.aktif as jadwal_aktif, nominal.aktif as poli_aktif');
		$this->db->from('jadwal_dokter');
                $this->db->join('master_user', 'master_user.id = jadwal_dokter.id_dokter', 'LEFT');
                $this->db->join('nominal', 'jadwal_dokter.poli = nominal.poli', 'LEFT');
		//$this->db->where('master_user.email', $where['master_user.email']);
		//$this->db->or_where('master_user.username', $where['master_user.email']);
                $this->db->where('master_user.id_user_kategori', $where['master_user.id_user_kategori']);
                $this->db->order_by('jadwal_dokter.tanggal','DESC');
                $this->db->order_by('jadwal_dokter.hari', 'DESC');
                $result = $this->db->get()->result();

		return $result;
	}
	public function get_jadwal_dokter_by_id($where)
	{
		$this->db->select('master_user.*, master_user.aktif as user_aktif, jadwal_dokter.*, jadwal_dokter.aktif as jadwal_aktif');
		$this->db->from('jadwal_dokter');
		$this->db->join('master_user', 'master_user.id = jadwal_dokter.id_dokter', 'LEFT');
		//$this->db->where('master_user.email', $where['master_user.email']);
		//$this->db->or_where('master_user.username', $where['master_user.email']);
		$this->db->where('jadwal_dokter.id', $where['jadwal_dokter.id']);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function getAll_antrian_pasien($where = null)
	{
		$this->db->select('no_antrian.*, b.name as name_dokter, c.name as name_pasien, jk.tanggal, jk.jam');
		$this->db->from('no_antrian');
		$this->db->join('master_user b', 'b.id = no_antrian.id_dokter');
		$this->db->join('master_user c', 'c.id = no_antrian.id_pasien');
		$this->db->join('jadwal_konsultasi jk', 'jk.id = no_antrian.id_jadwal_konsultasi');
		$this->db->order_by('no_antrian.antrian');
        if($where != null)
        {
            $this->db->where($where);
        }
		$result = $this->db->get()->result();

		return $result;
	}
}