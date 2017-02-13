<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/appconfig.php');
	// require_once(dirname(__FILE__).'/../viewModels/Contest.php');

	class Vote extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();

			$this->load->model('ContestService');
			$this->load->model('PhotoService');
			$this->load->model('VoteService');
		}

		public function index() {
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				$currentContest = $this->ContestService->getCurrentContest();

				$this->load->view('structure/header');

				if (isset($currentContest)) {
					$data['contest'] = $currentContest;
					$data['photos'] = $this->PhotoService->getPhotosOfContest($currentContest->contestId);
					$data['url'] = $this->base_url();
					$this->load->view('vote', $data);
				} else {
					// TODO : show no active contest
					$data['test'] = 'NO CONTEST';
					$this->load->view('showtest', $data);
				}

				$this->load->view('structure/footer');
			}
		}

		public function vote($photo) {
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				$this->VoteService->vote($_SESSION['facebook-user-id'], $photo);
			}
		}

		public function unvote($photo) {
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				$this->VoteService->unvote($_SESSION['facebook-user-id'], $photo);
			}
		}
	}