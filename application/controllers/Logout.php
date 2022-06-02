<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index() {
		$this->session->unset_userdata('web_token');
		$this->session->unset_userdata('is_login');
		$this->session->unset_userdata('id_user');

		delete_cookie('cookielogin[is_login]');
		delete_cookie('cookielogin[user]');
		delete_cookie('cookielogin[pass]');

		redirect('login');
	}
}
