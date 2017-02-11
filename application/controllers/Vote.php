<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	 require_once(dirname(__FILE__).'/../popo/Contest.php');

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
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::app_id().'/', appconfig::app_permissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				$currentContest = $this->ContestService->getCurrentContest();

				$data['isAdmin'] = $this->fblib->isAdmin();
				$this->load->view('structure/header', $data);

				if (isset($currentContest)) {
					$data['start'] = $currentContest->startDate;
					$data['end'] = $currentContest->endDate;
					$data['photos'] = $this->PhotoService->getPhotosOfContest($currentContest->contestId);
					$this->load->view('vote', $data);
				} else {
					// TODO : show no active contest
					$data['test'] = 'NO CONTEST';
					$this->load->view('showtest', $data);
				}

				$this->load->view('structure/footer');
			}
		}
	}