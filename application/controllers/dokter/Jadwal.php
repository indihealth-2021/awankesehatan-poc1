<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	var $menu = 2;

	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
        $this->load->model('jadwal_konsultasi');
    }
    public function index()
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
    	if($this->session->userdata('is_login'))
    	{
        $css_addons = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $js_addons = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  $("#table_jadwal_dokter").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                });
                              </script>';
	    	$where ='id = '. $this->session->userdata('id_user');

	    	$this->dokter = $this->all_model->select_data_tele('id, name as nama_dokter, foto, id_user_kategori','master_user', 'row', $where);

	    	if(!is_null($this->dokter))
	    	{
	    		if($this->dokter->id_user_kategori == 2)
	    		{
		    		$where_dokter = 'id_dokter = '.$this->session->userdata('id_user').' AND aktif = 1';
		    		$this->jadwal = $this->all_model->select_data_tele('*','jadwal_dokter', 'result', $where_dokter);		    		
		    		$status = true;
		    		$view   = 'dokter/cek_jadwal_dokter';
    			
	    		} else {
					$this->dokter = 'Hak akses tidak sesuai';
		    		$this->jadwal = null;
		    		$status = false;
		    		$view   = 'dokter/index';

	    		}
	    	} else {
	    		$this->dokter = 'data tidak ditemukan';
	    		$this->jadwal = null;
	    		$status = false;
		    	$view   = 'dokter/index';

	    	}
	    	$user = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

      		$title = 'Jadwal Dokter';
	    	$this->response = array(
	    		'dokter' => $this->dokter,
	    		'jadwal' => $this->jadwal,
	    		'status' => $status,
	    		'view'   => $view,
			'user' => $user,
			'title' => $title,
			'css_addons' => $css_addons,
			'js_addons' => $js_addons,
			'list_notifikasi'=>$data['list_notifikasi']
	    	);
	    	$this->load->view('template', $this->response);
	    	// var_dump($this->session->userdata('id_user'));
	    	// var_dump($this->response);
    	} else {
			$this->load->view('login');
    	}    	
    }
    public function create()
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
    	if($this->session->userdata('is_login'))
    	{
    		$this->_validation();
    		$this->data = $this->input->post();
    		$this->save = $this->all_model->insert('jadwal_dokter', $this->data);

    		if($this->save)
    		{
    			$this->response = array('status' => $this->save, 'message' => 'Data berhasil disimpan');
    		} else {
    			$this->response = array('status' => $this->save, 'message' => 'ups..');
    		}
    		return $this->response;
    	} else {
			$this->load->view('login');
    	}
    	
    }
    private function _validation() {
		$this->form_validation->set_rules('poli', 'Poli', 'trim|required');
		$this->form_validation->set_rules('hari', 'Hari', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('waktu', 'Waktu', 'trim|required');

		if ($this->form_validation->run() !== TRUE) {
			$this->data->message = strip_tags(validation_errors());

			echo json_encode($this->data);

			die();
		}
	}
	public function konsultasi()
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
		if($this->session->userdata('is_login'))
		{
        $css_addons = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $js_addons = '
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
	    	$where ='id = '. $this->session->userdata('id_user');
			$this->dokter = $this->all_model->select_data_tele('id, name as nama_dokter, foto, id_user_kategori','master_user', 'row', $where);
	    	if(!is_null($this->dokter))
	    	{
	    		if($this->dokter->id_user_kategori == 2)
	    		{
					$user = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
      					$title = 'Jadwal Dokter';
					$this->data = $this->jadwal_konsultasi->get_join($this->session->userdata('id_user'));
        			$list_notifikasi = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 ORDER BY tanggal DESC LIMIT 0,2')->result();

					$this->response = array(
						'dokter' => $this->dokter,
						'jadwal_konsultasi' => $this->data,
						'status' => true,
						'message' => 'data ditemukan',
						'view' => 'dokter/teleconsultasi_pasien',
						'user' => $user,
						'title' => $title,
						'css_addons' => $css_addons,
						'js_addons' => $js_addons,
						'list_notifikasi'=>$list_notifikasi
					);
	    		} else {
	    			$this->response = array(
						'dokter' => null,
						'jadwal_konsultasi' => null,
						'status' => false,
						'message' => 'data tidak ditemukan',
						'view' => 'dokter/index',
						'user' => $user,
						'title' => $title,
						'css_addons' => $css_addons,
						'js_addons' => $js_addons
					);
	    		}
	    	} else {
				$this->response = array(
					'dokter' => null,
					'jadwal_konsultasi' => null,
					'status' => false,
					'message' => 'data tidak ditemukan',
					'view' => 'dokter/index',
					'user' => $user,
					'title' => $title,
					'css_addons' => $css_addons,
					'js_addons' => $js_addons
				);
	    	}
			// var_dump($this->response);
        	$this->load->view('template', $this->response);


		} else {
			$this->load->view('login');
		}
	}
	public function formAdd()
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
		if($this->session->userdata('is_login'))
		{
	    	$this->dokter = $this->all_model->select_data_tele('id, name as nama_dokter, foto, id_user_kategori','master_user', 'row', $where);
	    	if(!is_null($this->dokter))
	    	{
	    		if($this->dokter->id_user_kategori == 2)
	    		{
					$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
      					$data['title'] = 'Tambah Jadwal Dokter';
					$data['view'] = 'dokter/tambah_jadwal_dokter';
        			$data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


	    		} else {
					$this->load->view('login');
	    		}
	    	} else {
				$this->load->view('login');
	    	}
		} else {
			$this->load->view('login');
		}
	}
}
