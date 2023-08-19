<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryMedisPasien extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->model('rekam_medis_model');
        $this->load->model('dokter_model');

         $this->load->library(array('Key'));
         $this->load->library('session');
        //  $this->load->library(array('auth', 'setpdf'));

    }

    public function index($id_pasien){
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
        $data['view'] = 'dokter/manage_history_medis_pasien';
		$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
		$data['title'] = 'History Medis Pasien';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


        if($id_pasien == 'all'){
            $id_pasien = null;
        }
        else{
            $id_pasien = $id_pasien;
        }
        $data['list_rekam_medis'] = $this->rekam_medis_model->get_all_by_id_dokter($this->session->userdata('id_user'), $id_pasien);
        $data['dokter'] = $this->dokter_model->get($this->session->userdata('id_user'));
        $data['list_pasien'] = $this->db->query('SELECT master_user.id,master_user.name,master_user.username, detail_pasien.no_medrec FROM master_user LEFT JOIN detail_pasien ON detail_pasien.id_pasien = master_user.id WHERE id_user_kategori = 0')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(function () {
                                  var table_medrec = $("#table_medrec").DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "pageLength": 5,
                                    "searching": true,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": true,
                                    "responsive": true,
                                  });
                                  $("#table_medrec_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_medrec.search($(this).val()).draw();
                                  });
                                });

                                $("#id_pasien").change(function(){
                                    location.href = "'.base_url().'/dokter/HistoryMedisPasien/index/"+$(this).val();
                                })
                              </script>';
		$this->load->view('template', $data);
    }

    public function detail(){
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
	$id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
	$id_pasien = $this->input->get('id_pasien');

        $data['view'] = 'dokter/detail_medrec.php';
	$data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
	$data['title'] = 'History Medis Pasien';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


        $data['rekam_medis'] = $this->db->query('SELECT bukti_pembayaran.tanggal_konsultasi, bukti_pembayaran_obat.order_status, md.nama as diagnosis, md.id as diagnosis_code, diagnosis_dokter.id_registrasi, diagnosis_dokter.created_at, diagnosis_dokter.kronis, assesment.keluhan, GROUP_CONCAT(DISTINCT "<li>",master_obat.name, " ( ",resep_dokter.jumlah_obat, " ",master_obat.unit," ) " , " ( ",resep_dokter.keterangan," ) </li>" SEPARATOR "") as list_obat, p.name as nama_pasien, p.lahir_tanggal as tanggal_lahir_pasien, p.lahir_tempat as tempat_lahir_pasien, p.jenis_kelamin as jk_pasien,d.name as nama_dokter, nominal.poli, dp.no_medrec, data_penunjang.* FROM (diagnosis_dokter, assesment) LEFT JOIN resep_dokter ON resep_dokter.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi LEFT JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user p ON assesment.id_pasien = p.id INNER JOIN master_user d ON assesment.id_dokter = d.id LEFT JOIN detail_dokter ddr ON d.id = ddr.id_dokter LEFT JOIN nominal ON ddr.id_poli = nominal.id LEFT JOIN detail_pasien dp ON p.id = dp.id_pasien LEFT JOIN master_diagnosa md ON md.id = diagnosis_dokter.diagnosis LEFT JOIN bukti_pembayaran_obat ON bukti_pembayaran_obat.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi LEFT JOIN data_penunjang ON data_penunjang.id_jadwal_konsultasi=assesment.id_jadwal_konsultasi WHERE diagnosis_dokter.id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' AND assesment.id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' AND diagnosis_dokter.id_pasien = '.$id_pasien.' AND assesment.id_pasien = '.$id_pasien)->row();
        // var_dump($this->db->error());
		$data['rekam_medis']->no_medrec = str_split($data['rekam_medis']->no_medrec, "2");
		$data['rekam_medis']->no_medrec = implode('.',$data['rekam_medis']->no_medrec);

	$this->load->view('template', $data);
    }
}
