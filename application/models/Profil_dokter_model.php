<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_dokter_model extends CI_Model {
    public function get($limit, $start, $poli, $nama_dokter = ''){
        if($poli){
            $where = ' AND detail_dokter.id_poli = '.$poli;
        }
        else{
            $where = '';
        }
        $query = $this->db->query('SELECT master_user.*, detail_dokter.pengalaman_kerja, detail_dokter.id_poli, nominal.poli FROM master_user INNER JOIN detail_dokter ON master_user.id = detail_dokter.id_dokter INNER JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE id_user_kategori = 2 AND nominal.aktif = 1'.$nama_dokter.' AND master_user.aktif = 1'.$where.' LIMIT '.$limit.' OFFSET '.$start)->result();
        return $query;
    }
}