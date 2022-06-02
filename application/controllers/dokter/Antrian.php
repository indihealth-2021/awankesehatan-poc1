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
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['view'] = 'dokter/antrian';
        $data['list_antrian'] = $this->db->query('SELECT na.antrian, na.status, na.id, p.name as nama_pasien, na.id_pasien as id_pasien FROM no_antrian na INNER JOIN master_user d ON na.id_dokter=d.id INNER JOIN master_user p ON na.id_pasien=p.id WHERE (status=0 OR status=1) AND d.id = '.$this->session->userdata('id_user'))->result();        
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));    
      		$data['title'] = 'Antrian Pasien';
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

    public function update(){
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
        $antrian = $this->db->query('SELECT * FROM no_antrian WHERE id = '.$this->input->post('id'))->row();
        if(!$antrian){
            show_404();
        }
        if($data['aksi'] == 'selesai'){
            $status = 2;
        }
        else{
            $status = 1;
        }

        $data_update = array(
            'status'=>$status
        );

        $update = $this->all_model->update('no_antrian', $data_update, ['id'=>$this->input->post('id')]);
        if($update != 0)
        {
            if($update == -1){
                $this->session->set_flashdata('msg', 'Data gagal disimpan');
            }
            else{
                $this->session->set_flashdata('msg','Data berhasil disimpan');	
            }							
            redirect('dokter/Antrian');
            
        } else {
            $this->session->set_flashdata('msg','Data tidak ada yang disimpan');								
            redirect('dokter/Antrian');
        }
    }
}
