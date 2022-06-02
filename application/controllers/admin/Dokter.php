<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
	var $menu = 2;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master_jadwal_model');
		$this->load->model('dokter_model');

		$this->load->library(array('Key'));
		$this->load->library('session');
		$this->load->library('all_controllers');
	}

	public function index()
	{
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Manage Dokter",
			$view = "admin/manage_dokter"
		);

		$data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
		$data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_dokter = $("#table_dokter").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
								  $("#table_dokter_filter").remove();
								  $("#search").on("keyup", function(e){
									table_dokter.search($(this).val()).draw();
								  });

                                    $("#modalHapus").on("show.bs.modal", function(e) {
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                    });
                                });
                              </script>';
		$data['list_dokter'] = $this->dokter_model->get_all();
		$this->load->view('template', $data);
	}

	public function jadwal_dokter()
	{
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Manage Jadwal Dokter",
			$view = "admin/manage_jadwalDokter"
		);

		$id_user_kategori = 2;
		$where  = array('master_user.id_user_kategori' => $id_user_kategori, 'master_user.aktif' => 1);
		$jadwal = $this->master_jadwal_model->get_jadwal_dokter($where);
		$data['jadwal'] = $jadwal;
		$data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
		$data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
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

                                    $("#modalHapus").on("show.bs.modal", function(e) {
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                    });
                                });
                              </script>';
		$this->load->view('template', $data);
	}

	public function form_dokter()
	{
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Tambah Dokter",
			$view = "admin/form_dokter"
		);

		$data['list_poli'] = $this->db->query('SELECT id,poli FROM nominal WHERE aktif=1 ORDER BY nominal.poli')->result();
		if ($this->session->flashdata('old_form')) {
			$data['js_addons'] = '
			<script>
			$(document).ready(function(){
				$("#provinsi").empty();
				$("#kotkab").empty();
				$("#kecamatan").empty();
				$("#kelurahan").empty();

				$.ajax({
					method : "POST",
					url    : baseUrl+"Alamat/getProvinsi/",
					data   : {id_provinsi:"' . $this->session->flashdata('old_form')['alamat_provinsi'] . '"},
					success : function(data){
						data = JSON.parse(data);
						$.each(data, function(index, item){
							var template_provinsi = "<option value=\""+item.id+"\" "+item.selected+">"+item.name+"</option>";
							$("#provinsi").append(template_provinsi);
						});
						
					},
					error : function(data){
						alert("Terjadi kesalahan sistem, silahkan hubungi administrator.");
					}
				});
				
				$.ajax({
					method : "POST",
					url    : baseUrl+"Alamat/getKotKab",
					data   : {id_kotkab:"' . $this->session->flashdata('old_form')['alamat_kota'] . '"},
					success : function(data){
						data = JSON.parse(data);
						$.each(data, function(index, item){
							var template_kotkab = "<option value=\""+item.id+"\">"+item.name+"</option>";
							$("#kotkab").append(template_kotkab);
						});
						
					},
					error : function(data){
						alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
					}
				});
				
				$.ajax({
					method : "POST",
					url    : baseUrl+"Alamat/getKecamatan",
					data   : {id_kecamatan:"' . $this->session->flashdata('old_form')['alamat_kecamatan'] . '"},
					success : function(data){
						data = JSON.parse(data);
						$.each(data, function(index, item){
							var template_kecamatan = "<option value=\""+item.id+"\">"+item.name+"</option>";
							$("#kecamatan").append(template_kecamatan);
						});
						
					},
					error : function(data){
						alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
					}

				});

				$.ajax({
					method : "POST",
					url    : baseUrl+"Alamat/getKelurahan",
					data   : {id_kelurahan:"' . $this->session->flashdata('old_form')['alamat_kelurahan'] . '"},
					success : function(data){
						data = JSON.parse(data);
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
		} else {
			$data['js_addons'] = '
			<script>
			$(document).ready(function(){
				$.ajax({
					method : "POST",
					url    : baseUrl+"Alamat/getProvinsi/",
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
		}
		$this->load->view('template', $data);
	}

	public function form_jadwalDokter()
	{
		$this->all_controllers->check_user_admin();

		$data['id_user_kategori'] = 2;
		$data['aktif'] = 1;
		$dokter = $this->all_model->select('master_user', 'tabel', $data);

		$data = $this->all_controllers->get_data_view(
			$title = "Tambah Dokter",
			$view = "admin/form_jadwalDokter"
		);

		$data['dokter'] = $dokter;

		$data['specialist'] = $this->all_model->select('master_specialist', 'tabel');

		$data['css_addons'] = '<link rel="stylesheet" href="' . base_url() . 'assets/plugins/timepicker/css/timepicker.min.css">';
		$data['js_addons'] = '<script src="' . base_url() . 'assets/plugins/timepicker/js/timepicker.min.js"></script>
<script>
var timepicker = new TimePicker("time", {
  lang: "en",
  theme: "dark"
});
timepicker.on("change", function(evt) {
  
  var value = (evt.hour || "00") + ":" + (evt.minute || "00");
  evt.element.value = value;

});
</script>
<script>
$(document).ready(function(){
    $(".khusus").hide();
    $("input[name=\"colorRadio\"]").click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>
		';
		//echo '<pre>';
		//print_r($data);
		//echo '</pre>';
		$this->load->view('template', $data);
	}

	public function addDokter()
	{
		$this->all_controllers->check_user_admin();

		$result = $this->_get_json_data();
		$data = $this->input->post();
		$data_form = $this->input->post();

		$isStrExists = $this->db->query('SELECT id FROM master_user WHERE str = "' . $data['str'] . '"')->row();
		$isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
		$isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
		if ($isStrExists && $isUsernameExists && $isEmailExists) {
			$result->message = 'GAGAL: Username, Email, dan Str sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'usernameEmailAndStr');
			redirect(base_url('admin/Dokter/form_dokter'));
		} else if ($isStrExists && $isUsernameExists) {
			$result->message = 'GAGAL: Str dan Username sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'usernameAndStr');
			redirect(base_url('admin/Dokter/form_dokter'));
		} else if ($isStrExists && $isEmailExists) {
			$result->message = 'GAGAL: Str dan Email sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'strAndEmail');
			redirect(base_url('admin/Dokter/form_dokter'));
		} else if ($isUsernameExists && $isEmailExists) {
			$result->message = 'GAGAL: Username dan Email sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'usernameAndEmail');
			redirect(base_url('admin/Dokter/form_dokter'));
		} else if ($isUsernameExists) {
			$result->message = 'GAGAL: Username sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'username');
			redirect(base_url('admin/Dokter/form_dokter'));
		} else if ($isEmailExists) {
			$result->message = 'GAGAL: Email sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'email');
			redirect(base_url('admin/Dokter/form_dokter'));
		} else if ($isStrExists) {
			$result->message = 'GAGAL: Str sudah digunakan!';
			$this->session->set_flashdata('msg_add_dokter', $result->message);
			$this->session->set_flashdata('old_form', $data_form);
			$this->session->set_flashdata('error', 'str');
			redirect(base_url('admin/Dokter/form_dokter'));
		}

		unset($data['confirmasipassword']);
		$id_poli = $data['poli'];
		$pengalaman = $data['pengalaman'];
		unset($data['poli']);
		unset($data['pengalaman']);
		unset($data['pengalaman_sampai']);
		if ($data["id_user_kategori"] == 2) {
			// 	if (!empty($_FILES['foto']['name'])) {
			//         $data['foto'] = $this->_upload_file('foto');
			// $data["password"] = md5($data["password"]);

			//         if ($data['foto'] === FALSE) {
			//             $result->message = 'Foto gagal diupload';

			//             echo json_encode($result);

			//             die();
			//         }
			//     }
			$data["password"] = md5($data["password"]);
			unset($data['id_user_jenis']);
			unset($data['id_user_spesialis']);
			unset($data['id_layanan']);
			unset($data['id']);
			//echo $this->all_model->insert('master_user', $data); die();
			if ($this->all_model->insert('master_user', $data) == 1) {
				$result->status = TRUE;
				$result->message = 'Data user dokter berhasil disimpan';

				$userid = $this->db->insert_id();

				if (isset($_FILES['foto'])) {
					$config['upload_path']          = './assets/images/users';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
					$config['max_size']             = 10024;
					// $config['max_width']            = 1024;
					// $config['max_height']           = 768;
					$config['file_name'] = 'userfoto_' . $userid;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->overwrite = true;

					if (!$this->upload->do_upload('foto')) {
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('msg', 'Upload Foto Gagal!');
					} else {
						$data_foto = array('upload_data' => $this->upload->data());
						$data['foto'] = $data_foto['upload_data']['file_name'];
						$data_update = array('foto' => $data['foto']);
						$this->all_model->update('master_user', $data_update, array('id' => $userid));
					}
				}
				// TAMBAH KE ACTIVITY LOG DENGAN NAMA ACTIVITY = Menambahkan Dokter
				$data_detail_dokter = array('id_dokter' => $userid, 'pengalaman_kerja' => $pengalaman, 'id_poli' => $id_poli);
				$this->db->insert('detail_dokter', $data_detail_dokter);

				$this->load->library('user_agent');

				if ($this->agent->is_browser()) {
					$agent = $this->agent->browser() . ' ' . $this->agent->version();
				} elseif ($this->agent->is_robot()) {
					$agent = $this->agent->robot();
				} elseif ($this->agent->is_mobile()) {
					$agent = $this->agent->mobile();
				} else {
					$agent = 'Unidentified User Agent';
				}

				$ip_address = $this->input->ip_address();

				$data = array(
					"id_user" => $this->session->userdata('id_user'),
					"ip" => $ip_address,
					"user_agent" => $agent,
					"activity" => 'Menambahkan Dokter'
				);

				$this->db->insert('log_activity', $data);
				// ============================================================ // 

				$this->session->set_flashdata('msg_edit_dokter', $result->message);
				redirect(base_url('admin/Dokter/'));
			} else {
				$result->message = 'ERROR: Gagal menambahkan dokter!';
				$this->session->set_flashdata('msg_edit_dokter', $result->message);
				redirect(base_url('admin/Dokter/form_dokter'));
			}
		} else {
			$result->message = 'Maaf kategori user bukan dokter fasyankes';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			redirect(base_url('admin/Dokter/'));
		}
	}


	public function tampilEditDokter($id)
	{
		$this->all_controllers->check_user_admin();
		$hasil = $this->all_controllers->get_data_view(
			$title = "Edit Dokter",
			$view = "admin/form_edit_dokter"
		);

		$result = $this->_get_json_data();
		$data['id'] = $id;
		//echo $this->all_model->insert('master_user', $data); die();
		$user = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = ' . $id)->row();

		$hasil['result'] = $result;
		$hasil['data'] = $user;
		$hasil['list_poli'] = $this->db->query('SELECT id,poli,aktif FROM nominal ORDER BY nominal.poli')->result();
		$hasil['detail_dokter'] = $this->db->query('SELECT id_poli, pengalaman_kerja FROM detail_dokter WHERE id_dokter = ' . $id)->row();
		$hasil['js_addons'] = '
	<script>
	$(document).ready(function(){
		$.ajax({
			method : "POST",
			url    : baseUrl+"Alamat/getProvinsi",
			data   : {id_user:' . $id . '},
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
		$this->load->view('template', $hasil);
	}

	public function updateDokter($id)
	{
		$this->all_controllers->check_user_admin();

		$result = $this->_get_json_data();
		$data = $this->input->post();
		$isStrExists = $this->db->query('SELECT id FROM master_user WHERE str = "' . $data['str'] . '"')->row();
		$isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
		$isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
		$this_user = $this->db->query('SELECT str, username, email FROM master_user WHERE id = ' . $id)->row();
		if (($isStrExists && $this_user->str != $data['str']) && ($isUsernameExists && $this_user->username != $data['username']) && ($isEmailExists && $this_user->email != $data['email'])) {
			$result->message = 'GAGAL: Username, Email, dan Str sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'usernameEmailAndStr');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		} else if (($isStrExists && $this_user->str != $data['str']) && ($isUsernameExists && $this_user->username != $data['username'])) {
			$result->message = 'GAGAL: Str dan Username sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'usernameAndStr');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		} else if (($isStrExists && $this_user->str != $data['str']) && ($isEmailExists && $this_user->email != $data['email'])) {
			$result->message = 'GAGAL: Str dan Email sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'strAndEmail');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		} else if (($isUsernameExists && $this_user->username != $data['username']) && ($isEmailExists && $this_user->email != $data['email'])) {
			$result->message = 'GAGAL: Username dan Email sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'usernameAndEmail');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		} else if (($isUsernameExists && $this_user->username != $data['username'])) {
			$result->message = 'GAGAL: Username sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'username');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		} else if (($isEmailExists && $this_user->email != $data['email'])) {
			$result->message = 'GAGAL: Email sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'email');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		} else if (($isStrExists && $this_user->str != $data['str'])) {
			$result->message = 'GAGAL: Str sudah digunakan!';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			$this->session->set_flashdata('error', 'str');
			redirect(base_url('admin/Dokter/tampilEditDokter/' . $id));
		}
		$where = array('id' => $id);
		$id_poli = $data['poli'];
		$pengalaman_kerja = $data['pengalaman'];
		unset($data['poli']);
		unset($data['pengalaman']);
		unset($data['pengalaman_sampai']);
		$data_detail_dokter = array('id_poli' => $id_poli, 'pengalaman_kerja' => $pengalaman_kerja);
		$detail_dokter = $this->db->query('SELECT id FROM detail_dokter WHERE id_dokter = ' . $id)->row();

		if (!$detail_dokter) {
			$data_detail_dokter['id_dokter'] = $id;
			$this->db->insert('detail_dokter', $data_detail_dokter);
		} else {
			$this->all_model->update('detail_dokter', $data_detail_dokter, array('id_dokter' => $id));
		}
		$userid = $id;
		if (isset($_FILES['foto'])) {
			$config['upload_path']          = './assets/images/users';
			$config['allowed_types']        = 'jfif|gif|jpg|png|jpeg';
			$config['max_size']             = 5024;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;
			$config['file_name'] = 'userfoto_' . $userid;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->overwrite = true;

			if (!$this->upload->do_upload('foto')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msg', 'Upload Foto Gagal!');
			} else {
				$data_foto = array('upload_data' => $this->upload->data());
				$data['foto'] = $data_foto['upload_data']['file_name'];
				$data_update = array('foto' => $data['foto']);
				$this->all_model->update('master_user', $data_update, array('id' => $id));
			}
		}
		if ($this->all_model->update('master_user', $data, $where) == 1) {
			if ($data['aktif'] == 0) {
				$this->all_model->update('master_user', array('register_token' => NULL), array('id' => $userid));
			}
			$result->status = TRUE;
			$result->message = 'Data user dokter berhasil diubah';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			redirect(base_url('admin/Dokter'));
		} else {
			$result->message = 'Data user dokter berhasil diubah';
			$this->session->set_flashdata('msg_edit_dokter', $result->message);
			redirect(base_url('admin/Dokter'));
		}
	}

	public function hapusDokter($id)
	{
		$this->all_controllers->check_user_admin();

		$where = array('id' => $id,'id_user_kategori'=>2);
		$jadwal_dokter = $this->db->query('SELECT id FROM jadwal_dokter WHERE id_dokter = '.$id)->row();
		$data_registrasi = $this->db->query('SELECT data_registrasi.id FROM data_registrasi INNER JOIN jadwal_dokter ON jadwal_dokter.id =  data_registrasi.id_jadwal WHERE jadwal_dokter.id_dokter = '.$id)->row();
		$bukti_pembayaran = $this->db->query('SELECT id FROM bukti_pembayaran WHERE id_dokter = '.$id)->row();
		$bukti_pembayaran_obat = $this->db->query('SELECT id FROM bukti_pembayaran_obat WHERE id_dokter = '.$id)->row();
		$jadwal_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id_dokter = '.$id)->row();
		$resep_dokter = $this->db->query('SELECT id FROM resep_dokter WHERE id_dokter = '.$id)->row();
		if($jadwal_dokter || $data_registrasi || $bukti_pembayaran || $bukti_pembayaran_obat || $jadwal_konsultasi || $resep_dokter){
			$result->message = "GAGAL: Dokter masih memiliki transaksi / jadwal yang terkait!";
			$this->session->set_flashdata('msg_hps_dokter', $result->message);
			redirect(base_url('admin/Dokter'));
		}

		if ($this->all_model->delete('master_user', $where) == 1) {
			$detail_dokter = $this->db->query('SELECT id FROM detail_dokter WHERE id_dokter = ' . $id)->row();
			if ($detail_dokter) {
				$this->db->delete('detail_dokter', array('id_dokter' => $id));
			}
			$result->message = "Data user dokter berhasil dihapus!";
		} else {
			$result->message = "Data user dokter gagal dihapus!";
		}

		$this->session->set_flashdata('msg_hps_dokter', $result->message);
		redirect(base_url('admin/Dokter'));
	}

	public function addJadwalDokter()
	{
		$this->all_controllers->check_user_admin();

		$result = $this->_get_json_data();
		$data = $this->input->post();
		$detail_dokter = $this->db->query('SELECT nominal.poli FROM detail_dokter ddr INNER JOIN nominal ON nominal.id = ddr.id_poli WHERE ddr.id_dokter = ' . $data['id_dokter'])->row();
		$data['poli'] = $detail_dokter->poli;
		$data['waktu'] = $data['waktu1'] . ' - ' . $data['waktu2'];
		if (((int)explode('.', $data['waktu1'])[0] - (int)explode('.', $data['waktu2'])[0]) > 0) {
			$this->session->set_flashdata('msg_jadwal_dokter', 'Selisih Waktu Tidak Benar, Harap Periksa Kembali!');
			redirect(base_url('admin/Dokter/form_jadwalDokter'));
		}
		if ($data['tanggal']) {
			$datetime = DateTime::createFromFormat('Y-m-d', $data['tanggal']);
			$english_day = $datetime->format('D');

			switch ($english_day) {
				case 'Mon':
					$data['hari'] = 'Senin';
					break;
				case 'Tue':
					$data['hari'] = 'Selasa';
					break;
				case 'Wed':
					$data['hari'] = 'Rabu';
					break;
				case 'Thu':
					$data['hari'] = 'Kamis';
					break;
				case 'Fri':
					$data['hari'] = "Jum'at";
					break;
				case 'Sat':
					$data['hari'] = 'Sabtu';
					break;
				case 'Sun':
					$data['hari'] = 'Minggu';
					break;
				default:
					$data['hari'] = '';
					break;
			}
		}

		// ========================== PENGECEKAN APAKAH JADWAL BENTROK / TIDAK ============================== //
		$new_start_time = new DateTime($data['waktu1']);
		$new_end_time = new DateTime($data['waktu2']);
		$new_since_start = $new_start_time->diff($new_end_time);
		$new_diff_minutes = $new_since_start->days * 24 * 60;
		$new_diff_minutes += $new_since_start->h * 60;
		$new_diff_minutes += $new_since_start->i;

		$list_jadwal_dokter = $this->db->query('SELECT waktu FROM jadwal_dokter WHERE id_dokter = ' . $data['id_dokter'] . ' AND hari = "' . $data['hari'] . '"')->result();
		$isJadwalExists = false;
		foreach ($list_jadwal_dokter as $jadwal_dokter) {
			$jadwal_dokter_waktu = explode('-', str_replace(' ', '', $jadwal_dokter->waktu));
			$start_time = new DateTime($jadwal_dokter_waktu[0]);
			$since_start_jadwal = $new_start_time->diff($start_time);
			$diff_minutes_jadwal = $since_start_jadwal->days * 24 * 60;
			$diff_minutes_jadwal += $since_start_jadwal->h * 60;
			$diff_minutes_jadwal += $since_start_jadwal->i;
			if ($diff_minutes_jadwal < $new_diff_minutes) {
				$isJadwalExists = true;
			}

			$end_time = new DateTime($jadwal_dokter_waktu[1]);
			$since_start_jadwal = $end_time->diff($new_end_time);
			$diff_minutes_jadwal = $since_start_jadwal->days * 24 * 60;
			$diff_minutes_jadwal += $since_start_jadwal->h * 60;
			$diff_minutes_jadwal += $since_start_jadwal->i;
			if ($diff_minutes_jadwal < $new_diff_minutes) {
				$isJadwalExists = true;
			}
		}

		if ($isJadwalExists) {
			$this->session->set_flashdata('msg_jadwal_dokter', 'Waktu jadwal bentrok, cek ulang data jadwal sebelum mengisi!');
			redirect(base_url('admin/Dokter/form_jadwalDokter'));
		}

		// ----------------------------------------------------------------- //

		unset($data['waktu1']);
		unset($data['waktu2']);
		if ($this->all_model->insert('jadwal_dokter', $data) == 1) {
			$result->status = TRUE;
			$result->message = 'Jadwal dokter berhasil disimpan';
		} else {
			$result->message = 'Jadwal dokter gagal disimpan';
		}

		// SEND NOTIF //
		$now = (new DateTime('now'))->format('Y-m-d H:i:s');
		if ($data['tanggal']) {
			$notifikasi = 'Jadwal anda telah dibuat [' . $data['hari'] . ' ' . $data['tanggal'] . ' ' . $data['waktu'] . ']';
		} else {
			$notifikasi = 'Jadwal anda telah dibuat [' . $data['hari'] . ' ' . $data['waktu'] . ']';
		}
		$dokter = $this->db->query('SELECT reg_id,id FROM master_user WHERE id = ' . $data['id_dokter'])->row();

		$data_notif = array("id_user" => $dokter->id, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('dokter/Jadwal'));
		$this->db->insert('data_notifikasi', $data_notif);
		$id_notif = $this->db->insert_id();

		$msg_notif = array(
			'name' => 'add_jadwal_dokter',
			'id_notif' => $id_notif,
			'keterangan' => $notifikasi,
			'tanggal' => $now,
			'id_user' => json_encode(array($dokter->id)),
			'direct_link' => base_url('dokter/Jadwal'),
		);
		$msg_notif = json_encode($msg_notif);
		$this->key->_send_fcm($dokter->reg_id, $msg_notif);
		// ----------//

		$this->session->set_flashdata('msg_jadwal_dokter', $result->message);
		redirect(base_url('admin/Dokter/jadwal_dokter'));
	}

	public function hapus_jadwalDokter($id)
	{
		$this->all_controllers->check_user_admin();

		$deleter = $this->db->query('SELECT name FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
		$jadwal_dokter = $this->db->query('SELECT d.reg_id as dokter_reg_id, d.id as id_dokter FROM jadwal_dokter jd INNER JOIN master_user d ON jd.id_dokter = d.id WHERE jd.id = ' . $id)->row();

		$data_registrasi = $this->db->query('SELECT id FROM data_registrasi WHERE id_jadwal = '.$id)->row();
		if($data_registrasi){
			 $result->message = "GAGAL: Jadwal Dokter masih memiliki transaksi terkait!";
			 $this->session->set_flashdata('msg_jadwal_dokter', $result->message);
			 redirect(base_url('admin/Dokter/jadwal_dokter'));
		}

		$where = array('id' => $id);
		if ($this->all_model->delete('jadwal_dokter', $where) == 1) {
			// SEND NOTIF //
			$now = (new DateTime('now'))->format('Y-m-d H:i:s');
			$notifikasi = 'Jadwal anda telah dihapus oleh ' . $deleter->name;

			$data_notif = array("id_user" => $jadwal_dokter->id_dokter, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('dokter/Jadwal'));
			$this->db->insert('data_notifikasi', $data_notif);
			$id_notif = $this->db->insert_id();

			$msg_notif = array(
				'name' => 'delete_jadwal_dokter',
				'id_notif' => $id_notif,
				'keterangan' => $notifikasi,
				'tanggal' => $now,
				'id_user' => json_encode(array($jadwal_dokter->id_dokter)),
				'direct_link' => base_url('dokter/Jadwal'),
			);
			$msg_notif = json_encode($msg_notif);
			$this->key->_send_fcm($jadwal_dokter->dokter_reg_id, $msg_notif);
			// ----------//
			$result->message = "Data jadwal dokter berhasil dihapus!";
		} else {
			$result->message = "Data jadwal dokter gagal dihapus!";
		}
		
		$this->session->set_flashdata('msg_jadwal_dokter', $result->message);
		redirect(base_url('admin/Dokter/jadwal_dokter'));
	}

	public function tampilEdit_jadwalDokter($id)
	{
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Edit Jadwal Dokter",
			$view = "admin/form_edit_jadwalDokter"
		);

		$data['dokter'] = $this->all_model->select('master_user', 'tabel', array('id_user_kategori'=>2, 'aktif'=>1));
		$data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

		$data['specialist'] = $this->all_model->select('master_specialist', 'tabel');
		$data['id'] = $id;
		//echo $this->all_model->insert('master_user', $data); die();
		$where  = array('master_user.id_user_kategori' => 2, 'jadwal_dokter.id' => $data['id']);
		$data['jadwal'] = $this->master_jadwal_model->get_jadwal_dokter_by_id($where);
		if ($data['jadwal'][0]->tanggal) {
			$data['tipe'] = 'khusus';
			$data['hide-tipe'] = 'rutin';
		} else {
			$data['tipe'] = 'rutin';
			$data['hide-tipe'] = 'khusus';
		}
		if ($data['jadwal']) {
			$data['status'] = TRUE;
			$data['message'] = 'Data user dokter berhasil disimpan';
		} else {
			$data['status'] = FALSE;
			$data['message'] = 'Data user dokter gagal disimpan';
		}

		$data['js_addons'] = '
<script>
$(document).ready(function(){
$(".' . $data['hide-tipe'] . '").hide();
$("input[name=\"colorRadio\"]").click(function(){
	var inputValue = $(this).attr("value");
	var targetBox = $("." + inputValue);
	$(".box").not(targetBox).hide();
	$(targetBox).show();
});
});
</script>       
	';

		$this->load->view('template', $data);
	}

	public function updateJadwalDokter($id)
	{
		$this->all_controllers->check_user_admin();

		$result = $this->_get_json_data();
		$data = $this->input->post();
		$jadwal_dokter = $this->db->query('SELECT jd.id, jd.aktif, dr.id_status_pembayaran, dr.id as id_registrasi, bp.id as id_bukti FROM jadwal_dokter jd LEFT JOIN data_registrasi dr ON dr.id_jadwal = jd.id LEFT JOIN bukti_pembayaran bp ON bp.id_registrasi = dr.id WHERE jd.id = '.$id)->row();
		if($data['aktif'] == 0 && $jadwal_dokter->aktif != 0){
			if($jadwal_dokter->id_registrasi != null){
				$this->session->set_flashdata('msg_jadwal_dokter', 'GAGAL: Jadwal ini tidak dapat dinonaktifkan, karena sudah ada pasien yang mendaftar!');
				redirect(base_url('admin/Dokter/tampilEdit_jadwalDokter/' . $id));
			}
		}else if($data['aktif'] == $jadwal_dokter->aktif){
			if($jadwal_dokter->id_registrasi != null || $jadwal_dokter->id_bukti != null){
				$this->session->set_flashdata('msg_jadwal_dokter', 'GAGAL: Jadwal ini tidak dapat diubah, karena sudah ada pasien yang mendaftar!');
				redirect(base_url('admin/Dokter/tampilEdit_jadwalDokter/' . $id));
			}
		}
		// $detail_dokter = $this->db->query('SELECT nominal.poli FROM detail_dokter ddr INNER JOIN nominal ON nominal.id = ddr.id_poli WHERE ddr.id_dokter = '.$data['id_dokter'])->row();
		// $data['poli'] = $detail_dokter->poli;
		$data['waktu'] = $data['waktu1'] . ' - ' . $data['waktu2'];
		if (isset($data['tanggal'])) {
			$datetime = DateTime::createFromFormat('Y-m-d', $data['tanggal']);
			$english_day = $datetime->format('D');

			switch ($english_day) {
				case 'Mon':
					$data['hari'] = 'Senin';
					break;
				case 'Tue':
					$data['hari'] = 'Selasa';
					break;
				case 'Wed':
					$data['hari'] = 'Rabu';
					break;
				case 'Thu':
					$data['hari'] = 'Kamis';
					break;
				case 'Fri':
					$data['hari'] = "Jum'at";
					break;
				case 'Sat':
					$data['hari'] = 'Sabtu';
					break;
				case 'Sun':
					$data['hari'] = 'Minggu';
					break;
				default:
					$data['hari'] = '';
					break;
			}
		}

		// ========================== PENGECEKAN APAKAH JADWAL BENTROK / TIDAK ============================== //
		$new_start_time = new DateTime($data['waktu1']);
		$new_end_time = new DateTime($data['waktu2']);
		$new_since_start = $new_start_time->diff($new_end_time);
		$new_diff_minutes = $new_since_start->days * 24 * 60;
		$new_diff_minutes += $new_since_start->h * 60;
		$new_diff_minutes += $new_since_start->i;

		$list_jadwal_dokter = $this->db->query('SELECT tanggal, waktu FROM jadwal_dokter WHERE id_dokter = ' . $data['id_dokter'] . ' AND hari = "' . $data['hari'] . '" AND id != '.$id)->result();
		$isJadwalExists = false;
		foreach ($list_jadwal_dokter as $jadwal_dokter) {
			$jadwal_dokter_waktu = explode('-', str_replace(' ', '', $jadwal_dokter->waktu));
			$start_time = new DateTime($jadwal_dokter_waktu[0]);
			$since_start_jadwal = $new_start_time->diff($start_time);
			$diff_minutes_jadwal = $since_start_jadwal->days * 24 * 60;
			$diff_minutes_jadwal += $since_start_jadwal->h * 60;
			$diff_minutes_jadwal += $since_start_jadwal->i;
			if ($diff_minutes_jadwal < $new_diff_minutes && $jadwal_dokter->id != $id) {
				if($jadwal_dokter->tanggal){
					$tgl_dokter = new DateTime($jadwal_dokter->tanggal);
					$now = new DateTime('now');
					$diff_now_tgl_dokter = $now->diff($tgl_dokter);
					if(!$diff_now_tgl_dokter->invert){
						$isJadwalExists = true;
					}
				}else{
					$isJadwalExists = true;
				}
			}

			$end_time = new DateTime($jadwal_dokter_waktu[1]);
			$since_start_jadwal = $end_time->diff($new_end_time);
			$diff_minutes_jadwal = $since_start_jadwal->days * 24 * 60;
			$diff_minutes_jadwal += $since_start_jadwal->h * 60;
			$diff_minutes_jadwal += $since_start_jadwal->i;
			if ($diff_minutes_jadwal < $new_diff_minutes && $jadwal_dokter->id != $id) {
				if($jadwal_dokter->tanggal){
					$tgl_dokter = new DateTime($jadwal_dokter->tanggal);
					$now = new DateTime('now');
					$diff_now_tgl_dokter = $now->diff($tgl_dokter);
					if(!$diff_now_tgl_dokter->invert){
						$isJadwalExists = true;
					}
				}else{
					$isJadwalExists = true;
				}
			}
		}

		if ($isJadwalExists) {
			$this->session->set_flashdata('msg_jadwal_dokter', 'Waktu jadwal bentrok, cek ulang data jadwal sebelum mengisi!');
			redirect(base_url('admin/Dokter/tampilEdit_jadwalDokter/' . $id));
		}

		// ----------------------------------------------- //
		unset($data['waktu1']);
		unset($data['waktu2']);
		if (!isset($data['tanggal'])) {
			$data['tanggal'] = null;
		}
		$where = array('id' => $id);
		if ($this->all_model->update('jadwal_dokter', $data, $where) == 1) {
			$result->status = TRUE;
			$result->message = 'Jadwal dokter berhasil diubah';
			// SEND NOTIF //
			$now = (new DateTime('now'))->format('Y-m-d H:i:s');
			if ($data['tanggal']) {
				$notifikasi = 'Jadwal anda telah diubah [' . $data['hari'] . ' ' . $data['tanggal'] . ' ' . $data['waktu'] . ']';
			} else {
				$notifikasi = 'Jadwal anda telah diubah [' . $data['hari'] . ' ' . $data['waktu'] . ']';
			}
			$dokter = $this->db->query('SELECT master_user.reg_id,master_user.id, nominal.poli FROM master_user LEFT JOIN detail_dokter ON detail_dokter.id_dokter = master_user.id LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE master_user.id = ' . $data['id_dokter'])->row();

			$data_update = array('poli' => $dokter->poli);
			$this->all_model->update('jadwal_dokter', $data_update, array('id' => $id));

			$data_notif = array("id_user" => $dokter->id, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('dokter/Jadwal'));
			$this->db->insert('data_notifikasi', $data_notif);
			$id_notif = $this->db->insert_id();

			$msg_notif = array(
				'name' => 'add_jadwal_dokter',
				'id_notif' => $id_notif,
				'keterangan' => $notifikasi,
				'tanggal' => $now,
				'id_user' => json_encode(array($dokter->id)),
				'direct_link' => base_url('dokter/Jadwal'),
			);
			$msg_notif = json_encode($msg_notif);
			$this->key->_send_fcm($dokter->reg_id, $msg_notif);
			// ----------//

		} else {
			$result->message = 'Jadwal dokter gagal diubah';
		}
		redirect(base_url('admin/Dokter/jadwal_dokter'));
	}


	private function _get_json_data($status = FALSE, $message = '', $data = NULL)
	{
		$result = new stdClass();

		$result->status = $status;
		$result->message = $message;
		$result->data = $data;

		return $result;
	}

	private function _get_user($username)
	{
		$where = array('username' => $username);

		return $this->all_model->select('master_user', 'row', $where);
	}
}
