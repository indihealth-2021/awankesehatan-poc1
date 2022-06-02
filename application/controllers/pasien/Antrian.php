<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {
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

        if($this->input->get('id_jadwal')){
            $where = ' AND na.id_jadwal='.$this->input->get('id_jadwal');
        }
        else{
            $where = '';
        }
        $data['view'] = 'pasien/antrian';
	$data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Antrian';
        $data['list_antrian'] = $this->db->query('SELECT DISTINCT jadwal_konsultasi.tanggal as tanggal_konsultasi, jadwal_dokter.hari, jadwal_dokter.tanggal, na.antrian, na.status, d.name as nama_dokter, d.id as id_dokter, d.foto as foto_dokter, p.name as nama_pasien, p.id as id_pasien, n.poli FROM no_antrian na INNER JOIN master_user d ON na.id_dokter=d.id INNER JOIN master_user p ON na.id_pasien=p.id INNER JOIN detail_dokter dd ON d.id = dd.id_dokter INNER JOIN nominal n ON dd.id_poli = n.id INNER JOIN jadwal_dokter ON jadwal_dokter.id = na.id_jadwal INNER JOIN jadwal_konsultasi ON na.id_jadwal_konsultasi = jadwal_konsultasi.id WHERE (status=1 OR status=0)'.$where.' ORDER BY nama_dokter ASC, jadwal_dokter.hari DESC, status DESC, antrian ASC')->result();
		$jadwal_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id_pasien = '.$this->session->userdata('id_user'))->row();
		// if(!$jadwal_konsultasi){
			// $data['list_antrian'] = array();
		// }
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['list_dokter_diantri'] = $this->db->query('SELECT DISTINCT jadwal_dokter.tanggal, jadwal_dokter.hari, na.id_jadwal, d.id, d.name FROM no_antrian na INNER JOIN master_user d ON na.id_dokter = d.id INNER JOIN jadwal_dokter ON jadwal_dokter.id = na.id_jadwal')->result();         
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_antrian = $("#table_antrian").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                  $("#table_antrian_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_antrian.search($(this).val()).draw();
                                  });
                                });
                              </script>';


        $this->load->view('template', $data);
    }
}
