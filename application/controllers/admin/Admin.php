<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    var $menu = 1;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->model('admin_model');
        $this->load->model('dokter_model');
        $this->load->model('pasien_model');
        $this->load->model('master_obat_model');

        $this->load->library('session');
        $this->load->library('all_controllers');
    }

    public function index()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Dashboard Admin",
            $view="admin/index"
        );

        $data['list_dokter'] = $this->dokter_model->get_all(null, 4);
        $data['list_pasien'] = $this->pasien_model->get_all(null, 4);
        $data['list_poli'] = $this->db->query('SELECT id FROM nominal')->result();
        $data['news'] = $this->db->query('SELECT * FROM data_news ORDER BY created_at DESC LIMIT 0,3')->result();

        $data['jml_admin'] = $this->admin_model->count_all();
        $data['jml_dokter'] = $this->dokter_model->count_all();
        $data['jml_pasien'] = $this->pasien_model->count_all();
        $data['jml_obat'] = $this->master_obat_model->count_all();
        $this->load->view('template', $data);
    }

    private function _category_check($userdata)
    {
        switch ($userdata->id_user_kategori) {
            case '0':
                redirect('pasien/Pasien');
                break;
            case '2':
                redirect('dokter/Dashboard');
                break;
            case '5':
                redirect('admin/Admin');
                break;
        }
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


    public function manage_admin()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Manage Admin",
            $view="admin/manage_admin"
        );
        
        $data['list_admin'] = $this->admin_model->get_all();
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
        <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_admin = $("#table_manage_admin").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_manage_admin_filter").remove();
                                $("#search").on("keyup", function(e){
                                table_admin.search($(this).val()).draw();
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

    public function addAdmin()
    {
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
            $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
            $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
            if ($isUsernameExists && $isEmailExists) {
                $result->message = 'GAGAL: Username dan Email sudah digunakan!';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                $this->session->set_flashdata('old_form', $data_form);
                $this->session->set_flashdata('error', 'usernameAndEmail');
                redirect(base_url('admin/Admin/form_admin'));
            } else if ($isUsernameExists) {
                $result->message = 'GAGAL: Username sudah digunakan!';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                $this->session->set_flashdata('old_form', $data_form);
                $this->session->set_flashdata('error', 'username');
                redirect(base_url('admin/Admin/form_admin'));
            } else if ($isEmailExists) {
                $result->message = 'GAGAL: Email sudah digunakan!';
                $this->session->set_flashdata('msg_add_admin', $result->message);
                $this->session->set_flashdata('old_form', $data_form);
                $this->session->set_flashdata('error', 'email');
                redirect(base_url('admin/Admin/form_admin'));
            }

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
            redirect(base_url('admin/Admin/manage_admin'));
        }
        //   echo var_dump($data);
        //   die;
    }

    public function form_admin()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Tambah Admin",
            $view="admin/form_admin"
        );

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

    public function tampilEditAdmin($id)
    {
        $this->all_controllers->check_user_admin();
        $hasil = $this->all_controllers->get_data_view(
            $title="Edit Admin",
            $view="admin/form_edit_admin"
        );

        $result = $this->_get_json_data();
        $hasil['menu'] = $this->menu;
        $hasil['data'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = ' . $id)->row();
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

    public function updateAdmin($id)
    {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username = "' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email = "' . $data['email'] . '"')->row();
        $this_user = $this->db->query('SELECT username, email FROM master_user WHERE id = ' . $id)->row();
        if (($isUsernameExists && $data['username'] != $this_user->username) && ($isEmailExists && $data['email'] != $this_user->email)) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/Admin/tampilEditAdmin/' . $id));
        } else if ($isUsernameExists && $data['username'] != $this_user->username) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/Admin/tampilEditAdmin/' . $id));
        } else if ($isEmailExists && $data['email'] != $this_user->email) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/Admin/tampilEditAdmin/' . $id));
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
        if ($this->all_model->update('master_user', $data, $where) == 1) {
            $result->status = TRUE;
            $result->message = 'Data user admin berhasil diubah';
            if ($data['aktif'] == 0) {
                $this->all_model->update('master_user', array('register_token' => NULL), array('id' => $userid));
            }
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            redirect(base_url('admin/Admin/manage_admin'));
        } else {
            $result->message = 'Data user admin telah diubah';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            redirect(base_url('admin/Admin/manage_admin'));
        }
    }

    public function hapusAdmin($id)
    {
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
