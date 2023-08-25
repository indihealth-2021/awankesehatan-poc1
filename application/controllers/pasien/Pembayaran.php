<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Pembayaran extends CI_Controller
{
    public $data;

    private function getIndoDay($dayInEnglish) {
        switch ($dayInEnglish) {
            case "Mon":
                $value = "Senin";
                break;
            case "Tue":
                $value = "Selasa";
                break;
            case "Wed":
                $value = "Rabu";
                break;
            case "Thu":
                $value = "Kamis";
                break;
            case "Fri":
                $value = "Jumat";
                break;
            case "Sat":
                $value = "Sabtu";
                break;
            case "Sun":
                $value = "Minggu";
                break;
            default:
              $value = "Unknown";
        }

        return $value;
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Key'));
        $this->load->library('session');
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
        $data['registrasi'] = $this->db->query('SELECT reg.id as registrasi_id, reg.keterangan, reg.id_status_pembayaran, reg.id_pasien, d.name as nama_dokter,d.foto as foto_dokter, p.poli, d.id as id_dokter, p.id as jadwal_id, nominal.biaya_adm as biaya_adm_poli, bukti_pembayaran.biaya_adm as biaya_adm_bukti, nominal.harga as biaya_konsultasi_poli,bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti, jk.tanggal as tanggal_konsultasi, jk.jam as waktu_konsultasi FROM data_registrasi reg INNER JOIN jadwal_dokter p ON reg.id_jadwal=p.id INNER JOIN master_user d ON p.id_dokter = d.id INNER JOIN detail_dokter ON d.id = detail_dokter.id_dokter INNER JOIN nominal ON nominal.id = detail_dokter.id_poli LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = reg.id LEFT JOIN jadwal_konsultasi jk ON reg.id = jk.id_registrasi WHERE reg.id = "' . $this->input->get('regid') . '" AND reg.id_pasien = ' . $this->session->userdata('id_user'))->row();

        if (!$data['registrasi']) {
            show_404();
        }
        $data['bukti_pembayaran'] = $this->db->query('SELECT bukti_pembayaran.*, (SELECT payment FROM payment WHERE payment_id = bukti_pembayaran.id_payment) as payment_name, (SELECT logo FROM payment WHERE payment_id = bukti_pembayaran.id_payment) as payment_logo, (SELECT payment FROM master_manual_payment WHERE payment_id = bukti_pembayaran.id_payment) as manual_payment_name, (SELECT logo FROM master_manual_payment WHERE payment_id = bukti_pembayaran.id_payment) as manual_payment_logo FROM bukti_pembayaran WHERE bukti_pembayaran.id_pasien = ' . $this->session->userdata('id_user') . ' AND bukti_pembayaran.id_registrasi = "' . $this->input->get('regid') . '" and bukti_pembayaran.status != 2')->row();

        if ($data['bukti_pembayaran']) {
            if ($data['bukti_pembayaran']->metode_pembayaran == 3 && $data['bukti_pembayaran']->status == 0) {
                redirect(base_url('pasien/Pembayaran/transfer_va/' . $this->input->get('regid') . '/' . $data['bukti_pembayaran']->id_payment));
            }
        }
        $data['view'] = 'pasien/pembayaran';
        $data['title'] = 'Pembayaran';
		$data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan, master_user.vip FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['js_addons'] = "
    <script>
    $('.no-hp').hide();
    $('textarea[name=alamat_2]').html(alamat_anda);
    $('textarea[name=alamat_3]').html(alamat_anda);
    $('textarea[name=alamat_4]').html(alamat_anda);
    $('input[name=cardNumber]').on('focus', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault();
        });
    });
    $('input[name=cardNumber]').on('blur', function (e) {
        $(this).off('wheel.disableScroll');
    });
    if ($('input[name=obat-dikirim]').val() == '1') {
        $('#alamat-pengiriman-obat').show();
    }
    $('input[name=otp]').on('focus', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault();
        });
    });
    $('input[name=otp]').on('blur', function (e) {
        $(this).off('wheel.disableScroll');
    });

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
    $('input[name=bank_id]').change(function(e){
        let href_btn = $('#btnBayar').attr('href').split('/');
        href_btn = href_btn.slice(0, href_btn.length-2);
        href_btn = href_btn.join('/');
        $('#btnBayar').attr('href', href_btn+'/'+this.value+'/');
    });

    $('input[name=bank_id_2]').change(function(e){
        let href_btn = $('#form-transfer-manual').attr('action').split('/');
        href_btn = href_btn.slice(0, href_btn.length-2);
        href_btn = href_btn.join('/');
        $('#form-transfer-manual').attr('action', href_btn+'/'+this.value+'/');
    });

    $('#select-alamat').hide();
      $('#label-select-alamat').hide();
      $('select#dikirim').on('change', function() {
        if(this.value == '1') {
          $('#select-alamat').show();
          $('#label-select-alamat').show();
        }else {
          $('#select-alamat').hide();
          $('#label-select-alamat').hide();
        }
      });

    $('select[name=metode_pembayaran]').change(function(e){
        $('#btnBayar').off('click');
        alamat_lain = '';
        if(this.value == '1'){
            $('#form-owlexa').hide();
            $('#transfer_va').show();
            $('#transfer_manual').hide();
            $('#dompet_digital').hide();
            $('#cc_debit').hide();

            $('#alamat-pengiriman-obat').show();

            $('#btnBayar').attr('href', '" . base_url('pasien/Pembayaran/transfer_va/' . $this->input->get('regid')) . "//');
            $('#btnBayar').click(function(e){
                e.preventDefault();

                let href_btn =  $('#btnBayar').attr('href').split('/');
                bank_id = href_btn[href_btn.length - 2];
                if(bank_id === ''){
                    alert('GAGAL: Pilih Metode Terlebih Dahulu!');
                    return false;
                }

                alamat_provinsi = $('#alamat-pengiriman-obat').find('select[name=alamat_provinsi]').val();
                alamat_kota = $('#alamat-pengiriman-obat').find('select[name=alamat_kota]').val();
                alamat_kecamatan = $('#alamat-pengiriman-obat').find('select[name=alamat_kecamatan]').val();
                alamat_kelurahan = $('#alamat-pengiriman-obat').find('select[name=alamat_kelurahan]').val();
                kode_pos = $('#alamat-pengiriman-obat').find('input[name=kode_pos]').val();
                alamat_detail = $('#alamat-pengiriman-obat').find('input[name=alamat_detail]').val();
                // if(!alamat_provinsi || !alamat_kota || !alamat_kecamatan || !alamat_kelurahan || !kode_pos || !alamat_detail){
                //     alert('GAGAL: Alamat tidak lengkap!');
                //     return false;
                // }else{
                    $('#form-va').find('input[name=alamat_provinsi]').val(alamat_provinsi);
                    $('#form-va').find('input[name=alamat_kota]').val(alamat_kota);
                    $('#form-va').find('input[name=alamat_kecamatan]').val(alamat_kecamatan);
                    $('#form-va').find('input[name=alamat_kelurahan]').val(alamat_kelurahan);
                    $('#form-va').find('input[name=kode_pos]').val(kode_pos);
                    $('#form-va').find('input[name=alamat_detail]').val(alamat_detail);
                    $('#form-va').submit();
                //}
            });
        }else if(this.value == '2'){
            $('#form-owlexa').hide();
            $('#transfer_va').hide();
            $('#transfer_manual').show();
            $('#dompet_digital').hide();
            $('#cc_debit').hide();

            $('#alamat-pengiriman-obat').show();

            $('#form-transfer-manual').attr('action', '" . base_url('pasien/Pembayaran/transfer_manual/' . $this->input->get('regid')) . "//');
            $('#btnBayar').click(function(e){
                e.preventDefault();
                let href_btn =  $('#form-transfer-manual').attr('action').split('/');
                bank_id = href_btn[href_btn.length - 2];
                if(bank_id === ''){
                    alert('GAGAL: Pilih Metode Terlebih Dahulu!');
                    return false;
                }

                alamat_provinsi = $('#alamat-pengiriman-obat').find('select[name=alamat_provinsi]').val();
                alamat_kota = $('#alamat-pengiriman-obat').find('select[name=alamat_kota]').val();
                alamat_kecamatan = $('#alamat-pengiriman-obat').find('select[name=alamat_kecamatan]').val();
                alamat_kelurahan = $('#alamat-pengiriman-obat').find('select[name=alamat_kelurahan]').val();
                kode_pos = $('#alamat-pengiriman-obat').find('input[name=kode_pos]').val();
                alamat_detail = $('#alamat-pengiriman-obat').find('input[name=alamat_detail]').val();
                //if(!alamat_provinsi || !alamat_kota || !alamat_kecamatan || !alamat_kelurahan || !kode_pos || !alamat_detail){
                //     alert('GAGAL: Alamat tidak lengkap!');
                //     return false;
                //}else{
                    // $('#form-transfer-manual').find('input[name=alamat_provinsi]').val(alamat_provinsi);
                    // $('#form-transfer-manual').find('input[name=alamat_kota]').val(alamat_kota);
                    // $('#form-transfer-manual').find('input[name=alamat_kecamatan]').val(alamat_kecamatan);
                    // $('#form-transfer-manual').find('input[name=alamat_kelurahan]').val(alamat_kelurahan);
                    // $('#form-transfer-manual').find('input[name=kode_pos]').val(kode_pos);
                    // $('#form-transfer-manual').find('input[name=alamat_detail]').val(alamat_detail);

                    $('input[name=alamat_provinsi]').val(alamat_provinsi);
                    $('input[name=alamat_kota]').val(alamat_kota);
                    $('input[name=alamat_kecamatan]').val(alamat_kecamatan);
                    $('input[name=alamat_kelurahan]').val(alamat_kelurahan);
                    $('input[name=alamat_detail]').val(alamat_detail);

                    $('#form-transfer-manual').submit();
                //}
            });
        }else if(this.value == '3'){
            $('#form-owlexa').hide();
            $('#transfer_va').hide();
            $('#transfer_manual').hide();
            $('#dompet_digital').show();
            $('#cc_debit').hide();
            let no_hp = $('input[name=no_hp]');
            no_hp.val('');

            $('#alamat-pengiriman-obat').show();

            $('#btnBayar').attr('href', '#');
            $('#btnBayar').click(function(e){
                e.preventDefault();
                platform = $('input[name=platform]:checked').val();
                if(platform == undefined){
                    alert('GAGAL: Pilih Platform Terlebih Dahulu!');
                    return false;
                }

                if(platform == '3'){
                    if(no_hp.val() === ''){
                        alert('GAGAL: No HP Harus diisi!');
                        return false;
                    }
                }


                alamat_provinsi = $('#alamat-pengiriman-obat').find('select[name=alamat_provinsi]').val();
                alamat_kota = $('#alamat-pengiriman-obat').find('select[name=alamat_kota]').val();
                alamat_kecamatan = $('#alamat-pengiriman-obat').find('select[name=alamat_kecamatan]').val();
                alamat_kelurahan = $('#alamat-pengiriman-obat').find('select[name=alamat_kelurahan]').val();
                kode_pos = $('#alamat-pengiriman-obat').find('input[name=kode_pos]').val();
                alamat_detail = $('#alamat-pengiriman-obat').find('input[name=alamat_detail]').val();
                // if(!alamat_provinsi || !alamat_kota || !alamat_kecamatan || !alamat_kelurahan || !kode_pos || !alamat_detail){
                //     alert('GAGAL: Alamat tidak lengkap!');
                //     return false;
                // }else{
                    $('#form-dompet-digital').find('input[name=alamat_provinsi]').val(alamat_provinsi);
                    $('#form-dompet-digital').find('input[name=alamat_kota]').val(alamat_kota);
                    $('#form-dompet-digital').find('input[name=alamat_kecamatan]').val(alamat_kecamatan);
                    $('#form-dompet-digital').find('input[name=alamat_kelurahan]').val(alamat_kelurahan);
                    $('#form-dompet-digital').find('input[name=kode_pos]').val(kode_pos);
                    $('#form-dompet-digital').find('input[name=alamat_detail]').val(alamat_detail);
                    $('#form-dompet-digital').submit();
                //}
                // let href_btn =  $('#btnBayar').attr('href').split('/');
                // if(href_btn.length <= 8){
                //     alert('GAGAL: Pilih Metode Terlebih Dahulu!');
                //     return false;
                // }
            });
        }else if(this.value == '4'){
            $('#form-owlexa').show();
            $('#transfer_va').hide();
            $('#transfer_manual').hide();
            $('#dompet_digital').hide();
            $('#cc_debit').hide();

            $('#alamat-pengiriman-obat').show();
            $('#btnBayar').click(function(e){
                e.preventDefault();
                alamat_provinsi = $('#alamat-pengiriman-obat').find('select[name=alamat_provinsi]').val();
                alamat_kota = $('#alamat-pengiriman-obat').find('select[name=alamat_kota]').val();
                alamat_kecamatan = $('#alamat-pengiriman-obat').find('select[name=alamat_kecamatan]').val();
                alamat_kelurahan = $('#alamat-pengiriman-obat').find('select[name=alamat_kelurahan]').val();
                kode_pos = $('#alamat-pengiriman-obat').find('input[name=kode_pos]').val();
                alamat_detail = $('#alamat-pengiriman-obat').find('input[name=alamat_detail]').val();
                // if(!alamat_provinsi || !alamat_kota || !alamat_kecamatan || !alamat_kelurahan || !kode_pos || !alamat_detail){
                //     alert('GAGAL: Alamat tidak lengkap!');
                //     return false;
                // }else{
                    $('#form-owlexa').find('input[name=alamat_provinsi]').val(alamat_provinsi);
                    $('#form-owlexa').find('input[name=alamat_kota]').val(alamat_kota);
                    $('#form-owlexa').find('input[name=alamat_kecamatan]').val(alamat_kecamatan);
                    $('#form-owlexa').find('input[name=alamat_kelurahan]').val(alamat_kelurahan);
                    $('#form-owlexa').find('input[name=kode_pos]').val(kode_pos);
                    $('#form-owlexa').find('input[name=alamat_detail]').val(alamat_detail);
                    $('#form-owlexa').submit();
                //}
            });
        }else if(this.value == '5'){
            $('#form-owlexa').hide();
            $('#transfer_va').hide();
            $('#transfer_manual').hide();
            $('#dompet_digital').hide();
            $('#cc_debit').show();

            $('#alamat-pengiriman-obat').show();

            $('#btnBayar').attr('href', '#');
            $('#btnBayar').click(function(e){
                e.preventDefault();
                alamat_provinsi = $('#alamat-pengiriman-obat').find('select[name=alamat_provinsi]').val();
                alamat_kota = $('#alamat-pengiriman-obat').find('select[name=alamat_kota]').val();
                alamat_kecamatan = $('#alamat-pengiriman-obat').find('select[name=alamat_kecamatan]').val();
                alamat_kelurahan = $('#alamat-pengiriman-obat').find('select[name=alamat_kelurahan]').val();
                kode_pos = $('#alamat-pengiriman-obat').find('input[name=kode_pos]').val();
                alamat_detail = $('#alamat-pengiriman-obat').find('input[name=alamat_detail]').val();
                // if(!alamat_provinsi || !alamat_kota || !alamat_kecamatan || !alamat_kelurahan || !kode_pos || !alamat_detail){
                //     alert('GAGAL: Alamat tidak lengkap!');
                //     return false;
                // }else{
                    $('#form-cc-debit').find('input[name=alamat_provinsi]').val(alamat_provinsi);
                    $('#form-cc-debit').find('input[name=alamat_kota]').val(alamat_kota);
                    $('#form-cc-debit').find('input[name=alamat_kecamatan]').val(alamat_kecamatan);
                    $('#form-cc-debit').find('input[name=alamat_kelurahan]').val(alamat_kelurahan);
                    $('#form-cc-debit').find('input[name=kode_pos]').val(kode_pos);
                    $('#form-cc-debit').find('input[name=alamat_detail]').val(alamat_detail);
                    $('#form-cc-debit').submit();
                //}
                // let href_btn =  $('#btnBayar').attr('href').split('/');
                // if(href_btn.length <= 8){
                //     alert('GAGAL: Pilih Metode Terlebih Dahulu!');
                //     return false;
                // }
            });
        }else{
            $('#form-owlexa').hide();
            $('#transfer_va').hide();
            $('#transfer_manual').hide();
            $('#dompet_digital').hide();
            $('#cc_debit').hide();

            $('#alamat-pengiriman-obat').hide();

            $('#btnBayar').attr('href', '#');
        }
    });
    $('#btnSendOtp').click(function(e){
        e.preventDefault();
        var cardNumber = $('input[name=cardNumber]').val();
        let fullName = $('input[name=fullName]').val();
        if(!cardNumber){
            alert('Isi Nomor Kartu Terlebih Dahulu!');
        }
        else{
            $.ajax({
                method : 'POST',
                url    : baseUrl+'pasien/Pembayaran/generate_otp',
                data   : {cardNumber:cardNumber, fullName:fullName},
                success : function(data){
                   alert(data);
                },
                error : function(data){
                     alert('Send OTP Gagal! Laporkan hal ini pada Admin!'+JSON.stringify(data));
                }
            });
        }
    });
    var getParam = window.location.search.substr(1).split('&');
    console.log(getParam);
    if(getParam.length > 0){
        if(getParam[1] == 'owlexa=true'){
            $('#form-owlexa').show();
            $('#transfer_va').hide();
            $('#transfer_manual').hide();
            $('#dompet_digital').hide();
            $('#cc_debit').hide();

            $('#alamat-pengiriman-obat').show();
            $('select[name=metode_pembayaran]').val('4');
            // if(getParam[2] == 'alamat_kustom=0'){
            //     $('input[name=alamat_kustom][value=0]').prop('checked', true);
            //     $('textarea[name=alamat]').prop('readonly',true);
            // }else{
            //     $('input[name=alamat_kustom][value=1]').prop('checked', true);
            //     $('textarea[name=alamat]').prop('readonly',false);
            // }
            // let alamat = getParam[3].split('=');
            // alamat = alamat.slice(1, alamat.length);
            // alamat = alamat.join('=');
            // $('textarea[name=alamat]').html(decodeURIComponent(alamat));
            $('#btnBayar').click(function(e){
                e.preventDefault();
                $('#form-owlexa').submit();
            });
        }
        else{
            $('#form-owlexa').hide();
            $('#transfer_va').hide();
            $('#transfer_manual').hide();
            $('#dompet_digital').hide();
            $('#cc_debit').hide();

            $('#alamat-pengiriman-obat').hide();
        }
    }

    $('input[name=platform]').change(function(e){
        let no_hp = $('input[name=no_hp]');
        no_hp.val('');
        if($(this).val() == 4 || $(this).val() == 5){
            $('.no-hp').hide();
        }else{
            $('.no-hp').show();
        }
    });

    $(document).ready(function(){
        $.ajax({
            method : 'POST',
            url    : baseUrl+'Alamat/getProvinsi',
            data   : {id_user:".$this->session->userdata('id_user')."},
            success : function(data){
                $('#provinsi').empty();
                data = JSON.parse(data);
                $('#provinsi').append('<option>PILIH PROVINSI</option>');
                $.each(data, function(index, item){
                    var template_provinsi = '<option value=\''+item.id+'\' '+item.selected+'>'+item.name+'</option>';
                    $('#provinsi').append(template_provinsi);
                });

            },
            error : function(data){
                alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
            }


        });
    });

    $('#provinsi').change(function(){
        $('#kotkab').empty();
        $('#kecamatan').empty();
        $('#kelurahan').empty();

        var id_provinsi = $(this).val();
        console.log(id_provinsi);

        $.ajax({
            method : 'POST',
            url    : baseUrl+'Alamat/getKotKab',
            data   : {id_provinsi:id_provinsi},
            success : function(data){
                data = JSON.parse(data);
                $('#kotkab').append('<option>PILIH KABUPATEN/KOTA</option>');
                $.each(data, function(index, item){
                    var template_kotkab = '<option value=\''+item.id+'\'>'+item.name+'</option>';
                    $('#kotkab').append(template_kotkab);
                });

            },
            error : function(data){
                alert('Terjadi kesalahan sistem, silahkan hubungi administrator.'+JSON.stringify(data));
            }


        });
    });

    $('#kotkab').change(function(){
        $('#kecamatan').empty();
        $('#kelurahan').empty();

        var id_kotkab = $(this).val();

        $.ajax({
            method : 'POST',
            url    : baseUrl+'Alamat/getKecamatan',
            data   : {id_kota:id_kotkab},
            success : function(data){
                data = JSON.parse(data);
                $('#kecamatan').append('<option>PILIH KECAMATAN</option>');
                $.each(data, function(index, item){
                    var template_kecamatan = '<option value=\''+item.id+'\'>'+item.name+'</option>';
                    $('#kecamatan').append(template_kecamatan);
                });

            },
            error : function(data){
                alert('Terjadi kesalahan sistem, silahkan hubungi administrator.'+JSON.stringify(data));
            }


        });
    });

    $('#kecamatan').change(function(){
        $('#kelurahan').empty();

        var id_kecamatan = $(this).val();

        $.ajax({
            method : 'POST',
            url    : baseUrl+'Alamat/getKelurahan',
            data   : {id_kecamatan:id_kecamatan},
            success : function(data){
                data = JSON.parse(data);
                $('#kelurahan').append('<option>PILIH KELURAHAN</option>');
                $.each(data, function(index, item){
                    var template_kelurahan = '<option value=\''+item.id+'\'>'+item.name+'</option>';
                    $('#kelurahan').append(template_kelurahan);
                });

            },
            error : function(data){
                alert('Terjadi kesalahan sistem, silahkan hubungi administrator.'+JSON.stringify(data));
            }


        });
    });
    </script>
    ";
        $data['web'] = $this->db->query("SELECT * FROM master_web")->row();
        $data['list_bank_va'] = $this->db->query('SELECT * FROM payment WHERE type = "va" AND vendor = "arthajasa"')->result();
        $data['list_e_wallet'] = $this->db->query('SELECT * FROM payment WHERE type = "ewallet" AND vendor = "arthajasa"')->result();
        $data['list_manual_payment'] = $this->db->query('SELECT * FROM master_manual_payment WHERE aktif = 1')->result();

        // GET TANGGAL KONSUL
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config->item('path_to_env') . "pasien/api/Telekonsultasi/getTanggalKonsultasi/" . $this->input->get('regid'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $result = curl_exec($curl);
        $result = json_decode($result);

        curl_close($curl);
        // ==

        $day_ind = $this->getIndoDay($dayInEnglish=(new DateTime($data['registrasi']->tanggal_konsultasi))->format('D'));

        if($result) {
            if ($result->status) {
                $data['tanggal_konsultasi'] = $result->status ? $result->data->tanggal_konsultasi : $day_ind . ', ' . (new DateTime($data['registrasi']->tanggal_konsultasi))->format('d/m/Y');
                $data['waktu_konsultasi'] = $result->status ? '' : $data['registrasi']->waktu_konsultasi;
                $data['waktu_konsultasi_berakhir'] = $result->status ? '' : (new DateTime($data['registrasi']->waktu_konsultasi))->modify('+30 Minutes')->format('H:i');
            }
        }else {
            $data['tanggal_konsultasi'] = $day_ind . ', ' . (new DateTime($data['registrasi']->tanggal_konsultasi))->format('d/m/Y');
            $data['waktu_konsultasi'] = $data['registrasi']->waktu_konsultasi;
            $data['waktu_konsultasi_berakhir'] = (new DateTime($data['registrasi']->waktu_konsultasi))->modify('+30 Minutes')->format('H:i');
        }

        $this->load->view('template', $data);
    }


    public function transfer_va($id_registrasi = null, $bank_id = null)
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
        if ($id_registrasi == null) {
            show_404();
        }

        // $data['bukti_pembayaran'] = $this->db->query('SELECT * FROM bukti_pembayaran WHERE id_pasien = ' . $this->session->userdata('id_user') . ' AND id_registrasi = "' . $this->input->get('regid') . '"')->row();

        // $data['registrasi'] = $this->db->query('SELECT reg.id as registrasi_id, reg.keterangan, reg.id_status_pembayaran, reg.id_pasien, d.name as nama_dokter, p.poli, d.id as id_dokter, p.id as jadwal_id, nominal.biaya_adm as biaya_adm_poli, bukti_pembayaran.biaya_adm as biaya_adm_bukti, bukti_pembayaran.expired_date, bukti_pembayaran.id_payment, nominal.harga as biaya_konsultasi_poli,bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti, jk.tanggal as tanggal_konsultasi, jk.jam as waktu_konsultasi, bukti_pembayaran.va_number FROM data_registrasi reg INNER JOIN jadwal_dokter p ON reg.id_jadwal=p.id INNER JOIN master_user d ON p.id_dokter = d.id INNER JOIN detail_dokter ON d.id = detail_dokter.id_dokter INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = reg.id LEFT JOIN jadwal_konsultasi jk ON reg.id = jk.id_registrasi WHERE reg.id = "' . $id_registrasi . '" AND reg.id_status_pembayaran = 0 AND bukti_pembayaran.status = 0 AND reg.id_pasien = ' . $this->session->userdata('id_user') . ' AND bukti_pembayaran.metode_pembayaran = 3')->row();

        $data['registrasi'] = $this->db->query('SELECT reg.id as registrasi_id, reg.keterangan, reg.id_status_pembayaran, reg.id_pasien, d.name as nama_dokter, p.poli, d.id as id_dokter, p.id as jadwal_id, nominal.biaya_adm as biaya_adm_poli, bukti_pembayaran.biaya_adm as biaya_adm_bukti, bukti_pembayaran.expired_date, bukti_pembayaran.id_payment, nominal.harga as biaya_konsultasi_poli,bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti, jk.tanggal as tanggal_konsultasi, jk.jam as waktu_konsultasi, bukti_pembayaran.va_number FROM data_registrasi reg INNER JOIN jadwal_dokter p ON reg.id_jadwal=p.id INNER JOIN master_user d ON p.id_dokter = d.id INNER JOIN detail_dokter ON d.id = detail_dokter.id_dokter INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = reg.id LEFT JOIN jadwal_konsultasi jk ON reg.id = jk.id_registrasi WHERE reg.id = "' . $id_registrasi . '" AND reg.id_status_pembayaran = 0 AND reg.id_pasien = ' . $this->session->userdata('id_user') . ' AND bukti_pembayaran.metode_pembayaran = 3')->row();

        $data['payment'] = $this->db->query('SELECT * FROM payment WHERE type = "va" AND payment_id = '.$data['registrasi']->id_payment)->row();

        if(!$data['payment'] || !$data["registrasi"]){
            show_404();
        }

        $data['web'] = $this->db->query("SELECT * FROM master_web")->row();
        $data['view'] = 'pasien/transfer_virtual_account';
        $data['title'] = 'Transfer Virtual Account';
        $data['user'] = $this->db->query('SELECT id, name, foto, lahir_tanggal FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['js_addons'] = '';
        $data['css_addons'] = '';


        $this->load->view('template', $data);
    }

    public function transfer_manual($id_registrasi = null, $bank_id = null)
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
        $post_data = $this->input->post();
        $alamat_provinsi = is_numeric($post_data['alamat_provinsi']) ? $post_data["alamat_provinsi"] : 11;
        $alamat_kota = is_numeric($post_data['alamat_kota']) ? $post_data["alamat_kota"] : 1101;
        $alamat_kecamatan = is_numeric($post_data['alamat_kecamatan']) ? $post_data["alamat_kecamatan"] : 1101010;
        $alamat_kelurahan = is_numeric($post_data['alamat_kelurahan']) ? $post_data["alamat_kelurahan"] : 1101010001;
        $kode_pos = $post_data['kode_pos'];
        $alamat_detail = $post_data['alamat_detail'];

        if( !($bank_id || $alamat_provinsi || $alamat_kota || $alamat_kecamatan || $alamat_kelurahan || $kode_pos || $alamat_detail) ) {
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        }

        $alamat_provinsi = $this->db->query('SELECT name FROM master_provinsi WHERE id = '.$alamat_provinsi)->row()->name;
        $alamat_kota = $this->db->query('SELECT name FROM master_kota WHERE id = '.$alamat_kota)->row()->name;
        $alamat_kecamatan = $this->db->query('SELECT name FROM master_kecamatan WHERE id = '.$alamat_kecamatan)->row()->name;
        $alamat_kelurahan = $this->db->query('SELECT name FROM master_kelurahan WHERE id = '.$alamat_kelurahan)->row()->name;

        if(!$alamat_provinsi || !$alamat_kota || !$alamat_kecamatan || !$alamat_kelurahan){
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        }
        $alamat = $alamat_detail.', KELURAHAN '.$alamat_kelurahan.', KECAMATAN '.$alamat_kecamatan.', '.$alamat_kota.', '.$alamat_provinsi.' '.$kode_pos;
        $data['alamat'] = $alamat;

        if ($id_registrasi == null) {
            show_404();
        }

        $data["dikirim"] = (int) $post_data["dikirim"];

        $data['registrasi'] = $this->db->query('SELECT reg.id as registrasi_id, reg.keterangan, reg.id_status_pembayaran, reg.id_pasien, d.name as nama_dokter, p.poli, d.id as id_dokter, p.id as jadwal_id, nominal.biaya_adm as biaya_adm_poli, bukti_pembayaran.biaya_adm as biaya_adm_bukti, nominal.harga as biaya_konsultasi_poli,bukti_pembayaran.biaya_konsultasi as biaya_konsultasi_bukti, jk.tanggal as tanggal_konsultasi, jk.jam as waktu_konsultasi FROM data_registrasi reg INNER JOIN jadwal_dokter p ON reg.id_jadwal=p.id INNER JOIN master_user d ON p.id_dokter = d.id INNER JOIN detail_dokter ON d.id = detail_dokter.id_dokter INNER JOIN nominal ON nominal.id = detail_dokter.id_poli LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = reg.id LEFT JOIN jadwal_konsultasi jk ON reg.id = jk.id_registrasi WHERE reg.id = "' . $id_registrasi . '" AND reg.id_status_pembayaran = 0 AND reg.id_pasien = ' . $this->session->userdata('id_user'))->row();
        if (!$data['registrasi']) {
            show_404();
        }
        $data['web'] = $this->db->query("SELECT * FROM master_web")->row();

        $data['view'] = 'pasien/transfer_upload_manual';
        $data['title'] = 'Transfer Manual';
        $data['user'] = $this->db->query('SELECT p.id, p.name, p.foto, p.lahir_tanggal, master_provinsi.name as nama_provinsi, master_kota.name as nama_kota, master_kecamatan.name as nama_kecamatan, master_kelurahan.name as nama_kelurahan, p.alamat_jalan, p.kode_pos, p.vip FROM master_user as p LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi WHERE p.id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['js_addons'] = "
        <script>
        $('textarea[name=alamat]').html(alamat_anda);
        $('#file_upload').change(function() {
            var file = $('#file_upload')[0].files[0].name;
            var file_substr = file.length > 40 ? file.substr(0, 39)+'...':file;
            $('#filename').html('<span title=\"' + file + '\">' + file_substr + '</span>');
          });

        $('input[name=alamat_kustom]').change(function(e){
            var val_alamat_kustom = $(this).val();

            if(val_alamat_kustom == 1){
                $('textarea[name=alamat]').val(alamat_lain);
                $('textarea[name=alamat]').prop('readonly',false);
            }
            else{
                $('textarea[name=alamat]').val(alamat_anda);
                $('textarea[name=alamat]').prop('readonly',true);
            }
        });

        $('textarea[name=alamat]').change(function(){
            alamat_lain = $(this).val();
        });

        $('#form_transfer').submit(function(e){
            alamat = $('textarea[name=alamat]').val();
            // if(alamat.search('Alamat tidak lengkap') > 0 || alamat.match(/^ *$/) !== null){
            //     alert('GAGAL: Alamat tidak lengkap!');
            //     return false;
            // }
        });
        </script>
        ";
        $data['css_addons'] = '';

        switch ($bank_id) {
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
                $bank_name = "OWLEXA HEALTHCARE";
                $bank_logo = "owlexa.png";
                break;
            default:
                $bank_name = '';
                $bank_logo = '';
                show_404();
                break;
        }

        $data['data_bank'] = array(
            "id_bank" => $bank_id,
            'nama_bank' => $bank_name,
            'logo_bank' => $bank_logo,
        );

        $data['manual_payment'] = $this->db->query('SELECT * FROM master_manual_payment WHERE aktif = 1 AND payment_id = '.$bank_id)->row();

        if(!$data['manual_payment']){
            show_404();
        }

        $this->load->view('template', $data);
    }

    public function bayar()
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
        if (!$this->db->query('SELECT id FROM data_registrasi WHERE id = "' . $this->input->post('regid') . '"')) {
            show_404();
        }

        $id_registrasi = $this->input->post('regid');
        if (!$id_registrasi) {
            show_404();
        }
        $bank_id = $this->input->post('bank_id');
        if (!$bank_id) {
            show_404();
        }

        $alamat_kustom = 1;
        $alamat_pengiriman_obat = $this->input->post('alamat');
        $dikirim = $this->input->post("dikirim");

        if (!$alamat_pengiriman_obat) {
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Alamat tidak lengkap!');
            redirect(base_url('pasien/Pembayaran/transfer_manual/' . $id_registrasi . '/' . $bank_id));
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyC7IdKoPYrF-6bqtHHOt3Rwa3xvsnSO2TQ&address='.urlencode($alamat_pengiriman_obat),
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

        $data_registrasi = $this->db->query('SELECT data_registrasi.id_jadwal, jadwal_dokter.hari, jadwal_dokter.tanggal, jadwal_dokter.waktu FROM data_registrasi INNER JOIN jadwal_dokter ON data_registrasi.id_jadwal = jadwal_dokter.id WHERE data_registrasi.id = "' . $id_registrasi . '" AND id_pasien = ' . $this->session->userdata('id_user'))->row();
        if (!$data_registrasi) {
            show_404();
        }
        if ($data_registrasi->tanggal) {
            $tgl_dokter = new DateTime($data_registrasi->tanggal);
            $now = new DateTime('now');
            $diff_now_tgl_dokter = $now->diff($tgl_dokter);
            if ($diff_now_tgl_dokter->invert) {
                $this->session->set_flashdata('msg', 'Pembayaran anda telat! Jadwal ini telah kadaluarsa!');
                redirect(base_url('pasien/JadwalTerdaftar'));
            }
        }
        switch ($data_registrasi->hari) {
            case 'Senin':
                $hari_dokter = 'Mon';
                break;
            case 'Selasa':
                $hari_dokter = 'Tue';
                break;
            case 'Rabu':
                $hari_dokter = 'Wed';
                break;
            case 'Kamis':
                $hari_dokter = 'Thu';
                break;
            case "Jum'at":
                $hari_dokter = 'Fri';
                break;
            case "Sabtu":
                $hari_dokter = 'Sat';
                break;
            case "Minggu":
                $hari_dokter = 'Sun';
                break;
            default:
                $hari_dokter = '';
                break;
        }
        $spare_waktu_jd = explode('-', str_replace(' ', '', $data_registrasi->waktu));
        $jadwal_konsultasi = $this->db->query('SELECT jk.jam,jk.tanggal FROM jadwal_konsultasi jk INNER JOIN data_registrasi dreg ON jk.id_registrasi = dreg.id INNER JOIN jadwal_dokter jd ON dreg.id_jadwal = jd.id WHERE jd.id = ' . $data_registrasi->id_jadwal . ' ORDER BY jk.created_at DESC LIMIT 1')->row();
        $jam_awal = new DateTime($hari_dokter . ' ' . $spare_waktu_jd[0]);
        $jam_terakhir = new DateTime($hari_dokter . ' ' . $spare_waktu_jd[1]);

        $now = new DateTime('now');
        $diff_spare_now = $now->diff($jam_awal);
        $diff_spare_terakhir = $now->diff($jam_terakhir);
        // echo var_dump(array($now, $spare_waktu_jd[0],$diff_spare_now));
        // die;
        if ($diff_spare_now->invert && !$diff_spare_terakhir->invert) {
            $this->session->set_flashdata('msg', 'Pembayaran anda telat! Jadwal ini sedang berlangsung, tunggu sampai jadwal selesai!');
            redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
        }
        if ($jadwal_konsultasi) {
            $last_jam_konsultasi = new DateTime($jadwal_konsultasi->tanggal . ' ' . $jadwal_konsultasi->jam);
            $last_jam_konsultasi->modify('+30 minutes');
            // echo var_dump($last_jam_konsultasi);
            // die;
            $list_registrasi = $this->db->query('SELECT bukti_pembayaran.id FROM bukti_pembayaran INNER JOIN data_registrasi ON data_registrasi.id = bukti_pembayaran.id_registrasi WHERE data_registrasi.id_jadwal = ' . $data_registrasi->id_jadwal . ' AND bukti_pembayaran.status = 0')->result();
            foreach ($list_registrasi as $registrasi) {
                $diff_spare_last = $last_jam_konsultasi->diff($jam_terakhir);
                if ($diff_spare_last->h == 0 && $diff_spare_last->i < 30) {
                    $last_jam_konsultasi->modify('+7 days');
                } else {
                    $last_jam_konsultasi->modify('+30 minutes');
                }
            }
            // $count_list_registrasi = count($list_registrasi);
            // $minutes_plus = $count_list_registrasi*30;

            // if($count_list_registrasi > 0){
            //     $last_jam_konsultasi->modify('+'.$minutes_plus.' minutes');
            // }

            //        if(count($list_registrasi) > 0){
            //            $last_jam_konsultasi->modify('-30 minutes');
            //        }
            $diff_spare_last = $last_jam_konsultasi->diff($jam_terakhir);

            if ($diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30) {
                $this->session->set_flashdata('msg_pmbyrn', 'Pembayaran anda telat! Jadwal Konsultasi untuk jadwal ini di minggu ini dan minggu depan sudah penuh, batalkan pendaftaran ini dan daftar kembali di minggu depan!');
                redirect('pasien/Pembayaran/?regid=' . $this->input->post('regid'));
            }

            $nextWeek = $last_jam_konsultasi->modify('+7 days');
            $nextWeek = $nextWeek->format('[ d-m-Y ]');
            if ((!$this->input->post('nextWeek') && !$diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30)) {
                // $msg_pmbyrn = '
                // <script>
                //     var test = confirm("Pembayaran anda telat! Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh, jadwal anda akan dialihkan ke minggu depan! Apakah anda berkenan?");
                //     if(test){

                //     }
                // </script>
                // ';
                // $this->session->set_flashdata('msg_pmbyrn', 'Pembayaran anda telat! Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh');
                // redirect('pasien/Pembayaran/?regid='.$this->input->post('regid'));
                $msg = '
                <script>
                    document.getElementsByTagName("BODY")[0].setAttribute("onload", "myFunction();");

                    function myFunction(){
                        var test = confirm("Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh, jadwal anda akan dialihkan ke minggu depan ' . $nextWeek . ', apakah anda berkenan?");
                        if(test){
                            var form_pembayaran = document.getElementById("form_pembayaran");
                            var node = document.createElement("input");
                            node.setAttribute("type", "hidden");
                            node.setAttribute("name", "nextWeek");
                            node.setAttribute("value", "true");
                            form_pembayaran.appendChild(node);
                            alert("Anda sudah menyetujui pengalihan jadwal konsultasi, upload kembali bukti pembayaran anda!");
                        }
                    }
                </script>
            ';
                $this->session->set_flashdata('msg_pmbyrn_2', $msg);
                redirect('pasien/Pembayaran/?regid=' . $this->input->post('regid'));
            }
        }
        $list_registrasi = $this->db->query('SELECT bukti_pembayaran.id FROM bukti_pembayaran INNER JOIN data_registrasi ON data_registrasi.id = bukti_pembayaran.id_registrasi WHERE data_registrasi.id_jadwal = ' . $data_registrasi->id_jadwal . ' AND bukti_pembayaran.status = 0')->result();
        foreach ($list_registrasi as $registrasi) {
            $diff_spare_last = $jam_awal->diff($jam_terakhir);
            if ($diff_spare_last->h == 0 && $diff_spare_last->i < 30) {
                $jam_awal->modify('+7 days');
            } else {
                $jam_awal->modify('+30 minutes');
            }
        }

        $diff_spare_last = $jam_awal->diff($jam_terakhir);
        $now = new DateTime($hari_dokter);
        $now = $now->format('Y-m-d');

        if ($diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30) {
            $this->session->set_flashdata('msg', 'Jadwal Konsultasi untuk minggu ini dan minggu depan sudah penuh, daftar kembali di minggu depan!');
            redirect(base_url('pasien/Pendaftaran?poli=&hari=all'));
        }

        $nextWeek = $jam_awal->modify('+7 days');
        $nextWeek = $nextWeek->format('[ d-m-Y ]');
        if ((!$this->input->post('nextWeek') && !$diff_spare_last->invert && $diff_spare_last->h == 0 && $diff_spare_last->i < 30)) {
            $msg = '
                <script>
                    document.getElementsByTagName("BODY")[0].setAttribute("onload", "myFunction();");

                    function myFunction(){
                        var test = confirm("Jadwal Konsultasi untuk jadwal ini di minggu ini sudah penuh, jadwal anda akan dialihkan ke minggu depan ' . $nextWeek . ', apakah anda berkenan?");
                        if(test){
                            var form_pembayaran = document.getElementById("form_pembayaran");
                            var node = document.createElement("input");
                            node.setAttribute("type", "hidden");
                            node.setAttribute("name", "nextWeek");
                            node.setAttribute("value", "true");
                            form_pembayaran.appendChild(node);
                            alert("Anda sudah menyetujui pengalihan jadwal konsultasi, upload kembali bukti pembayaran anda!");
                        }
                    }
                </script>
        ';
            $this->session->set_flashdata('msg_pmbyrn_2', $msg);
            redirect('pasien/Pembayaran/?regid=' . $this->input->post('regid'));
        }

        $config['upload_path']          = './assets/images/bukti_pembayaran';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 10024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $config['file_name']            = $this->input->post('regid');

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $bp = $this->db->query('SELECT id, status FROM bukti_pembayaran WHERE id_registrasi = "'.$id_registrasi.'" AND status = 0')->row();
        if($bp){
            $this->upload->overwrite = true;
        }

        if (!$this->upload->do_upload('bukti_pembayaran')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg_pmbyrn', 'Bukti Pembayaran Gagal Diupload');
            redirect('pasien/Pembayaran/transfer_manual/' . $this->input->post('regid') . '/' . $bank_id);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $jadwal = $this->db->query('SELECT nominal.biaya_adm as biaya_adm_poli, nominal.harga as biaya_konsultasi FROM data_registrasi INNER JOIN jadwal_dokter ON jadwal_dokter.id = data_registrasi.id_jadwal INNER JOIN master_user dokter ON dokter.id = jadwal_dokter.id_dokter INNER JOIN detail_dokter ON dokter.id = detail_dokter.id_dokter INNER JOIN nominal ON nominal.id = detail_dokter.id_poli WHERE data_registrasi.id = "' . $this->input->post('regid') . '"')->row();
            $master_web = $this->db->query('SELECT harga_adm FROM master_web')->row();
            $biaya_adm = $jadwal->biaya_adm_poli != null ? $jadwal->biaya_adm_poli : $master_web->harga_adm;
            $data_bukti = array(
                'id_dokter' => $this->input->post('id_dokter'),
                'id_pasien' => $this->session->userdata('id_user'),
                'id_registrasi' => $this->input->post('regid'),
                'metode_pengambilan_obat' => $this->input->post('dikirim'),
                'id_payment' => $this->input->post('bank_id'),
                'photo' => $this->upload->data('file_name'),
                'biaya_adm' => $biaya_adm,
                'biaya_konsultasi' => $jadwal->biaya_konsultasi,
                'status' => 0, 'metode_pembayaran' => 1
            );
            if($bp){
                $this->db->set($data_bukti);
                $this->db->where(array('id'=>$bp->id));
                $this->db->update('bukti_pembayaran');
            }else{
                $this->db->insert('bukti_pembayaran', $data_bukti);
            }

            $data_regis_update = array('id_status_pembayaran' => 2, 'keterangan' => 'Sedang Diproses');
            $this->db->set($data_regis_update);
            $this->db->where('id', $this->input->post('regid'));
            $this->db->update('data_registrasi');

            $message = 'Bukti Pembayaran Berhasil Diupload, tunggu verifikasi dari Admin';

            $alamat = $dikirim ? $alamat_pengiriman_obat : "";
            $latestId = $this->db->query("SELECT id FROM biaya_pengiriman_obat ORDER BY id DESC LIMIT 1")->row()->id + 1;

            $this->db->insert("biaya_pengiriman_obat", [
                "id" => $latestId,
                "alamat" => $dikirim ? $alamat_pengiriman_obat : "",
                "alamat_kustom" => $alamat_kustom,
                "id_registrasi" => $id_registrasi,
            ]);

            $this->session->set_flashdata('msg_pmbyrn', $message);

            $uploader = $this->db->query('SELECT name,reg_id FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
            $admins = $this->db->query('SELECT id, reg_id FROM master_user WHERE id_user_kategori = 5')->result();
            $admins_id = [];
            $admins_regid = [];
            for ($i = 0; $i < count($admins); $i++) {
                $admins_id[$i] = $admins[$i]->id;
                $admins_regid[$i] = $admins[$i]->reg_id;
            }

            $notifikasi = 'Bukti Pembayaran diupload oleh ' . $uploader->name;
            $now = (new DateTime('now'))->format('Y-m-d H:i:s');

            $data_notif = array("id_user" => implode(',', $admins_id), "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => base_url('admin/Payment'));
            $this->db->insert('data_notifikasi', $data_notif);
            $id_notif = $this->db->insert_id();

            $msg_notif = array(
                'name' => 'vp',
                'id_notif' => $id_notif,
                'keterangan' => $notifikasi,
                'tanggal' => $now,
                'id_user' => json_encode($admins_id),
                'direct_link' => base_url('admin/Payment'),
            );
            $msg_notif = json_encode($msg_notif);

            $to = $uploader->reg_id;
            foreach ($admins_regid as $admin_regid) {
                $this->key->_send_fcm($admin_regid, $msg_notif);
            }

            $detail_pasien = $this->db->query('SELECT id FROM detail_pasien WHERE id_pasien = ' . $this->session->userdata('id_user'))->row();

            $last_medrek = $this->db->query('SELECT no_medrec FROM detail_pasien ORDER BY no_medrec DESC')->row();
            $last_medrek = ltrim($last_medrek->no_medrec, "0");
            $last_medrek += 1;
            $no_medrek = str_pad($last_medrek, 8, "0", STR_PAD_LEFT);

            if (!$detail_pasien) {

                $data_detail_pasien = array(
                    'id_pasien' => $this->session->userdata('id_user'),
                    'no_medrec' => $no_medrek,
                );

                $this->db->insert('detail_pasien', $data_detail_pasien);
            } else {
                $this->all_model->update('detail_pasien', array('no_medrec' => $no_medrek), array('id_pasien' => $this->session->userdata('id_user')));
            }
            redirect('pasien/JadwalTerdaftar');
        }
    }

    public function bayar_owlexa()
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

        $id_user = $this->session->userdata('id_user');
        $user = $this->db->query('SELECT id, name, lahir_tanggal, email FROM master_user WHERE id = ' . $id_user)->row();
        $id_pasien = $user->id;
        //$fullName = $user->name;
        $fullName = $this->input->post('fullName');
        $birthDate = $this->input->post('birthDate');
        $email = $user->email;
        // $fullName = 'OWLEXA TESTING CARD 3566'; //$user->name;
        // $birthDate = '1991-05-01'; //$user->lahir_tanggal;
        $cardNumber = $this->input->post('cardNumber');
        // $otp = $this->input->post('otp');
        $id_dokter = $this->input->post('id_dokter');
        $id_registrasi = $this->input->post('id_registrasi');
        // echo var_dump($this->input->post());
        // die;

        $data = $this->input->post();
        $admissionDate = date("Y-m-d");
        $currentTime = date("Y-m-d H:i:s");

        $post_data = $this->input->post();

        // $alamat_kustom = $this->input->post('alamat_kustom');
        if ($post_data['dikirim'] == 1) {
            $alamat_provinsi = $post_data['alamat_provinsi'];
            $alamat_kota = $post_data['alamat_kota'];
            $alamat_kecamatan = $post_data['alamat_kecamatan'];
            $alamat_kelurahan = $post_data['alamat_kelurahan'];
            $kode_pos = $post_data['kode_pos'];
            $alamat_detail = $post_data['alamat_detail'];
            $alamat_pengiriman_obat = $alamat_detail . "," . $alamat_kelurahan . "," . $alamat_kecamatan . "," . $alamat_kota . "," . $alamat_provinsi . "," . $kode_pos; 
            if (!isset($data['cardNumber'])  || !$alamat_pengiriman_obat) {
                $response['msg'] = 'Data yang anda masukan tidak lengkap!';
                $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
                //redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true&alamat_kustom='.$alamat_kustom.'&alamat='.$alamat_pengiriman_obat.'#metode-pembayaran'));
                redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran'));
            }
        }
        

        $pasien = $this->db->query('SELECT id FROM master_user WHERE id = ' . $id_pasien . ' AND id_user_kategori = 0')->row();
        if (!$pasien) {
            $response['msg'] = 'User tersebut bukan pasien!';
            $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
            //redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true&alamat_kustom='.$alamat_kustom.'&alamat='.$alamat_pengiriman_obat.'#metode-pembayaran'));
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran'));
        }

        $dokter = $this->db->query('SELECT id FROM master_user WHERE id = ' . $id_dokter . ' AND id_user_kategori = 2')->row();
        if (!$dokter) {
            $response['msg'] = 'User tersebut bukan dokter!';
            $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
            //redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true&alamat_kustom='.$alamat_kustom.'&alamat='.$alamat_pengiriman_obat.'#metode-pembayaran'));
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran'));
        }

        $data_registrasi = $this->db->query('SELECT id FROM data_registrasi WHERE id = "' . $id_registrasi . '" AND id_pasien = ' . $this->session->userdata('id_user'))->row();
        if (!$data_registrasi) {
            $response['msg'] = 'Registrasi Tidak Ditemukan!';
            $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
            //redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true&alamat_kustom='.$alamat_kustom.'&alamat='.$alamat_pengiriman_obat.'#metode-pembayaran'));
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran'));
        }
        if ($data_registrasi->tanggal) {
            $tgl_dokter = new DateTime($data_registrasi->tanggal);
            $now = new DateTime('now');
            $diff_now_tgl_dokter = $now->diff($tgl_dokter);
            if ($diff_now_tgl_dokter->invert) {
                $this->session->set_flashdata('msg', 'Pembayaran anda telat! Jadwal ini sudah kadaluarsa!');
                redirect(base_url('pasien/JadwalTerdaftar'));
            }
        }

        $id_jadwal = $this->db->query('SELECT id_jadwal FROM data_registrasi WHERE id = "' . $id_registrasi . '"')->row();
        $jadwal = $this->db->query('SELECT waktu, id, tanggal, id_dokter,hari FROM jadwal_dokter WHERE id = ' . $id_jadwal->id_jadwal)->row();
        $spare_waktu_dokter = explode('-', str_replace(' ', '', $jadwal->waktu));
        $last_konsultasi = $this->db->query('SELECT reg.id_jadwal, jk.jam, jk.tanggal, jd.tanggal as tanggal_dokter, jd.hari as hari_dokter, jd.waktu as waktu_dokter FROM jadwal_konsultasi jk INNER JOIN (SELECT reg.id_jadwal, reg.id FROM data_registrasi reg WHERE reg.id_jadwal = ' . $id_jadwal->id_jadwal . ') as reg ON jk.id_registrasi = reg.id INNER JOIN jadwal_dokter jd ON reg.id_jadwal = jd.id ORDER BY jk.created_at DESC LIMIT 1')->row();
        if ($last_konsultasi) {
            $dateLastKonsultasi = new DateTime($last_konsultasi->tanggal . ' ' . $last_konsultasi->jam);
            $now = new DateTime('now');
            $diff_spare_last_now = $now->diff($dateLastKonsultasi);
            if ($diff_spare_last_now->invert) {
                switch ($last_konsultasi->hari_dokter) {
                    case 'Senin':
                        $hari_dokter = 'Mon';
                        break;
                    case 'Selasa':
                        $hari_dokter = 'Tue';
                        break;
                    case 'Rabu':
                        $hari_dokter = 'Wed';
                        break;
                    case 'Kamis':
                        $hari_dokter = 'Thu';
                        break;
                    case "Jum'at":
                        $hari_dokter = 'Fri';
                        break;
                    case "Sabtu":
                        $hari_dokter = 'Sat';
                        break;
                    case "Minggu":
                        $hari_dokter = 'Sun';
                        break;
                    default:
                        $hari_dokter = '';
                        break;
                }
                $jd_this_week = new DateTime($hari_dokter);
                $jd_this_week = $jd_this_week->format('Y-m-d');
                $last_konsultasi->tanggal = $jd_this_week;
                $last_konsultasi->jam = $spare_waktu_dokter[0];
                $last_konsultasi->jam = new DateTime($last_konsultasi->jam);
                $last_konsultasi->jam = $last_konsultasi->jam->modify('-30 minutes');
                $last_konsultasi->jam = $last_konsultasi->jam->format('H:i');
            }
            $jam_detik = new DateTime($spare_waktu_dokter[1]);
            $jam_detik = $jam_detik->modify("-30 minutes");
            $jam_detik = $jam_detik->format("H:i");
            if ($last_konsultasi->tanggal_dokter) {
                $now = new DateTime('now');
                $diff_reg_time = $now->diff(new DateTime($last_konsultasi->tanggal));
                if ($dif_reg_time->invert) {
                    $tanggal = new DateTime($last_konsultasi->tanggal);
                    $tanggal = $tanggal->modify("+7 days");
                    $tanggal = $tanggal->format('Y-m-d');
                    $jam = $spare_waktu_dokter[0];
                } else {
                    if ($last_konsultasi->jam == $jam_detik) {
                        $tanggal = new DateTime($last_konsultasi->tanggal);
                        $tanggal = $tanggal->modify("+7 days");
                        $tanggal = $tanggal->format('Y-m-d');
                        $jam = $spare_waktu_dokter[0];
                    } else {
                        $tanggal = $last_konsultasi->tanggal;
                        $jam = new DateTime($last_konsultasi->jam);
                        $jam = $jam->modify("+30 minutes");
                        $jam = $jam->format("H:i");
                    }
                }
            } else {
                $now = new DateTime('now');
                $hari_sekarang = $now;
                switch ($last_konsultasi->hari_dokter) {
                    case 'Senin':
                        $hari_dokter = 'Mon';
                        break;
                    case 'Selasa':
                        $hari_dokter = 'Tue';
                        break;
                    case 'Rabu':
                        $hari_dokter = 'Wed';
                        break;
                    case 'Kamis':
                        $hari_dokter = 'Thu';
                        break;
                    case "Jum'at":
                        $hari_dokter = 'Fri';
                        break;
                    case "Sabtu":
                        $hari_dokter = 'Sat';
                        break;
                    case "Minggu":
                        $hari_dokter = 'Sun';
                        break;
                    default:
                        $hari_dokter = '';
                        break;
                }
                $hari_dokter = new DateTime($hari_dokter . ' ' . $spare_waktu_dokter[1]);
                $diff_hari = $hari_sekarang->diff($hari_dokter);

                if ($diff_hari->invert) {
                    $tanggal = $last_konsultasi->tanggal;
                    $tanggal = $now->modify('+7 Days');
                    $tanggal = $tanggal->format('Y-m-d');
                    $jam = $spare_waktu_dokter[0];
                } else {

                    if ($last_konsultasi->jam == $jam_detik) {
                        $tanggal = new DateTime($last_konsultasi->tanggal);
                        $tanggal = $tanggal->modify("+7 days");
                        $tanggal = $tanggal->format('Y-m-d');
                        $jam = $spare_waktu_dokter[0];
                    } else {
                        $tanggal = $last_konsultasi->tanggal;
                        $jam = new DateTime($last_konsultasi->jam);
                        $jam = $jam->modify("+30 minutes");
                        $jam = $jam->format("H:i");
                    }
                }
            }
        } else {
            if ($jadwal->tanggal) {
                $now = new DateTime('now');
                $diff_reg_time = $now->diff(new DateTime($jadwal->tanggal));
                if ($diff_reg_time->invert) {
                    $response['msg'] = 'Tidak dapat mendaftar ke jadwal yang sudah kadaluarsa!';
                    $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
                    redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran#metode-pembayaran'));
                } else {
                    $tanggal = $jadwal->tanggal;
                    $jam = $spare_waktu_dokter[0];
                }
            } else {
                $now = new DateTime('now');
                $hari_sekarang = $now;
                switch ($jadwal->hari) {
                    case 'Senin':
                        $hari_dokter = 'Mon';
                        break;
                    case 'Selasa':
                        $hari_dokter = 'Tue';
                        break;
                    case 'Rabu':
                        $hari_dokter = 'Wed';
                        break;
                    case 'Kamis':
                        $hari_dokter = 'Thu';
                        break;
                    case "Jum'at":
                        $hari_dokter = 'Fri';
                        break;
                    case "Sabtu":
                        $hari_dokter = 'Sat';
                        break;
                    case "Minggu":
                        $hari_dokter = 'Sun';
                        break;
                    default:
                        $hari_dokter = '';
                        break;
                }
                $hari_dokter = new DateTime($hari_dokter);
                $diff_hari = $hari_sekarang->diff($hari_dokter);
                if ($diff_hari->d > 0) {
                    $diff_hari->d += 1;
                }
                $now = new DateTime('now');
                $tanggal = $now->modify('+' . $diff_hari->d . ' Days');
                $tanggal = $tanggal->format('Y-m-d');
                $jam = $spare_waktu_dokter[0];
            }
        }
        $jadwal = $this->db->query('SELECT jadwal_dokter.id, jadwal_dokter.id_dokter, nominal.biaya_adm as biaya_adm_poli, nominal.harga as biaya_konsultasi FROM data_registrasi INNER JOIN jadwal_dokter ON jadwal_dokter.id = data_registrasi.id_jadwal INNER JOIN master_user dokter ON dokter.id = jadwal_dokter.id_dokter INNER JOIN detail_dokter ON dokter.id = detail_dokter.id_dokter INNER JOIN nominal ON nominal.id = detail_dokter.id_poli WHERE data_registrasi.id = "' . $id_registrasi . '"')->row();
        $master_web = $this->db->query('SELECT harga_adm FROM master_web')->row();
        $biaya_adm = $jadwal->biaya_adm_poli != null ? $jadwal->biaya_adm_poli : $master_web->harga_adm;
        $biaya_konsultasi = $jadwal->biaya_konsultasi;
        $chargeValue = $biaya_konsultasi + $biaya_adm;
        // echo var_dump(floatval($data['chargeValue']));
        // die;
        $dataRaw = array(
            "birthDate" => $birthDate,
            "cardNumber" => $cardNumber,
            "currentTime" => $currentTime,
            "email" => $email,
            "providerCode" => 3495,
            "admissionDate" => $admissionDate,
            "fullName" => $fullName,
            "chargeValue" => floatval($chargeValue),
            // "otp" => $otp,
            "telemedicineType" => 'TM-001',
        );

        $dataRaw = json_encode($dataRaw);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://test.owlexa.com/owlexa-api/telemedicine/v1/verification",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $dataRaw,
            CURLOPT_HTTPHEADER => array(
                "Api-Key: VO6v8Id9eqEchgogLE1nDVFopJdnXxk9K/ZEm7xqX5I=",
                "Content-Type: application/json"
            ),
        ));

        $result = curl_exec($curl);
        $result = json_decode($result, true);

        curl_close($curl);

        $response['data'] = $result['data'];
        // $this->response($result, REST_Controller::HTTP_OK);
        if ($result['code'] == 200) {
            $claim_number = $result['data']['claimNumber'];

            $data_bukti_pembayaran = array(
                "id_registrasi" => $id_registrasi,
                "id_pasien" => $id_pasien,
                "id_dokter" => $id_dokter,
                "biaya_adm" => $biaya_adm,
                "biaya_konsultasi" => $jadwal->biaya_konsultasi,
                "metode_pembayaran" => 2,
                'metode_pengambilan_obat' => $this->input->post('dikirim'),
                "status" => 1,
                "card_number" => $cardNumber,
                "claim_number" => $claim_number
            );
            $this->db->insert('bukti_pembayaran', $data_bukti_pembayaran);
            $bukti_id = $this->db->insert_id();

            $data3 = array(
                "id_dokter" => $jadwal->id_dokter,
                "id_pasien" => $id_pasien,
                "id_registrasi" => $id_registrasi,
                "tanggal" => $tanggal,
                "jam" => $jam,
            );
            // $this->db->insert('jadwal_konsultasi', $data3);
            $id_jadwal_konsultasi = $this->db->insert_id();

            $data_biaya_pengiriman_obat = array(
                'alamat' => $post_data['dikirim'] == 1 ? $alamat_pengiriman_obat : '',
                'alamat_kustom' => 0,
                'id_registrasi' => $id_registrasi
            );
            $this->db->insert('biaya_pengiriman_obat', $data_biaya_pengiriman_obat);

            $hasil = $this->all_model->select_total($id_dokter);

            $data1 = array('id_status_pembayaran' => 1, 'keterangan' => 'Lunas');

            $assesment = $this->db->query('SELECT assesment.* FROM assesment INNER JOIN jadwal_konsultasi ON assesment.id_jadwal_konsultasi = jadwal_konsultasi.id WHERE assesment.id_pasien = ' . $id_pasien . ' ORDER BY assesment.created_at DESC')->row();
            $dokter = $this->db->query('SELECT id,name FROM master_user WHERE id = ' . $jadwal->id_dokter)->row();
            // if ($assesment) {
            //     $data_assesment = array(
            //         "id_pasien" => $id_pasien,
            //         "id_jadwal_konsultasi" => $id_jadwal_konsultasi,
            //         "id_dokter" => $jadwal->id_dokter,
            //         "berat_badan" => $assesment->berat_badan,
            //         "tinggi_badan" => $assesment->tinggi_badan,
            //         "tekanan_darah" => $assesment->tekanan_darah,
            //         "suhu" => $assesment->suhu,
            //         "merokok" => $assesment->alkohol,
            //         "kecelakaan" => $assesment->kecelakaan,
            //         "operasi" => $assesment->operasi,
            //         "dirawat" => $assesment->dirawat,
            //         "keluhan" => $assesment->keluhan,
            //     );
            //     $this->db->insert('assesment', $data_assesment);
            //     $notifikasi = 'Pembayaran telah diverifikasi. Isi Assesment untuk Jadwal Telekonsultasi dengan dokter ' . $dokter->name . ' yang telah dibuat [' . $tanggal . ' ' . $jam . ']';
            //     $direct_link = 'https://telemedicinelintasdev.indihealth.com/pasien/Assesment?id_jadwal_konsultasi=' . $id_jadwal_konsultasi;
            // } else {
            $notifikasi = 'Pembayaran telah diverifikasi. Isi Assessment untuk Jadwal Telekonsultasi dengan dokter ' . $dokter->name . ' yang telah dibuat [' . $tanggal . ' ' . $jam . ']';
            $direct_link = 'https://telemedicinelintasdev.indihealth.com/pasien/Assesment?id_jadwal_konsultasi=' . $id_jadwal_konsultasi;
            // }

            $konsultasi = $this->db->query('SELECT p.name as nama_pasien, p.email as email_pasien FROM jadwal_konsultasi INNER JOIN master_user p ON jadwal_konsultasi.id_pasien = p.id WHERE jadwal_konsultasi.id = ' . $id_jadwal_konsultasi)->row();
            $now = (new DateTime('now'))->format('Y-m-d H:i:s');
            $pasien_reg = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $id_pasien)->row();

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
            $user = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $id_pasien)->row();
            $this->key->_send_fcm($pasien_reg->reg_id, $msg_notif);

            $dokter_reg = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $dokter->id)->row();

            $notifikasi_2 = 'Jadwal Telekonsultasi dengan pasien ' . $konsultasi->nama_pasien . ' telah dibuat [' . $tanggal . ' ' . $jam . ']';

            $now_2 = (new DateTime('now'))->format('Y-m-d H:i:s');

            $data_notif_2 = array("id_user" => $dokter->id, "notifikasi" => $notifikasi_2, "tanggal" => $now_2, "direct_link" => 'https://telemedicinelintasdev.indihealth.com/dokter/Teleconsultasi');
            $this->db->insert('data_notifikasi', $data_notif_2);
            $id_notif = $this->db->insert_id();

            $msg_notif_2 = array(
                'name' => 'vp',
                'id_notif' => $id_notif,
                'keterangan' => $notifikasi_2,
                'tanggal' => $now_2,
                'id_user' => json_encode(array($dokter->id)),
                'direct_link' => 'https://telemedicinelintasdev.indihealth.com/dokter/Teleconsultasi',
            );
            $msg_notif_2 = json_encode($msg_notif_2);
            $user = $this->db->query('SELECT reg_id FROM master_user WHERE id = ' . $id_pasien)->row();
            $this->key->_send_fcm($dokter_reg->reg_id, $msg_notif_2);

            $save1 = $this->all_model->update('data_registrasi', $data1, array('id' => $id_registrasi));
            $data2['id_pasien'] = $id_pasien;
            $data2['id_dokter'] = $id_dokter;

            if ($save1) {
                $hasil = $this->db->query('SELECT id FROM no_antrian WHERE id_jadwal = ' . $jadwal->id);
                if (empty($hasil->result())) {
                    $data2['created_at'] = date('Y-m-d');
                    $data2['antrian'] = 1;
                    $data2['id_jadwal'] = $jadwal->id;
                    $data2['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

                    $this->all_model->insert('no_antrian', $data2);
                } else {

                    $data2['antrian'] = $hasil->num_rows() + 1;
                    $data2['created_at'] = date('Y-m-d');
                    $data2['id_jadwal'] = $jadwal->id;
                    $data2['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

                    $this->all_model->insert('no_antrian', $data2);
                }

                $detail_pasien = $this->db->query('SELECT id FROM detail_pasien WHERE id_pasien = ' . $this->session->userdata('id_user'))->row();

                $last_medrek = $this->db->query('SELECT no_medrec FROM detail_pasien ORDER BY no_medrec DESC')->row();
                $last_medrek = ltrim($last_medrek->no_medrec, "0");
                $last_medrek += 1;
                $no_medrek = str_pad($last_medrek, 8, "0", STR_PAD_LEFT);

                if (!$detail_pasien) {

                    $data_detail_pasien = array(
                        'id_pasien' => $this->session->userdata('id_user'),
                        'no_medrec' => $no_medrek,
                    );

                    $this->db->insert('detail_pasien', $data_detail_pasien);
                } else {
                    $this->all_model->update('detail_pasien', array('no_medrec' => $no_medrek), array('id_pasien' => $this->session->userdata('id_user')));
                }

                $response = array('status' => $save1, 'msg' => 'Pembayaran terverifikasi');

                // // ------------------------- SEND EMAIL ------------------------------//
                // $data_message['nama_pasien'] = $konsultasi->nama_pasien;
                // $data_message['nama_dokter'] = $dokter->name;
                // $data_message['konsultasi_detail'] = $notifikasi;
                // $data_message['claim_number'] = $claim_number;
                // $data_message['logo'] = "https://telemedicinelintasdev.indihealth.com/assets/telemedicine/img/logo.png";
                // // Set to, from, message, etc.
                // $message = $this->load->view('pasien/payment_owlexa_email',$data_message, TRUE);

                // $data = array(
                //     'mail'      => $konsultasi->email_pasien,
                //     'pesan' => $message,
                //     'subjek' => 'Pembayaran Telah Diverifikasi'
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
                $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
                redirect(base_url('pasien/JadwalTerdaftar'));
            } else {
                $response = array('status' => $save1, 'msg' => 'Pembayaran tidak terverifikasi');
                $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
                //redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true&alamat_kustom='.$alamat_kustom.'&alamat='.$alamat_pengiriman_obat.'#metode-pembayaran'));
                redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran'));
            }
        } else {
            $response['msg'] = 'GAGAL: ' . $result['message'];
            $this->session->set_flashdata('msg_pmbyrn', $response['msg']);
            //redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true&alamat_kustom='.$alamat_kustom.'&alamat='.$alamat_pengiriman_obat.'#metode-pembayaran'));
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi . '&owlexa=true#metode-pembayaran'));
        }
    }

    public function bayar_va()
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

        $post_data = $this->input->post();
        $bank_id = isset($post_data['bank_id']) ? $post_data['bank_id'] : (isset($post_data['platform']) ? $post_data['platform'] : 6);
        $alamat_kustom = 1;
        $alamat_provinsi = $post_data['alamat_provinsi'];
        $alamat_kota = $post_data['alamat_kota'];
        $alamat_kecamatan = $post_data['alamat_kecamatan'];
        $alamat_kelurahan = $post_data['alamat_kelurahan'];
        $kode_pos = $post_data['kode_pos'];
        $alamat_detail = $post_data['alamat_detail'];
        $id_registrasi = $post_data['id_registrasi'];
        if (!$id_registrasi) {
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: ID Registrasi tidak dicantumkan!');
            redirect(base_url('pasien/JadwalTerdaftar'));
        }
        if (!$bank_id || !$alamat_provinsi || !$alamat_kota || !$alamat_kecamatan || !$alamat_kelurahan || !$kode_pos || !$alamat_detail) {
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        }

        // $alamat_provinsi = $this->db->query('SELECT name FROM master_provinsi WHERE id = '.$post_data['alamat_provinsi'])->row()->name;
        // $alamat_kota = $this->db->query('SELECT name FROM master_kota WHERE id = '.$post_data['alamat_kota'])->row()->name;
        // $alamat_kecamatan = $this->db->query('SELECT name FROM master_kecamatan WHERE id = '.$post_data['alamat_kecamatan'])->row()->name;
        // $alamat_kelurahan = $this->db->query('SELECT name FROM master_kelurahan WHERE id = '.$post_data['alamat_kelurahan'])->row()->name;
        // if(!$alamat_provinsi || !$alamat_kota || !$alamat_kecamatan || !$alamat_kelurahan){
        //     $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Data Tidak Lengkap!');
        //     redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        // }
        // $alamat_pengiriman_obat = $alamat_detail.', KELURAHAN '.$alamat_kelurahan.', KECAMATAN '.$alamat_kecamatan.', '.$alamat_kota.', '.$alamat_provinsi.' '.$kode_pos;


        $data_registrasi = $this->db->query('SELECT data_registrasi.id_status_pembayaran, jadwal_dokter.id_dokter, bukti_pembayaran.va_number, bukti_pembayaran.id_payment, bukti_pembayaran.status FROM data_registrasi LEFT JOIN bukti_pembayaran ON data_registrasi.id = bukti_pembayaran.id_registrasi INNER JOIN jadwal_dokter ON data_registrasi.id_jadwal = jadwal_dokter.id WHERE data_registrasi.id = "' . $id_registrasi . '" AND data_registrasi.id_pasien = ' . $this->session->userdata('id_user'))->row();
        if (!$data_registrasi) {
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Data Registrasi tidak ada');
            // exit();
            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        }
        if ($data_registrasi->va_number && $data_registrasi->status == 0) {
            $this->session->set_flashdata('msg_pmbyrn', 'GAGAL: Anda tinggal membayar ke rekening yang sudah disediakan!');

            redirect(base_url('pasien/Pembayaran/transfer_va/' . $id_registrasi . '/' . $data_registrasi->id_payment));
        }
        $pasien = $this->db->query('SELECT name, email,telp FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if (!$pasien) {
            show_404();
        }

        $no_hp = isset($post_data['no_hp']) ? ($post_data['no_hp'] ? $post_data['no_hp'] : $pasien->telp) : $pasien->telp;

        $dataRaw = array(
            'paymentId' => $bank_id,
            'idRegistrasi' => $id_registrasi,
            'name' => $pasien->name,
            'email' => $pasien->email,
            'phone' => $no_hp,
            'id_pasien' => $this->session->userdata('id_user'),
            'id_dokter' => $data_registrasi->id_dokter,
            'alamat_provinsi' => $alamat_provinsi,
            'alamat_kota' => $alamat_kota,
            'alamat_kecamatan' => $alamat_kecamatan,
            'alamat_kelurahan' => $alamat_kelurahan,
            'kode_pos' => $kode_pos,
            'alamat' => $alamat_detail,
            'alamat_kustom' => $alamat_kustom
        );
        // var_dump($dataRaw);
        // die;
        // $dataRaw = json_encode($dataRaw);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config->item('path_to_api').'arthajasa/api/purchaseTelekonsul',
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
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        curl_close($curl);

        if ($result->status) {
            $this->session->set_flashdata('msg_pmbyrn', $result->msg);

            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        } else {
            $this->session->set_flashdata('msg_pmbyrn', $result->msg);

            redirect(base_url('pasien/Pembayaran/?regid=' . $id_registrasi));
        }
    }

    public function generate_otp()
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

        $id_user = $this->session->userdata('id_user');
        $pasien = $this->db->query('SELECT name,email, lahir_tanggal FROM master_user WHERE id = ' . $id_user)->row();
        $data = $this->input->post();

        $cardNumber = $data['cardNumber'];
        // $fullName = 'OWLEXA TESTING CARD 3566'; //$pasien->name;
        // $birthDate = '1991-05-01'; //$pasien->lahir_tanggal;
        $fullName = $data['fullName']; //$pasien->name;
        $birthDate = $pasien->lahir_tanggal;
        $email = $pasien->email;

        $dataRaw = array(
            "birthDate" => $birthDate,
            "cardNumber" => $cardNumber,
            "fullName" => $fullName,
            "email" => $email,
            "providerCode" => 3495
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config->item('path_to_api')."owlexa/Api/generateOtp",
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
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        // echo var_dump($error_msg);
        // die;
        $result = json_decode($result, true);

        curl_close($curl);

        $response['data'] = $result['data'];
        if ($result['code'] == 200) {
            echo $result['msg'];
        } else {
            echo $result['msg'];
        }
    }

    public function get_toc()
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

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://test.owlexa.com/owlexa-api/telemedicine/v1/term-condition",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Api-Key: VO6v8Id9eqEchgogLE1nDVFopJdnXxk9K/ZEm7xqX5I=",
                "Content-Type: application/json"
            ),
        ));

        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        // echo var_dump($error_msg);
        // die;
        $result = json_decode($result, true);

        curl_close($curl);

        $response = $result;
        echo json_encode($response);
    }

    public function history()
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
        $data['list_pembayaran'] = $this->db->query('SELECT bp.id as id, bp.created_at, bp.photo as foto, bp.status as status, bp.id_payment, bp.metode_pembayaran as metode_pembayaran, bp.claim_number as claim_number, bp.va_number as va_number, d.name as nama_dokter, p.name as nama_pasien, bp.biaya_adm, bp.biaya_konsultasi FROM bukti_pembayaran bp LEFT JOIN master_user d ON bp.id_dokter = d.id INNER JOIN master_user p ON bp.id_pasien = p.id WHERE bp.id_pasien = ' . $this->session->userdata('id_user') . ' ORDER BY bp.created_at DESC')->result_array();

        $data['title'] = 'History Pembayaran';
        $data['view'] = 'pasien/history_pembayaran';
        $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                              <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                              <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                              <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                              <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                              <script>
                              $(function () {
                                var table_histori = $("#table_histori").DataTable({
                                  "responsive": true,
                                  "autoWidth": false,
                                  "pageLength": 5,
                                  "searching": true,
                                  "lengthChange": false,
                                  "paging": true
                                });
                                $("#table_histori_filter").remove();
                                $("#search").on("keyup", function(e){
                                    table_histori.search($(this).val()).draw();
                                });
                              });
                            </script>';
        $this->load->view('template', $data);
    }

    public function history_obat()
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
        $data['list_pembayaran'] = $this->db->query('SELECT bukti_pembayaran.tanggal_konsultasi, bukti_pembayaran.metode_pengambilan_obat, bpo.id as id, bpo.id_payment, bpo.metode_pembayaran, bpo.order_status, bpo.claim_number, bpo.created_at, bpo.foto as foto, bpo.status as status, bpo.va_number as va_number, d.name as nama_dokter, p.name as nama_pasien,GROUP_CONCAT("<li>",master_obat.name, " ( ", rd.jumlah_obat, " ",master_obat.unit ," )"," ( ", rd.keterangan, " )", "</li>"  SEPARATOR "") as detail_obat, GROUP_CONCAT(rd.harga SEPARATOR ",") as harga_obat, GROUP_CONCAT(rd.harga_per_n_unit SEPARATOR ",") as harga_obat_per_n_unit, GROUP_CONCAT(rd.jumlah_obat SEPARATOR ",") as jumlah_obat, rd.created_at as tanggal_resep, biaya_pengiriman_obat.biaya_pengiriman FROM bukti_pembayaran_obat bpo LEFT JOIN master_user d ON bpo.id_dokter = d.id INNER JOIN master_user p ON bpo.id_pasien = p.id INNER JOIN resep_dokter rd ON rd.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi INNER JOIN master_obat ON rd.id_obat = master_obat.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = rd.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = rd.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE bpo.id_pasien = ' . $this->session->userdata('id_user') . ' AND bukti_pembayaran.status = 1 GROUP BY rd.id_jadwal_konsultasi ORDER BY rd.created_at DESC')->result();
        // var_dump($this->db->error());

        $data['title'] = 'History Pembayaran Obat';
        $data['view'] = 'pasien/history_pembayaran_obat';
        $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                              <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                              <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                              <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                              <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                              <script>
                              $(function () {
                                var table_histori = $("#table_histori").DataTable({
                                    "responsive": false,
                                    "autoWidth": false,
                                    "pageLength": 5,
                                    "searching": true,
                                    "lengthChange": false,
                                    "paging": true
                                });
                                $("#table_histori_filter").remove();
                                $("#search").on("keyup", function(e){
                                    table_histori.search($(this).val()).draw();
                                });

                                $("#modalTrackingJNE").on("show.bs.modal",function(e){
                                    const no_resi = $(e.relatedTarget).data("resi");
                                    const token = $(e.relatedTarget).data("token");
                                    $.ajax({
                                        method: "GET",
                                        url: baseUrl+"pasien/jne/track/"+no_resi+"/"+token,
                                        success: function(data){
                                            if(data != "null"){
                                                data = JSON.parse(data);
                                                $(e.currentTarget).find(".status-text").html(data.status_text);
                                                $(e.currentTarget).find(".alamat-pengirim").html(data.pengirim.detail_tempat);
                                                $(e.currentTarget).find(".alamat-penerima").html(data.penerima.detail_tempat);

                                                $(e.currentTarget).find(".foto-kurir").attr("src", data.kurir.foto);
                                                $(e.currentTarget).find(".nama-kurir").html(data.kurir.nama);
                                                $(e.currentTarget).find(".nopol-kurir").html(data.kurir.plat);
                                                $(e.currentTarget).find(".nomor-kurir").html(data.kurir.telp);
                                            }else{
                                                $("#modalTrackingJNE").modal("hide");
                                            }
                                        },
                                        error: function(err){
                                            console.log("error")
                                        }
                                    });
                                });
                              });
                            </script>';
        $this->load->view('template', $data);
    }
}
