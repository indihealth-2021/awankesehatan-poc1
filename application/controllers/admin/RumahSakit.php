<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RumahSakit extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('RumahSakit_model');
        $this->load->library('all_controllers');
    }

    public function manage_rs(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Manage RS",
            $view="admin/manage_rs"
        );

        $data['rs'] = $this->db->query('SELECT master_rs.*, master_provinsi.name as nama_provinsi, master_kota.name as nama_kota, master_kecamatan.name as nama_kecamatan, master_kelurahan.name as nama_kelurahan FROM master_rs LEFT JOIN master_provinsi ON master_provinsi.id = master_rs.alamat_provinsi LEFT JOIN master_kota ON master_kota.id = master_rs.alamat_kota LEFT JOIN master_kecamatan ON master_kecamatan.id = master_rs.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = master_rs.alamat_kelurahan')->row();
        $provinsi = $data['rs'] ? $data['rs']->alamat_provinsi : '';
        $data['js_addons'] = '
		<script>
		$(document).ready(function(){
			$.ajax({
				method : "POST",
				url    : baseUrl+"Alamat/getProvinsi",
				data   : {id_provinsi:"'.$provinsi.'"},
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

        $("#logo-rs").change(function() {
            var file = $("#logo-rs")[0].files[0].name;
            var file_substr = file.length > 40 ? file.substr(0, 39)+"...":file;
            $("#filename").html("<span title=\"" + file + "\">" + file_substr + "</span>");
          });
		</script>
        ';

        $this->load->view('template', $data);
    }

    public function save_rs(){
        $this->all_controllers->check_user_admin();
        $post_data = $this->input->post();

        $nama = $post_data['nama'];
        $telp_fax = $post_data['telp_fax'];
        $alamat_provinsi = $post_data['alamat_provinsi'];
        $alamat_kota = $post_data['alamat_kota'];
        $alamat_kecamatan = $post_data['alamat_kecamatan'];
        $alamat_kelurahan = $post_data['alamat_kelurahan'];
        $alamat_detail = $post_data['alamat_detail'];
        $kode_pos = $post_data['kode_pos'];
        $direktur = $post_data['direktur'];
        if(!$nama || !$telp_fax || !$alamat_provinsi || $alamat_provinsi == "PILIH PROVINSI" || !$alamat_kota || $alamat_kota == "PILIH KABUPATEN/KOTA" || !$alamat_kecamatan || $alamat_kecamatan == "PILIH KECAMATAN" || !$alamat_kelurahan || $alamat_kelurahan == "PILIH KELURAHAN" || !$alamat_detail || !$kode_pos || !$direktur){
            $this->session->set_flashdata('msg', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('admin/RumahSakit/manage_rs'));
        }
        $data_rs = [
            "nama"=>$nama,
            "telp_fax"=>$telp_fax,
            "alamat_provinsi"=>$alamat_provinsi,
            "alamat_kota"=>$alamat_kota,
            "alamat_kecamatan"=>$alamat_kecamatan,
            "alamat_kelurahan"=>$alamat_kelurahan,
            "alamat_detail"=>$alamat_detail,
            "kode_pos"=>$kode_pos,
            "direktur"=>$direktur,
        ];

        $master_rs = $this->db->query('SELECT id FROM master_rs')->row();
        if($master_rs){
            $this->all_model->update('master_rs', $data_rs, ['id'=>$master_rs->id]);
            $id_rs = $master_rs->id;
        }else{
            $this->db->insert('master_rs', $data_rs);
            $id_rs = $this->db->insert_id();
        }

        $alamat_provinsi = $this->db->query('SELECT name FROM master_provinsi WHERE id = '.$alamat_provinsi)->row()->name;
        $alamat_kota = $this->db->query('SELECT name FROM master_kota WHERE id = '.$alamat_kota)->row()->name;
        $alamat_kecamatan = $this->db->query('SELECT name FROM master_kecamatan WHERE id = '.$alamat_kecamatan)->row()->name;
        $alamat_kelurahan = $this->db->query('SELECT name FROM master_kelurahan WHERE id = '.$alamat_kelurahan)->row()->name;
        if(!$alamat_provinsi || !$alamat_kota || !$alamat_kecamatan || !$alamat_kelurahan){
            $this->session->set_flashdata('msg', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('admin/RumahSakit/manage_rs'));
        }
        $alamat_rs = $alamat_detail.', KELURAHAN '.$alamat_kelurahan.', KECAMATAN '.$alamat_kecamatan.', '.$alamat_kota.', '.$alamat_provinsi.' '.$kode_pos;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyC7IdKoPYrF-6bqtHHOt3Rwa3xvsnSO2TQ&address='.urlencode($alamat_rs),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $result = json_decode(curl_exec($curl));
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        curl_close($curl);
        $koordinat = $result->results[0]->geometry->location;

        if(!$koordinat){
            $this->session->set_flashdata('msg', 'error');
            redirect(base_url('admin/RumahSakit/manage_rs'));
        }

        $this->all_model->update('master_rs', [
            "lat" => $koordinat->lat,
            "lng" => $koordinat->lng,
        ], ["id"=>$id_rs]);

        if($_FILES['logo']['size'] > 0){
            $config['upload_path']          = './assets/images/logo';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
            $config['max_size']             = 10024;
            $config['file_name'] = 'logo';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->overwrite = true;

            if ( ! $this->upload->do_upload('logo')){
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('msg', 'Upload Foto Gagal!');
                redirect(base_url('admin/RumahSakit/manage_rs'));
            }else{
                $data_foto = array('upload_data' => $this->upload->data());
                $logo = $data_foto['upload_data']['file_name'];
                $this->all_model->update('master_rs', ['logo'=>$logo], ['id'=>$id_rs]);
            }
        }

        $this->session->set_flashdata('msg', 'Data RS telah diupdate!');
        redirect(base_url('admin/RumahSakit/manage_rs'));
    }

    public function users(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Master User RS",
            $view="admin/manage_users_rs"
        );

        $data['users'] = $this->RumahSakit_model->get_all_users();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                let table_users = $("#table_users").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "searching": true,
                                "pageLength": 5,
                                });
                                $("#table_users_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table_users.search($(this).val()).draw();
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

    //--- TAMBAH --//
    public function form_tambah(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Tambah Master User RS",
            $view="admin/form_user_rs"
        );

        $this->load->view('template', $data);
    }
    public function tambah_user(){
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $data_form = $this->input->post();
        unset($data['confirmasipassword']);

        $data["password"] = md5($data["password"]);

        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
        if ($isUsernameExists && $isEmailExists) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_add_user', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/RumahSakit/form_tambah'));
        } else if ($isUsernameExists) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_add_user', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/RumahSakit/form_tambah'));
        } else if ($isEmailExists) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_add_user', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/RumahSakit/form_tambah'));
        }

        if($this->RumahSakit_model->insert_user($data) == 1){
            $result->message = 'BERHASIL: Akun berhasil ditambahkan!';
            $this->session->set_flashdata('msg_user', $result->message);
            // TAMBAH KE ACTIVITY LOG DENGAN NAMA ACTIVITY = Menambahkan Admin
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
                "activity" => 'Menambahkan User RS'
            );

            $this->db->insert('log_activity', $data);
            // ============================================================ //

            redirect(base_url('admin/RumahSakit/users'));
        }else{
            $result->message = 'GAGAL: Akun gagal ditambahkan!';
            $this->session->set_flashdata('msg_user', $result->message);
            redirect(base_url('admin/RumahSakit/users'));
        }
    }
    //------//

    //---- EDIT --//
    public function form_edit_user($id){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Edit Master User RS",
            $view="admin/form_edit_user_rs"
        );

        $data['user_rs'] = $this->RumahSakit_model->get_user($id);

        $this->load->view('template', $data);
    }
    public function edit_user($id){
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username = "' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email = "' . $data['email'] . '"')->row();
        $this_user = $this->db->query('SELECT username, email FROM master_user WHERE id = ' . $id)->row();
        if (($isUsernameExists && $data['username'] != $this_user->username) && ($isEmailExists && $data['email'] != $this_user->email)) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_user', $result->message);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/RumahSakit/form_edit_user/' . $id));
        } else if ($isUsernameExists && $data['username'] != $this_user->username) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_edit_user', $result->message);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/RumahSakit/form_edit_user/' . $id));
        } else if ($isEmailExists && $data['email'] != $this_user->email) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_user', $result->message);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/RumahSakit/form_edit_user/' . $id));
        }

        if($this->RumahSakit_model->update_user($id, $data) == 1){
            $this->session->set_flashdata('msg_user', 'BERHASIL: Akun telah diperbarui!');
        }else{
            $this->session->set_flashdata('msg_user', 'GAGAL: Akun tidak ada yang diperbarui!');
        }

        redirect(base_url('admin/RumahSakit/users'));
    }
    //-----------//

    public function hapus_user($id){
        if($this->RumahSakit_model->delete_user($id) == 1){
            $this->session->set_flashdata('msg_user', 'BERHASIL: Akun telah dihapus!');
        }else{
            $this->session->set_flashdata('msg_user', 'GAGAL: Akun gagal dihapus!');
        }
        redirect(base_url('admin/RumahSakit/users'));
    }
}
