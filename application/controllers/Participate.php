<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/appconfig.php');
	require_once(dirname(__FILE__).'/../viewModels/Album.php');
	require_once(dirname(__FILE__).'/../viewModels/Photo.php');

	class Participate extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();
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
				$currentContest = $this->ContestService->getCurrentContest();

				$data['links'] = array(
					'<link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/style/box.css" />',
					'<link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/style/participate.css" />',
					'<script type="text/javascript" src="'.base_url().'assets/js/scripts/participate.js"></script>'
				);
				$this->load->view('structure/header', $data);

				if (isset($currentContest)) {
					$response = $this->facebook->get('/me/albums?fields=id,name,picture{url}');
					$result = $response->getDecodedBody();

					$albums = array();

					if (array_key_exists('data', $result)) {
						foreach ($result['data'] as $album) {
							$albums[] = new Album(
									$album['id'],
									$album['name'],
									$album['picture']['data']['url']
								);
						}
					}
					
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

		public function showPhotosOfAlbum($album) {
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				$response = $this->facebook->get('/'.$album.'?fields=photos{id,images{source}}');
				$result = $response->getDecodedBody();

				$photos = array();

				if (array_key_exists('photos', $result)) {
					foreach ($result['photos']['data'] as $photo) {
						$photos[] = new Photo($photo['id'], '', $photo['images'][0]['source'], 0, 0);
					}
				}

				$data['photos'] = $photos;
				$this->load->view('templates/participate-list-photos', $data);
			}
		}

		public function participate($photo) {
			if (!$this->fblib->checkAccessToken()) {
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				$this->load->model('ContestService');
				$currentContest = $this->ContestService->getCurrentContest();

				if (isset($currentContest)) {
					$this->load->model('PhotoService');
					$currentContest = $this->PhotoService->addPhoto($currentContest->id, $photo, $_SESSION['facebook-user-id']);
					$this->fblib->jsRedirect(base_url().'vote/index');
				}
			}
		}
	}