<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/appconfig.php');
	require_once(dirname(__FILE__).'/../viewModels/Album.php');

	class Participate extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();

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
				$this->load->model('ContestService');
				$this->load->model('PhotoService');

				$currentContest = $this->ContestService->getCurrentContest();

				$this->load->view('structure/header');

				if (isset($currentContest)) {
					$response = $this->facebook->get('/me/albums?fields=id,name,picture');
					$result = $response->getDecodedBody();

					$albums = array();

					foreach ($result['data'] as $album) {
						$albums[] = new Album(
								$result['id'],
								$result['name'],
								$result['picture']['url']
							);
					}
					$data['result'] = $result;
					$data['resultData'] = $result['data'];
					$data['contest'] = $currentContest;
					$data['albums'] = $albums;
					$data['url'] = base_url();
					$this->load->view('participate', $data);
				} else {
					$data['contest'] = getNextContest();
					$this->load->view('no-contest', $data);
				}

				$this->load->view('structure/footer');
			}
		}

		public function showPhotosOfAlbum($albumId) {
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
	}