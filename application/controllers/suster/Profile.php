<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
    
    }
    public function index()
    {
    	if($this->session->userdata('is_login'))
    	{
	    	$where ='id = '. $this->session->userdata('id_user');
	    	$this->data = $this->all_model->select('master_user', 'row', $where);
	    	if(!is_null($this->data))
	    	{
	    		if($this->data->id_user_kategori == 7)
	    		{
	    			$data['view'] = 'dokter/cek_jadwal_suster';
	    			$data['data'] = $this->data;

	    			$this->load->view('dokter/template', $data);
	    		} else {
					$this->load->view('login'); // atau warning kalo yang diakses bukan profile suster
	    		}
	    	} else {
				$this->load->view('login'); // atau warning kalo data yang dicari tidak ditemukan
	    	}
    	} else {
			$this->load->view('login');
    	}    	
    }
}