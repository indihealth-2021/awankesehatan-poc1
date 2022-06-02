<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekam_medis_model extends CI_Model{
    public function get_all_by_id_dokter($id_dokter, $id_pasien = null, $pasien_aktif = null, $limit = null){
        $this->db->select('
            bukti_pembayaran.tanggal_konsultasi, 
            resep_dokter.id_jadwal_konsultasi, 
            assesment.id_jadwal_konsultasi, 
            diagnosis_dokter.id_jadwal_konsultasi, 
            resep_dokter.created_at, 
            resep_dokter.id_pasien, 
            assesment.id_pasien, 
            diagnosis_dokter.id_pasien, 
            resep_dokter.id_dokter, 
            assesment.id_dokter, 
            diagnosis_dokter.id_dokter, 
            p.name as nama_pasien, 
            p.foto as foto_pasien,
            p.id as id_pasien, 
            md.nama as diagnosis, 
            md.id as diagnosis_code, 
            d.name as nama_dokter, 
            nominal.poli, 
            dp.no_medrec'
        );
        $this->db->from('(assesment, diagnosis_dokter)');
        $this->db->join('master_user as p', 'assesment.id_pasien = p.id', 'inner');
        $this->db->join('master_user as d', 'assesment.id_dokter = d.id', 'inner');
        $this->db->join('detail_dokter as ddr', 'd.id = ddr.id_dokter', 'left');
        $this->db->join('nominal', 'ddr.id_poli = nominal.id', 'left');
        $this->db->join('detail_pasien as dp', 'dp.id_pasien = p.id', 'left');
        $this->db->join('master_diagnosa as md', 'md.id = diagnosis_dokter.diagnosis', 'left');
        $this->db->join('bukti_pembayaran', 'bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi', 'left');
        $this->db->join('resep_dokter', 'resep_dokter.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi', 'left');
        $this->db->where('diagnosis_dokter.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi');
        $this->db->where('assesment.id_dokter', $id_dokter);
        if($id_pasien){
            $this->db->where('assesment.id_pasien', $id_pasien);
        }
        if($pasien_aktif){
            $this->db->where('p.aktif', $pasien_aktif);
        }
        $this->db->group_by('assesment.id_jadwal_konsultasi');
        $this->db->group_by('assesment.id_pasien');
        $this->db->order_by('bukti_pembayaran.tanggal_konsultasi', 'DESC');
        $this->db->order_by('diagnosis_dokter.created_at', 'DESC');
        if($limit){
            $this->db->limit($limit);
        }
        // $this->db->get();
        // var_dump($this->db->error());

        $result = $this->db->get();
	    return $result->result();
    }
}
