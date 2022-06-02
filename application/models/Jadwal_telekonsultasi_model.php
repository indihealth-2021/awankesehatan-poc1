<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_telekonsultasi_model extends CI_Model{
    public function get_all_by_id_pasien($id_pasien, $dokter_aktif = null, $limit = null){
        $this->db->select('jk.id, jk.tanggal, jk.jam, d.name as nama_dokter, d.foto as foto_dokter, d.id as id_dokter, n.poli');
        $this->db->from('jadwal_konsultasi as jk');
        $this->db->join('master_user as d', 'jk.id_dokter = d.id', 'inner');
        $this->db->join('detail_dokter as dd', 'dd.id_dokter = d.id', 'inner');
        $this->db->join('nominal as n', 'dd.id_poli = n.id', 'inner');
        $this->db->where('id_pasien', $id_pasien);
        if($dokter_aktif != null){
            $this->db->where('d.aktif', $dokter_aktif);
        }
        $this->db->order_by('jk.tanggal', 'asc');
        $this->db->order_by('jk.jam', 'asc');
        if($limit != null){
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    public function get_all_by_id_dokter($id_dokter, $pasien_aktif = null, $limit = null){
        $this->db->select('jk.id, jk.tanggal, jk.jam, p.name as nama_pasien, p.foto as foto_pasien, p.id as id_pasien, n.poli');
        $this->db->from('jadwal_konsultasi as jk');
        $this->db->join('master_user as p', 'jk.id_pasien = p.id', 'inner');
        $this->db->join('master_user as d', 'jk.id_dokter = d.id', 'inner');
        $this->db->join('detail_dokter as dd', 'dd.id_dokter = d.id', 'inner');
        $this->db->join('nominal as n', 'dd.id_poli = n.id', 'inner');
        $this->db->where('d.id', $id_dokter);
        if($pasien_aktif != null){
            $this->db->where('p.aktif', $pasien_aktif);
        }
        $this->db->order_by('jk.tanggal', 'asc');
        $this->db->order_by('jk.jam', 'asc');
        if($limit != null){
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    public function get_dokter($id_pasien){
        $this->db->select('
            dokter.name,
            dokter.username,
            dokter.email,
            dokter.str,
            IF(dokter.aktif = 1, "Aktif", "<font color=\'red\'>Tidak Aktif</font>") as aktif,
            IF(dokter.foto IS NULL or dokter.foto = "", "'.base_url('assets/dashboard/img/user.jpg').'", CONCAT("'.base_url('assets/images/users/').'", dokter.foto)) as foto,
            n.poli,
            n.aktif as poli_aktif
        ');
        $this->db->from('jadwal_konsultasi as jk');
        $this->db->join('master_user as dokter', 'jk.id_dokter = dokter.id', 'inner');
        $this->db->join('detail_dokter as dd', 'dd.id_dokter = dokter.id', 'inner');
        $this->db->join('nominal as n', 'n.poli = dd.id_poli');
        $this->db->order_by('jk.tanggal', 'ASC');

        return $this->db->get()->result();
    }
}