<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apotek extends CI_Controller
{
    var $menu = 1;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("all_model");
        $this->load->model("apotek_model");
        $this->load->model("adminApotek_model");

        $this->load->library('session');
        $this->load->library('all_controllers');
    }

    public function index()
    {
        $this->output->set_header('Feature-Policy: geolocation \'self\'; camera \'self\'; microphone \'self\'');
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Manage Apotek",
            $view = "admin/manage_apotek"
        );

        $data['list_apotek'] = $this->apotek_model->get_all();
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

    private function _get_json_data($status = FALSE, $message = '', $data = NULL)
    {
        $result = new stdClass();

        $result->status = $status;
        $result->message = $message;
        $result->data = $data;

        return $result;
    }

    public function addApotek()
    {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        $data_form = $this->input->post();
        // unset($data['confirmasipassword']);

        if ($data["id_user_kategori"] == 5) {
            unset($data["id_user_kategori"]);
            if ($this->all_model->insert_('master_apotek', $data) == 1) {
                $result->status = TRUE;
                $result->message = 'Data user apotek berhasil disimpan';
                $userid = $this->db->insert_id();

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
                    "activity" => 'Menambahkan Apotek'
                );

                $this->db->insert('log_activity', $data);
                // ============================================================ //
                $result->message = 'Data apotek berhasil disimpan';
                $this->session->set_flashdata('msg_add_apotek', $result->message);
            } else {
                $result->message = 'Data apotek gagal disimpan';
                $this->session->set_flashdata('msg_add_apotek', $this->db->last_query());
            }
        } else {
            $result->message = 'Maaf kategori user bukan admin fasyankes';
            $this->session->set_flashdata('msg_add_apotek', $result->message);
        }
        redirect(base_url('admin/apotek'));
        //   echo var_dump($data);
        //   die;
    }

    public function tampilEditApotek($id)
    {
        $this->all_controllers->check_user_admin();
        $hasil = $this->all_controllers->get_data_view(
            $title = "Edit Apotek",
            $view = "admin/form_edit_apotek"
        );

        $result = $this->_get_json_data();
        $hasil['menu'] = $this->menu;
        $hasil['data'] = $this->db->query('SELECT master_apotek.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_apotek LEFT JOIN master_provinsi ON master_apotek.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_apotek.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_apotek.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_apotek.alamat_kelurahan = master_kelurahan.id WHERE master_apotek.id = ' . $id)->row();

        $hasil['js_addons'] = '
    <script>
    $(document).ready(function(){
        $.ajax({
            method : "POST",
            url    : baseUrl+"Alamat/getProvinsi",
            data   : {id_apotek:' . $id . '},
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

        $this->load->view('template', $hasil);
    }

    public function updateApotek($id)
    {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        unset($data["id_user_kategori"]);

        $where = array('id' => $id);
        $apotekId = $id;

        if ($this->all_model->update('master_apotek', $data, $where) == 1) {
            $result->status = TRUE;
            $result->message = 'Data apotek berhasil diubah';
            if ($data['aktif'] == 0) {
                $this->all_model->update('master_apotek', array('register_token' => NULL), array('id' => $apotekId));
            }
            $this->session->set_flashdata('msg_edit_apotek', $result->message);
        } else {
            $result->message = 'Data apotek telah diubah';
            $this->session->set_flashdata('msg_edit_apotek', $result->message);
        }

        redirect(base_url('admin/apotek'));
    }

    public function hapusApotek($id)
    {
        $this->all_controllers->check_user_admin();

        // if ($id == $this->session->userdata('id_user')) {
        //     $this->session->set_flashdata('msg_hps_admin', 'ERROR: Tidak bisa menghapus diri sendiri!');
        //     redirect(base_url('admin/admin/manage_admin'));
        // }

        $where = array('id' => $id);
        if ($this->all_model->delete('master_apotek', $where) == 1) {
            $result->message =  "Data apotek berhasil dihapus";
            $this->session->set_flashdata('msg_hps_apotek', $result->message);
        } else {
            $result->message = "Data apotek gagal dihapus";
            $this->session->set_flashdata('msg_hps_apotek', $result->message);
        }

        redirect(base_url('admin/apotek/'));
    }

    public function form_apotek()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Tambah Apotek",
            $view = "admin/form_apotek"
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
}
