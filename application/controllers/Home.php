<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/appconfig.php');
	require_once(dirname(__FILE__).'/../popo/User.php');

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
				$_SESSION['facebook-user-id'] = $facebookId;

				$user = new User(
					$facebookId,
					$result['first_name'],
					$result['last_name'],
					$result['email'],
					$result['birthday'],
					$result['gender'],
					$_SESSION['facebook-access-token']
				);

				$exists = $this->UserService->getUser($facebookId);

				if (isset($exists)) {
					$this->UserService->updateUser($user);
				} else {
					$this->UserService->addUser($user);
				}

				$data['isAdmin'] = $this->fblib->isAdmin();
				$data['showNav'] = false;
				$this->load->view('structure/header', $data);

				$data['firstName'] = $user->firstName;
				// $data['voteUrl'] = redirect('/vote/');
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