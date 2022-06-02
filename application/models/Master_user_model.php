<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_user_model extends CI_Model {
        public function get_layanan_user($user_id) {
                $this->db->select('app_layanan.*');
                $this->db->from('app_layanan');
                $this->db->join('data_akses_layanan', 'app_layanan.id = data_akses_layanan.id_layanan');
                $this->db->where('data_akses_layanan.id_user', $user_id);
                $this->db->group_by('app_layanan.id');

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