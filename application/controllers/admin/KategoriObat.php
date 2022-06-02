<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriObat extends CI_Controller
{
    var $menu = 6;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library('all_controllers');
    }

    public function index()
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

    public function tambah()
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $new_data = $this->db->insert('master_kategori_obat', $data);
        if ($new_data) {
            echo $this->db->insert_id() . ',' . $data['name'];
        } else {
            echo "gagal";
        }
    }

    public function perbarui($id)
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();

        $update_data = $this->all_model->update('master_kategori_obat', $data, array('id' => $id));
        if ($update_data) {
            if ($update_data == -1) {
                echo "gagal";
            } else {
                echo $id . ',' . $data['name'];
            }
        } else {
            echo "gagal";
        }
    }

    public function hapus()
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $kategori_obat = $this->db->query('SELECT * FROM master_kategori_obat WHERE id = ' . $data['id'])->row();
        if (!$kategori_obat) {
            show_404();
        }
        $where = array('id' => $data['id']);

        if ($this->db->delete('master_kategori_obat', $where)) {
            echo $data['id'];
        } else {
            echo "gagal";
        }
    }

    public function form_tambah_kategori()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Tambah Kategori Obat",
            $view = "admin/form_tambah_kategori"
        );

        $this->load->template('template', $data);
    }

    public function form_edit_kategori($id)
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Edit Kategori Obat",
            $view = "admin/form_edit_kategori"
        );

        $data['kategori_obat'] = $this->db->query('SELECT * FROM master_kategori_obat WHERE id = ' . $id)->row();

        $this->load->view('template', $data);
    }

    public function insert()
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        if (empty($data)) {
            show_404();
        }

        // $this->db->insert('master_kategori_obat', )
    }
}
