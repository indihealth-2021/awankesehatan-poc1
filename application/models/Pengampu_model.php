<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengampu_model extends CI_Model{
    public function get($id){
        $this->db->select('id,reg_id,name,username,email,aktif,foto');
        $this->db->from('master_user');
        $this->db->where('id_user_kategori = 6 AND id_user_level = 2 AND aktif = 1 AND id = '.$id);

        return $this->db->get()->row();
    }

    public function get_all(){
        $this->db->select('id,reg_id,name,username,email,aktif,foto');
        $this->db->from('master_user');
        $this->db->where('id_user_kategori = 6 AND id_user_level = 2 AND aktif = 1');

        return $this->db->get()->result();
    }
}