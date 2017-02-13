<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/appconfig.php');

	class Home extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();

			$this->load->model('UserService');
		}

		public function index() {
			try {
				$pageHelper = $this->facebook->getPageTabHelper();
				$accessToken = $pageHelper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				$data['message'] = 'Graph returned an error: ' . $e->getMessage();
				$this->load->view('errors/access.php', $data);
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				$data['message'] = 'Facebook SDK returned an error: ' . $e->getMessage();
				$this->load->view('errors/access.php', $data);
			}

			if (isset($accessToken)) {
				$_SESSION['facebook-access-token'] = (string) $accessToken;
			}
			
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
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
				$token = $_SESSION['facebook-access-token'];

				$_SESSION['facebook-user-id'] = $facebookId;
				$_SESSION['facebook-is-admin'] = $this->fblib->isAdmin();

				$exists = $this->UserService->getUser($facebookId);

				if (isset($exists)) {
					$this->UserService->updateUser($facebookId, $firstName, $lastName, $email, $birth, $gender, $token);
				} else {
					$this->UserService->addUser($facebookId, $firstName, $lastName, $email, $birth, $gender, $token);
				}
				
				$this->load->view('structure/header');

				$data['firstName'] = $firstName;
				$this->load->view('index', $data);

				$this->load->view('structure/footer');
			}
		}

		// public function callback() {
		// 	try {
		// 		$redirectHelper = $this->facebook->getRedirectLoginHelper();
		// 		$accessToken = $redirectHelper->getAccessToken();

		// 		// $response = $this->facebook->get("/me?fields=id", $accessToken);
		// 		// $result = $response->getGraphUser();
		// 		// $facebookId = $result['id'];
		// 	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// 		$data['message'] = 'Graph returned an error: ' . $e->getMessage() . '<div>' . $this->input->get('state') . '</div>';
		// 		$this->load->view('errors/access.php', $data);
		// 	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// 		$data['message'] = 'Facebook SDK returned an error: '  . '<div>' . $this->input->get('state') . '</div>';
		// 		$this->load->view('errors/access.php', $data);
		// 	}

		// 	if (isset($accessToken))
		// 		$_SESSION['facebook-access-token'] = (string) $accessToken;

		// 	// if (isset($facebookId))
		// 	// 	$_SESSION['facebook-user-id'] = (string) $facebookId;
				
		// 	//redirect('https://www.facebook.com/projetconcourphoto/app/1158724760874896/', 'refresh');
		// 	//redirect('/', 'refresh');
		// 	$this->index();
		// }
	}