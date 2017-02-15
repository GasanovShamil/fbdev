<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require_once(dirname(__FILE__).'/../libraries/appconfig.php');
	require_once(dirname(__FILE__).'/../viewModels/Album.php');
	require_once(dirname(__FILE__).'/../viewModels/Photo.php');

	class Cron extends CI_Controller {

		private $facebook;

		public function __construct() {
			parent::__construct();

			$this->load->library('fblib');
			$this->facebook = $this->fblib->getFacebook();
		}

		public function index() {
			$this->load->model('ContestService');
			$contest = $this->ContestService->dailyCheckCurrentContest();

			if ($contest != null) {
				$this->load->model('PhotoService');
				$participants = $this->PhotoService->getParticipants($contest);

				$this->fblib->massPublish(
					$contest->name,
					'Félicitations à PRENOM NOM !',
					$participants,
					$winningPhoto
				);

				//SEND MAIL
			}

			$this->ContestService->dailyCheckFutureContest();			
		}
	}