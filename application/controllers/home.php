<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require(dirname(__FILE__).'/../libraries/facebook.php');

	class Home extends CI_Controller {

		public function index() {
			$this->load->view('index');
		}

		public function callback() {
			$this->load->view('callback');
		}

		public function logout() {
			session_start();
			session_destroy();
			$this->load->view('index');
		}
	}
	

// if (checkAccessToken()) {
// 	if (checkPermissions()) {
// 		$this->load->view('index');
// 	} else {
// 		$this->load->view('error-permissions');
// 	}
// } else {
// 	$this->load->view('error-access-token');
// }