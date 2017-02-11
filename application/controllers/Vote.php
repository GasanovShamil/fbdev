<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// require_once(dirname(__FILE__).'/../popo/User.php');

	class Vote extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();

			$this->load->model('ContestService');
			$this->load->model('PhotoService');
		}

		public function index() {
			$permissions = ['email', 'user_likes', 'user_photos', 'user_birthday', 'user_friends'];

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
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/1158724760874896/', $permissions);
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions($permissions)) {
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

				$user = new User(
					$result['id'],
					$result['first_name'],
					$result['last_name'],
					$result['email'],
					$result['birthday'],
					$result['gender'],
					$_SESSION['facebook-access-token']
				);

				$exists = $this->UserService->exists($result['id']);

				if (isset($exists)) {
					$this->UserService->updateUser($user);
				} else {
					$this->UserService->addUser($user);
				}

				$data['isAdmin'] = $this->fblib->isAdmin();
				$this->load->view('structure/header', $data);

				$data['firstName'] = $user->firstName;
				$this->load->view('index', $data);

				$this->load->view('structure/footer');
			}
		}
	}