<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	var $menu = 2;

	public function __construct() {
        parent::__construct();       
    }

    public function index() {
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		$data['menu'] = $this->menu;
		$data['view'] = 'dokter/view_news';
		$data['news'] = $this->all_model->select('data_news','result');
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user')); 
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
   
      		$data['title'] = 'Berita';
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  $("#example1").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                });
                              </script>';
		// var_dump($data);
		// echo '<pre>';
            // print_r($data);
            // echo '</pre>';
		$this->load->view('template', $data);
	}
	public function lihat($id){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		$where = array('id' =>$id); // where nya id ya, sesuaikan value dgn id
		$get = $this->all_model->select('data_news', 'row', $where);
		$data['menu'] = $this->menu;
		$data['view'] = 'dokter/detail_news'; 
		$data['data'] = $get;
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));  
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
  
      		$data['title'] = 'Detail News';
		$this->load->view('template', $data);
	}
	// public function lihat_berita_dash(){
	// 	$where = $this->input->post(); // where nya id ya, sesuaikan value dgn id
	// 	$get = $this->all_model->select('data_news', 'row', $where);
	// 	$data['menu'] = $this->menu;
	// 	$data['view'] = 'dokter/detail_news_dash'; 
	// 	$data['data'] = $get;
	// 	$this->load->view('template', $data);
	// }
	// public function detail(){
	// 	if($this->session->userdata('is_login')){
	// 	$data['menu'] = $this->menu;
	// 	$data['view'] = 'dokter/detail_list_news'; 
	// 	$data['news'] = $this->all_model->select('data_news','result');
	// 	$this->load->view('template', $data);
	// 	} else {
 //      		redirect('Login');
 //    		}
 //    }
    public function viewDetail($id)
	{
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		if($this->session->userdata('is_login')){
		$where = array('id'=>$id);
		$data['news'] = $this->db->query('SELECT * FROM data_news WHERE id = '.$id)->row();		
		if($data['news']->foto == null || $data['news']->foto == ""){
			$data['news']->foto = base_url("assets/images/news/noImage.png");	
		}else{
			$data['news']->foto = base_url("assets/images/news/".$data['news']->foto);	
		}		
		$data['menu'] = $this->menu;
		$data['view'] = 'dokter/detail_news_dash';
		$data['data'] = $data;
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

      		$data['title'] = 'Detail Berita';

		$this->load->view('template', $data);
		} else {
      		redirect('Login');
    		}
	}
	public function viewAll()
	{
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		if($this->session->userdata('is_login')){
		$data['menu'] = $this->menu;
		$data['view'] = 'dokter/detail_list_news'; 
		$data['news'] = $this->all_model->select('data_news','result');
	$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user')); 
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
   
      	$data['title'] = 'Berita';
		$this->load->view('template', $data);
		} else {
      		redirect('Login');
    		}
	}
}
