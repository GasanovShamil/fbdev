<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../models/User.php');

	class Home extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();
		}

		public function index() {
			$helper = $this->facebook->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes', 'user_photos', 'user_birthday', 'user_friends'];

			if (!$this->fblib->checkAccessToken()) {
				$url = $helper->getLoginUrl(base_url().'callback', $permissions);
				redirect($url);
			} else if (!$this->fblib->checkPermissions($permissions)) {
				$url = $_SESSION['rerequest-url'];
				redirect($url);
			} else {

				try {
					$response = $this->facebook->get("/me?fields=first_name,last_name,email,gender,birthday");
				} catch(Exception $e) {
					$data['message'] = $e->getMessage();
					$this->load->view('errors/access.php', $data);
				}
				
				$result = $response->getGraphUser();

				$facebookId = $result['id'];
				$firstName = $result['first_name'];
				$lastName = $result['last_name'];
				$email = $result['email'];
				$birth = $result['birthday'];
				$gender = $result['gender'];

				$user = new User($facebookId, $firstName, $lastName, $email, $birth, $gender);

				//TODO : NIKSAMER - Add or Update user to db

				$data['isAdmin'] = $this->fblib->isAdmin();
				$this->load->view('structure/header', $data);
				$data['firstName'] = $firstName;
				$this->load->view('index', $data);
				$this->load->view('structure/footer');
			}
		}

		public function callback() {
			try {
				// $helper = $this->facebook->getRedirectLoginHelper();
				$helper = $this->facebook->getCanvasHelper();
				$signedRequest = $helper->getSignedRequest();
				$accessToken = $signedRequest->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				$data['message'] = 'Graph returned an error: ' . $e->getMessage() . '<div>' . $this->input->get('state') . '</div>';
				$this->load->view('errors/access.php', $data);
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				$data['message'] = 'Facebook SDK returned an error: '  . '<div>' . $this->input->get('state') . '</div>';
				$this->load->view('errors/access.php', $data);
			}

			if (isset($accessToken)) {
				$_SESSION['facebook-access-token'] = (string) $accessToken;
			}
				
			redirect('/', 'refresh');
		}
	}