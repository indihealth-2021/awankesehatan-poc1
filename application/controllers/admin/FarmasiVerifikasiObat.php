<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FarmasiVerifikasiObat extends CI_Controller
{
    var $menu = 6;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('session');
        $this->load->library('all_controllers');
        $this->load->library('pagination');
    }

    private function debug()
    {
        echo json_encode([
            "query" => $this->db->last_query(),
            "error" => $this->db->error()
        ]);
        exit();
    }
    public function index()
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Verifikasi Obat",
            $view = "admin/farmasi_manage_verifikasi_obat"
        );

        $where = $this->input->get('nama_pasien');
        $where = $where ? ' AND p.name LIKE "%' . $where . '%"' : '';

        $count_rows = count($this->db->query("SELECT resep_dokter.id_pasien,bukti_pembayaran.tanggal_konsultasi, resep_dokter.id, resep_dokter.created_at, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, nominal.poli as nama_poli, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', IF(master_obat.active, '', '<span class=\"badge badge-danger\">Nonaktif</span>') ,'</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat, master_diagnosa.nama as diagnosis FROM (resep_dokter, diagnosis_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE resep_dokter.dibatalkan = 0 AND resep_dokter.dirilis = 0 AND resep_dokter.diverifikasi = 0 AND resep_dokter.id_jadwal_konsultasi = diagnosis_dokter.id_jadwal_konsultasi" . $where . " GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY bukti_pembayaran.tanggal_konsultasi ASC")->result());
        //$config = $this->pagination->paginate(5, 4, $count_rows, base_url('admin/FarmasiVerifikasiObat/index'));
        $config['base_url'] = 'admin/FarmasiVerifikasiObat/index';
        $config['total_rows'] = 5;
        $config['per_page'] = 4;

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['uri_segment'] = $this->uri->segment(4);
        $limit = ' LIMIT ' . $config['per_page'] . ' OFFSET ' . $data['page'];

        $apotekId = $this->db->query("SELECT id_apotek FROM master_user WHERE master_user.id=" . $this->session->userdata("id_user"))->result_array()[0]["id_apotek"];
        $data['list_resep'] = $this->db->query("SELECT resep_dokter.id_pasien,bukti_pembayaran.tanggal_konsultasi, resep_dokter.id, resep_dokter.created_at, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, nominal.poli as nama_poli, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', IF(master_obat.active, '', '<span class=\"badge badge-danger\">Nonaktif</span>') ,'</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat, master_diagnosa.nama as diagnosis FROM (resep_dokter, diagnosis_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN master_diagnosa ON master_diagnosa.id = diagnosis_dokter.diagnosis LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE resep_dokter.dibatalkan = 0 AND resep_dokter.dirilis = 0 AND resep_dokter.diverifikasi = 0 AND resep_dokter.id_apotek=" . $apotekId . " AND resep_dokter.id_jadwal_konsultasi = diagnosis_dokter.id_jadwal_konsultasi" . $where . " GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY bukti_pembayaran.tanggal_konsultasi ASC" . $limit)->result();
        $data["apotek"] = $this->db->query("SELECT * FROM master_apotek WHERE master_apotek.id=" . $apotekId)->result()[0];

        // $data["apotek"]->alamat_provinsi = $this->db->query("SELECT name FROM master_provinsi WHERE master_provinsi.id=".$data["apotek"]->alamat_provinsi)->result()[0];
        // $data["apotek"]->alamat_kota = $this->db->query("SELECT name FROM master_kota WHERE master_kota.id=".$data["apotek"]->alamat_kota)->result()[0];
        // $data["apotek"]->alamat_kecamatan = $this->db->query("SELECT name FROM master_kecamatan WHERE master_kecamatan.id=".$data["apotek"]->alamat_kecamatan)->result()[0];
        //$data['pagination'] = $this->pagination->create_links();

        //
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(function () {
                                    $("#table_obat").DataTable({
                                        "paging": true,
                                        "lengthChange": true,
                                        "searching": true,
                                        "ordering": true,
                                        "info": false,
                                        "autoWidth": false,
                                        "responsive": false,
                                    });
                                    $("#search").keypress(function(e){
                                        if(e.keyCode === 13){
                                            $("#searchForm").submit();
                                        }
                                    });
                                    $("#searchButton").click(function(){
                                        $("#searchForm").submit();
                                    });
                                });
                            </script>';
        $this->load->view('template', $data);
    }

    public function form_edit_resep($id_jadwal_konsultasi)
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Edit Resep Obat",
            $view = "admin/farmasi_form_edit_resep"
        );

        $data['list_obat'] = $this->db->query("SELECT master_obat.name as nama_obat, master_obat.unit as nama_unit, master_obat.active, resep_dokter.keterangan as aturan_pakai, resep_dokter.jumlah_obat, resep_dokter.id, resep_dokter.id_obat, resep_dokter.id_pasien, resep_dokter.id_dokter FROM resep_dokter INNER JOIN master_obat ON master_obat.id = resep_dokter.id_obat WHERE resep_dokter.id_jadwal_konsultasi = " . $id_jadwal_konsultasi)->result();
        $data['pasien'] = $this->db->query('SELECT p.id, p.name, dp.no_medrec FROM master_user p INNER JOIN detail_pasien dp ON dp.id_pasien = p.id WHERE p.id = ? AND p.id_user_kategori = 0', $data['list_obat'][0]->id_pasien)->row();
        $data['pasien']->no_medrec = str_split($data['pasien']->no_medrec, "2");
        $data['pasien']->no_medrec = implode('.', $data['pasien']->no_medrec);
        $data['list_master_obat'] = $this->db->query("SELECT * FROM master_obat WHERE active=1")->result();
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

        $data['css_addons'] = '
        <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
        <script src="https://meet.jit.si/external_api.js"></script>
        <style>
            .input-like-text{
                background-color:transparent;
                border: 0;
                font-size: 1em;
                width: 100%;
            }
        </style>
        ';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(document).ready(function() {
                                    var table_farmasi = $("#table_farmasi").DataTable({
                                                            "paging": true,
                                                            "lengthChange": false,
                                                            "searching": false,
                                                            "ordering": true,
                                                            "info": true,
                                                            "autoWidth": true,
                                                            "responsive": false,
                                                        });

                                    $(".hapusObat").click(function(e){
                                        $(e.target).parents("tr").remove();
                                    });

                                    $("#ModalResep").on("shown.bs.modal", function (e) {
                                        $("#formResepDokter").trigger("reset");
                                        $("#formResepDokter").find("#unit").attr("placeholder","Jml");
                                    });

                                    $("#formResepDokter").submit(function(e){
                                        e.preventDefault();
                                        var dataResep = $(this).serializeArray();
                                        var namaObat = $("select[name=id_obat] option:selected").text();
                                        var listResep = $("#listResep");


                                        var templateResep = "<tr><td>"+namaObat+"</td><input type=\'hidden\' name=\'id_obat[]\' value=\'"+dataResep[0].value+"\'><td>"+dataResep[1].value+" "+dataResep[3].value+"</td><input type=\'hidden\' name=\'jumlah_obat[]\' value=\'"+dataResep[1].value+"\'><td>"+dataResep[2].value+"</td><input type=\'hidden\' name=\'keterangan[]\' value=\'"+dataResep[2].value+"\'><td><button class=\'btn btn-secondary\' onclick=\'return (this.parentNode).parentNode.remove();\'><i class=\'fas fa-trash-alt\'></i></button></td></tr>";

                                        listResep.append(templateResep);
                                        alert("Resep telah ditambahkan!");
                                        $("#ModalResep").modal("hide");
                                    });

                                    // ========================= panggil pasien ================== //
                                    $(".chat-wrap-inner").scrollTop($(".chat-wrap-inner")[0].scrollHeight);

                                    $("#panggil-pasien").click(function(){
                                        $("#messages").empty();
                                        var iframes = document.getElementsByTagName("iframe");
                                        for (var i = 0; i < iframes.length; i++) {
                                            iframes[i].parentNode.removeChild(iframes[i]);
                                        }
                                        $("#konten-panggilan").prop("hide", true);
                                        function makeid(length) {
                                            var result = "";
                                            var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                                            var charactersLength = characters.length;
                                            for (var i = 0; i < length; i++) {
                                                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                                            }
                                            return result;
                                        }
                                        let uniqid = makeid(12);
                                        const id_farmasi = ' . $this->session->userdata("id_user") . ';
                                        const id_user = $("select[name=pasien]").val();
                                        $("#btn-stop-farmasi").attr("data-id-user", id_user);

                                        id_pasien = id_user;
                                        chat_id = id_farmasi+"_"+id_user;
                                        get_chat(chat_id);

                                        foto_pasien = baseUrl+"/assets/telemedicine/img/default.png";
                                        room_name = "telemedicine_lintas_" + id_farmasi + "_" + id_user + "_" + uniqid;
                                        const p_or_d = "p";
                                        const postData = "id_user="+id_user+"&p_or_d="+p_or_d+"&room_name="+room_name;
                                        $.ajax({
                                            url: baseUrl+"admin/FarmasiCall/call",
                                            method: "POST",
                                            data: postData,
                                            success: function(data){
                                                $("#memanggil").modal("show");
                                                start_consultation();
                                            },
                                            error: function(err){
                                                console.log("GAGAL: Laporkan ke admin terkait hal ini!");
                                            }
                                        });
                                    });

                                    function get_chat(endpoint){
                                        firebase.auth().onAuthStateChanged(function(user) {
                                            if (user) {
                                                firebase.database()
                                                .ref("/chats/"+endpoint)
                                                .on("child_added", function(snapshot){
                                                    console.log(snapshot.val());
                                                    $("#messages").append(template_message(snapshot.val()));
                                                    $(".chat-wrap-inner").scrollTop($(".chat-wrap-inner")[0].scrollHeight);
                                                });
                                            }
                                        });
                                    }
                                    // =========================================================== //
                                });
                            </script>
                            <script src="' . base_url('assets/js/message.js') . '"></script>
                            ';
        $this->load->view('template', $data);
    }

    public function hapus_obat($id)
    {
        $this->all_controllers->check_user_farmasi();

        $obat = $this->db->query('SELECT id_jadwal_konsultasi FROM resep_dokter WHERE id = ' . $id)->row();
        if (!$obat) {
            show_404();
        }
        $this->db->delete('resep_dokter', array('id' => $id));
        $this->session->set_flashdata('msg_hapus_obat', 'Hapus Obat berhasil!');
        redirect(base_url('admin/FarmasiVerifikasiObat/form_edit_resep/' . $obat->id_jadwal_konsultasi));
    }

    public function tambah_obat()
    {
        $this->all_controllers->check_user_farmasi();

        $data_obat = array(
            'id_obat' => $this->input->post('id_obat'),
            'jumlah_obat' => $this->input->post('jumlah_obat'),
            'keterangan' => $this->input->post('aturan_pakai'),
            'id_jadwal_konsultasi' => $this->input->post('id_jadwal_konsultasi'),
        );
        $this->db->insert('resep_dokter', $data_obat);
    }

    public function submit_resep()
    {
        $this->all_controllers->check_user_farmasi();

        $post_data = $this->input->post();

        $list_resep = $this->db->query('SELECT id FROM resep_dokter WHERE id_jadwal_konsultasi = ' . $post_data['id_jadwal_konsultasi'])->result();

        foreach ($list_resep as $resep) {
            $this->db->delete('resep_dokter', array('id' => $resep->id));
        }

        $jmlData = count($post_data['keterangan']);
        for ($i = 0; $i < $jmlData; $i++) {
            $resep = $this->db->query('SELECT harga, harga_per_n_unit FROM master_obat WHERE id = ' . $post_data['id_obat'][$i])->row();
            $data_resep = array(
                "id_jadwal_konsultasi" => $post_data['id_jadwal_konsultasi'],
                "id_pasien" => $post_data['id_pasien'],
                "id_dokter" => $post_data['id_dokter'],
                "id_obat" => $post_data['id_obat'][$i],
                "jumlah_obat" => $post_data['jumlah_obat'][$i],
                "harga" => $resep->harga,
                "harga_per_n_unit" => $resep->harga_per_n_unit,
                "keterangan" => $post_data['keterangan'][$i]
            );
            $this->db->insert('resep_dokter', $data_resep);
        }
        $this->session->set_flashdata('msg_simpan_resep', "Resep Obat telah disimpan!");
        redirect(base_url('admin/FarmasiVerifikasiObat'));
    }

    public function verifikasi($id_jadwal_konsultasi)
    {
        $this->all_controllers->check_user_farmasi();

        $list_resep = $this->db->query('SELECT id FROM resep_dokter WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->result();
        $id_pasien = 0;
        foreach ($list_resep as $resep) {
            $data_resep_update = array("diverifikasi" => 1);
            $this->all_model->update('resep_dokter', $data_resep_update, array('id' => $resep->id));
            $id_pasien = $resep->id_pasien;
        }

        $id_notif = $this->db->insert_id();
        $notifikasi = "Resep Obat telah diverifikasi!";
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $pasien = $this->db->query('SELECT * FROM master_user WHERE id = ' . $id_pasien)->row();
        $msg_notif = array(
            'name' => 'resep_obat_diverifikasi',
            'id_notif' => $id_notif,
            'keterangan' => $notifikasi,
            'tanggal' => $now,
            'id_jadwal_konsultasi' => $id_jadwal_konsultasi,
            'id_user' => json_encode(array($id_pasien)),
            'direct_link' => base_url('pasien/ResepDokter'),
        );
        $msg_notif = json_encode($msg_notif);
        $this->key->_send_fcm($pasien->reg_id, $msg_notif);

        $data_notif = array("id_user" => $dokter->id, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('pasien/ResepDokter/konfirmasi/?id_jadwal_konsultasi=' . $id_jadwal_konsultasi));
        $this->db->insert('data_notifikasi', $data_notif);

        $this->session->set_flashdata('msg_verif_resep', $notifikasi);
        redirect(base_url('admin/FarmasiVerifikasiObat'));
    }
}
