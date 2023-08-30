<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    var $menu = 9;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master_jadwal_model');
        $this->load->model('pasien_model');
        $this->load->model('assesment_model');

        $this->load->library('all_controllers');
    }

    public function index()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Manage Pasien",
            $view = "admin/manage_pasien"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_pasien = $("#table_pasien").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "searching": true,
                                "pageLength": 5,
                                });

                                $("#table_pasien_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table_pasien.search($(this).val()).draw();
                                });

                                $("#modalHapus").on("show.bs.modal", function(e) {
                                    var nama = $(e.relatedTarget).data("nama");
                                    $(e.currentTarget).find("#nama").html(nama);

                                    var href_input = $(e.relatedTarget).data("href");
                                    $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                });
                            });
                            </script>';
        $data['list_pasien'] = $this->pasien_model->get_all();
        $this->load->view('template', $data);
    }

    public function antrian_pasien()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "manage_antrianPasien",
            $view = "admin/manage_antrianPasien"
        );

        $data['antrian'] = $this->db->query('SELECT DISTINCT jadwal_konsultasi.jam,jadwal_konsultasi.tanggal, jadwal_dokter.hari as hari_jadwal, jadwal_dokter.tanggal as tanggal_jadwal, na.antrian, na.status, d.name as name_dokter, d.id as id_dokter, p.name as name_pasien, p.id as id_pasien, n.poli FROM no_antrian na INNER JOIN master_user d ON na.id_dokter=d.id INNER JOIN master_user p ON na.id_pasien=p.id INNER JOIN detail_dokter dd ON d.id = dd.id_dokter INNER JOIN nominal n ON dd.id_poli = n.id INNER JOIN jadwal_dokter ON jadwal_dokter.id = na.id_jadwal INNER JOIN jadwal_konsultasi ON jadwal_konsultasi.id = na.id_jadwal_konsultasi WHERE (status=1 OR status=0) ORDER BY name_dokter ASC, tanggal_jadwal DESC, hari_jadwal DESC, antrian ASC, status DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_antrian = $("#table_antrian").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "searching": true,
                                "pageLength": 5,
                                });
                                $("#table_antrian_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table_antrian.search($(this).val()).draw();
                                });
                            });
                            </script>';
        //echo $this->db->last_query();die();
        $this->load->view('template', $data);
    }
    // public function create_antrian_pasien()
    // {
    //     if (!$this->session->userdata('is_login')) {
    //         redirect(base_url('Login'));
    //     }
    //     $valid = $this->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
    //     if ($valid->id_user_kategori != 5) {
    //         if ($valid->id_user_kategori == 0) {
    //             redirect(base_url('pasien/Pasien'));
    //         } else {
    //             redirect(base_url('dokter/Dashboard'));
    //         }
    //     } else {
    //         if ($valid->id_user_level == 2) {
    //             redirect(base_url('admin/FarmasiVerifikasiObat'));
    //         }
    //     }
    //     $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

    //     if ($this->session->userdata('is_login')) {

    //         $dataSave = $this->input->post();
    //         $getDataAntrian = $this->all_model->select('no_antrian', 'result', $dataSave['id']);
    //         if (!is_null($getDataAntrian)) {
    //             $count = count($getDataAntrian);
    //             $dataSave['antrian'] = $count;
    //         } else {
    //             $dataSave['antrian'] = 1;
    //         }
    //         $dataSave['status']  = 0;

    //         $save = $this->all_model->insert('no_antrian', $dataSave);
    //         $data['menu'] = $this->menu;
    //         $data['view'] = 'admin/antrian_pasien';
    //         $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
    //         $data['title'] = 'Antrian Pasien';

    //         $this->load->view('template', $data);
    //     } else {
    //         redirect('Login');
    //     }
    // }

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

    public function form_pasien()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Tambah Pasien",
            $view = "admin/form_pasien"
        );

        $this->load->view('template', $data);
    }

    // public function form_antrian()
    // {
    //     if (!$this->session->userdata('is_login')) {
    //         redirect(base_url('Login'));
    //     }
    //     $valid = $this->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
    //     if ($valid->id_user_kategori != 5) {
    //         if ($valid->id_user_kategori == 0) {
    //             redirect(base_url('pasien/Pasien'));
    //         } else {
    //             redirect(base_url('dokter/Dashboard'));
    //         }
    //     } else {
    //         if ($valid->id_user_level == 2) {
    //             redirect(base_url('admin/FarmasiVerifikasiObat'));
    //         }
    //     }
    //     $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

    //     if ($this->session->userdata('is_login')) {
    //         $data['id_user_kategori'] = 2;
    //         $data['dokter'] = $this->all_model->select('master_user', 'tabel', $data);
    //         $kategori['id_user_kategori'] = 0;
    //         $data['pasien'] = $this->all_model->select('master_user', 'tabel', $kategori);
    //         $data['menu'] = $this->menu;
    //         $data['view'] = 'admin/form_antrian';
    //         $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
    //         $data['title'] = 'Tambah Antrian Pasien';
    //         $this->load->view('template', $data);
    //     } else {
    //         redirect('Login');
    //     }
    // }

    public function addPasien()
    {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        $data_form = $this->input->post();
        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
        if ($isUsernameExists && $isEmailExists) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_pasien', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/Pasien/form_edit_pasien/' . $id));
        } else if ($isUsernameExists) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_edit_pasien', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/Pasien/form_edit_pasien/' . $id));
        } else if ($isEmailExists) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_pasien', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/Pasien/form_edit_pasien/' . $id));
        }
        $data["password"] = password_hash($this->input->post("password"), PASSWORD_DEFAULT, $this->config->item('hash_config'));
        if ($data["id_user_kategori"] == 0) {
            if (!empty($_FILES['foto']['name'])) {
                $data['foto'] = $this->_upload_file('foto');

                if ($data['foto'] === FALSE) {
                    $result->message = 'Foto gagal diupload';

                    echo json_encode($result);

                    die();
                }
            }
            unset($data['id_user_jenis']);
            unset($data['id_user_spesialis']);
            unset($data['id_layanan']);
            unset($data['id']);
            //echo $this->all_model->insert('master_user', $data); die();
            if ($this->all_model->insert('master_user', $data) == 1) {
                $result->status = TRUE;
                $result->message = 'Data user pasien berhasil disimpan';
                // TAMBAH KE ACTIVITY LOG DENGAN NAMA ACTIVITY = Menambahkan Pasien
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
                    "activity" => 'Menambahkan Pasien'
                );

                $this->db->insert('log_activity', $data);
                // ============================================================ //

                $this->session->set_flashdata('msg_add_pasien', $result->message);
                redirect(base_url('admin/Pasien'));
            } else {
                $result->message = 'Data user pasien gagal disimpan';
                $this->session->set_flashdata('msg_add_pasien', $result->message);
                redirect(base_url('admin/Pasien'));
            }
        } else {
            $result->message = 'Maaf kategori user bukan pasien fasyankes';
            $this->session->set_flashdata('msg_add_pasien', $result->message);
            redirect(base_url('admin/Pasien'));
        }
    }

    public function tampilEditPasien($id)
    {
        $this->all_controllers->check_user_admin();
        $hasil = $this->all_controllers->get_data_view(
            $title = "Edit Pasien",
            $view = "admin/form_edit_pasien"
        );

        $result = $this->_get_json_data();
        $data['id'] = $id;
        //echo $this->all_model->insert('master_user', $data); die();
        $user = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = ' . $id)->row();

        $hasil['result'] = $result;
        $hasil['data'] = $user;
        $hasil['detail_pasien'] = $this->db->query('SELECT no_medrec FROM detail_pasien WHERE id_pasien = ' . $id)->row();
        if ($hasil['detail_pasien']) {
            $hasil['detail_pasien']->no_medrec = str_split($hasil['detail_pasien']->no_medrec, "2");
            $hasil['detail_pasien']->no_medrec = implode('.', $hasil['detail_pasien']->no_medrec);
        }
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

    // public function detailPasien($id)
    // {
    //     if (!$this->session->userdata('is_login')) {
    //         redirect(base_url('Login'));
    //     }
    //     $valid = $this->db->query('SELECT id_user_kategori, id_user_level FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
    //     if ($valid->id_user_kategori != 5) {
    //         if ($valid->id_user_kategori == 0) {
    //             redirect(base_url('pasien/Pasien'));
    //         } else {
    //             redirect(base_url('dokter/Dashboard'));
    //         }
    //     } else {
    //         if ($valid->id_user_level == 2) {
    //             redirect(base_url('admin/FarmasiVerifikasiObat'));
    //         }
    //     }
    //     $hasil['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 ORDER BY tanggal DESC LIMIT 0,2')->result();

    //     if ($this->session->userdata('is_login')) {
    //         $data['id'] = $id;
    //         //echo $this->all_model->insert('master_user', $data); die();
    //         $hasil['user'] = $this->all_model->select('master_user', 'tabel', $data);

    //         $hasil['menu'] = $this->menu;
    //         $hasil['view'] = 'admin/detail_pasien';
    //         $hasil['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
    //         $hasil['title'] = 'Detail Pasien';

    //         $this->load->view('template', $hasil);
    //     } else {
    //         redirect('Login');
    //     }
    // }

    public function updatePasien($id)
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $data["vip"] = isset($data["vip"]) ? $data["vip"] : 0;
        $result = $this->_get_json_data();
        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
        $this_user = $this->db->query('SELECT username, email FROM master_user WHERE id = ' . $id)->row();
        if (($isUsernameExists && $data['username'] != $this_user->username) && ($isEmailExists && $data['email'] != $this_user->email)) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/Pasien/tampilEditPasien/' . $id));
        } else if ($isUsernameExists && $data['username'] != $this_user->username) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/Pasien/tampilEditPasien/' . $id));
        } else if ($isEmailExists && $data['email'] != $this_user->email) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_admin', $result->message);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/Pasien/tampilEditPasien/' . $id));
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
        if ($this->db->update('master_user', $data, $where) == 1) {
            if ($data['aktif'] == 0) {
                $this->all_model->update('master_user', array('register_token' => NULL), array('id' => $id));
            }
            $result->status = TRUE;
            $result->message = 'Data user pasien berhasil diubah';
            $this->session->set_flashdata('msg_edit_pasien', $result->message);
            redirect(base_url('admin/Pasien'));
        } else {
            $result->message = 'Data user pasien gagal diubah';
            echo var_dump($this->db->error());
            die;
            $this->session->set_flashdata('msg_edit_pasien', $result->message);
            redirect(base_url('admin/Pasien'));
        }
    }

    public function hapusPasien($id)
    {
        $this->all_controllers->check_user_admin();

        $where = array('id' => $id, 'id_user_kategori' => 0);
        $data_registrasi = $this->db->query('SELECT data_registrasi.id FROM data_registrasi WHERE data_registrasi.id_pasien = ' . $id)->row();
        $bukti_pembayaran = $this->db->query('SELECT id FROM bukti_pembayaran WHERE id_pasien = ' . $id)->row();
        $bukti_pembayaran_obat = $this->db->query('SELECT id FROM bukti_pembayaran_obat WHERE id_pasien = ' . $id)->row();
        $jadwal_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id_pasien = ' . $id)->row();
        $resep_dokter = $this->db->query('SELECT id FROM resep_dokter WHERE id_pasien = ' . $id)->row();
        if ($data_registrasi || $bukti_pembayaran || $bukti_pembayaran_obat || $jadwal_konsultasi || $resep_dokter) {
            $result->message = "GAGAL: Pasien masih memiliki transaksi / jadwal yang terkait!";
            $this->session->set_flashdata('msg_hps_pasien', $result->message);
            redirect(base_url('admin/Pasien'));
        }

        if ($this->all_model->delete('master_user', $where) == 1) {
            $detail_pasien = $this->db->query('SELECT id FROM detail_pasien WHERE id_pasien = ' . $id)->row();
            if ($detail_pasien) {
                $this->db->delete('detail_pasien', array('id_pasien' => $id));
            }
            $result->message = "Data user pasien berhasil dihapus!";
        } else {
            $result->message = "Data user pasien gagal dihapus!";
        }

        $this->session->set_flashdata('msg_hps_pasien', $result->message);
        redirect(base_url('admin/Pasien'));
    }

    public function assignment($id_pasien)
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            'Assesment',
            'admin/form_edit_assignment'
        );

        $data['assesment'] = $this->assesment_model->get_by_id_pasien($id_pasien);
        $data['pasien'] = $this->pasien_model->get_by_id($id_pasien);
        $data['list_dokter'] = $this->assesment_model->get_dokter($id_pasien);

        $this->load->view('template', $data);
    }
}
