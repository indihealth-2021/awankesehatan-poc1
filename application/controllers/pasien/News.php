<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       
    }

    public function index(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['view'] = 'pasien/news';
        $data['title'] = 'Berita';
	$data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $news = $this->db->query('SELECT * FROM data_news ORDER BY created_at DESC')->result();
        foreach ($news as $key => $value) {
            $value->foto = base_url("assets/images/news/".$value->foto);            
        }
         $data['list_berita'] = $news;
        $this->load->view('template', $data);
    }

    public function detail(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['berita'] = $this->db->query('SELECT * FROM data_news WHERE id = '.$this->input->get('id_berita'))->row();
        $data['view'] = 'pasien/detail_news';
        $data['title'] = 'Detail Berita'; 
	$data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();              
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();        
        
        $data['berita']->foto = base_url("assets/images/news/". $data['berita']->foto);            
                
        $this->load->view('template', $data);
    }
}
