<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengaturanWeb extends CI_Controller {
    var $menu = 9;

    public function __construct() {
        parent::__construct(); 
        $this->load->model('all_model');    
        $this->load->library('all_controllers');  
    }

    public function index(){
		$this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Pengaturan Web",
			$view = "admin/pengaturan_web"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    $("#hargaAdmInput").hide();
                                    $("#remindAtInput").hide();
                                    $("#remindEveryInput").hide();
                                    $("#table_pengaturan").DataTable({
                                    "responsive": true,
                                    "order": false,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": false,
                                    "pageLength": 5,
                                    "info": false,
                                    "paging": false
                                    });

                                    $("#table_pengingat").DataTable({
                                        "responsive": true,
                                        "order": false,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": false,
                                        "pageLength": 5,
                                        "info": false,
                                        "paging": false
                                        });    
                                        
                                        $("#table-manual-payment").DataTable({
                                            "responsive": true,
                                            "autoWidth": false,
                                            "lengthChange": false,
                                            "searching": false,
                                            "pageLength": 5,
                                        });
                        
                                        $("#table-va").DataTable({
                                            "responsive": true,
                                            "autoWidth": false,
                                            "lengthChange": false,
                                            "searching": false,
                                            "pageLength": 5,
                                        });
                        
                                        $("#table-e-wallet").DataTable({
                                            "responsive": true,
                                            "autoWidth": false,
                                            "lengthChange": false,
                                            "searching": false,
                                            "pageLength": 5,
                                        });
                                
                                    $("#btnEditHargaAdm").click(function(e){
                                        $("#hargaAdmInput").show();
                                        $("#hargaAdmInput").find("input").val(hargaAdm);
                                        $("#helpTextHargaAdm").html(formatRupiah(hargaAdm.toString(), "Rp. ")+",00");
                                        $("#hargaAdmText").hide();
                                    });
                                    $("#btnEditRemindAt").click(function(e){
                                        $("#remindAtInput").show();
                                        $("#remindAtInput").find("input").val(remindAt);
                                        $("#remindAtText").hide();
                                    });
                                    $("#btnEditRemindEvery").click(function(e){
                                        $("#remindEveryInput").show();
                                        $("#remindEveryInput").find("input").val(remindEvery);
                                        $("#remindEveryText").hide();
                                    });

                                    $("#hargaAdmInputText").keyup(function(){
                                        $("#helpTextHargaAdm").html(formatRupiah(this.value, "Rp. ")+",00");
                                    });
                                    $("#hargaAdmInputText").change(function(){
                                        $("#helpTextHargaAdm").html(formatRupiah(this.value, "Rp. ")+",00");
                                    });

                                    $("#btnCloseHargaAdm").click(function(e){
                                        $("#hargaAdmInput").hide();
                                        $("#hargaAdmText").show();
                                    });
                                    $("#btnCloseRemindAt").click(function(e){
                                        $("#remindAtInput").hide();
                                        $("#remindAtText").show();
                                    });
                                    $("#btnCloseRemindEvery").click(function(e){
                                        $("#remindEveryInput").hide();
                                        $("#remindEveryText").show();
                                    });

                                    $("#btnOkHargaAdm").click(function(){
                                        if($("#hargaAdmInputText").val()){
                                            var valHargaAdmInputText = $("#hargaAdmInputText").val();
                                            $.ajax({
                                                method : "GET",
                                                url    : baseUrl+"admin/PengaturanWeb/update_harga_adm/"+valHargaAdmInputText,
                                                success : function(data){
                                                    hargaAdm = valHargaAdmInputText;
                                                    $("#hargaAdmText").html(formatRupiah(valHargaAdmInputText, "Rp. ")+",00");
                                                    $("#hargaAdmText").show();
                                                    $("#hargaAdmInput").hide();             
                                                },
                                                error : function(data){
                                                        alert(data);
                                                }
                                                
                                        
                                            });
                                        }
                                    });
                                    $("#btnOkRemindAt").click(function(){
                                        if($("#remindAtInputText").val()){
                                            var valRemindAtInputText = $("#remindAtInputText").val();
                                            $.ajax({
                                                method : "GET",
                                                url    : baseUrl+"admin/PengaturanWeb/update_ingatkan_pada/"+valRemindAtInputText,
                                                success : function(data){
                                                    remindAt = valRemindAtInputText;
                                                    $("#remindAtText").html(valRemindAtInputText+" Menit");
                                                    $("#remindAtText").show();
                                                    $("#remindAtInput").hide();             
                                                },
                                                error : function(data){
                                                        console.log(data);
                                                }
                                                
                                        
                                            });
                                        }
                                    });
                                    $("#btnOkRemindEvery").click(function(){
                                        if($("#remindEveryInputText").val()){
                                            var valRemindEveryInputText = $("#remindEveryInputText").val();
                                            $.ajax({
                                                method : "GET",
                                                url    : baseUrl+"admin/PengaturanWeb/update_ingatkan_setiap/"+valRemindEveryInputText,
                                                success : function(data){
                                                    remindEvery = valRemindEveryInputText;
                                                    $("#remindEveryText").html(valRemindEveryInputText+" Menit");
                                                    $("#remindEveryText").show();
                                                    $("#remindEveryInput").hide();             
                                                },
                                                error : function(data){
                                                        console.log(data);
                                                }
                                                
                                        
                                            });
                                        }
                                    });

                                    function formatRupiah(angka, prefix){
                                        var number_string = angka.replace(/[^,\d]/g, "").toString(),
                                        split   		= number_string.split(","),
                                        sisa     		= split[0].length % 3,
                                        rupiah     		= split[0].substr(0, sisa),
                                        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                                
                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if(ribuan){
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }
                                
                                        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : (rupiah ? "Rp. " + rupiah : "");
                                    }
                                });
                                </script>';
        $data['web'] = $this->db->query('SELECT * FROM master_web')->row();
        $data['list_manual_payment'] = $this->db->query('SELECT * FROM master_manual_payment')->result();
        $data['list_payment_va'] = $this->db->query('SELECT * FROM payment WHERE type = "va" AND vendor = "arthajasa"')->result();
        $data['list_e_wallet'] = $this->db->query('SELECT * FROM payment WHERE type = "ewallet" AND vendor = "arthajasa"')->result();

        $this->load->view('template', $data);
    }

    public function update_harga_adm($hargaAdm){
		$this->all_controllers->check_user_admin();
        
        $master_web = $this->db->query('SELECT id FROM master_web')->row();
        $hargaAdm = array("harga_adm"=>$hargaAdm);
        $this->all_model->update('master_web', $hargaAdm, array('id'=>$master_web->id));

        echo $hargaAdm;
    }

    public function update_ingatkan_pada($ingatkan_pada){
        $this->all_controllers->check_user_admin();

        $master_web = $this->db->query('SELECT id FROM master_web')->row();
        $data = array("ingatkan_pada"=>$ingatkan_pada);
        $this->all_model->update('master_web', $data, array('id'=>$master_web->id));

        echo $ingatkan_pada;
    }

    public function update_ingatkan_setiap($ingatkan_setiap){
        $this->all_controllers->check_user_admin();

        $master_web = $this->db->query('SELECT id FROM master_web')->row();
        $data = array("ingatkan_setiap"=>$ingatkan_setiap);
        $this->all_model->update('master_web', $data, array('id'=>$master_web->id));

        echo $ingatkan_setiap;
    }

    public function form_edit_manual_payment($payment_id){
        $this->all_controllers->check_user_admin();
		$data = $this->all_controllers->get_data_view(
			$title = "Edit Channel Bank Verifikasi Manual",
			$view = "admin/form_edit_manual_payment"
        );

        $data['manual_payment'] = $this->db->query('SELECT * FROM master_manual_payment WHERE payment_id = '.$payment_id)->row();
        if(!$data['manual_payment']){
            redirect(base_url('admin/PeraturanWeb'));
        }

        $data['js_addons'] = '
        <script>
        $("input[name=logo]").change(function() {
            var file = $("input[name=logo]")[0].files[0].name;
            var file_substr = file.length > 40 ? file.substr(0, 39)+"...":file;
            $("#filename").html("<span title=\"" + file + "\">" + file_substr + "</span>");
          });  
        </script>
        ';

        $this->load->view('template', $data);
    }

    public function update_manual_payment($payment_id){
        $this->all_controllers->check_user_admin();

        $post_data = $this->input->post();
        $payment_id = isset($post_data['payment_id']) ? $post_data['payment_id']:null;
        $payment = isset($post_data['payment']) ? $post_data['payment']:null;
        $aktif = isset($post_data['aktif']) ? $post_data['aktif']:null;
        $no_rekening = isset($post_data['no_rekening']) ? $post_data['no_rekening']:null;
        var_dump('ON PROGRESS');
        die;
    }
}