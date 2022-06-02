<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_obat_model extends CI_Model{
    public function count_all($aktif = null){
        $this->db->select('id');
        $this->db->from('master_obat');
        if($aktif != null){
            $this->db->where('active', $aktif);
        }

        return count($this->db->get()->result());
    }
}