<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    var $menu = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('all_controllers');
    }

    public function index()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Manage Berita",
            $view = "admin/manage_news"
        );

        $data['news'] = $this->all_model->select('data_news', 'result');
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(document).ready(function () {
                                  var table_news = $("#table_news").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                  });
                                  $("#table_news_filter").remove();
								  $("#search").on("keyup", function(e){
									table_news.search($(this).val()).draw();
								  });

                                    $("#modalHapus").on("show.bs.modal", function(e) {
                                        var nama = $(e.relatedTarget).data("nama");
                                        $(e.currentTarget).find("#nama").html(nama);

                                        var href_input = $(e.relatedTarget).data("href");
                                        $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                    });
                                });
                              </script>';
        $this->load->view('template', $data);
    }

    public function formAdd()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Tambah Berita",
            $view = "admin/form_news"
        );

        $data['css_addons'] = '
  //<link rel="stylesheet" type="text/css" href="' . base_url() . 'assets/adminLTE/ckeditor/css/style.css">
		';
        $data['js_addons'] = '
	<script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
    <script>
    ClassicEditor.defaultConfig = {
        toolbar: {
          items: [
            "heading",
            "|",
            "bold",
            "italic",
            "|",
            "bulletedList",
            "numberedList",
            "|",
            "undo",
            "redo"
          ]
        },
        table: {
          contentToolbar: [ "tableColumn", "tableRow", "mergeTableCells" ]
        },
        language: "en"
      };

    var theEditor;
    ClassicEditor
        .create( document.querySelector( "#ckedtor" ) )
        .then(editor=>{
            theEditor = editor;
        })
        .catch(error=>{
            console.log(error);
        });
        
    
    function getDataFromTheEditor() {
        return theEditor.getData();
    }

    $(".btn-simpan").click(function(e){
        if(!getDataFromTheEditor()){
            e.preventDefault();
            alert("Keterangan tidak boleh kosong!");
        }
    })

    </script>
		';
        $this->load->view('template', $data);
    }

    public function formEdit($id)
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Edit Berita",
            $view = "admin/form_edit_news"
        );

        $where = array('id' => $id); // where nya id ya, sesuaikan value dgn id
        $get = $this->all_model->select('data_news', 'row', $where);
        $data['data'] = $get;
        $data['css_addons'] = '
  <link rel="stylesheet" type="text/css" href="' . base_url() . '/assets/adminLTE/ckeditor/css/style.css">
		';
        $data['js_addons'] = '
 	<script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
// <script type="text/javascript">
//   $(document).ready(function(){
//     var editor = CKEDITOR.replace("ckedtor");
//   });

//     $("#file_upload").change(function() {
//       var file = $("#file_upload")[0].files[0].name;
//       $("#filename").text(file);
//     });    
// </script>
<script>
ClassicEditor.defaultConfig = {
    toolbar: {
      items: [
        "heading",
        "|",
        "bold",
        "italic",
        "|",
        "bulletedList",
        "numberedList",
        "|",
        "undo",
        "redo"
      ]
    },
    table: {
      contentToolbar: [ "tableColumn", "tableRow", "mergeTableCells" ]
    },
    language: "en"
  };
  var theEditor;
  ClassicEditor
      .create( document.querySelector( "#ckedtor" ) )
      .then(editor=>{
          theEditor = editor;
      })
      .catch(error=>{
          console.log(error);
      });
      
  
  function getDataFromTheEditor() {
      return theEditor.getData();
  }

  $(".btn-simpan").click(function(e){
      if(!getDataFromTheEditor()){
          e.preventDefault();
          alert("Keterangan tidak boleh kosong!");
      }
  })
</script>
		';
        $this->load->view('template', $data);
    }

    public function create()
    {
        $this->all_controllers->check_user_admin();

        date_default_timezone_set("Asia/Bangkok");
        $created_at = date('Y-m-d');
        $data = $this->input->post(); // field sesuaikan dengan databse
        $datas = array('judul' => $data['judul'], 'berita' => $data['berita'], 'created_at' => $created_at);
        $save = $this->all_model->insert_('data_news', $datas);
        $news_id = $this->db->insert_id();

        if ($save) {
            $config['upload_path'] = "./assets/images/news";
            $config['allowed_types'] = 'jpeg|jpg|png|jfif';
            $config['max_size'] = 5000;
            $config['max_width'] = 6000;
            $config['max_height'] = 6000;
            $config['encrypt_name'] = false;
            $config['file_name'] = 'news_' . $this->db->insert_id();

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->overwrite = true;

            if (!$this->upload->do_upload('foto')) {
                $upload = array('result', $this->upload->display_errors());
                $response = array('message'=>'GAGAL: Upload gambar gagal!');
                $this->session->set_flashdata('msg_news', $response['message']);
                redirect(base_url('admin/News/formAdd'));
            } else {

                $up = array(
                    'foto' => $this->upload->data('file_name'),
                );
                $upload = $this->all_model->update_($up, array('id' => $save), 'data_news');
            }
            $response = array('status' => $save, 'message' => 'Berita berhasil disimpan', 'upload' => $upload);
            $this->session->set_flashdata('msg_news', $response['message']);
            redirect(base_url('admin/News'));
        } else {
            $response = array('status' => $save, 'message' => 'Berita gagal disimpan');
            $this->session->set_flashdata('msg_news', $response['message']);
            redirect(base_url('admin/News/formAdd'));
        }
    }
    public function update()
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post(); // sesuaikan dengan field database
        $id   = $data['id'];
        unset($data['id']);

        $save = $this->all_model->update_($data, array('id' => $id), 'data_news');
        if (!empty($_FILES['foto']['name'])) {
            $where = 'id = ' . $id;
            $this->data = $this->all_model->select('data_news', 'row', $where);
            if (!is_null($this->data)) {
                if ($this->data->foto != null) {
                    $Path = './assets/images/news/' . $this->data->foto;
                    unlink($Path);
                }
            }
            $config['upload_path'] = "./assets/images/news";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;
            $config['max_width'] = 6000;
            $config['max_height'] = 6000;
            $config['encrypt_name'] = false;
            $config['file_name'] = 'news_' . $id;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->overwrite = true;

            if (!$this->upload->do_upload('foto')) {
                $upload = array('result', $this->upload->display_errors());
            } else {

                $up = array(
                    'foto' => $this->upload->data('file_name'),
                );
                $upload = $this->all_model->update_($up, array('id' => $id), 'data_news');
            }
        } else {
            $upload = 'null';
        }
        // var_dump($upload);

        if ($save) {
            $response = array('status' => $save, 'message' => 'Berita berhasil diubah');
            $this->session->set_flashdata('msg_news', $response['message']);
            redirect(base_url('admin/News'));
        } else {
            $response = array('status' => $save, 'message' => 'Berita gagal diubah');
            $this->session->set_flashdata('msg_news', $response['message']);
            redirect(base_url('admin/News/formEdit/'.$id));
        }


        redirect(base_url('admin/News'));
    }
    public function delete($id)
    {
        $this->all_controllers->check_user_admin();

        //$where  = $this->input->post(); // id
        $where = array('id' => $id);
        $news_deleted = $this->db->query('SELECT foto FROM data_news WHERE id = ' . $id)->row();
        $delete = $this->all_model->delete('data_news', $where);

        $news_deleted->foto = $news_deleted->foto ? $news_deleted->foto : 'nothing_image.jpg';
        if (file_exists(FCPATH . "assets/images/news/" . $news_deleted->foto)) {
            unlink(FCPATH . "assets/images/news/" . $news_deleted->foto);
        }

        $this->session->set_flashdata('msg_news', 'Berita berhasil dihapus!');
        redirect(base_url('admin/News'));
    }
    public function get_byId($where)
    {
        $this->all_controllers->check_user_admin();

        $data  = $this->all_model->select('data_news', 'row', $where);
        return $data;
    }
    public function viewDetail($id)
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Ditel Berita",
            $view = "admin/detail_news"
        );

        $where = array('id' => $id);
        $data['news'] = $this->get_byId($where);
        if ($data['news']->foto == null || $data['news']->foto == "") {
            $data['news']->foto = base_url("assets/images/news/noImage.png");
        } else {
            $data['news']->foto = base_url("assets/images/news/" . $data['news']->foto);
        }

        $data['data'] = $data;

        $this->load->view('template', $data);
    }
}
