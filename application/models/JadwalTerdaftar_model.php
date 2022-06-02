<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalTerdaftar_model extends CI_Model{
    public function get_all_by_id_pasien($id_pasien, $poli = null, $limit = null){
        $this->db->select('
                            dr.id, 
                            dr.id_jadwal, 
                            jd.waktu, 
                            jd.hari, 
                            jd.tanggal, 
                            d.name as nama_dokter, 
                            d.foto as foto_dokter,
                            dr.id_status_pembayaran, 
                            n.harga, 
                            jd.poli, 
                            n.biaya_adm as biaya_adm_poli, 
                            bukti_pembayaran.metode_pembayaran,
                            bukti_pembayaran.status as status_bukti,
                            bukti_pembayaran.biaya_adm as biaya_adm_bukti, 
                            bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti'
                        );
        $this->db->from('data_registrasi as dr');
        $this->db->join('jadwal_dokter as jd', 'dr.id_jadwal = jd.id', 'inner');
        $this->db->join('master_user as d', 'jd.id_dokter = d.id', 'inner');
        $this->db->join('nominal as n', 'jd.poli = n.poli', 'inner');
        $this->db->join('bukti_pembayaran', 'dr.id = bukti_pembayaran.id_registrasi', 'left');
        $this->db->where('dr.id_pasien', $id_pasien);
        // $this->db->where('(bukti_pembayaran.status IS NULL OR bukti_pembayaran.status != 2)');
        if($poli != null){
            $this->db->where('jd.poli', $poli);
        }
        $this->db->order_by('jd.hari','DESC');
        $this->db->order_by('jd.waktu', 'ASC');
        if($limit != null){
            $this->db->limit($limit);
        }
        $this->db->where('(bukti_pembayaran.status != 2 OR bukti_pembayaran.status IS NULL)');
        // $this->db->group_by('bukti_pembayaran.id_registrasi');

        // var_dump($this->db->get()->result());
        // die;
        return $this->db->get()->result();
    }
}