<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model{
    public function get_all($aktif = null, $limit = null){
        $this->db->select('
            nominal.poli,
            nominal.aktif as poli_aktif, 
            master_user.id, 
            master_user.name, 
            master_user.username, 
            IF(master_user.foto IS NULL or master_user.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", master_user.foto)) as foto,
            master_user.email, 
            master_user.telp, 
            master_user.aktif,
        ');
        $this->db->from('master_user');
        $this->db->join('detail_dokter', 'detail_dokter.id_dokter = master_user.id', 'inner');
        $this->db->join('nominal', 'nominal.id = detail_dokter.id_poli', 'inner');
        $this->db->where('master_user.id_user_kategori', 2);
        if($aktif != null){
            $this->db->where('master_user.aktif', $aktif);
        }
        if($limit != null){
            $this->db->limit($limit);
            $this->db->order_by('detail_dokter.pengalaman_kerja', 'ASC');
        }else{
            $this->db->order_by('master_user.created_at', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function get($id){
        $this->db->select('
            nominal.poli,
            nominal.aktif as poli_aktif, 
            master_user.id, 
            master_user.name, 
            master_user.username, 
            IF(master_user.foto IS NULL or master_user.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", master_user.foto)) as foto,
            master_user.email, 
            master_user.telp, 
            master_user.aktif,
        ');
        $this->db->from('master_user');
        $this->db->join('detail_dokter', 'detail_dokter.id_dokter = master_user.id', 'inner');
        $this->db->join('nominal', 'nominal.id = detail_dokter.id_poli', 'inner');
        $this->db->where('master_user.id_user_kategori', 2);
        $this->db->where('master_user.id', $id);

        return $this->db->get()->row();
    }

    public function count_all($aktif = null){
        $this->db->select('master_user.id');
        $this->db->from('master_user');
        $this->db->join('detail_dokter', 'detail_dokter.id_dokter = master_user.id', 'inner');
        $this->db->join('nominal', 'nominal.id = detail_dokter.id_poli', 'inner');
        $this->db->where('master_user.id_user_kategori', 2);

        return count($this->db->get()->result());
    }
}