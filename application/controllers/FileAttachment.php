<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileAttachment extends CI_Controller {
	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
        $this->load->library(array('Key'));   
        $this->load->library('session');         
    }

    // public function test(){
    //   echo var_dump(array($_SERVER['DOCUMENT_ROOT'].'/assets/files/attachments/347_382'=>is_dir($_SERVER['DOCUMENT_ROOT'].'/assets/files/attachments/346_350'))); 
    // }

    public function upload($chat_id){
        $chat_id_explode = explode('_', $chat_id);
        $dokter = $this->db->query('SELECT id,id_user_kategori FROM master_user WHERE id = '.$chat_id_explode[0])->row();
        if(!$dokter || $dokter->id_user_kategori != 2){
            show_404();
        }
        $pasien = $this->db->query('SELECT id,id_user_kategori FROM master_user WHERE id = '.$chat_id_explode[1])->row();
        if(!$pasien || $pasien->id_user_kategori != 0){
            show_404();
        }
        if($this->session->userdata('is_login')){
                if(!is_dir(FCPATH . 'assets/files/attachments/'.$chat_id)){
                    mkdir(FCPATH . 'assets/files/attachments/'.$chat_id, 0777, TRUE);
                }
                $file_name = preg_replace('/[^a-zA-Z0-9.]/', '_', $_FILES['attachment']['name']);
                // $file_name = str_replace(' ','_',$_FILES["attachment"]['name']);
                // $file_name = str_replace('-','_',$file_name);
				$config['upload_path']          = './assets/files/attachments/'.$chat_id;
				$config['allowed_types']        = 'txt|doc|docx|jpg|jpeg|png|pdf';
				$config['max_size']             = 10024;
                $config['file_name'] = $file_name;
				// $config['max_width']            = 1024;
				// $config['max_height']           = 768;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->overwrite = true;

				if ( ! $this->upload->do_upload('attachment')){
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);
				}else{
					$data_attachment = array('upload_data' => $this->upload->data());
					$data['attachment'] = $data_attachment['upload_data']['file_name'];	
                    if(!file_exists(FCPATH . 'assets/files/attachments/'.$chat_id.'/index.php')){
                        touch(FCPATH . 'assets/files/attachments/'.$chat_id.'/index.php');
                    }
                    echo 'OK';
				}
        }
        else{
            redirect(base_url('login'));
        }
    }
}