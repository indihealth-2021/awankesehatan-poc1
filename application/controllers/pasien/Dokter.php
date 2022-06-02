<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();       

        $this->load->library('pagination');
        $this->load->library('my_pagination');
 
        //load the department_model
        $this->load->model('profil_dokter_model');
        $this->load->model('jadwal_dokter_model');
    }

    public function jadwal(){
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
        $poli = $this->input->get('poli');
        if(!$poli){
            $poli = null;
        }
        else{
            $poli = $poli;
        }
        $data['list_jadwal_dokter'] = $this->jadwal_dokter_model->get_all(null, $poli, 1);
        $data['title'] = 'Jadwal Dokter';
        $data['view'] = 'pasien/jadwal_dokter';
	$data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();        
        
        $data['data_poli'] = $this->db->query('SELECT DISTINCT poli FROM jadwal_dokter')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_jadwal_dokter = $("#table_jadwal_dokter").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                  $("#table_jadwal_dokter_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_jadwal_dokter.search($(this).val()).draw();
                                  });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    public function profil($id_poli){
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

        //konfigurasi pagination
        if($id_poli != 'all'){
            $poli = $id_poli;
            $where = ' AND detail_dokter.id_poli = '.$poli;
        }
        else{
            $poli = null;
            $where = '';
        }
        $nama_dokter = $this->input->get('nama_dokter');
        $where = $nama_dokter ? ' AND master_user.name LIKE "%'.$nama_dokter.'%"':'';
        $count_rows = $this->db->query('SELECT master_user.*, detail_dokter.pengalaman_kerja, detail_dokter.id_poli, nominal.poli FROM master_user INNER JOIN detail_dokter ON master_user.id = detail_dokter.id_dokter INNER JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE id_user_kategori = 2 AND nominal.aktif = 1'.$where.' AND master_user.aktif = 1'.$where);
        $count_rows = $count_rows->num_rows();

        $config = $this->my_pagination->paginate(9, 5, $count_rows, site_url('pasien/Dokter/profil/'.$id_poli));
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['uri_segment'] = $this->uri->segment(5);
 
        //panggil function get_mahasiswa_list yang ada pada mmodel s. 
        $data['list_dokter'] = $this->profil_dokter_model->get($config["per_page"], $data['page'], $poli, $where);        
 
        $data['pagination'] = $this->pagination->create_links();

        $data['id_poli'] = $id_poli;
        $data['title'] = 'Profil Dokter';
        $data['view'] = 'pasien/profil_dokter';
	    $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['list_poli'] = $this->db->query('SELECT id,poli FROM nominal WHERE aktif = 1')->result();

	// $data['list_dokter'] = $this->db->query('SELECT master_user.*, detail_dokter.pengalaman_kerja, detail_dokter.id_poli, nominal.poli FROM master_user LEFT JOIN detail_dokter ON master_user.id = detail_dokter.id_dokter LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE id_user_kategori = 2 ORDER BY detail_dokter.pengalaman_kerja DESC')->result();

	    $data['js_addons'] = "
<script>
$('.modal').on('show.bs.modal', function (event) {
  var foto = $(event.relatedTarget).data('foto');
  var nama = $(event.relatedTarget).data('nama');
  var poli = $(event.relatedTarget).data('poli');
  var pengalaman_kerja = $(event.relatedTarget).data('pengalaman-kerja');
  var no_str = $(event.relatedTarget).data('no-str');
  $(this).find('.nama-dokter').text(nama);
  $(this).find('.pengalaman-kerja').text(pengalaman_kerja);
  $(this).find('.no-str').text(no_str);
  $(this).find('.poli').text(poli);
  $(this).find('.foto').attr('src', foto);
});

$('#id_poli').change(function(){
    location.href='".base_url()."/pasien/Dokter/profil/'+$(this).val()+'?nama_dokter=".$nama_dokter."';
})

$('#search').keypress(function(e){
    if(e.keyCode === 13){
        $('#searchForm').submit();
    }
});
$('#searchButton').click(function(){
    $('#searchForm').submit();
});
</script>
";

	$this->load->view('template', $data);
    }
}
