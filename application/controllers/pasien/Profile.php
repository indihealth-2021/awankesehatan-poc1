<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
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
    	if($this->session->userdata('is_login'))
    	{
	    	$where ='id = '. $this->session->userdata('id_user');
	    	// $this->data = $this->all_model->select('master_user', 'row', $where);
			$this->data = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
			$no_medrek = $this->db->query('SELECT no_medrec FROM detail_pasien WHERE id_pasien = '.$this->session->userdata('id_user'))->row();
			if($no_medrek){
				$no_medrek->no_medrec = str_split($no_medrek->no_medrec, "2");
				$no_medrek->no_medrec = implode('.',$no_medrek->no_medrec);
			}
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
		if(!is_null($this->data))
	    	{
				$user = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
				$this->response = array('user'=>$this->data, 'view' => 'pasien/profile', 'title' => 'Profile', 'list_notifikasi'=>$data['list_notifikasi'],'no_medrek'=>$no_medrek);
				$this->load->view('template', $this->response);
	    	}
    	} else {
			redirect('Login');
    	}
    }

	public function edit(){
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
        $data['view'] = 'pasien/edit_profil';
		// $data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
		$data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
		$data['title'] = 'Edit Profil';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

		$data['no_medrek'] = $this->db->query('SELECT no_medrec FROM detail_pasien WHERE id_pasien = '.$this->session->userdata('id_user'))->row();
		if($data['no_medrek']){
			$data['no_medrek']->no_medrec = str_split($data['no_medrek']->no_medrec, "2");
			$data['no_medrek']->no_medrec = implode('.',$data['no_medrek']->no_medrec);
		}

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
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->db->escape($this->session->userdata('id_user')))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
		if($this->session->userdata('is_login')){
			$data = $this->input->post();
			foreach($data as $key => $val)
			{
				$data_noxss[$key] = htmlentities($val);
			}
			$id   = $this->session->userdata('id_user');
			$user = $this->db->query('SELECT foto FROM master_user WHERE id = '.$this->db->escape($id))->row();

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
			$update = $this->all_model->update('master_user', $data_noxss, array('id'=>$id));

			if($update != 0)
			{
				if($update == -1){
					$this->session->set_flashdata('msg', 'Data gagal disimpan');
				}
				else{
					$this->session->set_flashdata('msg','Data berhasil disimpan');
				}
				redirect('pasien/Profile');

			} else {
				$this->session->set_flashdata('msg','Data tidak ada yang disimpan');
				redirect('pasien/Profile');
			}
		}
		else{
			redirect('Login');
		}
	}
}
