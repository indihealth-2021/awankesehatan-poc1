<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmp extends CI_Controller {

	public function __construct() {
        parent::__construct();       
    }

    public function ks(){ // Kosongkan Semua
        echo var_dump("PAGE LOCKED");
        die;
        $pwd = $this->input->get('password');
        if($pwd != 'rdzsp'){
            show_404();
        }
        $this->db->empty_table('assesment');
        $this->db->empty_table('biaya_pengiriman_obat');
        $this->db->empty_table('bukti_pembayaran');
        $this->db->empty_table('bukti_pembayaran_obat');
        $this->db->empty_table('data_history_log_dokter'); 
        $this->db->empty_table('data_notifikasi');
        $this->db->empty_table('data_registrasi');
        $this->db->empty_table('detail_dokter');
        $this->db->empty_table('detail_pasien');
        $this->db->empty_table('diagnosis_dokter');
        $this->db->empty_table('jadwal_dokter');
        $this->db->empty_table('jadwal_konsultasi');
        $this->db->empty_table('log_activity');
        $this->db->empty_table('no_antrian');
        $this->db->empty_table('resep_dokter');

        $files_bp = glob('./assets/images/bukti_pembayaran');
        foreach($files_bp as $file_bp){
            if(is_file($file_bp)){
                unlink($file_bp);
            }
        }
        
        $files_bpo = glob('./assets/images/bukti_pembayaran_obat');
        foreach($files_bpo as $file_bpo){
            if(is_file($file_bpo)){
                unlink($file_bpo);
            }
        }

        $files_fu = glob('./assets/images/users');
        foreach($files_fu as $file_fu){
            if(is_file($file_fu)){
                unlink($file_fu);
            }
        }

        $files_att = glob('./assets/files/attachments');
        foreach($files_att as $file_att){
            if(is_file($file_att)){
                unlink($file_att);
            }
            else{
                _deleteDir($file_att);
            }
        }

        echo "OK";
    }

    public function ksku(){ // Kosongkan Semua Kecuali User
        // echo var_dump("PAGE LOCKED");
        // die;
        $pwd = $this->input->get('password');
        if($pwd != 'rdzsp'){
            show_404();
        }
        $this->db->empty_table('assesment');
        $this->db->empty_table('biaya_pengiriman_obat');
        $this->db->empty_table('bukti_pembayaran');
        $this->db->empty_table('bukti_pembayaran_obat');
        $this->db->empty_table('data_history_log_dokter'); 
        $this->db->empty_table('data_notifikasi');
        $this->db->empty_table('data_registrasi');
        $this->db->empty_table('diagnosis_dokter');
        $this->db->empty_table('jadwal_konsultasi');
        $this->db->empty_table('log_activity');
        $this->db->empty_table('no_antrian');
        $this->db->empty_table('resep_dokter');

        $files_bp = glob('./assets/images/bukti_pembayaran/*');
        foreach($files_bp as $file_bp){
            if(is_file($file_bp)){
                unlink($file_bp);
            }
        }
        
        $files_bpo = glob('./assets/images/bukti_pembayaran_obat/*');
        foreach($files_bpo as $file_bpo){
            if(is_file($file_bpo)){
                unlink($file_bpo);
            }
        }

        $files_att = glob('./assets/files/attachments/*');
        foreach($files_att as $file_att){
            if(is_file($file_att)){
                unlink($file_att);
            }
            else{
                $this->_deleteDir($file_att);
            }
        }

        echo "OK";
    }

    public static function _deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::_deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}