<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	public $data;

	public function __construct() {
		parent::__construct();     
		$this->load->library('all_controllers');
    }

    public function index(){
		$this->all_controllers->check_user_admin_farmasi();
		$data = $this->all_controllers->get_data_view(
			$title = "Profil",
			$view = "admin/profil_admin"
		);
		
		$where ='id = '. $this->session->userdata('id_user');
		//$this->data = $this->all_model->select('master_user', 'row', $where);
		$this->data = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
		if(!is_null($this->data))
		{
			$user = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
			$response['user'] = $this->data;
			$response['view'] = $data['view'];
			$response['title'] = $data['title'];
			$response['menu'] = $data['menu'];
			$response['list_notifikasi'] = $data['list_notifikasi']; 
			$this->load->view('template', $response);		
		}   	
    }

	public function edit(){
		$this->all_controllers->check_user_admin_farmasi();
		$data = $this->all_controllers->get_data_view(
			$title = "Edit Profil",
			$view = "admin/edit_profil"
		);

		// $data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
		$data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();

		$data['js_addons'] = '
		<script>
		$(document).ready(function(){
			$.ajax({
				method : "POST",
				url    : baseUrl+"Alamat/getProvinsi",
				data   : {id_user:'.$this->session->userdata('id_user').'},
				success : function(data){
					$("#provinsi").empty();
					data = JSON.parse(data);
					$("#provinsi").append("<option>PILIH PROVINSI</option>");
					$.each(data, function(index, item){
						var template_provinsi = "<option value=\""+item.id+"\" "+item.selected+">"+item.name+"</option>";
						$("#provinsi").append(template_provinsi);
					});
					
				},
				error : function(data){
					alert("Terjadi kesalahan sistem, silahkan hubungi administrator.");
				}
				

			});
		});

		$("#provinsi").change(function(){
			$("#kotkab").empty();
			$("#kecamatan").empty();
			$("#kelurahan").empty();

			var id_provinsi = $(this).val();
			console.log(id_provinsi);

			$.ajax({
				method : "POST",
				url    : baseUrl+"Alamat/getKotKab",
				data   : {id_provinsi:id_provinsi},
				success : function(data){
					data = JSON.parse(data);
					$("#kotkab").append("<option>PILIH KABUPATEN/KOTA</option>");
					$.each(data, function(index, item){
						var template_kotkab = "<option value=\""+item.id+"\">"+item.name+"</option>";
						$("#kotkab").append(template_kotkab);
					});
					
				},
				error : function(data){
					alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
				}
				

			});
		});

		$("#kotkab").change(function(){
			$("#kecamatan").empty();
			$("#kelurahan").empty();

			var id_kotkab = $(this).val();

			$.ajax({
				method : "POST",
				url    : baseUrl+"Alamat/getKecamatan",
				data   : {id_kota:id_kotkab},
				success : function(data){
					data = JSON.parse(data);
					$("#kecamatan").append("<option>PILIH KECAMATAN</option>");
					$.each(data, function(index, item){
						var template_kecamatan = "<option value=\""+item.id+"\">"+item.name+"</option>";
						$("#kecamatan").append(template_kecamatan);
					});
					
				},
				error : function(data){
					alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
				}
				

			});
		});

		$("#kecamatan").change(function(){
			$("#kelurahan").empty();

			var id_kecamatan = $(this).val();

			$.ajax({
				method : "POST",
				url    : baseUrl+"Alamat/getKelurahan",
				data   : {id_kecamatan:id_kecamatan},
				success : function(data){
					data = JSON.parse(data);
					$("#kelurahan").append("<option>PILIH KELURAHAN</option>");
					$.each(data, function(index, item){
						var template_kelurahan = "<option value=\""+item.id+"\">"+item.name+"</option>";
						$("#kelurahan").append(template_kelurahan);
					});
					
				},
				error : function(data){
					alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
				}
				

			});
		});
		</script>
		';

		$this->load->view('template', $data);		
	}

	public function update(){
		$this->all_controllers->check_user_admin_farmasi();

		$data = $this->input->post();
		$id   = $this->session->userdata('id_user');
		$user = $this->db->query('SELECT foto FROM master_user WHERE id = '.$id)->row();

		if(isset($_FILES['foto'])){
			$config['upload_path']          = './assets/images/users';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
			$config['max_size']             = 10024;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;
			$config['file_name'] = 'userfoto_'.$this->session->userdata('id_user');
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->overwrite = true;
			
			if ( ! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msg', 'Upload Foto Gagal!');
			}else{
				$data_foto = array('upload_data' => $this->upload->data());
				$data['foto'] = $data_foto['upload_data']['file_name'];	
			}
		}	

		// var_dump($data);
		$update = $this->all_model->update('master_user', $data, array('id'=>$id));

		if($update != 0)
		{
			if($update == -1){
				$this->session->set_flashdata('msg', 'Data gagal diedit');
			}
			else{
				$this->session->set_flashdata('msg','Data berhasil diedit');	
			}							
			redirect('admin/Profil');
			
		} else {
			$this->session->set_flashdata('msg','Data berhasil diedit');								
			redirect('admin/Profil');
		}
	}
}