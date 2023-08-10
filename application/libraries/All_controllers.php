<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ALL_Controllers{
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('all_model');
    }

    public function get_data_view($title="", $view=""){
        $data['list_notifikasi'] = $this->CI->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->CI->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['user'] = $this->CI->all_model->select('master_user', 'row', 'id = ' . $this->CI->session->userdata('id_user'));
        $data['title'] = $title;
        $data['view'] = $view;

        if($data['user']->id_user_kategori == 5){
            $data['menu'] = 0;
        }
        return $data;
    }

    public function check_user(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori == 2){
            redirect(base_url('dokter/Dashboard'));
        }
        else if($valid->id_user_kategori == 0){
            redirect(base_url('pasien/Pasien'));
        }
        else{
            if($valid->id_user_level == 1){
                redirect(base_url('admin/Admin'));
            }
            else{
                redirect(base_url('admin/FarmasiVerifikasiObat'));
            }
        }
    }

    public function check_user_admin(){
        if (!$this->CI->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->CI->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 5) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else if($valid->id_user_kategori == 6){
                if($valid->id_user_level == 1){
                    redirect(base_url('diampu/Diampu/list_pengampu'));
                }else{
                    redirect(base_url('pengampu/Pengampu/dashboard'));
                }
            }else {
                redirect(base_url('dokter/Dashboard'));
            }
        } else {
            if ($valid->id_user_level == 2) {
                redirect(base_url('admin/FarmasiVerifikasiObat'));
            }
        }
    }

    public function check_user_farmasi(){
        if(!$this->CI->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori,id_user_level FROM master_user WHERE id = '.$this->CI->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 5){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            } else if($valid->id_user_kategori == 6){
                if($valid->id_user_level == 1){
                    redirect(base_url('diampu/Diampu/list_pengampu'));
                }else{
                    redirect(base_url('pengampu/Pengampu/dashboard'));
                }
            }
            else{
                redirect(base_url('dokter/Dashboard'));
            }
        }
        else{
            if($valid->id_user_level == 1){
                redirect(base_url('admin/Admin'));
            }
        }
    }

    public function check_user_admin_farmasi(){
        if(!$this->CI->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori,id_user_level FROM master_user WHERE id = '.$this->CI->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 5){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            } else if($valid->id_user_kategori == 6){
                if($valid->id_user_level == 1){
                    redirect(base_url('diampu/Diampu/list_pengampu'));
                }else{
                    redirect(base_url('pengampu/Pengampu/dashboard'));
                }
            }
            else{
                redirect(base_url('dokter/Dashboard'));
            }
        }
    }

    public function check_user_pasien(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            } else if($valid->id_user_kategori == 6){
                if($valid->id_user_level == 1){
                    redirect(base_url('diampu/Diampu/list_pengampu'));
                }else{
                    redirect(base_url('pengampu/Pengampu/dashboard'));
                }
            }
            else{
                if($valid->id_user_level == 1){
                    redirect(base_url('admin/Admin'));
                }
                else{
                    redirect(base_url('admin/FarmasiVerifikasiObat'));
                }
            }
        }
    }

    public function check_user_diampu(){
        if(!$this->CI->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori,id_user_level FROM master_user WHERE id = '.$this->CI->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 6){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            } else if($valid->id_user_kategori == 5){
                if($valid->id_user_level == 1){
                    redirect(base_url('admin/Admin'));
                }else{
                    redirect(base_url('admin/FarmasiVerifikasiObat'));
                }
            }
            else{
                redirect(base_url('dokter/Dashboard'));
            }
        }
        else{
            if($valid->id_user_level == 2){
                redirect(base_url('pengampu/Pengampu'));
            }
        }
    }

    public function check_user_pengampu(){
        if(!$this->CI->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->CI->db->query('SELECT id_user_kategori,id_user_level FROM master_user WHERE id = '.$this->CI->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 6){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            } else if($valid->id_user_kategori == 5){
                if($valid->id_user_level == 1){
                    redirect(base_url('admin/Admin'));
                }else{
                    redirect(base_url('admin/FarmasiVerifikasiObat'));
                }
            }
            else{
                redirect(base_url('dokter/Dashboard'));
            }
        }
        else{
            if($valid->id_user_level == 1){
                redirect(base_url('diampu/Diampu/list_pengampu'));
            }
        }
    }

    public function setHargaObatFrom($list_id_jadwal_konsultasi) {
        for($i = 0; $i < count($list_id_jadwal_konsultasi); $i ++) {
            $allObat = $this->CI->db->query("SELECT * FROM resep_dokter WHERE id_jadwal_konsultasi=".$list_id_jadwal_konsultasi[$i])->result();

            $total = 0;
            foreach($allObat as $obat) {
                if($obat->harga != 0) {
                    $total += $obat->harga * $obat->jumlah_obat;
                }else {
                    $hargaObat = $this->CI->db->query("SELECT harga FROM master_obat WHERE id=".$obat->id_obat)->row()->harga;
                    $total += $hargaObat * $obat->jumlah_obat;
                }
            }

            $this->CI->db->update(
                $table="biaya_pengiriman_obat",
                $set=["harga_obat" => $total],
                $where=["id_jadwal_konsultasi" => $list_id_jadwal_konsultasi[$i]]
            );
        }
    }

    public function getTotalHargaObatFrom($list_id_jadwal_konsultasi) {
        $data = [];
        $data["harga_obat"] = [];
        for($i = 0; $i < count($list_id_jadwal_konsultasi); $i ++) {
            $data["harga_obat"][$list_id_jadwal_konsultasi[$i]] = $this->CI->db->query("SELECT * FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi=".$list_id_jadwal_konsultasi[$i])->row()->harga_obat;
        }

        return $data["harga_obat"];
    }

    public function debug($output) {
        echo json_encode([
            "output" => $output,
            "last_query" => $this->CI->db->last_query(),
            "error" => $this->CI->db->error()
        ]); exit();
    }
}
