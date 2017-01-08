<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/facebook.php');

	class Home extends CI_Controller {
		public function __construct() {
			parent::__construct();
			session_start();
		}

		public function index() {
			$this->load->view('index');
		}

		public function callback() {
			$fb = getFacebook();
			$helper = $fb->getRedirectLoginHelper();
			$_SESSION['FBRLH_' . 'state'] = $this->input->get('state');

			try {
				$accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				echo 'Graph returned an error: ' . $e->getMessage() . '<div>' . $this->input->get('state') . '</div>';
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: '  . '<div>' . $this->input->get('state') . '</div>';
				exit;
			}

			if (isset($accessToken)) $_SESSION['facebook-access-token'] = (string) $accessToken;

			$this->load->view('home/home');
		}

		public function logout() {
			session_destroy();
			redirect('/');
		}

		public function homepage(){
			$this->load->view('home/home');
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