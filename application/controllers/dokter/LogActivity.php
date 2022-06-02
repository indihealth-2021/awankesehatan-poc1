<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogActivity extends CI_Controller {
    public $data;
    var $menu = 10;

	public function __construct() {
        parent::__construct();
        
    }

    public function index(){
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
        $data['log_activities'] = $this->db->query('SELECT ip,activity_at, user_agent, activity, id_user, u.username as username , u.id_user_kategori as kategori_user FROM log_activity INNER JOIN master_user u ON log_activity.id_user = u.id WHERE u.id_user_kategori != 5 ORDER BY activity_at DESC')->result();
        $data['view'] = 'dokter/log_activity';
	$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
      	$data['title'] = 'Log Activity';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


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

        $this->load->view('template', $data);
    }
}
