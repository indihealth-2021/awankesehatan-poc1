<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_dokter_model extends CI_Model{
    public function get_all($id_dokter = null, $poli = null, $dokter_aktif = null, $limit = null){
        $this->db->select('
            jd.id as id, 
            jd.waktu as waktu, 
            jd.tanggal as tanggal, 
            jd.hari as hari ,
            d.name as nama_dokter, 
            d.foto as foto_dokter,
            jd.poli
        ');
        $this->db->from('jadwal_dokter as jd');
        $this->db->join('master_user as d', 'jd.id_dokter = d.id', 'inner');
        $this->db->where('jd.aktif = 1');
        if($id_dokter){
            $this->db->where('jd.id_dokter', $id_dokter);
        }
        if($poli){
            $this->db->where('jd.poli', $poli);
        }
        if($dokter_aktif){
            $this->db->where('d.aktif', $dokter_aktif);
        }
        $this->db->order_by('jd.tanggal', 'asc');
        $this->db->order_by('jd.hari', 'desc');
        $this->db->order_by('jd.waktu', 'asc');
        if($limit){
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }
}