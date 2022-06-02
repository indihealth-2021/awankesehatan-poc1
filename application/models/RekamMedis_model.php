<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekamMedis_model extends CI_Model{
    public function get_by_pasien($id_pasien){
        $this->db->select('bukti_pembayaran.tanggal_konsultasi, 
                            resep_dokter.id_jadwal_konsultasi, 
                            assesment.id_jadwal_konsultasi, 
                            diagnosis_dokter.id_jadwal_konsultasi, 
                            assesment.created_at, 
                            resep_dokter.id_pasien, 
                            assesment.id_pasien, 
                            diagnosis_dokter.id_pasien, 
                            resep_dokter.id_dokter, 
                            assesment.id_dokter, 
                            diagnosis_dokter.id_dokter, 
                            md.nama as diagnosis, 
                            md.id as diagnosis_code, 
                            d.name as nama_dokter, 
                            nominal.poli, 
                            resep_dokter.diverifikasi as resep_verif, 
                            resep_dokter.dirilis as resep_rilis');
        $this->db->from('(resep_dokter, assesment, diagnosis_dokter)');
        $this->db->join('master_user as d', 'd.id = diagnosis_dokter.id_dokter', 'inner');
        $this->db->join('detail_dokter as ddr', 'd.id = ddr.id_dokter', 'left');
        $this->db->join('nominal', 'ddr.id_poli = nominal.id', 'left');
        $this->db->join('master_diagnosa as md', 'md.id = diagnosis_dokter.diagnosis');
        $this->db->join('bukti_pembayaran', 'bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi');
        $this->db->where('resep_dokter.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi AND 
                            resep_dokter.id_jadwal_konsultasi = diagnosis_dokter.id_jadwal_konsultasi AND 
                            resep_dokter.id_pasien = '.$id_pasien.' AND 
                            assesment.id_pasien = '.$id_pasien.' AND 
                            diagnosis_dokter.id_pasien = '.$id_pasien);
        $this->db->group_by('resep_dokter.id_jadwal_konsultasi');
        $this->db->order_by('diagnosis_dokter.created_at', 'desc');

        $result = $this->db->get();
	return $result ? $result->result:[];
    }

    public function get($id_pasien, $id_jadwal_konsultasi){
        $this->db->select('bukti_pembayaran.tanggal_konsultasi, bukti_pembayaran_obat.order_status, md.nama as diagnosis, md.id as diagnosis_code, diagnosis_dokter.id_registrasi, diagnosis_dokter.created_at, assesment.keluhan, GROUP_CONCAT("<li>",master_obat.name, " ( ",resep_dokter.jumlah_obat, " ",master_obat.unit," ) " , " ( ",resep_dokter.keterangan," ) </li>" SEPARATOR "") as list_obat, p.name as nama_pasien, p.lahir_tanggal as tanggal_lahir_pasien, p.lahir_tempat as tempat_lahir_pasien, p.jenis_kelamin as jk_pasien,d.name as nama_dokter, nominal.poli, dp.no_medrec');
        $this->db->from('(diagnosis_dokter, assesment, resep_dokter)');
        $this->db->join('master_obat', 'resep_dokter.id_obat = master_obat.id', 'inner');
        $this->db->join('master_user as p', 'resep_dokter.id_pasien = p.id', 'inner');
        $this->db->join('master_user as d', 'resep_dokter.id_dokter = d.id', 'inner');
        $this->db->join('detail_dokter as ddr', 'd.id = ddr.id_dokter', 'left');
        $this->db->join('nominal', 'ddr.id_poli = nominal.id', 'left');
        $this->db->join('detail_pasien as dp', 'p.id = dp.id_pasien', 'left');
        $this->db->join('master_diagnosa as md', 'md.id = diagnosis_dokter.diagnosis', 'left');
        $this->db->join('bukti_pembayaran_obat', 'bukti_pembayaran_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi', 'left');
        $this->db->join('bukti_pembayaran', 'bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi', 'left');
        $this->db->where('diagnosis_dokter.id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' AND assesment.id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' AND resep_dokter.id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' AND diagnosis_dokter.id_pasien = '.$id_pasien.' AND resep_dokter.id_pasien = '.$id_pasien.' AND assesment.id_pasien = '.$id_pasien);

        return $this->db->get()->row();
    }
}
