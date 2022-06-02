<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SelfAssesment extends CI_Controller {
	var $menu = 1;

	public function __construct() {
        parent::__construct();      
        // $this->load->model('Assesment_model');
        $this->load->library('all_controllers');
    }

    public function index() {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Assesment Pasien",
			$view = "admin/manage_selfAssesment"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  $("#table_assesment").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                });
                              </script>';
		$data['data'] = $this->db->query('SELECT assesment.*, d.name as nama_dokter, p.name as nama_pasien, n.poli FROM assesment INNER JOIN master_user d ON assesment.id_dokter = d.id INNER JOIN detail_dokter ddr ON d.id = ddr.id_dokter LEFT JOIN nominal n ON n.id = ddr.id_poli INNER JOIN master_user p ON assesment.id_pasien = p.id ORDER BY created_at')->result();
		$this->load->view('template', $data);
	}
	public function create()
	{
		$this->all_controllers->check_user_admin();

		$data = $this->input->post(); // field sesuaikan dengan databse
		$save = $this->all_model->insert('assesment', $data);
		if($save) $response = array('status' => $save, 'message' => 'Data berhasil disimpan'); else $response = array('status' => $save, 'message' => 'Data gagal disimpan');

		return $response;
	}
	public function update()
	{
		$this->all_controllers->check_user_admin();

		$data = $this->input->post(); // sesuaikan dengan field database
		$id   = $data['id'];
		unset($data['id']);

		$save = $this->all_model->update_($data, $id, 'assesment');
		if($save) $response = array('status' => $save, 'message' => 'Data berhasil disimpan'); else $response = array('status' => $save, 'message' => 'Data gagal disimpan');

		return $response;
	}
}
