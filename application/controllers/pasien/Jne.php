<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Jne extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Key'));
        $this->load->library('session');
    }

    public function track($no_resi, $token)
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
            CURLOPT_URL => $this->config->item('path_to_api').'jne/Api/detailOrder/'.$no_resi.'/'.$token,
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

        if(!isset($result->detail)){
            echo json_encode($result);
        }
    }
}