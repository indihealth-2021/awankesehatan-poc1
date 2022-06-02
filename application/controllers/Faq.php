<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       
    }

    public function index() {
	$menu['menu_landing'] = 1;
        $this->load->view('faq', $menu);
    }
    public function akun() {
	$menu['menu_landing'] = 1;
        $this->load->view('faq_info_akun', $menu);
    }
    public function payment() {
	$menu['menu_landing'] = 1;
        $this->load->view('faq_info_payment', $menu);
    }
    public function konsultasi() {
	$menu['menu_landing'] = 1;
        $this->load->view('faq_info_konsultasi', $menu);
    }
    public function beliobat() {
	$menu['menu_landing'] = 1;
        $this->load->view('faq_info_beli_obat', $menu);
    }
    public function delivery() {
	$menu['menu_landing'] = 1;
        $this->load->view('faq_info_delivery', $menu);
    }
}
