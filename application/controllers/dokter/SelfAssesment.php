<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SelfAssesment extends CI_Controller {
	var $menu = 1;

	public function __construct() {
        parent::__construct();      
        $this->load->model('Assesment_model');
    }
    public function detail($id_jadwal_konsultasi){
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
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['view'] = 'dokter/detail_assesment';
      	$data['title'] = 'Assesment Pasien';
        $data['assesment'] = $this->assesment_model->get_by_konsultasi($id_jadwal_konsultasi, $this->session->userdata('id_user'));
        $this->load->view('template', $data);
    }
    public function verification()
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
    		$id_dokter = $this->session->userdata('id_user');
//    		$dataverifikasi = [];
    		$data['menu'] = $this->menu;
			$data['view'] = 'dokter/selfassesment_pasien';
//			$datas = $this->assesment_model->get_data('assesment.id_pasien');
//			if(!empty($datas)) {
//				foreach($datas as $d)
//				{
//					if($d->id == $id_dokter)
///					{
//						$dataverifikasi = $d;
//					}
//				}
//			}
//			$data['pasien'] = $dataverifikasi;
			$data['list_assesment'] = $this->assesment_model->get_all_by_id_dokter($this->session->userdata('id_user'), true);
			$data['dokter'] = $this->all_model->select('master_user', 'row', array('id' => $id_dokter));
	$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

      	$data['title'] = 'Assesment Pasien';
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_assesment = $("#table_assesment").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                  $("#table_assesment_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_assesment.search($(this).val()).draw();
                                  });
                                });
                              </script>';
			$this->load->view('template', $data);
    	} else {
    		redirect('login');
    	}
    }
    public function openForm($id)
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
    		$dataverifikasi = [];
    		$data['menu'] = $this->menu;
			$data['view'] = 'dokter/update_selfassesment';
//			$data['data'] = $this->assesment_model->get_data(array('assesment.id'=>$id));
			$data['data'] = $this->db->query('SELECT assesment.*, p.name as nama_pasien, p.lahir_tanggal as tanggal_lahir_pasien FROM assesment INNER JOIN master_user p ON assesment.id_pasien = p.id WHERE assesment.id = '.$id)->row();
      			$birthDate = new DateTime($data['data']->tanggal_lahir_pasien);
      			$now = new DateTime('today');
			$data['data']->age = $birthDate->diff($now)->y;
	$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));  
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
  
      	$data['title'] = 'Self Assesment Pasien';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
    }
    public function update()
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
    	$data = $this->input->post();
	echo var_dump($data);
    	$id = $data['id'];
    	unset($data['id']);
    	$update = $this->all_model->update('assesment', $data, array('id' => $id));
    	if($update)
    	{
    		$response = array('status' => $update, 'message' => 'Data berhasil disimpan');
    	} else {
    		$response = array('status' => $update, 'message' => 'Data gagal disimpan');
    	}
    	redirect(base_url('dokter/SelfAssesment/openForm/'.$id));
    }
}
