<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminApotek_model extends CI_Model{
    public function get_all($aktif = null, $limit = null){
        $this->db->select('
            master_user.id,
            master_user.name,
            master_user.username,
            master_user.email,
            master_user.telp,
            master_user.aktif,
            master_user.alamat_jalan,
            master_provinsi.name as alamat_provinsi,
            master_kota.name as alamat_kota,
            master_kelurahan.name as alamat_kelurahan,
            master_kecamatan.name as alamat_kecamatan,
            master_apotek.nama as nama_apotek,
            IF(master_user.foto IS NULL or master_user.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", master_user.foto)) as foto,
        ');

        $this->db->from('master_user');
        $this->db->join('master_provinsi', 'master_user.alamat_provinsi = master_provinsi.id', 'left');
        $this->db->join('master_kota', 'master_user.alamat_kota = master_kota.id', 'left');
        $this->db->join('master_kelurahan', 'master_user.alamat_kelurahan = master_kelurahan.id', 'left');
        $this->db->join('master_kecamatan', 'master_user.alamat_kecamatan = master_kecamatan.id', 'left');
        $this->db->join('master_apotek', 'master_user.id_apotek = master_apotek.id', "left");
        $this->db->where('id_user_kategori', 5);
        $this->db->where("id_user_level", 2);

        if($aktif != null){
            $this->db->where('master_user.aktif', $aktif);
        }
        $this->db->order_by('master_user.created_at', 'DESC');
        if($limit != null){
            $this->db->limit($limit);
        }
        return $this->db->get()->result();
    }

    public function get_by_id($id){
        $this->db->select('
            master_user.id,
            master_user.name,
            master_user.username,
            master_user.email,
            master_user.telp,
            master_user.lahir_tanggal,
            IF(master_user.aktif = 1, "Aktif", "<font color=\'red\'>Tidak Aktif</font>") as aktif,
            IF(master_user.foto IS NULL or master_user.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", master_user.foto)) as foto,
        ');
        $this->db->from('master_user');
        $this->db->where('master_user.id_user_kategori', 55);
        $this->db->where('master_user.id', $id);

        return $this->db->get()->row();
    }

    public function count_all($aktif = null){
        $this->db->select('id');
        $this->db->from('master_user');
        $this->db->where('id_user_kategori', 55);

        return count($this->db->get()->result());
    }
}
