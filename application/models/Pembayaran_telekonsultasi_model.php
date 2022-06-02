<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_telekonsultasi_model extends CI_Model{
    public function get_all_history($nama_pasien = null, $nama_dokter = null, $limit = null, $offset = null){
        $this->db->select('
            jadwal_konsultasi.tanggal as tanggal_konsultasi_b, 
            bukti_pembayaran.tanggal_konsultasi as tanggal_konsultasi_s, 
            d.name as nama_dokter, 
            p.name as nama_pasien, 
            bukti_pembayaran.photo, 
            bukti_pembayaran.status, 
            bukti_pembayaran.metode_pembayaran, 
            bukti_pembayaran.id_payment,
            bukti_pembayaran.claim_number, 
            bukti_pembayaran.va_number,
            nominal.harga as harga_poli, 
            bukti_pembayaran.biaya_adm, 
            bukti_pembayaran.biaya_konsultasi, 
            bukti_pembayaran.created_at as tanggal_pembayaran
        ');
        $this->db->from('bukti_pembayaran');
        $this->db->join('master_user as p', 'bukti_pembayaran.id_pasien = p.id', 'left');
        $this->db->join('master_user as d', 'bukti_pembayaran.id_dokter = d.id', 'left');
        $this->db->join('detail_dokter', 'detail_dokter.id_dokter = d.id', 'left');
        $this->db->join('nominal', 'detail_dokter.id_poli = nominal.id', 'left');
        $this->db->join('jadwal_konsultasi', 'jadwal_konsultasi.id_registrasi = bukti_pembayaran.id_registrasi', 'left');
        $this->db->where('bukti_pembayaran.status != 0');
        if($nama_pasien){
            $this->db->like('p.name', $nama_pasien);
        }

        if($nama_dokter){
            $this->db->like('d.name', $nama_dokter);
        }

        $this->db->order_by('tanggal_konsultasi_b', 'DESC');
        $this->db->order_by('tanggal_konsultasi_s', 'DESC');
        $this->db->order_by('bukti_pembayaran.created_at', 'DESC');

        if($limit && $offset){
            $this->db->limit($limit, $offset);
        }else if($limit){
            $this->db->limit($limit);
        }

        // var_dump($this->db->get()->result());
        // die;
        return $this->db->get()->result();
    }
}