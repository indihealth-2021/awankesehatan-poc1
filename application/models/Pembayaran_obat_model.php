<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_obat_model extends CI_Model{
    public function get_all_history($nama_pasien = null, $nama_dokter = null, $limit = null, $offset = null){
        $this->db->select("
            resep_dokter.id, 
            resep_dokter.created_at, 
            bpo.foto as foto_bukti, 
            bpo.status as status_bukti, 
            bpo.created_at as tanggal_pembayaran, 
            bpo.id as id_bukti, 
            bpo.id_payment,
            bpo.claim_number, 
            bpo.va_number,
            bpo.metode_pembayaran, 
            resep_dokter.id_jadwal_konsultasi, 
            d.name as nama_dokter, 
            nominal.poli as nama_poli, 
            p.name as nama_pasien, 
            biaya_pengiriman_obat.biaya_pengiriman, 
            GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, 
            GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, 
            GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat, 
            bukti_pembayaran.tanggal_konsultasi 
        ");
        $this->db->from('resep_dokter');

        $this->db->join('master_obat', 'resep_dokter.id_obat = master_obat.id', 'left');
        $this->db->join('master_user as d', 'resep_dokter.id_dokter = d.id', 'left');
        $this->db->join('detail_dokter', 'detail_dokter.id_dokter = d.id', 'left');
        $this->db->join('nominal', 'nominal.id = detail_dokter.id_poli', 'left');
        $this->db->join('master_user as p', 'resep_dokter.id_pasien = p.id', 'left');
        $this->db->join('bukti_pembayaran_obat as bpo', 'resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi', 'inner');
        // $this->db->join('master_kategori_obat as mko', 'master_obat.id_kategori_obat = mko.id', 'left');
        $this->db->join('biaya_pengiriman_obat', 'biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi', 'inner');
        $this->db->join('diagnosis_dokter', 'diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi', 'inner');
        $this->db->join('bukti_pembayaran', 'bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi', 'inner');
        $this->db->where('bukti_pembayaran.status = 1');
        // $this->db->where('bpo.status != 0');
        if($nama_pasien){
            $this->db->like('p.name', $nama_pasien);
        }

        if($nama_dokter){
            $this->db->like('d.name', $nama_dokter);
        }

        $this->db->group_by('resep_dokter.id_jadwal_konsultasi');
        $this->db->order_by('bukti_pembayaran.tanggal_konsultasi', 'DESC');
        $this->db->order_by('bpo.created_at', 'DESC');

        if($limit && $offset){
            $this->db->limit($limit, $offset);
        }else if($limit){
            $this->db->limit($limit);
        }
        
        return $this->db->get()->result();
    }
}