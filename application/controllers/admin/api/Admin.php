<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin_model');

        $this->load->library('all_controllers');
    }

    public function get_all_paginate(){
        $this->all_controllers->check_user_admin();

        header('Content-Type: application/json');
        echo $this->admin_model->get_all_paginate();
    }
}