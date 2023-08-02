<?php
defined("BASEPATH") or exit("No direct script access allowed");

class AdminApotek extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("all_model");
        $this->load->model("adminApotek_model");
        $this->load->model("apotek_model");

        $this->load->library('session');
        $this->load->library('all_controllers');
    }

    private function js_addons($key) {
        $dictionary = array();
        $dictionary["index"] = '
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

        return $dictionary[$key];
    }

    private function css_addons($key) {
        $dictionary = [
            "index" => '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">'
        ];

        return $dictionary[$key];
    }

    public function index() {
      $this->all_controllers->check_user_admin();
      $data = $this->all_controllers->get_data_view(
        $title = "Manage Admin Apotek",
        $view = "admin/manage_admin_apotek"
      );

      $data['css_addons'] = $this->css_addons("index");
      $data['js_addons'] = $this->js_addons("index");
      $data['list_admin_apotek'] = $this->adminapotek_model->get_all();

      $this->load->view('template', $data);
    }

    public function form_admin_apotek() {
        $this->all_controllers->check_user_admin();
      $data = $this->all_controllers->get_data_view(
        $title = "Tambah Dokter",
        $view = "admin/form_admin_apotek"
      );

		$data['list_poli'] = $this->db->query('SELECT id,poli FROM nominal WHERE aktif=1 ORDER BY nominal.poli')->result();
        $data["list_apotek"] = $this->db->query("SELECT * FROM master_apotek")->result();
		if ($this->session->flashdata('old_form')) {
			$data['js_addons'] = '
      <script>
      $(document).ready(function(){
          $("#provinsi").empty();
          $("#kotkab").empty();
          $("#kecamatan").empty();
          $("#kelurahan").empty();
          $("#apotek").empty();

          $.ajax({
            method : "POST",
            url    : baseUrl+"Apotek/getAll",
            success : function(data){
                data = JSON.parse(data);
                $.each(data, function(index, item){
                    var template_apotek = "<option value=\""+item.id+"\" "+item.selected+">"+item.nama+"</option>";
                    $("#apotek").append(template_apotek);
                });

            },
            error : function(data){
                alert("Terjadi kesalahan sistem, silahkan hubungi administrator.");
            }
        });
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
                    url    : baseUrl+"Apotek/getAll",
                    success : function(data){
                        data = JSON.parse(data);
                        $.each(data, function(index, item){
                            var template_apotek = "<option value=\""+item.id+"\" "+item.selected+">"+item.nama+"</option>";
                            $("#apotek").append(template_apotek);
                        });

                    },
                    error : function(data){
                        alert("Terjadi kesalahan sistem, silahkan hubungi administrator.");
                    }
                });
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

                $.ajax({
					method : "POST",
					url    : baseUrl+"Apotek/getApotek/",
					success : function(data){
						$("#apotek").empty();
						data = JSON.parse(data);
						$("#apotek").append("<option>PILIH APOTEK</option>");
                        console.log(data);
						$.each(data, function(index, item){
							var template_apotek = "<option value=\""+item.id+"\" "+item.selected+">"+item.nama+"</option>";
							$("#apotek").append(template_apotek);
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

    private function _get_json_data($status = FALSE, $message = '', $data = NULL)
    {
        $result = new stdClass();

        $result->status = $status;
        $result->message = $message;
        $result->data = $data;

        return $result;
    }

    public function addAdminApotek() {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        $data_form = $this->input->post();
        unset($data['confirmasipassword']);

        if ($data["id_user_kategori"] == 5) {
            // if (!empty($_FILES['foto']['name'])) {
            //   $data['foto'] = $this->_upload_file('foto');

            //   if ($data['foto'] === FALSE) {
            //     $result->message = 'Foto gagal diupload';

            //     echo json_encode($result);

            //     die();
            //   }
            // }

            $data["password"] = md5($data["password"]);
            unset($data['id_user_jenis']);
            unset($data['id_user_spesialis']);
            unset($data['id_layanan']);
            unset($data['id']);

            // echo var_dump($data);
            // die;

            // $this->all_model->insert('master_user', $data);
            // echo var_dump($this->db->error());
            // die;

            $redirect = "admin/AdminApotek/form_admin_apotek";
            $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
            $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
            if ($isUsernameExists && $isEmailExists) {
                $result->message = 'GAGAL: Username dan Email sudah digunakan!';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                $this->session->set_flashdata('old_form', $data_form);
                $this->session->set_flashdata('error', 'usernameAndEmail');
                redirect(base_url($redirect));
            } else if ($isUsernameExists) {
                $result->message = 'GAGAL: Username sudah digunakan!';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                $this->session->set_flashdata('old_form', $data_form);
                $this->session->set_flashdata('error', 'username');
                redirect(base_url($redirect));
            } else if ($isEmailExists) {
                $result->message = 'GAGAL: Email sudah digunakan!';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                $this->session->set_flashdata('old_form', $data_form);
                $this->session->set_flashdata('error', 'email');
                redirect(base_url($redirect));
            }

            $data["id_user_kategori"] = 5;
            $data["id_user_level"] = 2;

            if ($this->all_model->insert('master_user', $data) == 1) {
                $result->status = TRUE;
                $result->message = 'Data user admin berhasil disimpan';
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
                    "activity" => 'Menambahkan Admin'
                );

                $this->db->insert('log_activity', $data);
                // ============================================================ //
                $result->message = 'Data user admin berhasil disimpan';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                redirect(base_url('admin/Admin/manage_admin'));
            } else {
                $result->message = 'Data user admin gagal disimpan';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                redirect(base_url('admin/Admin/form_admin'));
            }
        } else {
            $result->message = 'Maaf kategori user bukan admin fasyankes';
            $this->session->set_flashdata('msg_add_admin', $result->message);
            redirect(base_url('admin/AdminApotek/'));
        }
        //   echo var_dump($data);
        //   die;
    }

    public function edit($id) {
        $this->all_controllers->check_user_admin();
        $hasil = $this->all_controllers->get_data_view(
            $title="Edit Admin",
            $view="admin/form_edit_admin_apotek"
        );

        $result = $this->_get_json_data();
        $hasil['data'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan, master_apotek.id as id_apotek, master_apotek.nama as nama_apotek FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id LEFT JOIN master_apotek ON master_user.id_apotek=master_apotek.id WHERE master_user.id = ' . $id)->row();
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

        $.ajax({
            method : "POST",
            url    : baseUrl+"Apotek/getApotekOnUser",
            data   : {id_user:' . $id . '},
            success : function(data){
                $("#apotek").empty();
                data = JSON.parse(data);
                $("#apotek").append("<option>PILIH APOTEK</option>");
                $.each(data, function(index, item){
                    var template_apotek = "<option value=\""+item.id+"\" "+item.selected+">"+item.nama+"</option>";
                    $("#apotek").append(template_apotek);
                });

            },
            error : function(data){
                alert(data);
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

    public function update($id) {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        $data["id_user_kategori"] = 55;
        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username = "' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email = "' . $data['email'] . '"')->row();
        $this_user = $this->db->query('SELECT username, email FROM master_user WHERE id = ' . $id)->row();
        if (($isUsernameExists && $data['username'] != $this_user->username) && ($isEmailExists && $data['email'] != $this_user->email)) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/AdminApotek/edit/' . $id));
        } else if ($isUsernameExists && $data['username'] != $this_user->username) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/AdminApotek/edit/' . $id));
        } else if ($isEmailExists && $data['email'] != $this_user->email) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/AdminApotek/edit/' . $id));
        }

        $where = array('id' => $id);
        $userid = $id;
        if (isset($_FILES['foto'])) {
            $config['upload_path']          = './assets/images/users';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
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
                $this->all_model->update('master_user', $data_update, array('id' => $userid));
            }
        }

        $redirect_route = "admin/AdminApotek/";
        if ($this->all_model->update('master_user', $data, $where) == 1) {
            $result->status = TRUE;
            $result->message = 'Data user admin berhasil diubah';
            if ($data['aktif'] == 0) {
                $this->all_model->update('master_user', array('register_token' => NULL), array('id' => $userid));
            }
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            redirect(base_url($redirect_route));
        } else {
            $result->message = 'Data user admin telah diubah';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            redirect(base_url($redirect_route));
        }
    }

    public function delete($id) {
        $this->all_controllers->check_user_admin();

        if ($id == $this->session->userdata('id_user')) {
            $this->session->set_flashdata('msg_hps_admin', 'ERROR: Tidak bisa menghapus diri sendiri!');
            redirect(base_url('admin/admin/manage_admin'));
        }

        $where = array('id' => $id);
        if ($this->all_model->delete('master_user', $where) == 1) {
            $result->message =  "Data user admin berhasil dihapus";
            $this->session->set_flashdata('msg_hps_admin', $result->message);
        } else {
            $result->message = "Data user admin gagal dihapus";
        $this->session->set_flashdata('msg_hps_admin', $result->message);
        }

        redirect(base_url('admin/admin/manage_admin'));
    }
}
