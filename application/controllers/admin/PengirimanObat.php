<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengirimanObat extends CI_Controller {
	var $menu = 6;

	public function __construct() {
        parent::__construct();
		$this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('session');
        $this->load->library('all_controllers');
        $this->load->library('my_pagination');
    }

    public function submit_biaya_pengiriman2($id_jadwal_konsultasi){
		$this->all_controllers->check_user_farmasi();

        // $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');
        $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $alamat = $this->input->post('alamat');
        $alamat_kustom = $this->input->post('alamat_kustom');

        if(!$id_jadwal_konsultasi || !$biaya_pengiriman || !$alamat){
            $this->session->set_flashdata('msg_biaya_pengiriman', $id_jadwal_konsultasi.",".$biaya_pengiriman.",".$alamat);
            redirect(base_url('admin/PengirimanObat'));
        }

        $data_biaya_pengiriman = array(
            'id_jadwal_konsultasi'=>$id_jadwal_konsultasi,
            'biaya_pengiriman'=>$biaya_pengiriman,
            'alamat_kustom'=>$alamat_kustom,
            'alamat'=>$alamat
        );

        $biaya_pengiriman_isExists = $this->db->query("SELECT id FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = ".$id_jadwal_konsultasi)->row();
        if(!$biaya_pengiriman_isExists){
            $this->db->insert('biaya_pengiriman_obat', $data_biaya_pengiriman);
        }
        else{
            $this->all_model->update('biaya_pengiriman_obat', array('biaya_pengiriman'=>$biaya_pengiriman, 'alamat_kustom'=>$alamat_kustom, 'alamat'=>$alamat), array('id'=>$biaya_pengiriman_isExists->id));
        }

        $biaya_pengiriman = $this->db->query('SELECT id,biaya_pengiriman FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = '.$id_jadwal_konsultasi)->row();

        // if(!$biaya_pengiriman){
        //     $this->db->insert('biaya_pengiriman_obat', array('biaya_pengiriman'=>0, 'id_jadwal_konsultasi'=>$id_jadwal_konsultasi));
        // }

        $this->session->set_flashdata('msg_biaya_pengiriman', 'SUKSES: Resep Obat telah disimpan');
        redirect(base_url('admin/PengirimanObat'));
    }

    public function index(){
		$this->all_controllers->check_user_farmasi();
		$data = $this->all_controllers->get_data_view(
			$title = "Biaya Pengiriman Obat",
			$view = "admin/pengiriman_obat"
        );

        $user = $this->db->query("SELECT * FROM master_user WHERE master_user.id=".$this->session->userdata("id_user"))->result_array()[0];
        $data['list_resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.alamat_kustom, biaya_pengiriman_obat.alamat as alamat_pengiriman, resep_dokter.id, resep_dokter.created_at, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, p.name as nama_pasien, p.vip as pasien_is_vip, p.telp as telp_pasien, p.email as email_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, nominal.poli as nama_poli, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(resep_dokter.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(resep_dokter.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE resep_dokter.dibatalkan = 0 AND resep_dokter.dirilis = 0 AND resep_dokter.diverifikasi = 1 AND resep_dokter.diverifikasi_user=1 AND resep_dokter.id_apotek=".$user["id_apotek"]." GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY resep_dokter.created_at DESC")->result();
        // 2023/8/5 - Changed from id_reg to jadwal_konsultasi

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
        <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
        <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
        <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
        <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
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
url    : '.base_url().'+"admin/PengirimanObat/submit_biaya_pengiriman",
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

    public function history_pengiriman_obat(){
		$this->all_controllers->check_user_farmasi();
		$data = $this->all_controllers->get_data_view(
			$title = "Riwayat Pengiriman Obat",
			$view = "admin/history_pengiriman_obat"
        );
        $nama_pasien = isset($_GET['nama_pasien']) ? $_GET['nama_pasien']:null;
        $where = $nama_pasien ? ' AND p.name LIKE "%'.$nama_pasien.'%"':'';

        $count_rows = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, bpo.order_status, resep_dokter.id, resep_dokter.created_at, bpo.foto as foto_bukti, bpo.status as status_bukti, bpo.created_at as tanggal_pembayaran, bpo.id as id_bukti, bpo.claim_number, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, nominal.poli as nama_poli, p.name as nama_pasien, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.tanggal_pengiriman, biaya_pengiriman_obat.alamat, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE bpo.status != 0 AND bpo.order_status = 1 AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1".$where." GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY biaya_pengiriman_obat.tanggal_pengiriman DESC")->result();
        $count_rows = count($count_rows);

        $config = $this->my_pagination->paginate(5, 4, $count_rows, base_url('admin/PengirimanObat/history_pengiriman_obat'));

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['uri_segment'] = $this->uri->segment(4);
        $limit = ' LIMIT '.$config['per_page'].' OFFSET '.$data['page'];

        $data['list_resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, bpo.order_status, resep_dokter.id, resep_dokter.created_at, bpo.foto as foto_bukti, bpo.status as status_bukti, bpo.created_at as tanggal_pembayaran, bpo.id as id_bukti, bpo.claim_number, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, nominal.poli as nama_poli, p.name as nama_pasien, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.tanggal_pengiriman, biaya_pengiriman_obat.alamat, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE bpo.status != 0 AND bpo.order_status = 1 AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1".$where." GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY biaya_pengiriman_obat.tanggal_pengiriman DESC".$limit)->result();
        $data['pagination'] = $this->pagination->create_links();

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(function () {
                                    $("#table_obat").DataTable({
                                        "paging": true,
                                        "lengthChange": true,
                                        "searching": true,
                                        "ordering": true,
                                        "info": true,
                                        "autoWidth": true,
                                        "responsive": true,
                                    });
                                    $("#search").keypress(function(e){
                                        if(e.keyCode === 13){
                                            $("#searchForm").submit();
                                        }
                                    });
                                    $("#searchButton").click(function(){
                                        $("#searchForm").submit();
                                    });
                            ';
        $this->load->view('template', $data);
    }

    public function submit_biaya_pengiriman($id_jadwal_konsultasi){
        $this->all_controllers->check_user_farmasi();

        if ($this->input->post('id_registrasi')){
            $id_registrasi = $this->input->post('id_registrasi');
        } else {
            $id_registrasi = $this->db->query('SELECT id_registrasi FROM diagnosis_dokter WHERE id_jadwal_konsultasi = '.$id_jadwal_konsultasi)->row();
        }

        // $id_registrasi = $id_registrasi ?
        //     $id_registrasi : $diagnosis_dokter->id_registrasi;
        $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $alamat = $this->input->post('alamat');

        if(!$id_jadwal_konsultasi || $biaya_pengiriman == null || !$alamat){
            echo json_encode(
                [$id_jadwal_konsultasi, $biaya_pengiriman, $alamat]
            );
            die;
        }

        $data_biaya_pengiriman = array(
            'id_registrasi'=>$id_registrasi,
            'id_jadwal_konsultasi'=>$id_jadwal_konsultasi,
            'biaya_pengiriman'=>$biaya_pengiriman,
            'alamat'=>$alamat
        );

        $id_registrasi = gettype($id_registrasi) == "object" ? $id_registrasi->id_registrasi : $id_registrasi;

        $biaya_pengiriman_isExists = $this->db->query("SELECT id, jumlah_edit,alamat FROM biaya_pengiriman_obat WHERE id_registrasi = '".$id_registrasi."'")->row();
        if($biaya_pengiriman_isExists != null){
            $this->db->insert('biaya_pengiriman_obat', $data_biaya_pengiriman);
            $jml_edit = 1;
        }
        else{
            $jml_edit = $biaya_pengiriman_isExists->jumlah_edit+1;
            $alamat_kustom = $alamat != $biaya_pengiriman_isExists->alamat ? 1:0;
            $this->all_model->update('biaya_pengiriman_obat', array('id_jadwal_konsultasi'=>$id_jadwal_konsultasi, 'biaya_pengiriman'=>$biaya_pengiriman, 'alamat'=>$alamat, 'alamat_kustom'=>$alamat_kustom, 'jumlah_edit'=>$biaya_pengiriman_isExists->jumlah_edit+1), array('id'=>$biaya_pengiriman_isExists->id));
        }

        // echo json_encode(array('status'=>'OK', 'jml_edit'=>$jml_edit));
        $this->session->set_flashdata('msg_biaya_pengiriman', 'SUKSES: Resep Obat telah disimpan');
        redirect(base_url('admin/PengirimanObat'));
    }

    public function rilis_obat($id_jadwal_konsultasi){
		$this->all_controllers->check_user_farmasi();

        // $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');
        $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $alamat = $this->input->post('alamat');
        $alamat_kustom = $this->input->post('alamat_kustom');

        if(!$id_jadwal_konsultasi || !$biaya_pengiriman || !$alamat){
            $this->session->set_flashdata('msg_biaya_pengiriman', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('admin/PengirimanObat'));
        }

        $data_biaya_pengiriman = array(
            'id_jadwal_konsultasi'=>$id_jadwal_konsultasi,
            'biaya_pengiriman'=>$biaya_pengiriman,
            'alamat_kustom'=>$alamat_kustom,
            'alamat'=>$alamat
        );

        $biaya_pengiriman_isExists = $this->db->query("SELECT id FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = ".$id_jadwal_konsultasi)->row();
        if(!$biaya_pengiriman_isExists){
            $this->db->insert('biaya_pengiriman_obat', $data_biaya_pengiriman);
        }
        else{
            $this->all_model->update('biaya_pengiriman_obat', array('biaya_pengiriman'=>$biaya_pengiriman, 'alamat_kustom'=>$alamat_kustom, 'alamat'=>$alamat), array('id'=>$biaya_pengiriman_isExists->id));
        }

        $biaya_pengiriman = $this->db->query('SELECT id,biaya_pengiriman FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = '.$id_jadwal_konsultasi)->row();
        if(!$biaya_pengiriman){
            $this->db->insert('biaya_pengiriman_obat', array('biaya_pengiriman'=>0, 'id_jadwal_konsultasi'=>$id_jadwal_konsultasi));
        }
        // $data_biaya_pengiriman = array(
        //     'id_jadwal_konsultasi'=>$id_jadwal_konsultasi,
        //     'biaya_pengiriman'=>$biaya_pengiriman
        // );
        // $biaya_pengiriman_isExists = $this->db->query("SELECT id FROM biaya_pengiriman_obat WHERE id_jadwal_konsultasi = ".$id_jadwal_konsultasi)->row();
        // if(!$biaya_pengiriman_isExists){
        //     $this->db->insert('biaya_pengiriman_obat', $data_biaya_pengiriman);
        // }
        // else{

        // }

        $list_resep = $this->db->query('SELECT resep_dokter.id,resep_dokter.id_pasien,resep_dokter.jumlah_obat FROM resep_dokter WHERE id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' AND diverifikasi = 1')->result();
        foreach($list_resep as $resep){
            $this->all_model->update('resep_dokter', array('dirilis'=>1), array('id'=>$resep->id));
        }

        // $list_resep_2 = $this->db->query("SELECT resep_dokter.id, resep_dokter.created_at, bpo.status as status_bukti, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter,GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id LEFT JOIN bukti_pembayaran_obat bpo ON bpo.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id WHERE resep_dokter.id_pasien = ".$this->session->userdata('id_user')." AND resep_dokter.dibatalkan = 0 AND resep_dokter.dirilis = 1 AND resep_dokter.diverifikasi = 1 GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY resep_dokter.created_at DESC")->result();
        // foreach($list_resep_2 as $resep){
        //     $list_harga_obat = explode(',', $resep->harga_obat);
        //     $list_harga_obat_per_n_unit = explode(',', $resep->harga_obat_per_n_unit);
        //     $list_jumlah_obat = explode(',', $resep->jumlah_obat);
        //     $jml_data = count($list_harga_obat);
        //     $list_total_harga = [];
        //     $total_harga = 0;
        //     for($i=0; $i<$jml_data; $i++){
        //         $list_total_harga[$i] = ( $list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i] ) * $list_harga_obat[$i];
        //     }

        //     foreach($list_total_harga as $tot_harga){
        //         $total_harga+=$tot_harga;
        //     }
        // }


        $pasien = $this->db->query('SELECT id,email,name,reg_id FROM master_user WHERE id = '.$list_resep[0]->id_pasien)->row();
        $verifier = $this->db->query('SELECT name FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();

        // $notifikasi = 'Resep Obat anda telah dirilis! dengan total harga Rp. '.number_format($total_harga,2,',','.');
        $notifikasi = 'Salah satu Resep Obat anda telah dirilis dan sedang disiapkan!';
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');

        $data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/ResepDokter'));
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();

        $msg_notif = array(
            'name'=>'universal',
            'judul'=>'Resep Obat',
            'id_notif'=>$id_notif,
            'keterangan'=>$notifikasi,
            'tanggal'=>$now,
            'id_user'=>json_encode(array($pasien->id)),
            'direct_link'=>base_url('pasien/ResepDokter'),
        );
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($pasien->reg_id, $msg_notif);

        // //----------------------------------- SEND EMAIL -----------------------------------//
        // $data_message['nama_pasien'] = $pasien->name;
        // $data_message['harga_semua_obat'] = $total_harga;
        // $data_message['biaya_pengiriman'] = $biaya_pengiriman;
        // $data_message['total_harga'] = $total_harga+$biaya_pengiriman;
        // $data_message['nama_admin'] = $verifier->name;
        // $data_message['logo'] = "https://telemedicinelintasdemo2.indihealth.com/assets/telemedicine/img/logo.png";
        // // Set to, from, message, etc.
        // $message = $this->load->view('admin/rilis_obat_email',$data_message, TRUE);

        // $data = array(
        //     'mail'      => $pasien->email,
        //     'pesan' => $message,
        //     'subjek' => 'Pembayaran Tidak Valid'
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

        $this->session->set_flashdata('msg_biaya_pengiriman', 'SUKSES: Resep Obat telah dirilis!');
        redirect(base_url('admin/PengirimanObat'));
    }

    public function status_resep(){
		$this->all_controllers->check_user_farmasi();
		$data = $this->all_controllers->get_data_view(
			$title = "Pengiriman Obat",
			$view = "admin/manage_status_pengiriman_obat"
        );

        $data['list_resep'] = $this->db->query("SELECT bukti_pembayaran.tanggal_konsultasi, resep_dokter.id, resep_dokter.created_at, bpo.foto as foto_bukti, bpo.status as status_bukti, bpo.created_at as tanggal_pembayaran, bpo.id as id_bukti, bpo.claim_number, resep_dokter.id_jadwal_konsultasi, d.name as nama_dokter, nominal.poli as nama_poli, p.name as nama_pasien, biaya_pengiriman_obat.biaya_pengiriman, biaya_pengiriman_obat.alamat, GROUP_CONCAT('<li>',master_obat.name, ' ( ', resep_dokter.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', resep_dokter.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(master_obat.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(master_obat.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(resep_dokter.jumlah_obat SEPARATOR ',') as jumlah_obat FROM (resep_dokter) INNER JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user d ON resep_dokter.id_dokter = d.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = d.id INNER JOIN nominal ON nominal.id = detail_dokter.id_poli INNER JOIN master_user p ON resep_dokter.id_pasien = p.id INNER JOIN bukti_pembayaran_obat bpo ON resep_dokter.id_jadwal_konsultasi = bpo.id_jadwal_konsultasi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id INNER JOIN biaya_pengiriman_obat ON biaya_pengiriman_obat.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN diagnosis_dokter ON diagnosis_dokter.id_jadwal_konsultasi = resep_dokter.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE bpo.status = 1 AND bpo.order_status = 0 AND resep_dokter.diverifikasi = 1 AND resep_dokter.dirilis = 1 GROUP BY resep_dokter.id_jadwal_konsultasi ORDER BY bpo.updated_at DESC, resep_dokter.created_at DESC")->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function(){
                                    var table_status_resep = $("#table_obat").DataTable({
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
                                      table_status_resep.search($(this).val()).draw();
                                    });

                                    $("#modalPengiriman").on("show.bs.modal", function (e) {
                                        var button = $(e.relatedTarget);
                                        var modal = $(e.currentTarget);

                                        modal.find("#link-delete").attr("href", button.data("link"));
                                    });
                                });
                                </script>

                            ';
        $this->load->view('template', $data);
    }

    public function kirim_obat($id){
		$this->all_controllers->check_user_farmasi();

        $bukti_pembayaran_obat = $this->db->query('SELECT id, id_pasien,id_jadwal_konsultasi FROM bukti_pembayaran_obat WHERE id = '.$id)->row();
        if(!$bukti_pembayaran_obat){
            show_404();
        }
        $this->all_model->update('bukti_pembayaran_obat', array('order_status'=>1), array('id'=>$id));

        $this->all_model->update('biaya_pengiriman_obat', array('tanggal_pengiriman'=>(new DateTime('now'))->format('Y-m-d H:i:s')), array('id_jadwal_konsultasi'=>$bukti_pembayaran_obat->id_jadwal_konsultasi));

        //SEND NOTIF=============

        $pasien = $this->db->query('SELECT id,email,name,reg_id FROM master_user WHERE id = '.$bukti_pembayaran_obat->id_pasien)->row();
        $verifier = $this->db->query('SELECT name FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();

        // $notifikasi = 'Resep Obat anda telah dirilis! dengan total harga Rp. '.number_format($total_harga,2,',','.');
        $notifikasi = 'Salah satu Resep Obat anda telah dikirim ke alamat yang telah ditentukan!';
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');

        $data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/Pembayaran/history_obat'));
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();

        $msg_notif = array(
            'name'=>'vp',
            'id_notif'=>$id_notif,
            'keterangan'=>$notifikasi,
            'tanggal'=>$now,
            'id_user'=>json_encode(array($pasien->id)),
            'direct_link'=>base_url('pasien/Pembayaran/history_obat'),
        );
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($pasien->reg_id, $msg_notif);
        //==================

        $this->session->set_flashdata('msg_kirim_obat', 'SUKSES: Resep obat telah dikirim!');
        redirect(base_url('admin/PengirimanObat/status_resep'));
    }
}
