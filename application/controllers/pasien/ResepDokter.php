<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResepDokter extends CI_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('session');
    }

    private function debug()
    {
        echo json_encode([
            "last_query" => $this->db->last_query(),
            "errors" => $this->db->error()
        ]);
        exit();
    }

    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['view'] = 'pasien/resep_dokter';
        $data['title'] = 'Resep Dokter';
        $data['user'] = $this->db->query('SELECT id,name, foto, vip FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['list_resep'] = $this->db->query("SELECT MAX(bp.tanggal_konsultasi) AS tanggal_konsultasi, MAX(rd.id) AS id, MAX(rd.diverifikasi_user) AS diverifikasi_user, MAX(rd.diterima_user) AS diterima, MAX(rd.dirilis) AS dirilis, MAX(rd.created_at) AS created_at, MAX(bpo.status) AS status_bukti, MAX(bpo.order_status) AS order_status, MAX(bpo.id) AS id_bukti_obat, rd.id_jadwal_konsultasi, MAX(d.name) AS nama_dokter, GROUP_CONCAT('<li>', mo.name, ' ( ', rd.jumlah_obat, ' ', mo.unit, ' )', ' ( ', rd.keterangan, ' ) ', '</li>' SEPARATOR '') AS detail_obat, GROUP_CONCAT(rd.harga SEPARATOR ',') AS harga_obat, GROUP_CONCAT(rd.harga_per_n_unit SEPARATOR ',') AS harga_obat_per_n_unit, GROUP_CONCAT(rd.jumlah_obat SEPARATOR ',') AS jumlah_obat, (SELECT MAX(bpo2.biaya_pengiriman) FROM biaya_pengiriman_obat bpo2 WHERE bpo2.id_jadwal_konsultasi = rd.id_jadwal_konsultasi) AS biaya_pengiriman, (SELECT MAX(bpo2.alamat) FROM biaya_pengiriman_obat bpo2 WHERE bpo2.id_jadwal_konsultasi = rd.id_jadwal_konsultasi) AS alamat_pengiriman, (SELECT MAX(bpo2.harga_obat) FROM biaya_pengiriman_obat bpo2 WHERE bpo2.id_jadwal_konsultasi = rd.id_jadwal_konsultasi) AS harga_kustom FROM resep_dokter rd INNER JOIN master_obat mo ON rd.id_obat = mo.id INNER JOIN master_user d ON rd.id_dokter = d.id LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = rd.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter dd ON dd.id_jadwal_konsultasi = rd.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran bp ON bp.id_registrasi = dd.id_registrasi WHERE rd.id_pasien =" . $this->session->userdata("id_user") . " AND rd.dibatalkan = 0 AND rd.diverifikasi = 1 AND rd.dirilis = 1 GROUP BY rd.id_jadwal_konsultasi ORDER BY MAX(rd.created_at) DESC;
        ")->result();

        // $data['list_resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, resep_dokter.id, resep_dokter.created_at, resep_dokter.diverifikasi_user, resep_dokter.diterima_user, bpo.status as status_bukti, bpo.id as id_bukti_obat, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter,GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.alamat as alamat_pengiriman FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE resep_dokter.id_pasien = " . $this->session->userdata('id_user') . " AND resep_dokter.dibatalkan = 0 AND resep_dokter.dirilis = 0 AND resep_dokter.diverifikasi = 1 AND (bpo.status = 0 OR bpo.status IS NULL) GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY resep_dokter.created_at DESC")->result();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>';

        $this->load->view('template', $data);
    }

    public function lacak($id_jadwal_konsultasi)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori,vip FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dokter'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_pasien = $this->session->userdata('id_user');
        // $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        $list_resep = $this->db->query("SELECT * FROM resep_dokter WHERE id_jadwal_konsultasi = " . $id_jadwal_konsultasi . " AND id_pasien = " . $id_pasien)->result();

        if (empty($list_resep)) {
            redirect(base_url('pasien/ResepDokter'));
        }
        $data['view'] = 'pasien/terima_obat';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['resep'] = $this->db->query("SELECT bukti_pembayaran.metode_pengambilan_obat AS dikirim, bukti_pembayaran.tanggal_konsultasi, diagnosis_dokter.id_registrasi, resep_dokter.id_jadwal_konsultasi, resep_dokter.created_at, resep_dokter.diterima_user AS diterima, d.name AS nama_dokter, d.foto AS foto_dokter, GROUP_CONCAT('<li>', master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ', master_obat.unit, ' )', ' ( ', resep_dokter.keterangan, ' ) ', '</li>' SEPARATOR '') AS detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') AS harga_obat, biaya_pengiriman_obat.harga_obat AS harga_kustom, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') AS harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') AS jumlah_obat, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.alamat AS alamat_pengiriman, n.poli AS poli_dokter FROM resep_dokter INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ddr ON ddr.id_dokter = d.id INNER JOIN nominal n ON ddr.id_poli = n.id LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi WHERE resep_dokter.id_jadwal_konsultasi = " . $id_jadwal_konsultasi . " AND resep_dokter.id_pasien = " . $this->session->userdata('id_user') . " AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1 ORDER BY resep_dokter.created_at DESC;")->row();

        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Konfirmasi Penerimaan Obat';

        $this->load->view('template', $data);
    }

    public function pembayaran($id_jadwal_konsultasi)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['menu'] = '1';
        $data['view'] = 'pasien/pembayaran_obat';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Pembayaran Obat';
        $data['js_addons'] = "
        <script>
        $('#file_upload').change(function() {
        var file = $('#file_upload')[0].files[0].name;
        var file_substr = file.length > 40 ? file.substr(0, 39)+'...':file;
        $('#filename').html('<span title=\"' + file + '\">' + file_substr + '</span>');
        });
        $('#btnKirim').click(function(){
            if($('select[name=metode_pembayaran]').val() == '1'){
                $('#form-transfer').submit();
            }else{
                $('#form-owlexa').submit();
            }
        });
        $('select[name=metode_pembayaran]').change(function(e){
            $('#btnBayar').off('click');
            if(this.value == '1'){
                $('#transfer_va').show();
                $('#transfer_manual').hide();
                $('#dompet_digital').hide();
                $('#form-owlexa').hide();
                $('#cc_debit').hide();

                $('#btnBayar').attr('href', '" . base_url('pasien/ResepDokter/bayar_va/' . $id_jadwal_konsultasi) . "/');
                // $('#btnBayar').click(function(e){
                //     e.preventDefault();
                //     $('#form-va').submit();
                // });
            }else if(this.value == '2'){
                $('#transfer_va').hide();
                $('#transfer_manual').show();
                $('#dompet_digital').hide();
                $('#form-owlexa').hide();
                $('#cc_debit').hide();

                $('#btnBayar').attr('href', '" . base_url('pasien/ResepDokter/transfer_manual/' . $id_jadwal_konsultasi) . "/');
                $('#btnBayar').click(function(e){
                    let href_btn =  $('#btnBayar').attr('href').split('/');
                    if(href_btn.length <= 8){
                        alert('GAGAL: Pilih Bank Terlebih Dahulu!');
                        return false;
                    }
                });
            }else if(this.value == '3'){
                $('#transfer_va').hide();
                $('#transfer_manual').hide();
                $('#dompet_digital').show();
                $('#form-owlexa').hide();
                $('#cc_debit').hide();

                $('#btnBayar').attr('href', '#');
            }
            else if(this.value == '4'){
                $('#transfer_va').hide();
                $('#transfer_manual').hide();
                $('#dompet_digital').hide();
                $('#form-owlexa').show();
                $('#cc_debit').hide();

                $('#btnBayar').attr('href', '#');
                $('#btnBayar').click(function(e){
                    e.preventDefault();
                    $('#form-owlexa').submit();
                });
            }else if(this.value == '5'){
                $('#transfer_va').hide();
                $('#transfer_manual').hide();
                $('#dompet_digital').hide();
                $('#form-owlexa').hide();
                $('#cc_debit').show();

                $('#btnBayar').attr('href', '#');
            }else{
                $('#transfer_va').hide();
                $('#transfer_manual').hide();
                $('#dompet_digital').hide();
                $('#form-owlexa').hide();
                $('#cc_debit').hide();

                $('#btnBayar').attr('href', '#');
            }
        });

        $('#btnSendOtp').click(function(e){
            e.preventDefault();
            var cardNumber = $('input[name=cardNumber]').val();
            if(!cardNumber){
                alert('Isi Nomor Kartu Terlebih Dahulu!');
            }
            else{
                $.ajax({
                    method : 'POST',
                    url    : baseUrl+'pasien/Pembayaran/generate_otp',
                    data   : {cardNumber:cardNumber},
                    success : function(data){
                       alert(data);
                    },
                    error : function(data){
                         alert('Send OTP Gagal! Laporkan hal ini pada Admin!'+JSON.stringify(data));
                    }
                });
            }
        });

        $('input[name=bank_id]').change(function(e){
            let href_btn = $('#btnBayar').attr('href').split('/');
            href_btn = href_btn.slice(0, href_btn.length-1);
            href_btn = href_btn.join('/');
            $('#btnBayar').attr('href', href_btn+'/'+this.value+'/');
        });

        $('input[name=bank_id_2]').change(function(e){
            let href_btn = $('#btnBayar').attr('href').split('/');
            href_btn = href_btn.slice(0, href_btn.length-1);
            href_btn = href_btn.join('/');
            $('#btnBayar').attr('href', href_btn+'/'+this.value+'/');
        });

        var getParam = window.location.search.substr(1).split('&');
        console.log(getParam);
        if(getParam.length > 0){
            if(getParam[0] == 'owlexa=true'){
                $('#transfer_va').hide();
                $('#transfer_manual').hide();
                $('#dompet_digital').hide();
                $('#cc_debit').hide();
                $('#form-owlexa').show();
                $('select[name=metode_pembayaran]').val('4');

                $('#btnBayar').click(function(e){
                    e.preventDefault()
                    $('#form-owlexa').submit();
                });
            }
            else{
                $('#transfer_va').hide();
                $('#transfer_manual').hide();
                $('#dompet_digital').hide();
                $('#form-owlexa').hide();
                $('#cc_debit').hide();
            }
        }
        </script>
        ";

        $data['resep'] = $this->db->query("SELECT resep_dokter.id_apotek, bukti_pembayaran.metode_pengambilan_obat AS dikirim, bukti_pembayaran.tanggal_konsultasi, diagnosis_dokter.id_registrasi, resep_dokter.id_jadwal_konsultasi, resep_dokter.created_at, d.name AS nama_dokter, d.foto AS foto_dokter, GROUP_CONCAT('<li>', master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ', master_obat.unit, ' )', ' ( ', resep_dokter.keterangan, ' ) ', '</li>' SEPARATOR '') AS detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') AS harga_obat, biaya_pengiriman_obat.harga_obat AS harga_kustom, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') AS harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') AS jumlah_obat, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.alamat AS alamat_pengiriman, n.poli AS poli_dokter, master_apotek.nama as nama_apotek, master_apotek.alamat_jalan as alamat_apotek, master_kelurahan.name as kelurahan_apotek, master_kecamatan.name as kecamatan_apotek, master_kota.name as kota_apotek, master_provinsi.name as provinsi_apotek, master_apotek.telp as telp_apotek FROM resep_dokter INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ddr ON ddr.id_dokter = d.id INNER JOIN nominal n ON ddr.id_poli = n.id LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN master_apotek ON resep_dokter.id_apotek = master_apotek.id LEFT JOIN master_kelurahan ON master_apotek.alamat_kelurahan = master_kelurahan.id LEFT JOIN master_kecamatan ON master_apotek.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kota ON master_apotek.alamat_kota = master_kota.id LEFT JOIN master_provinsi ON master_apotek.alamat_provinsi = master_provinsi.id WHERE resep_dokter.id_jadwal_konsultasi = " . $id_jadwal_konsultasi . " AND resep_dokter.id_pasien = " . $this->session->userdata('id_user') . " AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1 ORDER BY resep_dokter.created_at DESC;")->row();

        $data['bukti_pembayaran_obat'] = $this->db->query('SELECT bukti_pembayaran_obat.*, (SELECT payment FROM payment WHERE payment_id = bukti_pembayaran_obat.id_payment) as payment_name, (SELECT logo FROM payment WHERE payment_id = bukti_pembayaran_obat.id_payment) as payment_logo, (SELECT payment FROM master_manual_payment WHERE payment_id = bukti_pembayaran_obat.id_payment) as manual_payment_name, (SELECT logo FROM master_manual_payment WHERE payment_id = bukti_pembayaran_obat.id_payment) as manual_payment_logo FROM bukti_pembayaran_obat WHERE bukti_pembayaran_obat.id_pasien = ' . $this->session->userdata('id_user') . ' AND bukti_pembayaran_obat.status != 2 AND id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        // var_dump($data['bukti_pembayaran_obat']);
        // die;

        $data['list_manual_payment'] = $this->db->query('SELECT * FROM master_manual_payment WHERE payment LIKE "%OWLEXA%"')->result();
        $data['list_bank_va'] = $this->db->query('SELECT * FROM payment WHERE type = "va" AND vendor = "arthajasa" AND payment NOT LIKE "%OWLEXA%"')->result();
        $data['list_e_wallet'] = $this->db->query('SELECT * FROM payment WHERE type = "ewallet" AND vendor = "arthajasa"')->result();

        if ($data['bukti_pembayaran_obat']) {
            if ($data['bukti_pembayaran_obat']->status == 0 && $data['bukti_pembayaran_obat']->metode_pembayaran == 3) {
                redirect(base_url('pasien/ResepDokter/transfer_va/' . $id_jadwal_konsultasi . '/' . $data['bukti_pembayaran_obat']->id_payment));
            }
        }
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        if (!$data['resep']) {
            show_404();
        }

        $this->load->view('template', $data);
    }

    public function transfer_manual($id_jadwal_konsultasi = null, $bank_id = 4)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }

        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        // if ($id_jadwal_konsultasi == null) {
        //     show_404();
        // }
        $data['view'] = 'pasien/transfer_upload_manual_obat';
        $data['title'] = 'Transfer Upload Manual Obat';
        $data['user'] = $this->db->query('SELECT id, name, foto, lahir_tanggal FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['js_addons'] = "
        <script>
        $('#file_upload').change(function() {
            var file = $('#file_upload')[0].files[0].name;
            var file_substr = file.length > 40 ? file.substr(0, 39)+'...':file;
            $('#filename').html('<span title=\"' + file + '\">' + file_substr + '</span>');
          });
        </script>
        ";
        $data['css_addons'] = '';

        switch ($bank_id) {
                // case 1:
                //     $bank_name = 'BCA';
                //     $bank_logo = 'bca.png';
                //     break;
                // case 2:
                //     $bank_name = 'Mandiri';
                //     $bank_logo = 'mandiri.png';
                //     break;
                // case 3:
                //     $bank_name = 'BNI';
                //     $bank_logo = 'bni.png';
                //     break;
                // case 4:
                //     $bank_name = 'BRI';
                //     $bank_logo = 'bri.png';
                //     break;
            case 1:
                $bank_name = 'Permata';
                $bank_logo = 'permata.png';
                break;
            case 2:
                $bank_name = 'BNI';
                $bank_logo = 'bni.png';
                break;
            case 3:
                $bank_name = 'CIMB';
                $bank_logo = 'cimb.png';
                break;
            case 4:
                $bank_name = 'OWLEXA HEALTHCARE';
                $bank_logo = 'owlexa.png';
                break;
            default:
                $bank_name = '';
                $bank_logo = '';
                show_404();
                break;
        }

        $data['data_bank'] = array(
            'id_bank' => $bank_id,
            'nama_bank' => $bank_name,
            'logo_bank' => $bank_logo,
        );

        $data['resep'] = $this->db->query("SELECT MAX(biaya_pengiriman_obat.alamat != '') AS dikirim, MAX(bukti_pembayaran.tanggal_konsultasi) AS tanggal_konsultasi, diagnosis_dokter.id_registrasi, resep_dokter.id, MAX(resep_dokter.created_at) AS created_at, MAX(d.name) AS nama_dokter, MAX(d.foto) AS foto_dokter, GROUP_CONCAT(DISTINCT '<li>', master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ', master_obat.unit, ' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>' SEPARATOR '') AS detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') AS harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') AS harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') AS jumlah_obat, MAX(biaya_pengiriman_obat.biaya_pengiriman) AS biaya_pengiriman, MAX(biaya_pengiriman_obat.alamat) AS alamat_pengiriman, MAX(n.poli) AS poli_dokter FROM resep_dokter INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ddr ON ddr.id_dokter = d.id INNER JOIN nominal n ON ddr.id_poli = n.id LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi WHERE resep_dokter.id_jadwal_konsultasi = " . $id_jadwal_konsultasi . " AND resep_dokter.id_pasien = " . $this->session->userdata('id_user') . " AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1 AND (bpo.status != 2 OR bpo.status IS NULL) GROUP BY diagnosis_dokter.id_registrasi, resep_dokter.id ORDER BY created_at DESC")->row();

        $data['manual_payment'] = $this->db->query('SELECT * FROM master_manual_payment WHERE payment_id = ' . $bank_id)->row();



        // if (!$data['resep']) {
        //     show_404();
        // }
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

        $this->load->view('template', $data);
    }

    public function transfer_va($id_jadwal_konsultasi = null, $bank_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        if ($id_jadwal_konsultasi == null) {
            show_404();
        }
        $data['view'] = 'pasien/transfer_virtual_account_obat';
        $data['title'] = 'Transfer Virtual Account Obat';
        $data['user'] = $this->db->query('SELECT id, name, foto, lahir_tanggal FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['js_addons'] = '';
        $data['css_addons'] = '';

        switch ($bank_id) {
                // case 1:
                //     $bank_name = 'BCA';
                //     $bank_logo = 'bca.png';
                //     break;
                // case 2:
                //     $bank_name = 'Mandiri';
                //     $bank_logo = 'mandiri.png';
                //     break;
                // case 3:
                //     $bank_name = 'BNI';
                //     $bank_logo = 'bni.png';
                //     break;
                // case 4:
                //     $bank_name = 'BRI';
                //     $bank_logo = 'bri.png';
                //     break;
            case 22:
                $bank_name = 'Permata';
                $bank_logo = 'permata.png';
                break;
            case 28:
                $bank_name = 'BNI';
                $bank_logo = 'bni.png';
                break;
            case 37:
                $bank_name = 'CIMB';
                $bank_logo = 'cimb.png';
                break;
            default:
                $bank_name = '';
                $bank_logo = '';
                show_404();
                break;
        }

        $data['data_bank'] = array(
            'nama_bank' => $bank_name,
            'logo_bank' => $bank_logo,
        );

        $data['resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, diagnosis_dokter.id_registrasi, resep_dokter.id, resep_dokter.created_at, d.name as nama_dokter, d.foto as foto_dokter, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.alamat as alamat_pengiriman, n.poli as poli_dokter, bpo.va_number FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ddr ON ddr.id_dokter = d.id INNER JOIN nominal n ON ddr.id_poli = n.id LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi WHERE resep_dokter.id_jadwal_konsultasi = " . $id_jadwal_konsultasi . " AND resep_dokter.id_pasien = " . $this->session->userdata('id_user') . " AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1 AND (bpo.status != 2 OR bpo.status IS NULL) GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY resep_dokter.created_at DESC")->row();
        if (!$data['resep']) {
            show_404();
        }
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

        $this->load->view('template', $data);
    }

    public function bayar_owlexa($id_jadwal_konsultasi)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }

        $getProviderCode = $this->db->select('master_apotek.provider_code')->where('resep_dokter.id_jadwal_konsultasi', $id_jadwal_konsultasi)->where('resep_dokter.diverifikasi', 1)->where('resep_dokter.dirilis', 1)->join('master_apotek', 'resep_dokter.id_apotek = master_apotek.id', 'left')->get('resep_dokter', 1)->result();

        $resep = $this->db->query('SELECT resep_dokter.id, resep_dokter.id_dokter, resep_dokter.jumlah_obat, master_obat.harga_per_n_unit, master_obat.harga FROM resep_dokter INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id WHERE resep_dokter.id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1')->result();
        $biaya_pengiriman_obat = $this->db->query('SELECT biaya_pengiriman, harga_obat FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        $pembayaran = $this->db->query('SELECT id,foto FROM bukti_pembayaran_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND id_pasien = ' . $this->session->userdata('id_user'))->row();
        if (!$resep) {
            show_404();
        }
        $total_harga = 0;
        if ($biaya_pengiriman_obat->harga_obat) {
            $total_harga += $biaya_pengiriman_obat->harga_obat;
        } else {
            foreach ($resep as $r) {
                $total_harga = $total_harga + (($r->harga / $r->harga_per_n_unit) * $r->jumlah_obat);
            }
        }
        $total_harga += $biaya_pengiriman_obat->biaya_pengiriman;

        $user = $this->db->query('SELECT id,lahir_tanggal, name, email FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $id_pasien = $user->id;
        $data = $this->input->post();

        $birthDate = $user->lahir_tanggal;
        $fullName = 'Dinda Haripriana'; //$user->name;
        $email = $user->email;
        // $birthDate = '1991-05-01';
        // $fullName = 'OWLEXA TESTING CARD 3566';
        $currentTime = date("Y-m-d H:i:s");
        $chargeValue = $total_harga;
        $cardNumber = $data['cardNumber'];
        if (empty($data['cardNumber'])) {
            $this->session->set_flashdata('msg_pmbyrn_obat', 'GAGAL: Card Number Wajib Diisi!');
            redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi . '/?owlexa=true#metode-pembayaran'));
        }
        $otp = $data['otp'];
        if (!$birthDate || !$fullName) {
            $this->session->set_flashdata('msg_pmbyrn_obat', 'GAGAL: Form tidak lengkap!');
            redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi . '/?owlexa=true#metode-pembayaran'));
        }

        // Verify that the card number is correct
        $user = $this->all_model->select('master_user', 'row', 'id = ' . $id_pasien, 1); // Get user data reference
        if ($user->card_number != $cardNumber) {
            // Set failed message and redirect to previous page
            $response['msg'] = 'GAGAL: Nomor Kartu Tidak Teridentifikasi!';
            $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
            return redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi . '/?owlexa=true#metode-pembayaran'));
        }

        $dataRaw = array(
            'userId' => $id_pasien,
            'jadwalKonsultasiId' => $id_jadwal_konsultasi,
            'providerCode' => $getProviderCode[0]->provider_code
        );

        $pasien_reg2 = $this->db->query('SELECT name, reg_id FROM master_user WHERE id = ' . $id_pasien)->row();
        $now2 = (new DateTime('now'))->format('Y-m-d H:i:s');
        $notifikasi2 = 'Pasien ' . $pasien_reg2->name . ' Telah Melakukan Pembayaran Obat!';
        $dataApotek = $this->db->where('provider_code', $getProviderCode[0]->provider_code)->get('master_apotek', 1)->result();
        $farmasi_reg = $this->db->query('SELECT id, reg_id FROM master_user WHERE id_apotek = ' . $dataApotek[0]->id)->result();
        $direct_link2 = '#';
        foreach ($farmasi_reg as $f) {
            $data_notif2 = array("id_user" => $f->id, "notifikasi" => $notifikasi2, "tanggal" => $now2, "direct_link" => $direct_link2);
            $this->db->insert('data_notifikasi', $data_notif2);
            $id_notif = $this->db->insert_id();
            $msg_notif2 = array(
                'name' => 'vp',
                'id_notif' => $id_notif,
                'keterangan' => $notifikasi2,
                'tanggal' => $now2,
                'id_user' => json_encode(array($f->id)),
                'direct_link' => $direct_link2,
            );
            $msg_notif2 = json_encode($msg_notif2);
            $this->key->_send_fcm($f->reg_id, $msg_notif2);
        }

        // $dataRaw = json_encode($dataRaw);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config->item('pg_api') . "/owlexa/Api/guaranteeObat",
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

        $response['data'] = $result['data'];
        // $this->response($result, REST_Controller::HTTP_OK);
        if ($result['code'] == 200) {
            $claim_number = $result['data']['claimNumber'];
            $data_bukti_pembayaran_obat = array(
                'id_jadwal_konsultasi' => $id_jadwal_konsultasi,
                'id_pasien' => $this->session->userdata('id_user'),
                'id_dokter' => $resep[0]->id_dokter,
                'metode_pembayaran' => 2,
                'card_number' => $cardNumber,
                'claim_number' => $claim_number,
                'status' => 1,
            );

            $this->db->where('id_jadwal_konsultasi', $data_bukti_pembayaran_obat['id_jadwal_konsultasi']);
            $this->db->update('bukti_pembayaran_obat', $data_bukti_pembayaran_obat);

            $notifikasi = 'Pembayaran Obat dengan penjaminan Owlexa berhasil!';
            $now = (new DateTime('now'))->format('Y-m-d H:i:s');
            $pasien_reg = $this->db->query('SELECT name, reg_id FROM master_user WHERE id = ' . $id_pasien)->row();
            $direct_link = base_url('pasien/ResepDokter');

            $data_notif = array("id_user" => $id_pasien, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $direct_link);
            $this->db->insert('data_notifikasi', $data_notif);
            $id_notif = $this->db->insert_id();

            $msg_notif = array(
                'name' => 'vp',
                'id_notif' => $id_notif,
                'keterangan' => $notifikasi,
                'tanggal' => $now,
                'id_user' => json_encode(array($id_pasien)),
                'direct_link' => $direct_link,
            );
            $msg_notif = json_encode($msg_notif);
            $this->key->_send_fcm($pasien_reg->reg_id, $msg_notif);

            // // ------------------------- SEND EMAIL ------------------------------//
            // $data_message['nama_pasien'] = $user->name;
            // $data['claim_number'] = $claim_number;
            // $data_message['judul'] = 'Pembayaran Obat Dengan Penjaminan Owlexa Telah Diverifikasi';
            // $data_message['isi'] = 'Resep Dokter di bawah ini <b>Telah Diverifikasi</b>.';
            // $data_message['resep'] = $this->db->query("SELECT resep_dokter.id, resep_dokter.created_at, d.name as nama_dokter,GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id WHERE resep_dokter.id_jadwal_konsultasi = ".$id_jadwal_konsultasi." AND id_pasien = ".$id_pasien." GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY created_at DESC")->row();
            // $data_message['logo'] = "https://telemedicinelintas.indihealth.com/assets/telemedicine/img/logo.png";
            // // Set to, from, message, etc.
            // $message = $this->load->view('pasien/pembayaran_obat_owlexa_email',$data_message, TRUE);

            // $data = array(
            //     'mail'      => $user->email,
            //     'pesan' => $message,
            //     'subjek' => 'Pembayaran Obat Dengan Penjaminan Owlexa Telah Diverifikasi'
            // );

            // $data_string = json_encode($data);

            // $curl = curl_init('http://indihealth.com/api/Send');

            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

            // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            // 'Content-Type: application/json',
            // 'Content-Length: ' . strlen($data_string))
            // );

            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

            // // Send the request
            // $result = curl_exec($curl);

            // // Free up the resources $curl is using
            // curl_close($curl);

            // // ------------------------ END SEND EMAIL ------------------------------ //
            $response['msg'] = 'Resep Obat telah dijaminkan!';
            $this->session->set_flashdata('msg_pmbyrn_obat', $response['msg']);
            redirect(base_url('pasien/ResepDokter'));
        } else {
            $response['msg'] = 'INFO: ' . $result['msg'];
            $this->session->set_flashdata('msg_pmbyrn_obat', $response['msg']);
            redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi . '/?owlexa=true#metode-pembayaran'));
        }
    }

    public function bayar($id_jadwal_konsultasi)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        if (!$this->input->post('bank_id')) {
            show_404();
        }
        $resep = $this->db->query('SELECT id,id_dokter FROM resep_dokter WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        $pembayaran = $this->db->query('SELECT id,foto FROM bukti_pembayaran_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND id_pasien = ' . $this->session->userdata('id_user'))->row();
        if (!$resep || !isset($_FILES['bukti_pembayaran'])) {
            show_404();
        }
        $now = new DateTime('now');
        $now = $now->format('dmYHis');
        $config['upload_path']          = './assets/images/bukti_pembayaran_obat';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 10024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        if (!$pembayaran) {
            $config['file_name']            = $id_jadwal_konsultasi . '_' . $this->session->userdata('id_user') . '_' . $now;
        } else {
            $foto = explode('.', $pembayaran->foto);
            $config['file_name'] = $foto[0];
        }

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->overwrite = true;

        if (!$this->upload->do_upload('bukti_pembayaran')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg_pmbyrn_obat', 'Bukti Pembayaran Gagal Diupload');
            redirect('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data['foto'] = $data['upload_data']['file_name'];
            $data_bukti_pembayaran_obat = array(
                'id_jadwal_konsultasi' => $id_jadwal_konsultasi,
                'id_pasien' => $this->session->userdata('id_user'),
                'id_dokter' => $resep->id_dokter,
                'id_apotek' => $resep->id_apotek,
                'foto' => $data['foto'],
                'id_payment' => $this->input->post('bank_id'),
                'status' => 0,
            );
            $uploader = $this->db->query('SELECT name,reg_id FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
            $admins = $this->db->query('SELECT id,reg_id FROM master_user WHERE id_user_kategori = 5')->result();
            $admins_id = [];
            $admins_regid = [];
            for ($i = 0; $i < count($admins); $i++) {
                $admins_id[$i] = $admins[$i]->id;
                $admins_regid[$i] = $admins[$i]->reg_id;
            }

            $bukti_pembayaran_obat = $this->db->query('SELECT id FROM bukti_pembayaran_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
            if ($bukti_pembayaran_obat) {
                $notifikasi = 'Bukti Pembayaran Obat diupload ulang oleh ' . $uploader->name;
                $data_update = array('foto' => $data['foto']);
                $this->all_model->update('bukti_pembayaran_obat', $data_update, array('id_jadwal_konsultasi' => $id_jadwal_konsultasi));
            } else {
                $this->db->insert('bukti_pembayaran_obat', $data_bukti_pembayaran_obat);
                $notifikasi = 'Bukti Pembayaran Obat diupload oleh ' . $uploader->name;
            }

            $now = (new DateTime('now'))->format('Y-m-d H:i:s');

            $data_notif = array("id_user" => implode(',', $admins_id), "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('admin/PembayaranObat'));
            $this->db->insert('data_notifikasi', $data_notif);
            $id_notif = $this->db->insert_id();

            $msg_notif = array(
                'name' => 'vp',
                'id_notif' => $id_notif,
                'keterangan' => $notifikasi,
                'tanggal' => $now,
                'id_user' => json_encode($admins_id),
                'direct_link' => base_url('admin/PembayaranObat'),
            );
            $msg_notif = json_encode($msg_notif);

            $to = $uploader->reg_id;
            foreach ($admins_regid as $admin_regid) {
                $this->key->_send_fcm($admin_regid, $msg_notif);
            }

            $this->session->set_flashdata('msg_pmbyrn_obat', 'Bukti Pembayaran Telah Diupload');
            redirect('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi);
        }
    }

    public function konfirmasi($id_jadwal_konsultasi)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dokter'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_pasien = $this->session->userdata('id_user');
        // $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        $data['view'] = 'pasien/confirm_obat';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['pasien'] = $this->db->query('SELECT * FROM master_user WHERE id = ' . $id_pasien)->row();
        $data['list_resep'] = $this->db->query('SELECT * from resep_dokter WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND id_pasien = ' . $id_pasien)->result();
        if (empty($data['list_resep'])) {
            redirect(base_url('pasien/ResepDokter'));
        }
        $data['list_obat'] = [];
        $data['biaya_pengiriman'] = $this->db->query('SELECT biaya_pengiriman FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        $data['total_biaya'] = 0;
        if (!empty($data['biaya_pengiriman'])) {
            $data['biaya_pengiriman'] = $data['biaya_pengiriman']->biaya_pengiriman;
            $data['total_biaya'] += $data['biaya_pengiriman'];
        }
        $data['disetujui'] = 0;

        for ($i = 0; $i < count($data['list_resep']); $i++) {
            $obat = $this->db->query('SELECT name FROM master_obat WHERE id = ' . $data['list_resep'][$i]->id_obat)->row();
            if ($data['list_resep'][$i]->dibatalkan == 0) {
                $data['total_biaya'] += $data['list_resep'][$i]->harga;
            }
            if ($data['list_resep'][$i]->diverifikasi_user == 1) {
                $data['disetujui'] = 1;
            }
            if ($obat) {
                array_push($data['list_obat'], [
                    'id_obat' => $data['list_resep'][$i]->id_obat,
                    'nama_obat' => $obat->name,
                    'dibatalkan' => $data['list_resep'][$i]->dibatalkan,
                    'jumlah' => $data['list_resep'][$i]->jumlah_obat,
                    'harga' => $data['list_resep'][$i]->harga,
                ]);
            }
        }

        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Konfirmasi Pembelian Obat';
        $data['css_addons'] = '
          <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
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
</script>
<script src='" . base_url('assets/js/message.js') . "'></script>
		";
        $this->load->view('template', $data);
    }

    public function terima_obat()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dokter'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }

        if (isset($_POST['id_jadwal_konsultasi'])) {
            $data = $this->input->post();
            $list_resep = $this->db->query('SELECT * from resep_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->result();
            foreach ($list_resep as $resep) {
                $data_resep_update = array(
                    'diterima_user' => 1
                );
                $this->db->where('id', $resep->id);
                $this->db->update('resep_dokter', $data_resep_update);
            }
        }
    }

    public function diverifikasi_user()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dokter'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }

        if (isset($_POST['id_jadwal_konsultasi'])) {
            $data = $this->input->post();
            $list_resep = $this->db->query('SELECT * from resep_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->result();
            foreach ($list_resep as $resep) {
                $data_resep_update = array(
                    'diverifikasi_user' => 1
                );
                $this->db->where('id', $resep->id);
                $this->db->update('resep_dokter', $data_resep_update);
            }
        }

        $farmasi = $this->db->query('SELECT * FROM master_user WHERE id_user_kategori = 5 AND id_user_level = 2')->row();
        $id_notif = $this->db->insert_id();
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $notifikasi = "Ada resep yang sudah diverifikasi pasien.";
        $msg_notif = array(
            'name' => 'resep_diverifikasi_pasien',
            'id_notif' => $id_notif,
            'keterangan' => $notifikasi,
            'tanggal' => $now,
            'id_jadwal_konsultasi' => $data["id_jadwal_konsultasi"],
        );
        $msg_notif = json_encode($msg_notif);
        $this->key->_send_fcm($farmasi->reg_id, $msg_notif);

        $data_notif = array("id_user" => $farmasi->id, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('admin/FarmasiVerifikasiObat'));
        $this->db->insert('data_notifikasi', $data_notif);
    }

    public function batalkan_pembelian_obat()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dokter'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        if (isset($_POST['id_obat']) && is_array($_POST['id_obat'])) {
            $data = $this->input->post();
            for ($i = 0; $i < count($data['id_obat']); $i++) {
                $list_resep = $this->db->query('SELECT * from resep_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'] . ' AND id_obat = ' . $data['id_obat'][$i])->result();
                foreach ($list_resep as $resep) {
                    $data_resep_update = array(
                        'dibatalkan' => 1
                    );
                    $this->db->where('id', $resep->id);
                    $this->db->update('resep_dokter', $data_resep_update);
                }
            }
        }
    }

    public function bayar_va($id_jadwal_konsultasi = null, $bank_id = null)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        if ($id_jadwal_konsultasi == null) {
            show_404();
        }

        $biaya_pengiriman_obat = $this->db->query('SELECT id_registrasi FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        $bukti_pembayaran_obat = $this->db->query('SELECT va_number,id_payment FROM bukti_pembayaran_obat WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        if (!$bank_id) {
            $this->session->set_flashdata('msg_pmbyrn_obat', 'GAGAL: Data Bank tidak ada!');
            redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi));
        }
        if (!$biaya_pengiriman_obat) {
            $this->session->set_flashdata('msg_pmbyrn_obat', 'GAGAL: Data Biaya Pengiriman Obat tidak ada!');
            redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi));
        }
        if ($bukti_pembayaran_obat) {
            $this->session->set_flashdata('msg_pmbyrn_obat', 'GAGAL: Anda tinggal membayar ke rekening yang sudah disediakan!');
            redirect(base_url('pasien/ResepDokter/transfer_va/' . $id_jadwal_konsultasi . '/' . $bukti_pembayaran_obat->id_payment));
        }
        $pasien = $this->db->query('SELECT id,name,email,telp FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if (!$pasien) {
            redirect(base_url('Login'));
        }
        $paymentId = $bank_id;
        $merchantCode = 'IF00350';
        $id_registrasi = $biaya_pengiriman_obat->id_registrasi;
        $name = $pasien->name;
        $email = $pasien->email;
        $phone = $pasien->telp;
        $id_pasien = $pasien->id;

        $dataRaw = array(
            'paymentId' => $paymentId,
            'merchantCode' => $merchantCode,
            'idRegistrasi' => $id_registrasi,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'id_pasien' => $id_pasien,
            'id_jadwal_konsultasi' => $id_jadwal_konsultasi
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config->item('path_to_api') . 'e2pay/Api/purchaseObat',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dataRaw,
        ));

        $result = json_decode(curl_exec($curl));

        curl_close($curl);

        if ($result->status) {
            $this->session->set_flashdata('msg_pmbyrn_obat', $result->msg);
            redirect(base_url('pasien/ResepDokter/transfer_va/' . $id_jadwal_konsultasi . '/' . $paymentId));
        } else {
            $this->session->set_flashdata('msg_pmbyrn_obat', $result->msg);
            redirect(base_url('pasien/ResepDokter/pembayaran/' . $id_jadwal_konsultasi));
        }
    }

    public function batalkan($id_jadwal_konsultasi)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }

        $list_resep = $this->db->query('SELECT id FROM resep_dokter WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->result();
        foreach ($list_resep as $resep) {
            $data_resep_update = array(
                'dibatalkan' => 1
            );
            $this->db->where('id', $resep->id);
            $this->db->update('resep_dokter', $data_resep_update);
        }

        $this->session->set_flashdata('msg_resep_dokter', 'Resep dokter berhasil dibatalkan!');
        redirect(base_url('pasien/ResepDokter'));
    }

    public function batalkan_pembayaran($id)
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 0) {
            if ($valid->id_user_kategori == 2) {
                redirect(base_url('dokter/Dashboard'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }

        $this->db->select('id');
        $this->db->from('bukti_pembayaran_obat');
        $this->db->where('id', $id);
        $bukti_pembayaran_obat = $this->db->get()->row();
        if (!$bukti_pembayaran_obat) {
            redirect('pasien/ResepDokter');
        }

        $this->db->where('id', $id);
        $this->db->delete('bukti_pembayaran_obat');

        $this->session->set_flashdata('msg_resep_dokter', 'Pembayaran Resep Dokter berhasil dibatalkan!');
        redirect(base_url('pasien/ResepDokter'));
    }
}
