<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teleconsultasi extends CI_Controller
{
    var $menu = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->model('jadwal_telekonsultasi_model');
        $this->load->library('all_controllers');
        $this->load->library(array('Key'));
        $this->load->library('session');
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/jadwal_konsultasi';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Jadwal Telekonsultasi';
        $data['list_jadwal_konsultasi'] = $this->jadwal_telekonsultasi_model->get_all_by_id_dokter($this->session->userdata('id_user'));

        // $data['list_jadwal_konsultasi'] = $this->db->query('SELECT jk.id, jk.tanggal, jk.jam, p.name AS nama_pasien, p.foto AS foto_pasien, p.id AS id_pasien, n.poli, dr.id AS id_registrasi, dr.id_status_pembayaran FROM jadwal_konsultasi AS jk INNER JOIN master_user AS p ON jk.id_pasien = p.id INNER JOIN master_user AS d ON jk.id_dokter = d.id INNER JOIN detail_dokter AS dd ON dd.id_dokter = d.id INNER JOIN data_registrasi AS dr ON dr.id = jk.id_registrasi INNER JOIN nominal AS n ON dd.id_poli = n.id WHERE jk.id_dokter = '.$this->session->userdata('id_user') . ' AND dr.id_status_pembayaran = 1 ORDER BY jk.tanggal, jk.jam ASC')->result();

        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(function () {
                                  var table_jadwal_telekonsultasi = $("#table_jadwal_telekonsultasi").DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "pageLength": 5,
                                    "searching": true,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": true,
                                    "responsive": true,
                                  });
                                  $("#table_jadwal_telekonsultasi_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_jadwal_telekonsultasi.search($(this).val()).draw();
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
    private function _get_user($username)
    {
        $where = array('username' => $username);

        return $this->all_model->select('master_user', 'row', $where);
    }
    public function teleconsultasi_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/teleconsultasi_pasien';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['title'] = 'Telekonsultasi';
        $this->load->view('template', $data);
    }

    public function get_active_apotek()
    {
        $searchTerm = $this->input->get('searchTerm');

        $pglm = $this->input->get("page_limit");
        $page_lim = (empty($pglm) ? 10 : $pglm);
        $pg = $this->input->get("page");
        $page =  (empty($pg) ? 0 : $pg);
        $limit = $page * $page_lim;
        $cnt = $this->db->query("select id from master_apotek WHERE aktif = 1")->result();
        $filteredValues = $this->db->query("select id, nama as text FROM master_apotek WHERE aktif = 1 AND nama LIKE '%" . $searchTerm . "%' LIMIT $limit , $page_lim ;")->result_array();

        echo json_encode(array(
            'incomplete_results' => false,
            'items' => $filteredValues,
            'total' => count($cnt) // Total rows without LIMIT on SQL query
        ));
    }

    public function get_active_diagnoses()
    {
        $searchTerm = $this->input->get('searchTerm');

        $pglm = $this->input->get("page_limit");
        $page_lim = (empty($pglm) ? 10 : $pglm);
        $pg = $this->input->get("page");
        $page =  (empty($pg) ? 0 : $pg);
        $limit = $page * $page_lim;
        $cnt = $this->db->query("select id from master_diagnosa WHERE aktif = 1")->result();
        $filteredValues = $this->db->query("select id, nama as text FROM master_diagnosa WHERE aktif = 1 AND nama LIKE '%" . $searchTerm . "%' LIMIT $limit , $page_lim ;")->result_array();

        echo json_encode(array(
            'incomplete_results' => false,
            'items' => $filteredValues,
            'total' => count($cnt) // Total rows without LIMIT on SQL query
        ));
    }

    public function update_diagnose_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $data['id_dokter'] = $this->session->userdata('id_user');

        $diagnosis = $this->db->query('SELECT diagnosis FROM diagnosis_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'] . ' AND id_pasien = ' . $data['id_pasien'])->row();
        if ($diagnosis) {
            $update = $this->all_model->update('diagnosis_dokter', $data, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_diagnosis = $this->db->insert('diagnosis_dokter', $data);
            $new_diagnosis = $this->db->query('SELECT id_registrasi FROM diagnosis_dokter WHERE id = ' . $this->db->insert_id())->row();
            $id_registrasi = $new_diagnosis->id_registrasi;

            // Get transaction number from bukti_pembayaran with latest diagnosis_dokter data
            $dataBuktiPembayaran = $this->all_model->select('bukti_pembayaran', 'result', 'id_registrasi =' . $id_registrasi, 1);

            $dataRaw = [
                'transactionNumber' => $dataBuktiPembayaran->trans_id,
                'diagnosisCode'     => $new_diagnosis->diagnosis
            ];

            // Diagnose Verification from Owlexa API
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->config->item('pg_api') . "/owlexa/Api/verifyDiagnose",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $dataRaw,

            ));

            $result = curl_exec($curl);
            $result = json_decode($result, true);

            curl_close($curl);

            if ($result['code'] == 200) {
                echo 'verify diagnosa berhasil';
            }

            echo 'berhasil';
        }

        $data_history = array("activity" => "Diagnosis", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
    }
    public function update_assesment_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $data['id_dokter'] = $this->session->userdata('id_user');
        $assesment = $this->db->query('SELECT * FROM assesment WHERE id_pasien = ' . $this->input->post('id_pasien') . ' AND id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->row();
        if ($assesment) {
            $update = $this->all_model->update('assesment', $data, array('id_pasien' => $this->input->post('id_pasien'), 'id_jadwal_konsultasi' => $data['id_jadwal_konsultasi']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $data['id_pasien'] = $this->input->post('id_pasien');
            $new_assesment = $this->db->insert('assesment', $data);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Assesment Pasien", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $this->input->post('id_pasien'));
        $this->db->insert('data_history_log_dokter', $data_history);
    }
    public function update_resep_dokter_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $jml_data = count($data['keterangan']);
        for ($i = 0; $i < $jml_data; $i++) {
            $data_resep = array(
                "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
                "id_pasien" => $data['id_pasien'],
                "id_dokter" => $this->session->userdata('id_user'),
                "id_obat" => $data['id_obat'][$i],
                //"id_apotek" => $data["apotek"], //id_apotek
                "id_apotek" => explode(" - ", $data["apotek"])[0],
                "jumlah_obat" => $data['jumlah_obat'][$i],
                // "keterangan" => $data['keterangan'][$i]
            );
            $this->db->insert('resep_dokter', $data_resep);
        }
        $data_history = array("activity" => "Resep Dokter", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
    }

    public function data_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/data_pasien';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $this->load->view('template', $data);
    }

    public function send_data_penunjang($data)
    {
        $arr = [
            "id_jadwal_konsultasi"  =>  $data["id_jadwal_konsultasi"],
            "planning"      =>  $data["planning"],
            "kesimpulan"    =>  $data["kesimpulan"]
        ];

        if ($data["laboratorium"]) {
            $arr["pemeriksaan_penunjang_laboratorium"] = [];
            for ($i = 0; $i < $data["count-lab"]; $i++) {
                if ($data["tipe-pemeriksaan-1-" . $i]) {
                    array_push($arr["pemeriksaan_penunjang_laboratorium"], $data["tipe-pemeriksaan-1-" . $i]);
                }
            }

            $arr["pemeriksaan_penunjang_laboratorium"] = json_encode($arr["pemeriksaan_penunjang_laboratorium"]);
        }

        if ($data["radiologi"]) {
            $arr["pemeriksaan_penunjang_radiologi"] = [];
            for ($i = 0; $i < $data["count-rad"]; $i++) {
                if ($data["tipe-pemeriksaan-2-" . $i]) {
                    array_push($arr["pemeriksaan_penunjang_radiologi"], $data["tipe-pemeriksaan-2-" . $i]);
                }
            }

            $arr["pemeriksaan_penunjang_radiologi"] = json_encode($arr["pemeriksaan_penunjang_radiologi"]);
        }

        $arr["id"] = $this->db->select('*')->order_by('id', 'DESC')->get('data_penunjang', 1)->row()->id + 1;

        $this->db->insert("data_penunjang", $arr);
    }

    public function send_data_konsultasi()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->where('id', $this->session->userdata('id_user'))->get('master_user')->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }

        $id_dokter = $this->session->userdata('id_user');
        $data = $this->input->post();

        $data['tekanan_darah'] = isset($data['tekanan_darah']) ? $data['tekanan_darah'] : '-';
        $data['suhu'] = isset($data['suhu']) ? $data['suhu'] : '-';
        $data['merokok'] = isset($data['merokok']) ? $data['merokok'] : '0';
        $data['alkohol'] = isset($data['alkohol']) ? $data['alkohol'] : '0';
        $data['kecelakaan'] = isset($data['kecelakaan']) ? $data['kecelakaan'] : '0';
        $data['operasi'] = isset($data['operasi']) ? $data['operasi'] : '0';
        $data['dirawat'] = isset($data['dirawat']) ? $data['dirawat'] : '0';
        $data['keluhan'] = isset($data['keluhan']) ? $data['keluhan'] : '0';

        $data_assesment = array(
            "id_pasien" => $data['id_pasien'],
            "id_dokter" => $id_dokter,
            "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
            "berat_badan" => $data['berat_badan'],
            "tinggi_badan" => $data['tinggi_badan'],
            "tekanan_darah" => $data['tekanan_darah'],
            "suhu" => $data['suhu'],
            "merokok" => $data['merokok'],
            "alkohol" => $data['alkohol'],
            "kecelakaan" => $data['kecelakaan'],
            "operasi" => $data['operasi'],
            "dirawat" => $data['dirawat'],
            "keluhan" => $data['keluhan']
        );

        $updateAssesment = $this->all_model->update('assesment', $data_assesment, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'], 'id_pasien' => $data['id_pasien']));
        if ($updateAssesment == 0) {
            $new_assesment = $this->db->insert('assesment', $data_assesment);
        }

        $data_history = array("activity" => "Assesment", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        $data["id_registrasi"] = isset($data["id_registrasi"]) ?
            $data["id_registrasi"]  : $this->db->where('id', $data["id_jadwal_konsultasi"])->get('jadwal_konsultasi', 1)->row()->id_registrasi;

        $kronis = isset($data["kronis"]) ? $data["kronis"] : 0;

        $data_diagnosis_dokter = array(
            "id_dokter" => $id_dokter,
            "id_pasien" => $data['id_pasien'],
            "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
            "id_registrasi" => $data['id_registrasi'],
            "diagnosis" => $data['diagnosis'],
            "kronis" => $kronis,
        );

        $id_registrasi = $data["id_registrasi"];

        $updateDiagnosisDokter = $this->all_model->update('diagnosis_dokter', $data_diagnosis_dokter, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'], 'id_pasien' => $data['id_pasien']));
        if ($updateDiagnosisDokter == 0) {
            $insertDiagnosisDokter = $this->db->insert('diagnosis_dokter', $data_diagnosis_dokter);
            if ($insertDiagnosisDokter) {
                // Get transaction number from bukti_pembayaran with latest diagnosis_dokter data
                $dataBuktiPembayaran = $this->db->where('id_registrasi', $data["id_registrasi"])->get('bukti_pembayaran', 1)->result();

                if ($dataBuktiPembayaran) {
                    $dataRaw = [
                        'transactionNumber' => $dataBuktiPembayaran->trans_id,
                        'diagnosisCode'     => $data_diagnosis_dokter['diagnosis']
                    ];

                    // Diagnose Verification from Owlexa API
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $this->config->item('pg_api') . "/owlexa/Api/verifyDiagnose",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => $dataRaw,

                    ));

                    $result = curl_exec($curl);
                    $result = json_decode($result, true);

                    curl_close($curl);

                    if ($result['code'] == 200) {
                        echo 'verify diagnosa berhasil';
                    }

                    echo 'berhasil';
                }
            }
        }

        $bukti_pembayaran = $this->db->where('id_registrasi', $data["id_registrasi"])->where('status', 1)->get('bukti_pembayaran', 1)->row();
        $this->all_model->update('bukti_pembayaran', array('selesai_konsultasi' => (new DateTime('now'))->format('Y/m/d H:i:s')), array('id' => $bukti_pembayaran->id));

        $data_history = array("activity" => "Diagnosis", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        // $exist = $this->db->query("SELECT COUNT(id) FROM resep_dokter WHERE resep_dokter.id_jadwal_konsultasi=".$data["id_jadwal_konsultasi"]." AND resep_dokter.id_pasien=".$data["id_pasien"])->row();

        $jml_data_resep = count($data['keterangan']);
        for ($i = 0; $i < $jml_data_resep; $i++) {
            $obat = $this->db->where('id', $data['id_obat'][$i])->get('master_obat')->row();
            $data_resep = array(
                "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
                "id_pasien" => $data['id_pasien'],
                "id_dokter" => $id_dokter,
                "id_obat" => $data['id_obat'][$i],
                "jumlah_obat" => $data['jumlah_obat'][$i],
                "harga_per_n_unit" => $obat->harga_per_n_unit,
                "id_apotek" => $data["apotek"],
                "harga" => $obat->harga,
                "keterangan" => $data['keterangan'][$i],
            );
            $this->db->insert('resep_dokter', $data_resep);
        }

        // == Insert to biaya_pengiriman_obat table ==

        $user = $this->db->where('id', $data['id_pasien'])->get('master_user', 1)->row(); // Get user data reference
        $alamatUser = $this->db->select('
            master_user.alamat_jalan as alamat_user, master_kelurahan.name as kelurahan_user, master_kecamatan.name as kecamatan_user, master_kota.name as kota_user, master_provinsi.name as provinsi_user
        ')
            ->join('master_kelurahan', 'master_user.alamat_kelurahan = master_kelurahan.id', 'left')
            ->join('master_kecamatan', 'master_user.alamat_kecamatan = master_kecamatan.id', 'left')
            ->join('master_kota', 'master_user.alamat_kota = master_kota.id', 'left')
            ->join('master_provinsi', 'master_user.alamat_provinsi = master_provinsi.id', 'left')
            ->where('master_user.id', $data['id_pasien'])->get('master_user', 1)
            ->row();

        // Get all prices for id_jadwal_konsultasi in resep_dokter table
        $resepDokter = $this->db->where('id_jadwal_konsultasi', $data['id_jadwal_konsultasi'])->get('resep_dokter')->result();
        $hargaObat = 0;
        // Sum all prices and save it to harga_obat variable
        foreach ($resepDokter as $resep) {
            $hargaObat += intval($resep->harga);
        }

        // Get Registration ID from data_registrasi table
        $dataRegistrasi = $this->all_model->select('diagnosis_dokter', 'row', 'id_pasien = ' . $data['id_pasien'], 1);

        $data_biaya_pengiriman_obat = [
            'alamat_kustom'         => 1,
            'alamat'                => $user->alamat_jalan . ', ' . $alamatUser->kelurahan_user . ', ' . $alamatUser->kecamatan_user . ', ' . $alamatUser->kota_user . ', ' . $alamatUser->provinsi_user . '.',
            'id_registrasi'         => $dataRegistrasi->id_registrasi,
            'id_jadwal_konsultasi'  => $data['id_jadwal_konsultasi'],
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s'),
            'harga_obat'            => $hargaObat,
        ];

        if ($data_biaya_pengiriman_obat['id_jadwal_konsultasi'] != '' && $data['id_jadwal_konsultasi'] != '' && $hargaObat != '') {
            $this->db->insert('biaya_pengiriman_obat', $data_biaya_pengiriman_obat);
        }

        // == End of insert to biaya_pengiriman_obat ==

        $this->send_data_penunjang($data);
        $this->all_controllers->setHargaObatFrom([$data["id_jadwal_konsultasi"]]);

        $farmasi = $this->db->where('id_user_kategori', 5)->where('id_user_level', 2)->get('master_user')->row();
        $id_notif = $this->db->insert_id();
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $notifikasi = "Ada resep baru yang dikirimkan dokter.";
        $msg_notif = array(
            'name' => 'resep_dari_dokter',
            'id_notif' => $id_notif,
            'keterangan' => $notifikasi,
            'tanggal' => $now,
            'id_jadwal_konsultasi' => $data["id_jadwal_konsultasi"],
        );
        $msg_notif = json_encode($msg_notif);
        $this->key->_send_fcm($farmasi->reg_id, $msg_notif);

        $data_notif = array("id_user" => $farmasi->id, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('admin/FarmasiVerifikasiObat'));

        $this->db->insert('data_notifikasi', $data_notif);

        $data_history = array("activity" => "Resep Dokter", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        echo "OK";
        echo $this->db->error();
    }

    private function update_diagnosa()
    {
        $data = $this->input->post();
        $resep_dokter = $this->db->query("SELECT * FROM resep_dokter WHERE resep_dokter.id_jadwal_konsultasi=" . $data["id_jadwal_konsultasi"])->row();

        if (false) {
            show_404();
        } else {
            $id_pasien = $data["id_pasien"];
            $data_konsultasi = $data["data_konsultasi"];

            $data_resep = [];

            $apotek = $this->db->query("SELECT id FROM master_apotek WHERE master_apotek.nama='" . explode(" - ", $data["apotek"])[0] . "'")->row();
            for ($i = 0; $i < count($data["list_id_obat"]); $i++) {
                $data_resep[$i] = array(
                    "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
                    "id_pasien" => $data['id_pasien'],
                    "id_dokter" => $this->session->userdata('id_user'),
                    "id_obat" => $data['list_id_obat'][$i],
                    "id_apotek" => $apotek->id, // id apotek
                    "jumlah_obat" => $data['list_jumlah_obat'][$i],
                    "keterangan" => $data['list_keterangan_obat'][$i]
                );
                $this->db->insert('resep_dokter', $data_resep[$i]);
            }

            $diagnosis = $this->db->query("SELECT id FROM master_diagnosa WHERE master_diagnosa.nama='" . $data["diagnosis"] . "'")->row()->id;
            $regId = $this->db->query("SELECT id_registrasi FROM jadwal_konsultasi WHERE jadwal_konsultasi.id=" . $data["id_jadwal_konsultasi"])->row()->id_registrasi;
            $this->db->insert("diagnosis_dokter", [
                "id_dokter" => $this->session->userdata("id_user"),
                "id_pasien" => $data["id_pasien"],
                "id_jadwal_konsultasi" => $data["id_jadwal_konsultasi"],
                "id_registrasi" => $regId,
                "diagnosis" => $diagnosis
            ]);

            //$this->send_data_konsultasi();

            //$this->db->delete('jadwal_konsultasi', ['id' => $data["id_jadwal_konsultasi"]]);

            echo "OK";
        }
    }

    public function createRacikan()
    {

        $data = $this->input->post();

        if (empty($data["selectedObats"])) {
            echo json_encode(["error" => "Tidak ada obat yang dipilih"]);
            exit();
        }

        $total = 0;
        $name = [];

        foreach (explode(",", $data["selectedObats"]) as $idObat) {
            $jumlah = $data["jumlahObat-" . $idObat];
            $obat = $this->db->query("SELECT name, harga FROM master_obat WHERE id=" . $idObat)->row();
            $total += $obat->harga;

            array_push($name, $obat->name . " [" . $jumlah . " dosis] ");
        }

        $name = implode("; ", $name);
        $name = $data["nama_racikan"] . " (" . $name . ")";

        $nameIsExist = $this->db->query("SELECT name FROM master_obat WHERE name LIKE '%" . $name . "%'");

        if ($nameIsExist->num_rows() != 0) {
            echo json_encode(["error" => "Racikan dengan nama yang sama sudah ada, harap masukkan nama yang lain"]);
            exit();
        }

        $id = $this->db->query("SELECT id FROM master_obat ORDER BY id DESC")->row()->id + 1;

        // json_encode(["racikan" => $data["selectedObats"]])

        $insertVal = [
            "id" => $id,
            "name" => $name,
            "unit" => "racikan",
            "harga_per_n_unit" => $total,
            "harga" => $total,
            "created_at" => (new DateTime("now"))->format("Y-m-d H:i:s"),
            "created_by" => $this->session->userdata("id_user"),
        ];

        $this->db->insert("master_obat", $insertVal);

        echo json_encode(["success" => json_encode([
            "id" => $id,
            "name" => $name,
            "jumlah_obat" => $data["jumlah_obat"],
            "keterangan" => $data["keterangan"],
        ])]);
    }

    public function proses_teleconsultasi()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_pasien = $this->input->get('id_pasien');
        $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        $jadwal_konsultasi = $this->db->query('SELECT id,id_registrasi FROM jadwal_konsultasi WHERE id = ' . $id_jadwal_konsultasi)->row();
        $data['id_registrasi'] = $jadwal_konsultasi->id_registrasi;
        if (!$jadwal_konsultasi) {
            show_404();
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/proses_teleconsultasi';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['pasien'] = $this->db->query('SELECT * FROM master_user WHERE id = ' . $id_pasien)->row();
        $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan FROM assesment a WHERE id_pasien = ' . $id_pasien . ' AND id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        if ($data['assesment']) {
            $data['assesment'] = $data['assesment'];
            $data['old_assesment'] = false;
        } else {
            $data['old_assesment'] = true;
            $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan FROM assesment a WHERE id_pasien = ' . $id_pasien . " ORDER BY a.created_at DESC")->row();
        }
        $data['list_obat'] = $this->db->query('SELECT id, name, unit FROM master_obat WHERE active = 1 ORDER BY name')->result();
        $data['diagnosis'] = $this->db->query('SELECT master_diagnosa.id as id_diagnosa, master_diagnosa.nama as nama_diagnosa FROM diagnosis_dokter INNER JOIN master_diagnosa ON diagnosis_dokter.diagnosis = master_diagnosa.id WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND id_pasien = ' . $id_pasien)->row();
        $data['detail_dokter'] = $this->db->query('SELECT n.use_diagnosa,n.durasi as durasi,id_poli  FROM detail_dokter dd INNER JOIN nominal n ON dd.id_poli = n.id WHERE dd.id_dokter = ?', $this->session->userdata('id_user'))->row();

        $data['file_asesmen'] = $this->db->query('SELECT * FROM file_asesmen WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->result();

        $birthDate = new DateTime($data['pasien']->lahir_tanggal);
        $now = new DateTime('today');
        $data['pasien']->age = $birthDate->diff($now)->y;
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $curl = curl_init();

        //GET HISTORY DIAGNOSA
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://test.owlexa.com/api/telemedicine/v2/claim-transaction-history',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Api-Key: VO6v8Id9eqEchgogLE1nDVFopJdnXxk9K/ZEm7xqX5I="
            ),
            CURLOPT_POSTFIELDS => json_encode(array(
                'cardNumber' => $data['pasien']->card_number,
            ))
        ));

        $result = curl_exec($curl);
        $result = json_decode($result);

        curl_close($curl);

        if ($result) {
            $data['history_diagnosa'] = $result->data;
        }

        $data['title'] = 'Telekonsultasi';
        $data['css_addons'] = '
          <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
          <script src="https://meet.jit.si/external_api.js"></script>
          ';
        $data['js_addons'] = "
<script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js'></script>
<script>

    <script src='" . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . "'></script>
                                <script>
                                $(function () {
                                  $('#table_resep').DataTable({
                                    'paging': true,
                                    'lengthChange': true,
                                    'searching': true,
                                    'ordering': true,
                                    'info': false,
                                    'autoWidth': true,
                                    'responsive': true,
                                  });
                                });

function checkRemove() {
    if ($('div.resep-dokter').length == 1) {
        $('#remove').hide();
    } else {
        $('#remove').show();
    }
};
$(document).ready(function() {

    $('#diagnosis-detail-laboratorium').hide();
    $('#diagnosis-detail-radiologi').hide();

    $('#tipe-pemeriksaan-1').click( function () {
        if($('#tipe-pemeriksaan-1').is(':checked'))
        {
            $('#diagnosis-detail-laboratorium').show();
        }else {
            $('#diagnosis-detail-laboratorium').hide();
        }
    });

    $('#tipe-pemeriksaan-2').click( function () {
        if($('#tipe-pemeriksaan-2').is(':checked'))
        {
            $('#diagnosis-detail-radiologi').show();
        }else {
            $('#diagnosis-detail-radiologi').hide();
        }
    });

    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
    checkRemove();
    $('#add').click(function() {
        $('div.resep-dokter:last').after($('div.resep-dokter:first').clone());
        $('div.resep-dokter:last').find('input').val('');
        checkRemove();

    });
    $('#remove').click(function() {
        $('div.resep-dokter:last').remove();
        checkRemove();
    });

    $('#formResepDokter').submit(function(e){
        var dataResep = $(this).serializeArray();
        var namaObat = $('select[name=id_obat] option:selected').text();
        var listResep = $('#listResep');
        var countTr = $('#listResep tr');
        countTr = countTr.length;
        if(countTr == null){
            countTr = 0;
        }
        countTr+=1;
        var templateListResep = '<tr id=\''+dataResep[0].value+'\'><td>'+namaObat+'</td><td id=\''+dataResep[1].name+'\'>'+dataResep[1].value+'</td><td id=\''+dataResep[2].name+'\'>'+dataResep[2].value+'</td><td><button class=\'btn btn-secondary\' type=\'button\' onclick=\'return (this.parentNode).parentNode.remove();\' ><i class=\'fas fa-trash-alt\'></i></button></td><input type=\'hidden\' name=\''+dataResep[0].name+'[]\' value=\''+dataResep[0].value+'\'><input type=\'hidden\' name=\''+dataResep[1].name+'[]\' value=\''+dataResep[1].value+'\'><input type=\'hidden\' name=\''+dataResep[2].name+'[]\' value=\''+dataResep[2].value+'\'></tr>';
        listResep.append(templateListResep);
        $(this)[0].reset();
        // $('#ModalResep').modal('hide');
        alert('Resep telah ditambahkan!');
        e.preventDefault();
    });

    $('#formRacikanDokter').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: baseUrl+'dokter/Teleconsultasi/createRacikan',
            type: 'POST',
            data : $(this).serializeArray(),
            success: function(res){
                console.log(res);
                res = JSON.parse(res);
                if(res.error) {
                    alert(res.error); return;
                }else if(res.success) {
                    res = JSON.parse(res.success);

                    var namaObat = $('select[name=id_obat] option:selected').text();
                    var listResep = $('#listResep');
                    var countTr = $('#listResep tr');
                    countTr = countTr.length;
                    if(countTr == null){
                        countTr = 0;
                    }
                    countTr+=1;
                    var templateListResep = '<tr id=\''+res.id+'\'><td>'+res.name+'</td><td id=\''+'jumlah_obat'+'\'>'+res.jumlah_obat+'</td><td id=\''+'keterangan'+'\'>'+res.keterangan+'</td><td><button class=\'btn btn-secondary\' type=\'button\' onclick=\'return (this.parentNode).parentNode.remove();\' ><i class=\'fas fa-trash-alt\'></i></button></td><input type=\'hidden\' name=\''+'id_obat'+'[]\' value=\''+res.id+'\'><input type=\'hidden\' name=\''+'jumlah_obat'+'[]\' value=\''+res.jumlah_obat+'\'><input type=\'hidden\' name=\''+'keterangan'+'[]\' value=\''+res.keterangan+'\'></tr>';
                    listResep.append(templateListResep);
                    $('#formRacikanDokter')[0].reset();
                    // $('#ModalResep').modal('hide');
                    alert('Resep telah ditambahkan!');
                }
             },
        });
        // var dataResep = $(this).serializeArray();
        // var namaObat = $('select[name=id_obat] option:selected').text();
        // var listResep = $('#listResep');
        // var countTr = $('#listResep tr');
        // countTr = countTr.length;
        // if(countTr == null){
        //     countTr = 0;
        // }
        // countTr+=1;
        // var templateListResep = '<tr id=\''+dataResep[0].value+'\'><td>'+namaObat+'</td><td id=\''+dataResep[1].name+'\'>'+dataResep[1].value+'</td><td id=\''+dataResep[2].name+'\'>'+dataResep[2].value+'</td><td><button class=\'btn btn-secondary\' type=\'button\' onclick=\'return (this.parentNode).parentNode.remove();\' ><i class=\'fas fa-trash-alt\'></i></button></td><input type=\'hidden\' name=\''+dataResep[0].name+'[]\' value=\''+dataResep[0].value+'\'><input type=\'hidden\' name=\''+dataResep[1].name+'[]\' value=\''+dataResep[1].value+'\'><input type=\'hidden\' name=\''+dataResep[2].name+'[]\' value=\''+dataResep[2].value+'\'></tr>';
        // listResep.append(templateListResep);
        // $(this)[0].reset();
        // // $('#ModalResep').modal('hide');
        // alert('Resep telah ditambahkan!');
        // e.preventDefault();
    });

    $('select[name=diagnosis]').select2({
          ajax: {
            url: '" . base_url('dokter/Teleconsultasi/get_active_diagnoses') . "',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                    page_limit: 50,
                    page: params.page || 0
                };
            },
            processResults: function (data, params) {
                // console.log(params.page);
                // console.log(data.total);
                // console.log((params.page * 50) < data.total);
                params.page = params.page || 0;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 50) < data.total
                      }
                };
            },
            cache: true
        }
    });
    $('select[name=apotek]').select2({
        ajax: {
          url: '" . base_url('Apotek/findNearest') . "',
          dataType: 'json',
          method: 'POST',
          //delay: 250,
          data: function (params) {
              return {
                  searchTerm: params.term, // search term
                  page_limit: 50,
                  page: params.page || 0,
                  get_all: true, //id_kota, id_kecamatan, lat, long removed
                  id_pasien: " . $id_pasien . "
              };
          },
          processResults: function (data, params) {
              // console.log(params.page);
              // console.log(data.total);
              // console.log((params.page * 50) < data.total);
              params.page = params.page || 0;

              console.log(data.items);
              return {
                  results: data.items,
                  pagination: {
                      more: (params.page * 50) < data.total
                    }
              };
          },
          cache: true,
      }
    });
});
</script>
<script src='" . base_url('assets/js/message.js') . "'></script>
		";
        $data['teleconsul_admin_js'] = "
if(JSON.parse(JSON.parse(payload.data.body).id_user).includes(userid.toString())){
    if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_berakhir_dokter')){
            console.log('test');
            // console.log(JSON.parse(payload.data.body).chat_id);
            console.log(JSON.parse(payload.data.body).data_konsultasi);
            $.ajax({
                method : 'POST',
                url    : baseUrl+'dokter/Teleconsultasi/send_data_konsultasi',
                data   : JSON.parse(payload.data.body).data_konsultasi,
                success : function(data){
                    console.log('test');
                    console.log(data);
                    firebase.auth().signInAnonymously().catch(function(error) {
                    // Handle Errors here.
                        var errorCode = error.code;
                        var errorMessage = error.message;
                    // ...
                    });
                    firebase.auth().onAuthStateChanged(function(user) {
                        if (user) {
                                firebase.database()
                                .ref(JSON.parse(payload.data.body).chat_id)
                                .remove().then(function() {
										console.log('SUKSES Hapus Chat');
										api.executeCommand('stopRecording', {
											mode: 'file' //recording mode to stop, `stream` or `file`
										});
									}).catch(function(error) {
										console.error('Error removing document: ', error);
								});
                        }
                    });
                    location.href = '" . base_url('dokter/Teleconsultasi') . "';
                },
                error : function(request, status, error){
                    console.log(request);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    }
        ";
        $data['diagnoses'] = $this->db->query('SELECT * FROM master_diagnosa WHERE aktif = 1')->result();
        $this->load->view('template', $data);
    }

    public function history_diagnosa()
    {
        $curl = curl_init();

        //GET HISTORY DIAGNOSA
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://test.owlexa.com/api/telemedicine/v2/claim-transaction-history',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Api-Key: VO6v8Id9eqEchgogLE1nDVFopJdnXxk9K/ZEm7xqX5I="
            ),
            CURLOPT_POSTFIELDS => json_encode(array(
                'cardNumber' => '1000620030004536',
            ))
        ));

        $result = curl_exec($curl);
        $result = json_decode($result);

        curl_close($curl);

        if ($result) {
            $data['history_diagnosa'] = $result->data;
            echo json_encode($data['history_diagnosa']);
        } else {
            echo 'tidak ada result';
        }
    }
}
