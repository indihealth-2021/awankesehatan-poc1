<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Admin_model extends CI_Model{
    public function get_all($aktif = null, $limit = null){
        $this->db->select('
            master_user.id,
            master_user.name,
            master_user.username,
            master_user.telp,
            master_user.email,
            master_user.telp,
            master_user.aktif,
            master_user.alamat_jalan,
            master_provinsi.name as alamat_provinsi,
            master_kota.name as alamat_kota,
            master_kelurahan.name as alamat_kelurahan,
            master_kecamatan.name as alamat_kecamatan,
            IF(master_user.foto IS NULL or master_user.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", master_user.foto)) as foto,
        ');
        $this->db->from('master_user');
        $this->db->join('master_provinsi', 'master_user.alamat_provinsi = master_provinsi.id', 'left');
        $this->db->join('master_kota', 'master_user.alamat_kota = master_kota.id', 'left');
        $this->db->join('master_kelurahan', 'master_user.alamat_kelurahan = master_kelurahan.id', 'left');
        $this->db->join('master_kecamatan', 'master_user.alamat_kecamatan = master_kecamatan.id', 'left');
        $this->db->where('id_user_kategori', 5);
        if($aktif != null){
            $this->db->where('master_user.aktif', $aktif);
        }
        if($limit != null){
            $this->db->limit($limit);
        }
        $this->db->order_by('master_user.created_at', 'DESC');

        return $this->db->get()->result();
    }
    public function get_all_paginate(){
        $this->datatables->select('
            id,
            name,
            username,
            email,
            telp,
            aktif
        ');
        $this->datatables->from('master_user');
        $this->datatables->where('id_user_kategori', 5);
        $this->datatables->add_column('view', '<a class="border-bottom mx-3" href="'.base_url().'admin/Admin/tampilEditAdmin/$1"><i class="fas fa-pen font-16"></i></a> <a class="font-icon" href="#modalHapus" data-toggle="modal" data-href="'.base_url().'admin/Admin/hapusAdmin/$2" data-nama="$3" onclick="$(\'#modalHapus #form\')" ><i class="fas fa-trash fa-lg font-16"></i></a>', 'id,id,name');

        $data = json_decode($this->datatables->generate());

        return json_encode($data);
    }

    public function count_all($aktif = null){
        $this->db->select('id');
        $this->db->from('master_user');
        $this->db->where('id_user_kategori', 5);

        return count($this->db->get()->result());
    }
}