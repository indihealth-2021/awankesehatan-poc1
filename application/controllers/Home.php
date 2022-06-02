<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       
    }

    public function index() {
	$menu['menu_landing'] = 1;
    $menu['news'] = $this->db->query('SELECT * FROM data_news ORDER BY created_at DESC LIMIT 0,2')->result();
    $menu['list_dokter'] = $this->db->query('SELECT d.name as nama_dokter, d.jenis_kelamin, d.foto as foto_dokter, n.poli, ddr.pengalaman_kerja FROM master_user d INNER JOIN detail_dokter ddr ON d.id = ddr.id_dokter INNER JOIN nominal n ON ddr.id_poli = n.id WHERE d.id_user_kategori = 2 AND d.aktif = 1 ORDER BY ddr.pengalaman_kerja DESC LIMIT 0,4')->result();
	// $this->session->sess_destroy();
        $this->load->view('home', $menu);
    }
}
