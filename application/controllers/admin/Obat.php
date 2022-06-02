<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('session');
        $this->load->library('all_controllers');
    }

    // public function index()
    // {
    //     echo "Halo";
	// 	// $this->all_controllers->check_user_admin();
	// 	// $data = $this->all_controllers->get_data_view(
	// 	// 	$title = "Manage Obat",
	// 	// 	$view = "admin/menu_obat"
    //     // );

    //     // $data['list_obat'] = $this->db->query('SELECT master_obat.*, mko.name as nama_kategori FROM master_obat LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id ORDER BY master_obat.name ASC')->result();

    //     // $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
    //     // $data['js_addons'] = '
    //     //                                 <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
    //     //                                 <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
    //     //                                 <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
    //     //                                 <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
    //     //                                 <script>
    //     //                                 $(function () {
    //     //                                 $("#table_news").DataTable({
    //     //                                     "paging": true,
    //     //                                     "lengthChange": true,
    //     //                                     "searching": true,
    //     //                                     "ordering": true,
    //     //                                     "info": true,
    //     //                                     "autoWidth": true,
    //     //                                     "responsive": true,
    //     //                                 });
    //     //                                 });

    //     //                                 $("#id_pasien").change(function(){
    //     //                                     location.href = "' . base_url() . '/dokter/HistoryMedisPasien/index/"+$(this).val();
    //     //                                 })
    //     //                             </script>';
    //     // $this->load->view('template', $data);
    // }
    public function manage_obat()
    {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Manage Obat",
			$view = "admin/manage_obat"
        );

        $data['list_obat'] = $this->db->query('SELECT master_obat.*, mko.name as nama_kategori FROM master_obat LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id ORDER BY master_obat.name ASC')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';

        $addons = $this->session->flashdata('nama_obat') ? 'table.page.jumpToData("' . $this->session->flashdata('nama_obat') . '", 1);' : '';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                jQuery.fn.dataTable.Api.register( "page.jumpToData()", function ( data, column ) {
                                    var pos = this.column(column, {order:"current"}).data().indexOf( data );
                                    
                                    if ( pos >= 0 ) {
                                        var page = Math.floor( pos / this.page.info().length );
                                        this.page( page ).draw( false );
                                    }
                                    
                                    return this;
                                } );  

                                $(function () {
                                var table = $("#table_obat").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_obat_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table.search($(this).val()).draw();
                                });
                                ' . $addons . '
                                });

                                $("#id_pasien").change(function(){
                                    location.href = "' . base_url() . '/dokter/HistoryMedisPasien/index/"+$(this).val();
                                })

                                $("#modalHapus").on("show.bs.modal", function(e) {
                                    var nama = $(e.relatedTarget).data("nama");
                                    $(e.currentTarget).find("#nama").html(nama);

                                    var href_input = $(e.relatedTarget).data("href");
                                    $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                });

                                $("#modalStatusObat").on("show.bs.modal", function(e){
                                    var modal = $(e.currentTarget);
                                    var button = $(e.relatedTarget);

                                    var nama = button.data("nama-obat");
                                    var id = button.data("id-obat");
                                    var status = button.data("status-obat");

                                    if(status == "aktif"){
                                        var status = "menonaktifkan";
                                        var status_val = 0;
                                    }
                                    else{
                                        var status = "mengaktifkan";
                                        var status_val = 1;
                                    }
                                    var link = "'.base_url('admin/Obat/update_status/').'"+id+"/"+status_val;

                                    modal.find(".nama-obat").html(nama);
                                    modal.find(".delete-btn").attr("href", link);
                                    modal.find(".status-obat").html(status);
                                });
                            </script>';
        $this->load->view('template', $data);
    }
    public function manage_kategori_obat()
    {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Manage Kategori Obat",
			$view = "admin/manage_kategori_obat"
        );

        $data['list_obat'] = $this->db->query('SELECT * FROM master_kategori_obat ORDER BY name ASC')->result();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(function () {
                                $("#table_news").DataTable({
                                    "paging": true,
                                    "lengthChange": true,
                                    "searching": true,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": true,
                                    "responsive": true,
                                });
                                });

                                $("#id_pasien").change(function(){
                                    location.href = "' . base_url() . '/dokter/HistoryMedisPasien/index/"+$(this).val();
                                })

                                $("#modalHapus").on("show.bs.modal", function(e) {
                                    var nama = $(e.relatedTarget).data("nama");
                                    $(e.currentTarget).find("#nama").html(nama);

                                    var href_input = $(e.relatedTarget).data("href");
                                    $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                });
                            </script>';
        $this->load->view('template', $data);
    }

    public function form_tambah()
    {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Tambah Obat",
			$view = "admin/form_obat"
        );
        
        $data['js_addons'] = '
        <script>
            $("#buttonEdit").data("id", $("select[name=\'id_kategori_obat\']").val());
            $("#buttonEdit").data("name", $("select[name=\'id_kategori_obat\']").find("option:selected").text());

            $("#buttonHapus").data("id", $("select[name=\'id_kategori_obat\']").val());
            $("#buttonHapus").data("name", $("select[name=\'id_kategori_obat\']").find("option:selected").text());

            $("select[name=\'id_kategori_obat\']").change(function(e){
                $("#buttonEdit").data("id", $(this).val());
                $("#buttonEdit").data("name", $(this).find("option:selected").text());

                $("#buttonHapus").data("id", $(this).val());
                $("#buttonHapus").data("name", $(this).find("option:selected").text());
            });

            $("#modalHapus").on("show.bs.modal", function(e) {
                var id = $(e.relatedTarget).data("id");
                var name = $(e.relatedTarget).data("name");
                
                $(e.currentTarget).find("input[name=\'id\']").val(id);
                $(e.currentTarget).find("#nama_kategori").text(name);
            });
            $("#formHapusKategori").submit(function(e){
                e.preventDefault();
                var selectKategori = $("select[name=\'id_kategori_obat\']");
                var data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "' . base_url('admin/KategoriObat/hapus/') . '",
                    data: data,
                    success: function(response) {
                        if(response != "gagal"){
                            selectKategori.find("option[value=\'"+response+"\']").remove();
                            $("#modalHapus").modal("hide");
                            alert("Kategori Obat telah dihapus!");
                        }
                        else{
                            alert(\'Kategori Obat ini tidak ada / sudah dihapus !!\');
                        }
                    },
                    error: function(response) {
                        alert(\'Kategori Obat ini tidak ada / sudah dihapus !!\');
                    }
                });
            });

            $("#exampleModal").on("show.bs.modal", function(e) {
                var aksi = $(e.relatedTarget).data("aksi");
                if(aksi == "tambah"){
                    $("#exampleModal").find("input[name=\'id\']").remove();
                    $("#exampleModal").modal("show");
                    $(e.currentTarget).find("input[name=\'name\']").val("");
                    $(e.currentTarget).find(".modal-title").html("Tambah Kategori Obat");
                    $(e.currentTarget).find("#sendKategori").text("Buat");
                }
                else{
                    $("#exampleModal").find("input[name=\'id\']").remove();
                    var id = $(e.relatedTarget).data("id");
                    var name = $(e.relatedTarget).data("name");
                    var form = $("#formTambahKategori");

                    $(e.currentTarget).find("input[name=\'name\']").val(name);
                    $(e.currentTarget).find("input[name=\'name\']").after("<input type=\'hidden\' name=\'id\' id=\'id_kategori\' value=\'"+id+"\'>");
                    $(e.currentTarget).find("#sendKategori").text("Edit");
                    $(e.currentTarget).find(".modal-title").html("Edit Kategori Obat");
                }
            });
            $("#formTambahKategori").submit(function(e){
                e.preventDefault();
                addKategori($("#formTambahKategori").serialize());
            });

            function addKategori(data){
                var selectKategori = $("select[name=\'id_kategori_obat\']");
                var id = $("#exampleModal").find("input[name=\'id\']").val();
                if(id != "undefined"){
                    val_select = selectKategori.val();
                    $.ajax({
                        type: "POST",
                        url: "' . base_url('admin/KategoriObat/perbarui/') . '"+val_select,
                        data: data,
                        success: function(response) {
                            if(response != "gagal"){
                                response = response.split(",");
                                var id = response[0];
                                var name = response[1];
                                selectKategori.find("option[value=\'"+id+"\']").text(name);
                                $("#exampleModal").modal("hide");

                                $("#buttonEdit").data("id", id);
                                $("#buttonEdit").data("name", name);

                                $("#buttonHapus").data("id", id);
                                $("#buttonHapus").data("name", name);

                                alert("Kategori Obat telah diubah!");
                            }
                            else{
                                alert(\'Nama Kategori Sudah Ada!\');
                            }
                        },
                        error: function(response) {
                            alert(\'Nama Kategori Sudah Ada!\');
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "' . base_url('admin/KategoriObat/tambah') . '",
                        data: data,
                        success: function(response) {
                            if(response != "gagal"){
                                response = response.split(",");
                                var id = response[0];
                                var name = response[1];
                                var templateKategori = "<option value=\'"+id+"\'>"+name+"</option>";
                                selectKategori.append(templateKategori);
                                $("#exampleModal").modal("hide");
                                alert("Kategori Obat telah ditambahkan!");
                            }
                            else{
                                alert(\'Nama Kategori Sudah Ada!\');    
                            }
                        },
                        error: function(response) {
                            alert(\'Nama Kategori Sudah Ada!\');
                        }
                    });
                }
            }
        </script>
        ';

        $data['list_kategori'] = $this->db->query('SELECT * FROM master_kategori_obat')->result();

        $this->load->view('template', $data);
    }
    public function form_tambah_kategori()
    {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Tambah Kategori Obat",
			$view = "admin/form_tambah_kategori"
        );
        
        $data['js_addons'] = '
        <script>
            $("#buttonEdit").data("id", $("select[name=\'id_kategori_obat\']").val());
            $("#buttonEdit").data("name", $("select[name=\'id_kategori_obat\']").find("option:selected").text());

            $("#buttonHapus").data("id", $("select[name=\'id_kategori_obat\']").val());
            $("#buttonHapus").data("name", $("select[name=\'id_kategori_obat\']").find("option:selected").text());

            $("select[name=\'id_kategori_obat\']").change(function(e){
                $("#buttonEdit").data("id", $(this).val());
                $("#buttonEdit").data("name", $(this).find("option:selected").text());

                $("#buttonHapus").data("id", $(this).val());
                $("#buttonHapus").data("name", $(this).find("option:selected").text());
            });

            $("#modalHapus").on("show.bs.modal", function(e) {
                var id = $(e.relatedTarget).data("id");
                var name = $(e.relatedTarget).data("name");
                
                $(e.currentTarget).find("input[name=\'id\']").val(id);
                $(e.currentTarget).find("#nama_kategori").text(name);
            });
            $("#formHapusKategori").submit(function(e){
                e.preventDefault();
                var selectKategori = $("select[name=\'id_kategori_obat\']");
                var data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "' . base_url('admin/KategoriObat/hapus/') . '",
                    data: data,
                    success: function(response) {
                        if(response != "gagal"){
                            selectKategori.find("option[value=\'"+response+"\']").remove();
                            $("#modalHapus").modal("hide");
                            alert("Kategori Obat telah dihapus!");
                        }
                        else{
                            alert(\'Kategori Obat ini tidak ada / sudah dihapus !!\');
                        }
                    },
                    error: function(response) {
                        alert(\'Kategori Obat ini tidak ada / sudah dihapus !!\');
                    }
                });
            });

            $("#exampleModal").on("show.bs.modal", function(e) {
                var aksi = $(e.relatedTarget).data("aksi");
                if(aksi == "tambah"){
                    $("#exampleModal").find("input[name=\'id\']").remove();
                    $("#exampleModal").modal("show");
                    $(e.currentTarget).find("input[name=\'name\']").val("");
                    $(e.currentTarget).find(".modal-title").html("Tambah Kategori Obat");
                    $(e.currentTarget).find("#sendKategori").text("Buat");
                }
                else{
                    $("#exampleModal").find("input[name=\'id\']").remove();
                    var id = $(e.relatedTarget).data("id");
                    var name = $(e.relatedTarget).data("name");
                    var form = $("#formTambahKategori");

                    $(e.currentTarget).find("input[name=\'name\']").val(name);
                    $(e.currentTarget).find("input[name=\'name\']").after("<input type=\'hidden\' name=\'id\' id=\'id_kategori\' value=\'"+id+"\'>");
                    $(e.currentTarget).find("#sendKategori").text("Edit");
                    $(e.currentTarget).find(".modal-title").html("Edit Kategori Obat");
                }
            });
            $("#formTambahKategori").submit(function(e){
                e.preventDefault();
                addKategori($("#formTambahKategori").serialize());
            });

            function addKategori(data){
                var selectKategori = $("select[name=\'id_kategori_obat\']");
                var id = $("#exampleModal").find("input[name=\'id\']").val();
                if(id != "undefined"){
                    val_select = selectKategori.val();
                    $.ajax({
                        type: "POST",
                        url: "' . base_url('admin/KategoriObat/perbarui/') . '"+val_select,
                        data: data,
                        success: function(response) {
                            if(response != "gagal"){
                                response = response.split(",");
                                var id = response[0];
                                var name = response[1];
                                selectKategori.find("option[value=\'"+id+"\']").text(name);
                                $("#exampleModal").modal("hide");

                                $("#buttonEdit").data("id", id);
                                $("#buttonEdit").data("name", name);

                                $("#buttonHapus").data("id", id);
                                $("#buttonHapus").data("name", name);

                                alert("Kategori Obat telah diubah!");
                            }
                            else{
                                alert(\'Nama Kategori Sudah Ada!\');
                            }
                        },
                        error: function(response) {
                            alert(\'Nama Kategori Sudah Ada!\');
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "' . base_url('admin/KategoriObat/tambah') . '",
                        data: data,
                        success: function(response) {
                            if(response != "gagal"){
                                response = response.split(",");
                                var id = response[0];
                                var name = response[1];
                                var templateKategori = "<option value=\'"+id+"\'>"+name+"</option>";
                                selectKategori.append(templateKategori);
                                $("#exampleModal").modal("hide");
                                alert("Kategori Obat telah ditambahkan!");
                            }
                            else{
                                alert(\'Nama Kategori Sudah Ada!\');    
                            }
                        },
                        error: function(response) {
                            alert(\'Nama Kategori Sudah Ada!\');
                        }
                    });
                }
            }
        </script>
        ';

        $data['list_kategori'] = $this->db->query('SELECT * FROM master_kategori_obat')->result();

        $this->load->view('template', $data);
    }

    public function form_edit($id)
    {
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Edit Obat",
			$view = "admin/form_edit_obat"
        );
        
        $data['js_addons'] = '
        <script> 
									
            $("#buttonEdit").data("id", $("select[name=\'id_kategori_obat\']").val());
            $("#buttonEdit").data("name", $("select[name=\'id_kategori_obat\']").find("option:selected").text());

            $("#buttonHapus").data("id", $("select[name=\'id_kategori_obat\']").val());
            $("#buttonHapus").data("name", $("select[name=\'id_kategori_obat\']").find("option:selected").text());

            $("select[name=\'id_kategori_obat\']").change(function(e){
                $("#buttonEdit").data("id", $(this).val());
                $("#buttonEdit").data("name", $(this).find("option:selected").text());

                $("#buttonHapus").data("id", $(this).val());
                $("#buttonHapus").data("name", $(this).find("option:selected").text());
            });

            $("#modalHapus").on("show.bs.modal", function(e) {
                var id = $(e.relatedTarget).data("id");
                var name = $(e.relatedTarget).data("name");
                
                $(e.currentTarget).find("input[name=\'id\']").val(id);
                $(e.currentTarget).find("#nama_kategori").text(name);
            });
            $("#formHapusKategori").submit(function(e){
                e.preventDefault();
                var selectKategori = $("select[name=\'id_kategori_obat\']");
                var data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "' . base_url('admin/KategoriObat/hapus/') . '",
                    data: data,
                    success: function(response) {
                        if(response != "gagal"){
                            selectKategori.find("option[value=\'"+id+"\']").remove();
                            $("#modalHapus").modal("hide");
                            alert("Kategori Obat telah dihapus!");
                        }
                        else{
                            alert(\'Kategori Obat ini tidak ada / sudah dihapus !!\');
                        }
                    },
                    error: function(response) {
                        alert(\'Kategori Obat ini tidak ada / sudah dihapus !!\');
                    }
                });
            });

            $("#exampleModal").on("show.bs.modal", function(e) {
                var aksi = $(e.relatedTarget).data("aksi");
                if(aksi == "tambah"){
                    $("#exampleModal").find("input[name=\'id\']").remove();
                    $("#exampleModal").modal("show");
                    $(e.currentTarget).find("input[name=\'name\']").val("");
                    $(e.currentTarget).find(".modal-title").html("Tambah Kategori Obat");
                    $(e.currentTarget).find("#sendKategori").text("Buat");
                }
                else{
                    $("#exampleModal").find("input[name=\'id\']").remove();
                    var id = $(e.relatedTarget).data("id");
                    var name = $(e.relatedTarget).data("name");
                    var form = $("#formTambahKategori");

                    $(e.currentTarget).find("input[name=\'name\']").val(name);
                    $(e.currentTarget).find("input[name=\'name\']").after("<input type=\'hidden\' name=\'id\' id=\'id_kategori\' value=\'"+id+"\'>");
                    $(e.currentTarget).find("#sendKategori").text("Edit");
                    $(e.currentTarget).find(".modal-title").html("Edit Kategori Obat");
                }
            });
            $("#formTambahKategori").submit(function(e){
                e.preventDefault();
                addKategori($("#formTambahKategori").serialize());
            });

            function addKategori(data){
                var selectKategori = $("select[name=\'id_kategori_obat\']");
                var id = $("#exampleModal").find("input[name=\'id\']").val();
                if(id != "undefined"){
                    val_select = selectKategori.val();
                    $.ajax({
                        type: "POST",
                        url: "' . base_url('admin/KategoriObat/perbarui/') . '"+val_select,
                        data: data,
                        success: function(response) {
                            if(response != "gagal"){
                                response = response.split(",");
                                var id = response[0];
                                var name = response[1];
                                selectKategori.find("option[value=\'"+id+"\']").text(name);
                                $("#exampleModal").modal("hide");
                                alert("Kategori Obat telah diubah!");
                            }
                            else{
                                alert(\'Nama Kategori Sudah Ada!\');
                            }
                        },
                        error: function(response) {
                            alert(\'Nama Kategori Sudah Ada!\');
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "' . base_url('admin/KategoriObat/tambah') . '",
                        data: data,
                        success: function(response) {
                            if(response != "gagal"){
                                response = response.split(",");
                                var id = response[0];
                                var name = response[1];
                                var templateKategori = "<option value=\'"+id+"\'>"+name+"</option>";
                                selectKategori.append(templateKategori);
                                $("#exampleModal").modal("hide");
                                alert("Kategori Obat telah ditambahkan!");
                            }
                            else{
                                alert(\'Nama Kategori Sudah Ada!\');    
                            }
                        },
                        error: function(response) {
                            alert(\'Nama Kategori Sudah Ada!\');
                        }
                    });
                }
            }
        </script>
        ';

        $data['obat'] = $this->db->query('SELECT master_obat.id, master_obat.name, master_obat.unit, master_obat.harga_per_n_unit, master_obat.harga,master_obat.active, mko.name as nama_kategori, mko.id as id_kategori FROM master_obat LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id WHERE master_obat.id = ' . $id)->row();
        $data['list_kategori'] = $this->db->query('SELECT * FROM master_kategori_obat')->result();

        $this->load->view('template', $data);
    }

    public function insert()
    {
		$this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $data_obat = array(
            'id_kategori_obat' => 0,
            'name' => $data['nama'],
            'unit' => $data['satuan'],
            'active' => $data['aktif'],
            'harga_per_n_unit' => $data['harga_per_n_unit'],
            'harga' => $data['harga'],
        );
        $new_obat = $this->db->insert('master_obat', $data_obat);
        if ($new_obat) {
            $this->session->set_flashdata('msg_obat', 'Obat berhasil ditambahkan');
            $this->session->set_flashdata('nama_obat', $data['nama']);
            redirect(base_url('admin/Obat/manage_obat'));
        } else {
            $this->session->set_flashdata('msg_obat', 'Obat sudah ada');
            redirect(base_url('admin/Obat/form_tambah'));
        }
    }

    public function update($id)
    {
		$this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $data_obat = array(
            'id_kategori_obat' => 0,
            'name' => $data['nama'],
            'unit' => $data['satuan'],
            'harga_per_n_unit' => $data['harga_per_n_unit'],
            'harga' => $data['harga'],
            'active' => $data['aktif']
        );
        $update = $this->all_model->update('master_obat', $data_obat, array('id' => $id));
        if ($update) {
            $this->session->set_flashdata('msg_obat', 'Data obat berhasil diubah');
            $this->session->set_flashdata('nama_obat', $data['nama']);
        } else {
            $this->session->set_flashdata('msg_obat', 'Data obat tidak ada yang diubah');
        }
        redirect(base_url('admin/Obat/manage_obat'));
    }

    public function delete($id)
    {
		$this->all_controllers->check_user_admin();
        $resep_dokter = $this->db->query('SELECT id FROM resep_dokter WHERE id_obat = '.$id)->row();
        if($resep_dokter){
            $this->session->set_flashdata('msg_obat', 'GAGAL: Obat ini masih terkait dengan transaksi!');
            redirect(base_url('admin/Obat/manage_obat'));
        }

        if ($this->db->delete('master_obat', array('id' => $id))) {
            $this->session->set_flashdata('msg_obat', 'Obat berhasil dihapus');
            redirect(base_url('admin/Obat/manage_obat'));
        } else {
            $this->session->set_flashdata('msg_obat', 'Obat gagalh dihapus');
            redirect(base_url('admin/Obat/form_tambah'));
        }
    }

    public function update_status($id, $status){
        $this->all_controllers->check_user_admin();
        if(!is_int($status) || !is_int($id) || !isset($status) || !isset($id)){
            show_404();
        }
        
        $data_update = array(
            'active'=>$status
        );

        $obat = $this->db->query('SELECT name FROM master_obat WHERE id = '.$id)->row();

        $this->all_model->update('master_obat', $data_update, array('id'=>$id));
        $this->session->set_flashdata('msg_obat', 'Status obat berhasil diubah');
        $this->session->set_flashdata('nama_obat', $obat->name);

        redirect(base_url('admin/Obat/manage_obat'));
    }
}
