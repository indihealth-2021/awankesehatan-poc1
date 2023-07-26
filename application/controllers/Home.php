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

    private function getNearest() {
        $key = "AuPkBhRU1tlp5gG2Vki8-LpP7ooPssnBv_MQ_u1BNoPXIWZiY7AF_3BVvpLQz7XC";
        $url = 'https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=47.6044,-122.3345;47.6731,-122.1185;47.6149,-122.1936&destinations=47.6044,-122.3345;47.6731,-122.1185;47.6149,-122.1936&travelMode=driving&key='.$key;
        
        return json_decode(file_get_contents($url));
    }

    private function func($foo) {
        $n = "<br>";
        return "Hello".$n."World";
    }

    public function test() {
        // $results = $this->getNearest();
        // $results = $results->resourceSets[0]->resources[0]->results;
        // $br = "<br";
        echo $this->func("Hello");
        
    }
}
