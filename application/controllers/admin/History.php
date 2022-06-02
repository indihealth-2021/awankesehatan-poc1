<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
    var $menu = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model');
        $this->load->model('pembayaran_telekonsultasi_model');

        $this->load->library('all_controllers');
        $this->load->library('my_pagination');
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "History Log",
            $view = "admin/manage_history"
        );
        $nama_pasien = isset($_GET['nama_pasien']) ? $_GET['nama_pasien']:null;

        $count_rows = $this->pembayaran_telekonsultasi_model->get_all_history($nama_pasien);
        $count_rows = count($count_rows);

        $config = $this->my_pagination->paginate(5, 4, $count_rows, base_url('admin/History/index'));
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['uri_segment'] = $this->uri->segment(4);

        $temp = $this->pembayaran_telekonsultasi_model->get_all_history($nama_pasien, null, $config['per_page'], $data['page']);
        $data['pagination'] = $this->pagination->create_links();

        $data['master_web'] = $this->db->query('SELECT * FROM master_web')->row();

        $data['history'] = $temp;
        $data['css_addons'] = '
<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
<style>
.myImg {
border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}
/* The Modal (background) */
// .modal {
//   display: none; /* Hidden by default */
//   position: fixed; /* Stay in place */
//   z-index: 1; /* Sit on top */
//   padding-top: 100px; /* Location of the box */
//   left: 0;
//   top: 0;
//   width: 100%; /* Full width */
//   height: 100%; /* Full height */
//   overflow: auto; /* Enable scroll if needed */
//   background-color: rgb(0,0,0); /* Fallback color */
//   background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
// }

// /* Modal Content (Image) */
// .modal-content {
//   margin: auto;
//   display: block;
//   width: 80%;
//   max-width: 700px;
// }

// /* Caption of Modal Image (Image Text) - Same Width as the Image */
// #caption {
//   margin: auto;
//   display: block;
//   width: 80%;
//   max-width: 700px;
//   text-align: center;
//   color: #ccc;
//   padding: 10px 0;
//   height: 150px;
// }

// /* Add Animation - Zoom in the Modal */
// .modal-content, #caption {
//   animation-name: zoom;
//   animation-duration: 0.6s;
// }

// @keyframes zoom {
//   from {transform:scale(0)}
//   to {transform:scale(1)}
// }

// /* The Close Button */
// .close {
//   position: absolute;
//   top: 15px;
//   right: 35px;
//   color: #f1f1f1;
//   font-size: 40px;
//   font-weight: bold;
//   transition: 0.3s;
// }

// .close:hover,
// .close:focus {
//   color: #bbb;
//   text-decoration: none;
//   cursor: pointer;
// }

// /* 100% Image Width on Smaller Screens */
// @media only screen and (max-width: 700px){
//   .modal-content {
//     width: 100%;
//   }
// }
</style>
// 		';
        $data['js_addons'] = "
<script>
$(document).ready(function () {
$('img').on('click', function () {
    var image = $(this).attr('src');
var alt = $(this).attr('alt');
    $('#exampleModal').on('show.bs.modal', function () {
        $('.modal-body').attr('src', image);
    $('#caption').val(alt);
    });
});
});

// // Get the <span> element that closes the modal
// var modal = document.getElementById('myModal');
// var span = document.getElementsByClassName('close')[0];

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = 'none';
// } 
</script> 
// 	
                            <script src='" . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . "'></script>
                            <script src='" . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . "'></script>
                            <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . "'></script>
                            <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . "'></script>
                            <script>
                            $(document).ready(function () {
                                $('#table_histori').DataTable({
                                'responsive': true,
                                'autoWidth': false,
                                'lengthChange': false,
                                'searching': true,
                                'pageLength': 5,
                                });
                                $('#search').keypress(function(e){
                                    if(e.keyCode === 13){
                                        $('#searchForm').submit();
                                    }
                                });
                                $('#searchButton').click(function(){
                                    $('#searchForm').submit();
                                });
                            });
                            </script>	";

        $this->load->view('template', $data);
    }
}
