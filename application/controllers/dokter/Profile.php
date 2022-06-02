<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	var $menu = 2;

	public function __construct() {
        parent::__construct();
        $this->load->model('all_model');

    }
    public function index()
    {
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
    	if($this->session->userdata('is_login'))
    	{
	    	$where ='id = '. $this->session->userdata('id_user');
	    	// $this->data = $this->all_model->select('master_user', 'row', $where);
			$this->data = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();

	    	if(!is_null($this->data))
	    	{
	    		if($this->data->id_user_kategori == 2)
	    		{
        			$data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
					$list_poli = $this->db->query('SELECT id,poli FROM nominal')->result();
					$detail_dokter = $this->db->query('SELECT id_poli,pengalaman_kerja, nominal.poli FROM detail_dokter LEFT JOIN nominal ON nominal.id = detail_dokter.id_poli WHERE id_dokter = '.$this->session->userdata('id_user'))->row();
	    			$this->response = array('user'=>$this->data, 'view' => 'dokter/profil_dokter', 'title' => 'Profil Dokter', 'detail_dokter'=>$detail_dokter, 'list_poli'=>$list_poli, 'list_notifikasi'=>$data['list_notifikasi']);
	    			$this->load->view('template', $this->response);

	    		} else {
					$this->load->view('login'); // atau warning kalo yang diakses bukan profile dokter
	    		}
	    	} else {
				$this->load->view('dokter/profil_dokter',$this->response); // atau warning kalo data yang dicari tidak ditemukan
	    	}
    	} else {
			$this->load->view('login');
    	}
    }

	public function edit(){
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
        $data['view'] = 'dokter/edit_profil';
		// $data['user'] = $this->all_model->select('master_user', 'row', 'id = '.$this->session->userdata('id_user'));
		$data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
		$data['title'] = 'Edit Profil';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
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


		$data['list_poli'] = $this->db->query('SELECT id,poli FROM nominal')->result();
		$data['detail_dokter'] = $this->db->query('SELECT detail_dokter.id_poli,detail_dokter.pengalaman_kerja,nominal.poli FROM detail_dokter LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE detail_dokter.id_dokter = '.$this->session->userdata('id_user'))->row();

		$this->load->view('template', $data);
	}

    public function update()
    {
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
		if($this->session->userdata('is_login')){
			$data = $this->input->post();
			foreach($data as $key => $val)
			{
				$data_noxss[$key] = htmlentities($val);
			}
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
				$this->upload->overwrite = TRUE;

				if ( ! $this->upload->do_upload('foto')){
					$error = array('error' => $this->upload->display_errors());
					// echo var_dump($error);
					// die;
					$this->session->set_flashdata('msg', 'Upload Foto Gagal!');
				}else{
					$data_foto = array('upload_data' => $this->upload->data());
					$data['foto'] = $data_foto['upload_data']['file_name'];
					// echo var_dump($data_foto);
					// die;
				}
			}

			// var_dump($data);
			// die;
			// $id_poli = $data['poli'];
			// $pengalaman_kerja = $data['pengalaman'];
			// $data_detail_dokter = array('id_poli'=>$id_poli, 'pengalaman_kerja'=>$pengalaman_kerja);
			// $detail_dokter = $this->db->query('SELECT id FROM detail_dokter WHERE id_dokter = '.$id)->row();;
			// if(!$detail_dokter){
			// 	$data_detail_dokter['id_dokter'] = $id;
			// 	$this->db->insert('detail_dokter', $data_detail_dokter);
			// 	$this->session->set_flashdata('msg', 'Data berhasil disimpan');
			// }
			// else{
			// 	// $this->db->set($data_detail_dokter);
			// 	// $this->db->where(array('id_dokter'=>$id));
			// 	// $this->db->update('detail_dokter');
			// 	$this->all_model->update('detail_dokter', $data_detail_dokter, array('id_dokter'=>$id));
			// 	$this->session->set_flashdata('msg', 'Data berhasil disimpan');
			// }
			// unset($data['poli']);
			// unset($data['pengalaman']);
			$update = $this->all_model->update('master_user', $data_noxss, array('id'=>$id));

			if($update != 0)
			{
				if($update == -1){
					$this->session->set_flashdata('msg', 'Data gagal disimpan');
				}
				else{
					$this->session->set_flashdata('msg','Data berhasil disimpan');
				}
				redirect('dokter/Profile');

			} else {
				$this->session->set_flashdata('msg','Data berhasil disimpan');
				redirect('dokter/Profile');
			}
		}
		else{
			redirect('Login');
		}
    }
}
