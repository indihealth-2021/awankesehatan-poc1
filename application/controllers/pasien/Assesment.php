<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assesment extends CI_Controller {
	public $data;

    public function __construct() {
        parent::__construct();       
	$this->load->library(array('Key')); 
    }

    public function index(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        if($id_jadwal_konsultasi){
            $jk = $this->db->query('SELECT jadwal_konsultasi.*, d.name as nama_dokter, d.str as str_dokter, d.foto as foto_dokter, nominal.poli as poli_dokter FROM jadwal_konsultasi LEFT JOIN master_user d ON jadwal_konsultasi.id_dokter = d.id LEFT JOIN detail_dokter ON detail_dokter.id_dokter = d.id LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE jadwal_konsultasi.id = '.$id_jadwal_konsultasi)->row();
            if(!$jk){
                redirect(base_url('pasien/Pasien'));
            }
	        $data['jadwal_konsultasi'] = $jk;
            $assesment = $this->db->query('SELECT assesment.*, d.name as nama_dokter, d.str as str_dokter, d.foto as foto_dokter, n.poli as poli_dokter FROM assesment LEFT JOIN master_user d ON assesment.id_dokter = d.id LEFT JOIN detail_dokter ddr ON ddr.id_dokter = d.id LEFT JOIN nominal n ON ddr.id_poli = n.id WHERE assesment.id_pasien = '.$this->session->userdata('id_user').' AND id_jadwal_konsultasi = '.$id_jadwal_konsultasi.' ORDER BY updated_at DESC, created_at DESC')->row();
            if(!$assesment){
                $assesment = $this->db->query('SELECT assesment.* FROM assesment WHERE assesment.id_pasien = '.$this->session->userdata('id_user').' ORDER BY updated_at DESC, created_at DESC')->row();  
                $data['assesment_old'] = 'ok';            
            }
            $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        }
        else{
            // $assesment = $this->db->query('SELECT assesment.* FROM assesment WHERE assesment.id_pasien = '.$this->session->userdata('id_user').' ORDER BY updated_at DESC, created_at DESC')->row();
            // $data['assesment_old'] = 'ok';
            redirect(base_url('pasien/Pasien'));
        }
        $jadwal_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id_pasien = '.$this->session->userdata('id_user'))->row();
        $data['assesment'] = $assesment;
	    $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['view'] = 'pasien/form_assesment';
        $data['title'] = 'Assesment';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;

        $data['js_addons'] = "
        <script>
    $('#file_upload').change(function() {
      var file = $('#file_upload')[0].files[0].name;
      var file_substr = file.length > 40 ? file.substr(0, 39)+'...':file;
      $('#asesmenfilename').html('<span title=\"' + file + '\">' + file_substr + '</span>');
    });
</script>";

        if(!$jadwal_konsultasi){
            $data['view'] = 'pasien/assesment_error';
            $this->load->view('template', $data);
        }
        else{
            $this->load->view('template', $data);
        }
    }

    public function menu_assesment(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['view'] = 'pasien/menu_assesment';
        $data['title'] = 'Menu Assesment';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['list_jadwal_konsultasi'] = $this->db->query('SELECT jadwal_konsultasi.id, jadwal_konsultasi.tanggal, jadwal_konsultasi.jam, d.name as nama_dokter, d.foto as foto_dokter, d.str as str_dokter, nominal.poli FROM jadwal_konsultasi INNER JOIN master_user d ON jadwal_konsultasi.id_dokter = d.id LEFT JOIN detail_dokter ON detail_dokter.id_dokter = d.id LEFT JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE jadwal_konsultasi.id_pasien = '.$this->session->userdata('id_user'))->result();

        $this->load->view('template', $data);
    }

    public function update(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $jadwal_konsultasi = $this->db->query('SELECT id,id_dokter FROM jadwal_konsultasi WHERE id_pasien = '.$this->session->userdata('id_user'))->result();
        $assesments = $this->db->query('SELECT assesment.id_jadwal_konsultasi FROM assesment INNER JOIN jadwal_konsultasi ON assesment.id_jadwal_konsultasi = jadwal_konsultasi.id WHERE assesment.id_pasien = '.$this->session->userdata('id_user'))->result();

        // if(isset($data['merokok'])){
        //     $data['merokok'] = 1;
        // }
        // else{
        //     $data['merokok'] = 0;
        // }

        // if(isset($data['alkohol'])){
        //     $data['alkohol'] = 1;
        // }
        // else{
        //     $data['alkohol'] = 0;
        // }
        
        // if(isset($data['kecelakaan'])){
        //     $data['kecelakaan'] = 1;
        // }
        // else{
        //     $data['kecelakaan'] = 0;
        // }
        
        // if(isset($data['operasi'])){
        //     $data['operasi'] = 1;
        // }
        // else{
        //     $data['operasi'] = 0;
        // }
        
        // if(isset($data['dirawat'])){
        //     $data['dirawat'] = 1;
        // }
        // else{
        //     $data['dirawat'] = 0;
        // }


        if(!$jadwal_konsultasi){
            show_404();
        }
        else{
            $id_jadwal_konsultasi = $this->input->post('id_jadwal_konsultasi');
            if($id_jadwal_konsultasi){
                $jk = $this->db->query('SELECT id, id_dokter FROM jadwal_konsultasi WHERE id = '.$id_jadwal_konsultasi.' AND id_pasien = '.$this->session->userdata('id_user'))->row();
				$dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$jk->id_dokter)->row();
                if(!$jk || !$dokter){
                    show_404();
                }
                
                $config['upload_path'] = './assets/files/file_pemeriksaan_luar';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif|pdf|docx|doc|xlsx|xls|rar|zip';
                $config['max_size'] = 10024;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $files = $_FILES['file_upload'];

                $cpt = count($files['name']);

                if ($cpt > 0) {
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['userfile']['name'] = $files['name'][$i];
                        $_FILES['userfile']['type'] = $files['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['userfile']['error'] = $files['error'][$i];
                        $_FILES['userfile']['size'] = $files['size'][$i];
                    
                        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                        $_FILES['userfile']['name'] = uniqid().'.'.$ext;
                    
                        if (!$this->upload->do_upload('userfile')) {
                            $upload_error = $this->upload->display_errors();
                            $this->session->set_flashdata('msg_assesment', 'Gagal mengupload gambar.');
                        }else{
                            $this->db->query('INSERT INTO file_asesmen (id_jadwal_konsultasi, nama_file, type_file, ukuran_file) VALUES ("'.$id_jadwal_konsultasi.'", "'.$this->upload->data('file_name').' ", "'.$this->upload->data('file_type').' ", "'.$this->upload->data('file_size').'" )');
                        }
                    }
                }

				$data['name'] = 'unshow';
				$data['sub_name'] = 'submit_assesment_pasien';
				$data['id_user'] = json_encode(array($jk->id_dokter));
				$msg_notif = json_encode($data);
				$this->key->_send_fcm($dokter->reg_id, $msg_notif);


				unset($data['name']);
				unset($data['sub_name']);
				unset($data['id_user']);
				
				$data['id_pasien'] = $this->session->userdata('id_user');
				$data['id_dokter'] = $jk->id_dokter;

				$assesment = $this->db->query('SELECT * FROM assesment WHERE id_jadwal_konsultasi = '.$jk->id)->row();
				if($assesment){
					$this->all_model->update('assesment', $data, array('id_jadwal_konsultasi'=>$id_jadwal_konsultasi));
				}
				else{
					$this->db->insert('assesment', $data);	
				}
                $this->session->set_flashdata('msg_assesment', 'Data Berhasil Disimpan');
            }
            else{
                foreach($jadwal_konsultasi as $jk){
                    $assesment = $this->db->query('SELECT * FROM assesment WHERE id_jadwal_konsultasi = '.$jk->id)->row();
                    if($assesment){
			$dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$jk->id_dokter)->row();
			$data['name'] = 'unshow';
			$data['sub_name'] = 'submit_assesment_pasien';
			$data['id_user'] = json_encode(array($jk->id_dokter));
			$msg_notif = json_encode($data);
			$this->key->_send_fcm($dokter->reg_id, $msg_notif);
            $config['upload_path'] = './assets/files/file_pemeriksaan_luar';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif|pdf|docx|doc|xlsx|xls|rar|zip';
                $config['max_size'] = 10024;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $files = $_FILES['file_upload'];

                $cpt = count($files['name']);

                if ($cpt > 0) {
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['userfile']['name'] = $files['name'][$i];
                        $_FILES['userfile']['type'] = $files['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES['userfile']['error'] = $files['error'][$i];
                        $_FILES['userfile']['size'] = $files['size'][$i];
                    
                        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                        $_FILES['userfile']['name'] = uniqid().'.'.$ext;
                    
                        if (!$this->upload->do_upload('userfile')) {
                            $upload_error = $this->upload->display_errors();
                            $this->session->set_flashdata('msg_assesment', 'Gagal mengupload gambar.');
                        }else{
                            $this->db->query('INSERT INTO file_asesmen (id_jadwal_konsultasi, nama_file, type_file, ukuran_file) VALUES ("'.$id_jadwal_konsultasi.'", "'.$this->upload->data('file_name').' ", "'.$this->upload->data('file_type').' ", "'.$this->upload->data('file_size').'" )');
                        }
                    }
                }

			unset($data['name']);
			unset($data['sub_name']);
			unset($data['id_user']);

                        $update = $this->all_model->update('assesment', $data, array('id_jadwal_konsultasi'=>$jk->id));
                        if($update != 0)
                        {
                            if($update == -1){
                                $this->session->set_flashdata('msg_assesment', 'Data gagal disimpan');
                            }
                            else{
                                $this->session->set_flashdata('msg_assesment','Data berhasil disimpan');	
                            }							
                            
                        } else {
                            $this->session->set_flashdata('msg_assesment','Data tidak ada yang disimpan');								
                        }
                    }
                    else{
			$dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$jk->id_dokter)->row();
			$data['name'] = 'unshow';
			$data['sub_name'] = 'submit_assesment_pasien';
			$data['id_user'] = json_encode(array($jk->id_dokter));
			$msg_notif = json_encode($data);
			$this->key->_send_fcm($dokter->reg_id, $msg_notif);

			unset($data['name']);
			unset($data['sub_name']);
			unset($data['id_user']);		

                        $data['id_pasien'] = $this->session->userdata('id_user');
                        $data['id_jadwal_konsultasi'] = $jk->id;
                        $data['id_dokter'] = $jk->id_dokter;
                        $new_assesment = $this->db->insert('assesment', $data);
                        $this->session->set_flashdata('msg_assesment', 'Data berhasil disimpan, tunggu panggilan dari dokter yang telah dijadwalkan!');
                    }
                }
            }
        }
        redirect('pasien/Telekonsultasi/jadwal');
    }

    
}
