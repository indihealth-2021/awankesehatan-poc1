<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengambilanObat extends CI_Controller
{
    var $menu = 6;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('session');
        $this->load->library('all_controllers');
        $this->load->library('my_pagination');
    }

    public function index()
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Biaya Pengambilan Obat",
            $view = "admin/pengambilan_obat"
        );

        $user = $this->db->query("SELECT * FROM master_user WHERE master_user.id=" . $this->session->userdata("id_user"))->result_array()[0];

        $data['list_resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, biaya_pengiriman_obat.biaya_pengiriman, !(biaya_pengiriman_obat.alamat = '' OR biaya_pengiriman_obat.alamat IS NULL) AS dikirim,bukti_pembayaran.metode_pengambilan_obat, biaya_pengiriman_obat.tanggal_pengiriman IS NOT NULL as selesai, biaya_pengiriman_obat.alamat_kustom, biaya_pengiriman_obat.alamat as alamat_pengiriman, biaya_pengiriman_obat.harga_obat as harga_kustom, resep_dokter.id, resep_dokter.created_at, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, p.card_number as card_number , p.vip as pasien_is_vip, p.telp as telp_pasien, p.email as email_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, nominal.poli as nama_poli, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE resep_dokter.dibatalkan = 0 AND bukti_pembayaran.metode_pengambilan_obat = 2 AND resep_dokter.diverifikasi = 1 AND resep_dokter.id_apotek=" . $user['id_apotek'] . " GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY resep_dokter.created_at DESC;")->result();

        // Filter dikirim = 0, selesai = 1
        // for( $i = 0; $i < count($data["list_resep"]); $i ++ ) {
        //     if($data["list_resep"][$i]->dikirim == 1 || $data["list_resep"][$i]->selesai == 1) {
        //         unset($data["list_resep"][$i]);
        //     }
        // }

        // 2023/8/5 - Changed from id_reg to jadwal_konsultasi

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
        <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
        <script>

        $(function () {
            var table_pengiriman_obat = $("#table_obat").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
            $("#table_obat_filter").remove();
            $("#search").on("keyup", function(e){
              table_pengiriman_obat.search($(this).val()).draw();
            });

            $("#modalBiayaPengiriman").on("show.bs.modal", function (e) {
                var button = $(e.relatedTarget);
                var modal = $(e.currentTarget);

                modal.find("#biaya-pengiriman").val("");

                modal.find("#nama-pasien").val(button.data("nama-pasien"));
                modal.find("#telp").val(button.data("telp-pasien"));
                modal.find("#email-pasien").val(button.data("email-pasien"));

                modal.find("#alamat").val(button.data("alamat"));
                modal.find("#id_jadwal_konsultasi").val(button.data("id-jadwal-konsultasi"));
                modal.find("#biaya-pengiriman").val(button.data("biaya-pengiriman"));
                modal.find("#isAlamatLengkap").html(button.data("is-alamat-lengkap"));
                var biaya_pengiriman_rp = button.data("biaya-pengiriman-rp");
                biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
                modal.find("#biayaPengirimanHelp").html(biaya_pengiriman_rp);
                if(button.data("tipe") == "edit"){
                    $(".submit-form").hide();
                    $(".edit-form").show();
                    modal.find("#saveBiayaPengiriman").attr("type", "button");
                    modal.find("#biaya-pengiriman").removeAttr("readonly");

                    var is_alamat_kustom = button.data("is-alamat-kustom");
                    var alamat_kustom = button.data("alamat-kustom");
                    var alamat = button.data("alamat");

                    $("#alamat").prop("required",true);

                    // if(is_alamat_kustom == 1){
                    //     modal.find("textarea[name=alamat]").prop("readonly",false);
                    //     modal.find("textarea[name=alamat]").val(button.data("alamat-kustom"));
                    //     modal.find("input[name=alamat_kustom][value=1]").prop("checked",true);
                    //     modal.find("#isAlamatLengkap").html("");
                    // }
                    // else{
                    //     modal.find("textarea[name=alamat]").val(button.data("alamat"));
                    //     modal.find("textarea[name=alamat]").prop("readonly",true);

                    //     modal.find("input[name=alamat_kustom][value=0]").prop("checked",true);

                    //     modal.find("#isAlamatLengkap").html(button.data("is-alamat-lengkap"));
                    // }

                    $("#saveBiayaPengiriman").html("Simpan");
                    $("#saveBiayaPengiriman").off("click");
                    $("#saveBiayaPengiriman").click(function(e){
                    if(modal.find("input[name=alamat]").val()){
                    $.ajax({
                    method : "POST",
                    url    : ' . base_url() . '+"admin/PengirimanObat/submit_biaya_pengiriman",
                    data   : {
                    biaya_pengiriman:modal.find("#biaya-pengiriman").val(),
                    id_jadwal_konsultasi:modal.find("#id_jadwal_konsultasi").val(),
                    alamat_kustom:modal.find("input[name=alamat_kustom]:checked").val(),
                    alamat:$("#alamat-inputan").val(),
                    _csrf:modal.find("input[name=_csrf]").val()},
                    success : function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data.status == "OK"){
                        var biaya_pengiriman_rp = formatRupiah(modal.find("#biaya-pengiriman").val(), "Rp. ");
                        biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
                        var total_harga = parseInt(modal.find("#biaya-pengiriman").val())+parseInt(button.parent().find(".btnSubmit").data("harga-obat"));
                        var total_harga_rp = formatRupiah(total_harga.toString(), "Rp. ");
                        total_harga_rp = total_harga_rp.replace(",00","");
                        document.getElementById("biaya-pengiriman-"+modal.find("#id_jadwal_konsultasi").val()).innerHTML = modal.find("#biayaPengirimanHelp").html()+",00";

                        button.parent().find(".btnSubmit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());
                        button.parent().find(".btnEdit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());

                        button.parent().find(".btnSubmit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);
                        button.parent().find(".btnEdit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);

                        button.parent().find(".btnSubmit").data("alamat", modal.find("#alamat").val());

                        if(modal.find("input[name=alamat_kustom]:checked").val() == 1){
                            button.parent().find(".btnEdit").data("alamat-kustom", modal.find("#alamat").val());
                            button.parent().find(".btnEdit").data("is-alamat-kustom", 1);
                        }
                        else{
                            button.parent().find(".btnEdit").data("is-alamat-kustom", 0);
                        }
                        button.parent().find(".btnSubmit").data("total-harga", total_harga);
                        button.parent().find(".btnSubmit").data("total-harga-rp", total_harga_rp);
                        modal.modal("hide");

                        if(data.jml_edit == 1){
                            alert("SUKSES: Data berhasil disimpan!");
                        }else{
                            alert("SUKSES: Data telah disimpan "+data.jml_edit+"x!");
                        }
                        }else{
                            alert("GAGAL: Pastikan data yang anda isi lengkap!");
                            console.log(data);
                        }
                            },error : function(data){
                                alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
                            }
                        });
                    }else{
                        alert(data.status);
                        console.log(data.status);
                        }
                    });

                    $("input[name=alamat_kustom]").change(function(e){
                        var val_alamat_kustom = $(this).val();

                        if(val_alamat_kustom == 1){
                            modal.find("textarea[name=alamat]").prop("readonly",false);
                            modal.find("textarea[name=alamat]").val(button.data("alamat-kustom"));
                            modal.find("#isAlamatLengkap").html("");

                            modal.find("input[name=alamat_kustom][value=1]").prop("checked",true);
                        }
                        else{
                            modal.find("textarea[name=alamat]").val(button.data("alamat"));
                            modal.find("textarea[name=alamat]").prop("readonly",true);

                            modal.find("#isAlamatLengkap").html(button.data("is-alamat-lengkap"));

                            modal.find("input[name=alamat_kustom][value=0]").prop("checked",true);
                        }
                    });
                }
                else{
                    $(".submit-form").show();
                    $(".edit-form").hide();

                    modal.find("#alamat").removeAttr("required");
                    modal.find("#biaya-pengiriman").removeAttr("required");

                    modal.find("#harga-obat").val(button.data("harga-obat"));
                    modal.find("#hargaObatHelp").html(button.data("harga-obat-rp"));

                    modal.find("#total-harga").val(button.data("total-harga"));
                    modal.find("#totalHargaHelp").html(button.data("total-harga-rp"));

                    modal.find("#alamat").attr("readonly","readonly");
                    modal.find("#biaya-pengiriman").attr("readonly","readonly");

                    $("#saveBiayaPengiriman").off("click");
                    $("#saveBiayaPengiriman").html("Submit");
                    $("#saveBiayaPengiriman").attr("type", "submit");
                }
            });
        });
                            </script>';
        $this->load->view('template', $data);
    }

    public function selesaikan($id_jadwal_konsultasi)
    {
        $res = $this->db->update("biaya_pengiriman_obat", [
            "tanggal_pengiriman" => (new DateTime())->format("Y-m-d H:i:s")
        ], ["id_jadwal_konsultasi" => $id_jadwal_konsultasi]);

        echo json_encode([
            "res" => $res,
            // "last_query" => $this->db->last_query(),
            // "error" => $this->db->error()
        ]);
    }

    public function history()
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Biaya Pengambilan Obat",
            $view = "admin/history_pengambilan_obat"
        );

        $user = $this->db->query("SELECT * FROM master_user WHERE master_user.id=" . $this->session->userdata("id_user"))->result_array()[0];
        $data['list_resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, biaya_pengiriman_obat.biaya_pengiriman, !(biaya_pengiriman_obat.alamat = '' OR biaya_pengiriman_obat.alamat IS NULL) AS dikirim, biaya_pengiriman_obat.tanggal_pengiriman IS NOT NULL as selesai, biaya_pengiriman_obat.alamat_kustom, biaya_pengiriman_obat.alamat as alamat_pengiriman, resep_dokter.id, resep_dokter.created_at, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, p.card_number as card_number , p.vip as pasien_is_vip, p.telp as telp_pasien, p.email as email_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, nominal.poli as nama_poli, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE resep_dokter.dibatalkan = 0 AND resep_dokter.dirilis = 0 AND resep_dokter.diverifikasi = 1 AND resep_dokter.id_apotek=" . $user["id_apotek"] . " GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY resep_dokter.created_at DESC")->result();

        // Filter dikirim = 0, selesai = 1
        for ($i = 0; $i < count($data["list_resep"]); $i++) {
            if ($data["list_resep"][$i]->dikirim == 1 || $data["list_resep"][$i]->selesai == 0) {
                unset($data["list_resep"][$i]);
            }
        }

        // 2023/8/5 - Changed from id_reg to jadwal_konsultasi

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
        <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
        <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
        <script>
        $(function () {
            var table_pengiriman_obat = $("#table_obat").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
            $("#table_obat_filter").remove();
            $("#search").on("keyup", function(e){
              table_pengiriman_obat.search($(this).val()).draw();
            });

            $("#modalBiayaPengiriman").on("show.bs.modal", function (e) {
                var button = $(e.relatedTarget);
                var modal = $(e.currentTarget);

                modal.find("#biaya-pengiriman").val("");

                modal.find("#nama-pasien").val(button.data("nama-pasien"));
                modal.find("#telp").val(button.data("telp-pasien"));
                modal.find("#email-pasien").val(button.data("email-pasien"));

                modal.find("#alamat").val(button.data("alamat"));
                modal.find("#id_jadwal_konsultasi").val(button.data("id-jadwal-konsultasi"));
                modal.find("#biaya-pengiriman").val(button.data("biaya-pengiriman"));
                modal.find("#isAlamatLengkap").html(button.data("is-alamat-lengkap"));
                var biaya_pengiriman_rp = button.data("biaya-pengiriman-rp");
                biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
                modal.find("#biayaPengirimanHelp").html(biaya_pengiriman_rp);
                if(button.data("tipe") == "edit"){
                    $(".submit-form").hide();
                    $(".edit-form").show();
                    modal.find("#saveBiayaPengiriman").attr("type", "button");
                    modal.find("#biaya-pengiriman").removeAttr("readonly");

                    var is_alamat_kustom = button.data("is-alamat-kustom");
                    var alamat_kustom = button.data("alamat-kustom");
                    var alamat = button.data("alamat");

                    $("#alamat").prop("required",true);

                    // if(is_alamat_kustom == 1){
                    //     modal.find("textarea[name=alamat]").prop("readonly",false);
                    //     modal.find("textarea[name=alamat]").val(button.data("alamat-kustom"));
                    //     modal.find("input[name=alamat_kustom][value=1]").prop("checked",true);
                    //     modal.find("#isAlamatLengkap").html("");
                    // }
                    // else{
                    //     modal.find("textarea[name=alamat]").val(button.data("alamat"));
                    //     modal.find("textarea[name=alamat]").prop("readonly",true);

                    //     modal.find("input[name=alamat_kustom][value=0]").prop("checked",true);

                    //     modal.find("#isAlamatLengkap").html(button.data("is-alamat-lengkap"));
                    // }

                    $("#saveBiayaPengiriman").html("Simpan");
$("#saveBiayaPengiriman").off("click");
$("#saveBiayaPengiriman").click(function(e){
if(modal.find("input[name=alamat]").val()){
$.ajax({
method : "POST",
url    : ' . base_url() . '+"admin/PengirimanObat/submit_biaya_pengiriman",
data   : {
biaya_pengiriman:modal.find("#biaya-pengiriman").val(),
id_jadwal_konsultasi:modal.find("#id_jadwal_konsultasi").val(),
alamat_kustom:modal.find("input[name=alamat_kustom]:checked").val(),
alamat:$("#alamat-inputan").val(),
_csrf:modal.find("input[name=_csrf]").val()},
success : function(data){
console.log(data);
data = JSON.parse(data);
if(data.status == "OK"){
    var biaya_pengiriman_rp = formatRupiah(modal.find("#biaya-pengiriman").val(), "Rp. ");
    biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
    var total_harga = parseInt(modal.find("#biaya-pengiriman").val())+parseInt(button.parent().find(".btnSubmit").data("harga-obat"));
    var total_harga_rp = formatRupiah(total_harga.toString(), "Rp. ");
    total_harga_rp = total_harga_rp.replace(",00","");
    document.getElementById("biaya-pengiriman-"+modal.find("#id_jadwal_konsultasi").val()).innerHTML = modal.find("#biayaPengirimanHelp").html()+",00";

    button.parent().find(".btnSubmit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());
    button.parent().find(".btnEdit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());

    button.parent().find(".btnSubmit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);
    button.parent().find(".btnEdit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);

    button.parent().find(".btnSubmit").data("alamat", modal.find("#alamat").val());

    if(modal.find("input[name=alamat_kustom]:checked").val() == 1){
        button.parent().find(".btnEdit").data("alamat-kustom", modal.find("#alamat").val());
        button.parent().find(".btnEdit").data("is-alamat-kustom", 1);
    }
    else{
        button.parent().find(".btnEdit").data("is-alamat-kustom", 0);
    }
    button.parent().find(".btnSubmit").data("total-harga", total_harga);
    button.parent().find(".btnSubmit").data("total-harga-rp", total_harga_rp);
    modal.modal("hide");

    if(data.jml_edit == 1){
        alert("SUKSES: Data berhasil disimpan!");
    }else{
        alert("SUKSES: Data telah disimpan "+data.jml_edit+"x!");
    }
    }else{
        alert("GAGAL: Pastikan data yang anda isi lengkap!");
        console.log(data);
    }
        },error : function(data){
            alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
        }
    });
}else{
    alert(data.status);
    console.log(data.status);
    }
});



                                            $("input[name=alamat_kustom]").change(function(e){
                                                var val_alamat_kustom = $(this).val();

                                                if(val_alamat_kustom == 1){
                                                    modal.find("textarea[name=alamat]").prop("readonly",false);
                                                    modal.find("textarea[name=alamat]").val(button.data("alamat-kustom"));
                                                    modal.find("#isAlamatLengkap").html("");

                                                    modal.find("input[name=alamat_kustom][value=1]").prop("checked",true);
                                                }
                                                else{
                                                    modal.find("textarea[name=alamat]").val(button.data("alamat"));
                                                    modal.find("textarea[name=alamat]").prop("readonly",true);

                                                    modal.find("#isAlamatLengkap").html(button.data("is-alamat-lengkap"));

                                                    modal.find("input[name=alamat_kustom][value=0]").prop("checked",true);
                                                }
                                            });
                                        }
                                        else{
                                            $(".submit-form").show();
                                            $(".edit-form").hide();

                                            modal.find("#alamat").removeAttr("required");
                                            modal.find("#biaya-pengiriman").removeAttr("required");

                                            modal.find("#harga-obat").val(button.data("harga-obat"));
                                            modal.find("#hargaObatHelp").html(button.data("harga-obat-rp"));

                                            modal.find("#total-harga").val(button.data("total-harga"));
                                            modal.find("#totalHargaHelp").html(button.data("total-harga-rp"));

                                            modal.find("#alamat").attr("readonly","readonly");
                                            modal.find("#biaya-pengiriman").attr("readonly","readonly");

                                            $("#saveBiayaPengiriman").off("click");
                                            $("#saveBiayaPengiriman").html("Submit");
                                            $("#saveBiayaPengiriman").attr("type", "submit");
                                        }
                                    });
                                });
                            </script>';
        $this->load->view('template', $data);
    }

    public function submit_biaya_pengiriman($id_jadwal_konsultasi)
    {
        $this->all_controllers->check_user_farmasi();

        if ($this->input->post('id_registrasi')) {
            $id_registrasi = $this->input->post('id_registrasi');
        } else {
            $id_registrasi = $this->db->query('SELECT id_registrasi FROM diagnosis_dokter WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        }

        // $id_registrasi = $id_registrasi ?
        //     $id_registrasi : $diagnosis_dokter->id_registrasi;
        $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $alamat = $this->input->post('alamat');

        if (!$id_jadwal_konsultasi || $biaya_pengiriman == null || !$alamat) {
            echo json_encode(
                [$id_jadwal_konsultasi, $biaya_pengiriman, $alamat]
            );
            die;
        }

        $data_biaya_pengiriman = array(
            'id_registrasi' => $id_registrasi,
            'id_jadwal_konsultasi' => $id_jadwal_konsultasi,
            'biaya_pengiriman' => $biaya_pengiriman,
            'alamat' => $alamat
        );

        $id_registrasi = gettype($id_registrasi) == "object" ? $id_registrasi->id_registrasi : $id_registrasi;

        $biaya_pengiriman_isExists = $this->db->query("SELECT id, jumlah_edit,alamat FROM biaya_pengiriman_obat WHERE id_registrasi = '" . $id_registrasi . "'")->row();
        $jml_edit = $biaya_pengiriman_isExists->jumlah_edit + 1;
        $alamat_kustom = $alamat != $biaya_pengiriman_isExists->alamat ? 1 : 0;
        $this->all_model->update('biaya_pengiriman_obat', array('id_jadwal_konsultasi' => $id_jadwal_konsultasi, 'biaya_pengiriman' => $biaya_pengiriman, 'alamat' => $alamat, 'alamat_kustom' => $alamat_kustom, 'jumlah_edit' => $jml_edit), array('id' => $biaya_pengiriman_isExists->id));

        // echo json_encode(array('status'=>'OK', 'jml_edit'=>$jml_edit));
        $this->session->set_flashdata('msg_biaya_pengiriman', 'SUKSES: Resep Obat telah disimpan');
        redirect(base_url('admin/PengirimanObat'));
    }
}
