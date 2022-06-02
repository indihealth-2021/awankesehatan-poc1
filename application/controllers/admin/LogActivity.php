<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LogActivity extends CI_Controller
{
    public $data;
    var $menu = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('all_controllers');
    }

    public function index()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Log Activity",
            $view = "admin/log_activity"
        );

        $data['log_activities'] = $this->db->query('SELECT ip, user_agent, activity, id_user, activity_at, u.username as username , u.id_user_kategori as kategori_user FROM log_activity INNER JOIN master_user u ON log_activity.id_user = u.id ORDER BY activity_at DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_log = $("#table_log").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                  $("#table_log_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_log.search($(this).val()).draw();
                                  });
                                });
                              </script>';

        $this->load->view('template', $data);
    }
}
