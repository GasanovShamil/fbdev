<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/facebook.php');

	class Home extends CI_Controller {

		public function __construct() {
			parent::__construct();
			session_start();
		}

		public function index() {			
			$fb = getFacebook();
			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes', 'user_photos', 'user_birthday', 'user_friends'];

			if (!checkAccessToken()) {
				$url = $helper->getLoginUrl(base_url().'callback', $permissions);
				redirect($url);
			} else if (!checkPermissions($permissions)) {
				$url = $_SESSION['rerequest-url'];
				redirect($url);
			} else {
				$data = array('isAdmin' => isAdmin());
				$this->load->view('structure/header', $data);
				$this->load->view('index');
				$this->load->view('structure/footer');
			}
		}

		public function callback() {
			$fb = getFacebook();
			$helper = $fb->getRedirectLoginHelper();

			try {
				$accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				$data = array('message' => 'Graph returned an error: ' . $e->getMessage() . '<div>' . $this->input->get('state') . '</div>');
				$this->load->view('errors/access.php', $data);
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				$data = array('message' => 'Facebook SDK returned an error: '  . '<div>' . $this->input->get('state') . '</div>');
				$this->load->view('errors/access.php', $data);
			}

			if (isset($accessToken)) $_SESSION['facebook-access-token'] = (string) $accessToken;

			redirect('/', 'refresh');
		}
	}