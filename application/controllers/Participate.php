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
					$this->load->model('PhotoService');
					$hasParticipated = $this->PhotoService->hasParticipated($_SESSION['facebook-user-id'], $currentContest->id);

					if ($currentContest->multiple || !$hasParticipated) {
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
					} else {
						$data['alert'] = 'Vous avez déjà participé au concours !';
					}

					$this->load->view('participate', $data);
				} else {
					$data['contest'] = $this->ContestService->getNextContest();
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

		public function participate() {
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
					$photo = $this->input->post('photo');

					$this->load->model('PhotoService');
					$this->PhotoService->addPhoto($currentContest->id, $photo, $_SESSION['facebook-user-id']);

					$this->load->model('UserService');
					$user = $this->UserService->getUser($_SESSION['facebook-user-id']);

					$response = $this->fblib->publish(
						$currentContest->name,
						'Je viens de m\'inscrire au concours, venez voter pour moi !',
						$user,
						$photo,
						true
					);

					redirect('/vote/index');
				}
			}
		}

		public function uploadPhoto() {
			echo 'ta mere la timpe';
			if (!$this->fblib->checkAccessToken()) {
				echo 'ta mere me pépom tte la nuit';
				$redirectHelper = $this->facebook->getRedirectLoginHelper();
				$loginUrl = $redirectHelper->getLoginUrl('https://www.facebook.com/projetconcourphoto/app/'.appconfig::getAppId().'/', appconfig::getAppPermissions());
				$this->fblib->jsRedirect($loginUrl);
			} else if (!$this->fblib->checkPermissions()) {
				echo 'ta mere la pute a bougnoule';
				$rerequestUrl = $_SESSION['rerequest-url'];
				$this->fblib->jsRedirect($rerequestUrl);
			} else {
				echo '. . .';
				$path = $this->input->post('path');
				$description = $this->input->post('description');

				if ($description == null) $description = 'PhotoUp - Concours PARDON MAMAN';


				if ($path != null) {
					$data = [
						'message' => $description,
						'source' => $fb->fileToUpload($path)
					];

					try {
						$response = $fb->post('/me/photos', $data);
						$node = $response->getGraphNode();
						$photo = $node['id'];

						$response = $this->facebook->get('/'.$photo.'?fields=picture');
						$result = $response->getDecodedBody();

						$_POST['photo'] = $result['picture'];

						redirect('/participate/participate');
					} catch(Exception $e) {
						$data['test'] = 'Un problème est survenu.';
						$this->load->view('showtest.php', $data);
					}
				}
			}
		}
	}