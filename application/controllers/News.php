<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       
    }

    public function index() {
        // $this->data->view = 'Home';
	$data['menu_landing'] = 2;
	// $data['news'] = $this->all_model->select('data_news','result');
    $data['other_news'] = $this->db->query('SELECT * FROM data_news ORDER BY created_at LIMIT 0,3')->result();

        $config['base_url'] = site_url('News/index'); //site url
        $count_rows = $this->db->query('SELECT id FROM data_news');
        $count_rows = $count_rows->num_rows();
        $config['total_rows'] = $count_rows; //total row
        $config['per_page'] = 2;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['uri_segment'] = $this->uri->segment(3);

        $data['news'] = $this->all_model->get_news($config["per_page"], $data['page']); 
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('news', $data);
    }

    public function detail_news($id) {
	$where = array('id' => $id);
	$data['menu_landing'] = 2;
	$data['news'] = $this->all_model->select('data_news', 'row', $where);
	$data['all_news'] = $this->all_model->select('data_news','result');
    $data['other_news'] = $this->db->query('SELECT * FROM data_news ORDER BY created_at LIMIT 0,3')->result();
	
        $this->load->view('detail_news', $data);
    }
   
    public function search_result() {
	$input = $this->input->post('news');
	$data['menu_landing'] = 2;
	// $data['news'] = $this->all_model->get_search($input);
    //     $this->load->view('news', $data);
    $data['other_news'] = $this->db->query('SELECT * FROM data_news ORDER BY created_at LIMIT 0,3')->result();

        $config['base_url'] = site_url('News/index'); //site url
        $count_rows = $this->db->query('SELECT id FROM data_news');
        $count_rows = $count_rows->num_rows();
        $config['total_rows'] = $count_rows; //total row
        $config['per_page'] = 2;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['uri_segment'] = $this->uri->segment(3);

        $data['news'] = $this->all_model->get_news($config["per_page"], $data['page'], $input); 
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('news', $data);
    }

}
