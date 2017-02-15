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

			$this->load->library('maillib');
		}

		public function index() {
			$this->load->model('ContestService');
			$contest = $this->ContestService->dailyCheckCurrentContest();

			if ($contest != null) {
				$this->load->model('PhotoService');
				$participants = $this->PhotoService->getParticipants($contest->id);

				$winnersId = array();
				$winnersName = array();
				$winnersEmail = array();
				$max = 0;

				foreach ($participants as $participant) {
					if ($participant->nbVotes == $max) {
						$winnersId[] = $participant->facebookId;
						$winnersName[] = $participant->getFullName();
						$winnersEmail[] = $participant->email;
					} else if ($participant->nbVotes > $max) {
						$winnersId = array();
						$winnersName = array();
						$winnersEmail = array();

						$winnersId[] = $participant->facebookId;
						$winnersName[] = $participant->getFullName();
						$winnersEmail[] = $participant->email;

						$max = $participant->nbVotes;
					}
				}

				$data['test'] = $participants;
				$this->load->view('showtest.php', $data);

				$data['test'] = $winners;
				$this->load->view('showtest.php', $data);

				return;

				if (count($winnersId) > 1) {
					$winningPhoto = appconfig::getAppImage();
				} else {
					$this->load->model('VoteService');
					$winningPhoto = $this->VoteService->getMaxPhotoFromUser($winnersId[0], $contest->id);
				}

				$this->fblib->massPublish(
					$contest->name,
					'Félicitations à '.join(', ', $winnersName).' !!',
					$winnersEmail,
					$winningPhoto
				);

				$this->load->model('UserService');
				$admins = $this->fblib->getAdmins();
				$recipients = array();

				foreach ($admins['data'] as $value) {
					if ($value['role'] == 'administrators') {
						$admin = $this->UserService->getUser($value['user']);

						if ($admin != null) {
							$recipients[] = $admin->email;
						}
					}
				}

				$result = 'Concours : '.$contest->name;
				$result .= '<br>Prix : '.$contest->prize;
				$result .= '<br>Début : '.$contest->start;
				$result .= '<br>Fin : '.$contest->end;
				$result .= '<br>Vainqueur(s) : '.join(', ', $winners);
				$result .= '<br>Nombre participant(s) : '.count($participants);

				$this->maillib->sendMail($recipients, $result);

				$this->ContestService->stopContest($contest->id);
			}

			$this->ContestService->dailyCheckFutureContest();			
		}
	}