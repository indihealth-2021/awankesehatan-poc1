<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assesment_model extends CI_Model {
        public function get_all_by_id_dokter($id_dokter, $konsultasi = null, $id_pasien = null, $pasien_aktif = null, $limit = null){
                $this->db->distinct();
                $this->db->select('
                        assesment.*, 
                        p.name as nama_pasien,
                        p.foto as foto_pasien
                ');
                $this->db->from('assesment');
                $this->db->join('master_user as p', 'assesment.id_pasien = p.id', 'inner');
                if($konsultasi){
                        $this->db->join('jadwal_konsultasi as jk', 'assesment.id_pasien = jk.id_pasien', 'inner');
                }
                $this->db->where('assesment.id_dokter', $id_dokter);
                if($id_pasien){
                        $this->db->where('assesment.id_pasien', $id_pasien);
                }
                if($pasien_aktif){
                        $this->db->where('p.aktif', $pasien_aktif);
                }
                $this->db->order_by('p.name', 'ASC');
                if($limit){
                        $this->db->limit($limit);
                }

                return $this->db->get()->result();
        }

        public function get_by_konsultasi($id, $id_dokter = null){
                $this->db->select('
                        assesment.*,
                        p.name as nama_pasien
                ');
                $this->db->from('assesment');
                $this->db->join('master_user as p', 'assesment.id_pasien = p.id', 'left');
                $this->db->where('assesment.id', $id);
                if($id_dokter){
                        $this->db->where('assesment.id_dokter', $id_dokter);
                }

                return $this->db->get()->row();
        }

        public function get_by_id_pasien($id_pasien){
                $this->db->select('*');
                $this->db->from('assesment');
                $this->db->where('id_pasien', $id_pasien);
                $this->db->order_by('created_at', 'DESC');

                return $this->db->get()->row();
        }

        public function get_dokter($id_pasien){
                $this->db->select('
                    dokter.name,
                    dokter.username,
                    dokter.email,
                    dokter.str,
                    dokter.telp,
                    IF(dokter.aktif = 1, "<span class=\'status-aktif\'>Aktif</span>", "<span class=\'status-nonaktif\'>Tidak Aktif</span>") as aktif,
                    IF(dokter.foto IS NULL or dokter.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", dokter.foto)) as foto,
                    n.poli,
                    n.aktif as poli_aktif
                ');
                $this->db->from('assesment');
                $this->db->join('master_user as dokter', 'assesment.id_dokter = dokter.id', 'inner');
                $this->db->join('detail_dokter as dd', 'dd.id_dokter = dokter.id', 'inner');
                $this->db->join('nominal as n', 'n.id = dd.id_poli', 'inner');
                $this->db->where('assesment.id_pasien', $id_pasien);
                $this->db->order_by('assesment.created_at', 'DESC');
        
                return $this->db->get()->result();
        }
        public function get_data($where = null) {
                $this->db->select('assesment.*, master_user.name, master_user.email, master_user.lahir_tempat, master_user.lahir_tanggal, master_user.jenis_kelamin, master_user.alamat_jalan, pendaftaran.id_jadwal');
                $this->db->from('assesment');
                $this->db->join('master_user', 'master_user.id = assesment.id_pasien');
		$this->db->join('pendaftaran', 'pendaftaran.id_pasien = assesment.id_pasien');

                if($where != null)
                {
                        $this->db->where($where);
                }
                $query = $this->db->get();
                $result = $query->result();

                return $result;
        }

        public function get_user() {
                $this->db->select('master_user.*, GROUP_CONCAT(app_layanan.nama SEPARATOR ", ") as layanan');
                $this->db->from('master_user');
                $this->db->join('data_akses_layanan', 'master_user.id = data_akses_layanan.id_user');
                $this->db->join('app_layanan', 'data_akses_layanan.id_layanan = app_layanan.id');
                $this->db->group_by('master_user.id');

                $query = $this->db->get();
                $result = $query->result();

                return $result;
        }
}